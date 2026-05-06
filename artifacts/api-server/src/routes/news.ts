import { Router, type IRouter } from "express";
import { db, newsTable, insertNewsSchema } from "@workspace/db";
import { and, desc, eq } from "drizzle-orm";
import { requireAdmin } from "../middlewares/auth";

const router: IRouter = Router();

router.get("/news", async (_req, res) => {
  const rows = await db
    .select()
    .from(newsTable)
    .where(eq(newsTable.published, true))
    .orderBy(desc(newsTable.publishedAt));
  return res.json(rows);
});

router.get("/news/:id", async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const rows = await db
    .select()
    .from(newsTable)
    .where(and(eq(newsTable.id, id), eq(newsTable.published, true)))
    .limit(1);
  if (!rows[0]) return res.status(404).json({ error: "Not found" });
  return res.json(rows[0]);
});

router.post("/admin/news", requireAdmin, async (req, res) => {
  const parsed = insertNewsSchema.safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.insert(newsTable).values(parsed.data).returning();
  return res.status(201).json(row);
});

router.patch("/admin/news/:id", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const parsed = insertNewsSchema.partial().safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.update(newsTable).set(parsed.data).where(eq(newsTable.id, id)).returning();
  if (!row) return res.status(404).json({ error: "Not found" });
  return res.json(row);
});

router.delete("/admin/news/:id", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  await db.delete(newsTable).where(eq(newsTable.id, id));
  return res.status(204).end();
});

export default router;
