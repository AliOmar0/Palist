import { Router, type IRouter } from "express";
import {
  db,
  memberApplicationsTable,
  insertMemberApplicationSchema,
} from "@workspace/db";
import { desc, eq } from "drizzle-orm";
import { requireAuth, requireAdmin, type AuthedRequest } from "../middlewares/auth";

const router: IRouter = Router();

router.post("/membership/apply", requireAuth, async (req, res) => {
  const parsed = insertMemberApplicationSchema.safeParse({
    ...req.body,
    userId: (req as AuthedRequest).userId,
  });
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

router.patch("/admin/applications/:id", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const status = String(req.body?.status ?? "");
  if (!["pending", "approved", "rejected"].includes(status)) {
    return res.status(400).json({ error: "Invalid status" });
  }
  const [row] = await db
    .update(memberApplicationsTable)
    .set({ status, reviewedBy: (req as AuthedRequest).userId!, reviewedAt: new Date() })
    .where(eq(memberApplicationsTable.id, id))
    .returning();
  if (!row) return res.status(404).json({ error: "Not found" });
  return res.json(row);
});

export default router;
