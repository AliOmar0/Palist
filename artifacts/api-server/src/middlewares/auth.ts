import type { NextFunction, Request, Response } from "express";
import { getAuth, clerkClient } from "@clerk/express";
import { adminAuditLogTable, db, usersTable } from "@workspace/db";
import { eq } from "drizzle-orm";

export type AuthedRequest = Request & { userId: string; userRole: string };

function isAdminEmail(email: string): boolean {
  const list = (process.env["ADMIN_EMAILS"] ?? "")
    .split(",")
    .map((s) => s.trim().toLowerCase())
    .filter(Boolean);
  return list.includes(email.toLowerCase());
}

async function syncUser(userId: string): Promise<string> {
  // ADMIN_EMAILS is a BOOTSTRAP mechanism: it only takes effect when the user
  // row is first created. After that, `users.role` is the sole source of truth.
  // This means an admin demoted via the in-app Admins UI stays demoted across
  // sign-ins, even if their email is still listed in ADMIN_EMAILS — without
  // this, the env list would silently revert every audited demotion.
  const existing = await db.select().from(usersTable).where(eq(usersTable.id, userId)).limit(1);
  if (existing.length > 0) {
    return existing[0]!.role;
  }

  // First-time sign-in: fetch profile from Clerk and create the user row.
  // ADMIN_EMAILS is consulted exactly once here.
  const cu = await clerkClient.users.getUser(userId);
  const email = cu.emailAddresses?.[0]?.emailAddress ?? "";
  const desiredRole = isAdminEmail(email) ? "admin" : "member";
  const accountStatus = desiredRole === "admin" ? "approved" : "pending";
  await db
    .insert(usersTable)
    .values({
      id: userId,
      email,
      firstName: cu.firstName ?? null,
      lastName: cu.lastName ?? null,
      imageUrl: cu.imageUrl ?? null,
      role: desiredRole,
      accountStatus,
      approvedAt: accountStatus === "approved" ? new Date() : null,
    })
    .onConflictDoNothing();

  if (accountStatus === "pending") {
    await db
      .insert(adminAuditLogTable)
      .values({
        actorUserId: userId,
        actorEmail: email,
        action: "signup_request",
        entityType: "user",
        entityId: userId,
        payload: {
          email,
          firstName: cu.firstName ?? null,
          lastName: cu.lastName ?? null,
          adminEmails: process.env["ADMIN_EMAILS"] ?? "",
        } as never,
      })
      .catch(() => {
        /* swallow audit failures */
      });
  }
  return desiredRole;
}

export async function requireAuth(req: Request, res: Response, next: NextFunction): Promise<void> {
  const auth = getAuth(req);
  const userId = auth?.userId;
  if (!userId) {
    res.status(401).json({ error: "Unauthorized" });
    return;
  }
  try {
    const role = await syncUser(userId);
    (req as AuthedRequest).userId = userId;
    (req as AuthedRequest).userRole = role;
    next();
  } catch (err) {
    (req as Request & { log?: { error: (...a: unknown[]) => void } }).log?.error({ err }, "auth sync failed");
    res.status(500).json({ error: "Auth sync failed" });
  }
}

export async function requireAdmin(req: Request, res: Response, next: NextFunction): Promise<void> {
  await requireAuth(req, res, () => {
    if ((req as AuthedRequest).userRole !== "admin") {
      res.status(403).json({ error: "Forbidden" });
      return;
    }
    next();
  });
}
