import { Router, type IRouter } from "express";
import { db, usersTable, adminAuditLogTable } from "@workspace/db";
import { asc, eq } from "drizzle-orm";
import { requireAdmin, type AuthedRequest } from "../middlewares/auth";

const router: IRouter = Router();

// The first/root admin email is never allowed to be demoted by another admin.
// Falls back to the first entry in ADMIN_EMAILS if PRIMARY_ADMIN_EMAIL is unset.
function primaryAdminEmail(): string | null {
  const explicit = process.env["PRIMARY_ADMIN_EMAIL"]?.trim().toLowerCase();
  if (explicit) return explicit;
  const list = (process.env["ADMIN_EMAILS"] ?? "")
    .split(",")
    .map((s) => s.trim().toLowerCase())
    .filter(Boolean);
  return list[0] ?? null;
}

router.get("/admin/users", requireAdmin, async (_req, res) => {
  const rows = await db
    .select({
      id: usersTable.id,
      email: usersTable.email,
      firstName: usersTable.firstName,
      lastName: usersTable.lastName,
      imageUrl: usersTable.imageUrl,
      role: usersTable.role,
      fullNameAr: usersTable.fullNameAr,
      fullNameEn: usersTable.fullNameEn,
      nationalId: usersTable.nationalId,
      specialty: usersTable.specialty,
      mobile: usersTable.mobile,
      workplace: usersTable.workplace,
      alternateEmail: usersTable.alternateEmail,
      accountStatus: usersTable.accountStatus,
      approvedAt: usersTable.approvedAt,
      approvalNotifiedAt: usersTable.approvalNotifiedAt,
      createdAt: usersTable.createdAt,
    })
    .from(usersTable)
    .orderBy(asc(usersTable.createdAt));
  const primary = primaryAdminEmail();
  return res.json(
    rows.map((u) => ({
      ...u,
      isPrimaryAdmin: primary != null && u.email.toLowerCase() === primary,
    })),
  );
});

router.patch("/admin/users/:id/status", requireAdmin, async (req, res) => {
  const id = String(req.params.id);
  const body = req.body as { accountStatus?: unknown } | undefined;
  const accountStatus = body?.accountStatus;
  if (
    accountStatus !== "pending" &&
    accountStatus !== "approved" &&
    accountStatus !== "rejected"
  ) {
    return res.status(400).json({ error: "accountStatus must be pending, approved, or rejected" });
  }

  const target = await db.select().from(usersTable).where(eq(usersTable.id, id)).limit(1);
  if (!target[0]) return res.status(404).json({ error: "Not found" });

  const primary = primaryAdminEmail();
  const isPrimary = primary != null && target[0].email.toLowerCase() === primary;
  if (isPrimary && accountStatus !== "approved") {
    return res.status(403).json({ error: "Primary admin account must stay approved" });
  }

  const actor = req as AuthedRequest;
  const now = new Date();
  const [row] = await db
    .update(usersTable)
    .set({
      accountStatus,
      approvedBy: accountStatus === "approved" ? actor.userId : null,
      approvedAt: accountStatus === "approved" ? now : null,
      approvalNotifiedAt: accountStatus === "approved" ? now : null,
    })
    .where(eq(usersTable.id, id))
    .returning();

  await db
    .insert(adminAuditLogTable)
    .values({
      actorUserId: actor.userId,
      actorEmail: null,
      action: accountStatus === "approved" ? "account_approved" : "account_status",
      entityType: "user",
      entityId: id,
      payload: {
        email: target[0].email,
        accountStatus,
        activationNoticeQueued: accountStatus === "approved",
      } as never,
    })
    .catch(() => {
      /* swallow audit failures */
    });

  return res.json(row);
});

router.patch("/admin/users/:id/role", requireAdmin, async (req, res) => {
  const id = String(req.params.id);
  const body = req.body as { role?: unknown } | undefined;
  const role = body?.role;
  if (role !== "admin" && role !== "member") {
    return res.status(400).json({ error: "role must be 'admin' or 'member'" });
  }

  const target = await db.select().from(usersTable).where(eq(usersTable.id, id)).limit(1);
  if (!target[0]) return res.status(404).json({ error: "Not found" });

  const primary = primaryAdminEmail();
  const isPrimary = primary != null && target[0].email.toLowerCase() === primary;
  if (isPrimary && role !== "admin") {
    return res.status(403).json({ error: "Primary admin cannot be demoted" });
  }

  const actor = req as AuthedRequest;
  if (actor.userId === id && role !== "admin") {
    return res.status(403).json({ error: "You cannot demote yourself" });
  }

  const [row] = await db
    .update(usersTable)
    .set({ role })
    .where(eq(usersTable.id, id))
    .returning();

  await db
    .insert(adminAuditLogTable)
    .values({
      actorUserId: actor.userId,
      actorEmail: null,
      action: role === "admin" ? "promote" : "demote",
      entityType: "user",
      entityId: id,
      payload: { email: target[0].email, role } as never,
    })
    .catch(() => {
      /* swallow audit failures */
    });

  return res.json(row);
});

export default router;
