import { Router, type IRouter } from "express";
import { adminAuditLogTable, db, usersTable } from "@workspace/db";
import { eq } from "drizzle-orm";
import { requireAuth, type AuthedRequest } from "../middlewares/auth";

const router: IRouter = Router();
const PROFILE_FIELDS = [
  "firstName",
  "lastName",
  "fullNameAr",
  "fullNameEn",
  "nationalId",
  "nationalIdImageUrl",
  "specialty",
  "mobile",
  "workplace",
  "alternateEmail",
] as const;

router.get("/me", requireAuth, async (req, res) => {
  const rows = await db.select().from(usersTable).where(eq(usersTable.id, (req as AuthedRequest).userId!)).limit(1);
  if (!rows[0]) return res.status(404).json({ error: "Not found" });
  return res.json(rows[0]);
});

router.patch("/me/profile", requireAuth, async (req, res) => {
  const userId = (req as AuthedRequest).userId!;
  const [existing] = await db.select().from(usersTable).where(eq(usersTable.id, userId)).limit(1);
  if (!existing) return res.status(404).json({ error: "Not found" });

  const body = req.body && typeof req.body === "object" ? (req.body as Record<string, unknown>) : {};
  const update: Record<string, unknown> = {};
  const changedFields: string[] = [];

  for (const field of PROFILE_FIELDS) {
    if (!(field in body)) continue;
    const nextRaw = body[field];
    if (nextRaw != null && typeof nextRaw !== "string") {
      return res.status(400).json({ error: `${field} must be a string` });
    }
    const next = typeof nextRaw === "string" ? nextRaw.trim() || null : null;
    const current = existing[field] ?? null;
    if (next !== current) {
      update[field] = next;
      changedFields.push(field);
    }
  }

  if (changedFields.length === 0) return res.json(existing);

  const [row] = await db.update(usersTable).set(update).where(eq(usersTable.id, userId)).returning();

  await db
    .insert(adminAuditLogTable)
    .values({
      actorUserId: userId,
      actorEmail: existing.email,
      action: "profile_update",
      entityType: "user_profile",
      entityId: userId,
      payload: { changedFields, adminEmails: process.env["ADMIN_EMAILS"] ?? "" } as never,
    })
    .catch(() => {
      /* swallow audit failures */
    });

  return res.json(row);
});

export default router;
