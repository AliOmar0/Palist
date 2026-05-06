import type { NextFunction, Request, Response } from "express";
import { getAuth, clerkClient } from "@clerk/express";
import { db, usersTable } from "@workspace/db";
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
  const cu = await clerkClient.users.getUser(userId);
  const email = cu.emailAddresses?.[0]?.emailAddress ?? "";
  const desiredRole = isAdminEmail(email) ? "admin" : "member";

  const existing = await db.select().from(usersTable).where(eq(usersTable.id, userId)).limit(1);
  if (existing.length > 0) {
    if (existing[0]!.role !== desiredRole) {
      await db.update(usersTable).set({ role: desiredRole }).where(eq(usersTable.id, userId));
    }
    return desiredRole;
  }

  await db
    .insert(usersTable)
    .values({
      id: userId,
      email,
      firstName: cu.firstName ?? null,
      lastName: cu.lastName ?? null,
      imageUrl: cu.imageUrl ?? null,
      role: desiredRole,
    })
    .onConflictDoNothing();
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
