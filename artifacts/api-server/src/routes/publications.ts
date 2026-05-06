import { Router, type IRouter } from "express";
import { db, publicationsTable, insertPublicationSchema } from "@workspace/db";
import { desc, eq } from "drizzle-orm";
import { requireAdmin } from "../middlewares/auth";

const router: IRouter = Router();

router.get("/publications", async (_req, res) => {
  const rows = await db
    .select()
    .from(publicationsTable)
    .where(eq(publicationsTable.published, true))
    .orderBy(desc(publicationsTable.publishedAt));
  return res.json(rows);
});

router.post("/admin/publications", requireAdmin, async (req, res) => {
  const parsed = insertPublicationSchema.safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.insert(publicationsTable).values(parsed.data).returning();
  return res.status(201).json(row);
});

router.patch("/admin/publications/:id", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const parsed = insertPublicationSchema.partial().safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db
    .update(publicationsTable)
    .set(parsed.data)
    .where(eq(publicationsTable.id, id))
    .returning();
  if (!row) return res.status(404).json({ error: "Not found" });
  return res.json(row);
});

router.delete("/admin/publications/:id", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  await db.delete(publicationsTable).where(eq(publicationsTable.id, id));
  return res.status(204).end();
});

export default router;
