import { Router, type IRouter } from "express";
import {
  db,
  memberApplicationsTable,
  insertMemberApplicationSchema,
} from "@workspace/db";
import { and, desc, eq, inArray } from "drizzle-orm";
import { requireAuth, requireAdmin, type AuthedRequest } from "../middlewares/auth";
import { auditAdmin } from "../middlewares/audit";

const router: IRouter = Router();

router.post("/membership/apply", requireAuth, async (req, res) => {
  const userId = (req as AuthedRequest).userId!;
  const existing = await db
    .select({ id: memberApplicationsTable.id, status: memberApplicationsTable.status })
    .from(memberApplicationsTable)
    .where(
      and(
        eq(memberApplicationsTable.userId, userId),
        inArray(memberApplicationsTable.status, ["pending", "approved"]),
      ),
    )
    .limit(1);
  if (existing.length > 0) {
    return res.status(409).json({
      error: "You already have an active application",
      code: "duplicate_application",
      status: existing[0]!.status,
    });
  }
  const parsed = insertMemberApplicationSchema.safeParse({ ...req.body, userId });
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.insert(memberApplicationsTable).values(parsed.data).returning();
  return res.status(201).json(row);
});

router.get("/membership/me", requireAuth, async (req, res) => {
  const rows = await db
    .select()
    .from(memberApplicationsTable)
    .where(eq(memberApplicationsTable.userId, (req as AuthedRequest).userId!))
    .orderBy(desc(memberApplicationsTable.createdAt));
  return res.json(rows);
});

router.get("/admin/applications", requireAdmin, async (_req, res) => {
  const rows = await db
    .select()
    .from(memberApplicationsTable)
    .orderBy(desc(memberApplicationsTable.createdAt));
  return res.json(rows);
});

router.patch(
  "/admin/applications/:id",
  requireAdmin,
  auditAdmin("membership"),
  async (req, res) => {
    const id = Number(req.params.id);
    if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
    const status = String(req.body?.status ?? "");
    if (!["pending", "approved", "rejected"].includes(status)) {
      return res.status(400).json({ error: "Invalid status" });
    }
    const [existing] = await db
      .select()
      .from(memberApplicationsTable)
      .where(eq(memberApplicationsTable.id, id))
      .limit(1);
    if (!existing) return res.status(404).json({ error: "Not found" });

    const update: Record<string, unknown> = {
      status,
      reviewedBy: (req as AuthedRequest).userId!,
      reviewedAt: new Date(),
    };
    if (status === "approved") {
      const expires = new Date();
      expires.setFullYear(expires.getFullYear() + 1);
      update["expiresAt"] = expires;
      // Idempotent: keep existing membership number on re-approval.
      if (!existing.membershipNumber) {
        update["membershipNumber"] = `PIT-${new Date().getFullYear()}-${String(id).padStart(6, "0")}`;
      }
    }
    const [row] = await db
      .update(memberApplicationsTable)
      .set(update)
      .where(eq(memberApplicationsTable.id, id))
      .returning();
    return res.json(row);
  },
);

export default router;
