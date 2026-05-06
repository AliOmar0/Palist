import { Router, type IRouter } from "express";
import {
  db,
  contactSubmissionsTable,
  insertContactSubmissionSchema,
} from "@workspace/db";
import { desc, eq } from "drizzle-orm";
import { requireAdmin } from "../middlewares/auth";

const router: IRouter = Router();

router.post("/contact", async (req, res) => {
  const parsed = insertContactSubmissionSchema.safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.insert(contactSubmissionsTable).values(parsed.data).returning();
  return res.status(201).json(row);
});

router.get("/admin/contact", requireAdmin, async (_req, res) => {
  const rows = await db
    .select()
    .from(contactSubmissionsTable)
    .orderBy(desc(contactSubmissionsTable.createdAt));
  return res.json(rows);
});

router.patch("/admin/contact/:id/read", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const [row] = await db
    .update(contactSubmissionsTable)
    .set({ read: true })
    .where(eq(contactSubmissionsTable.id, id))
    .returning();
  if (!row) return res.status(404).json({ error: "Not found" });
  return res.json(row);
});

export default router;
