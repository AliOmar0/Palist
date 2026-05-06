import { Router, type IRouter } from "express";
import { db, trainingsTable, insertTrainingSchema } from "@workspace/db";
import { desc, eq } from "drizzle-orm";
import { requireAdmin } from "../middlewares/auth";

const router: IRouter = Router();

router.get("/trainings", async (_req, res) => {
  const rows = await db
    .select()
    .from(trainingsTable)
    .where(eq(trainingsTable.published, true))
    .orderBy(desc(trainingsTable.startsAt));
  return res.json(rows);
});

router.post("/admin/trainings", requireAdmin, async (req, res) => {
  const parsed = insertTrainingSchema.safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.insert(trainingsTable).values(parsed.data).returning();
  return res.status(201).json(row);
});

router.patch("/admin/trainings/:id", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const parsed = insertTrainingSchema.partial().safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db
    .update(trainingsTable)
    .set(parsed.data)
    .where(eq(trainingsTable.id, id))
    .returning();
  if (!row) return res.status(404).json({ error: "Not found" });
  return res.json(row);
});

router.delete("/admin/trainings/:id", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  await db.delete(trainingsTable).where(eq(trainingsTable.id, id));
  return res.status(204).end();
});

export default router;
