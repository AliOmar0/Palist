import { Router, type IRouter } from "express";
import { db, eventsTable, insertEventSchema } from "@workspace/db";
import { and, desc, eq } from "drizzle-orm";
import { requireAdmin } from "../middlewares/auth";
import { auditAdmin } from "../middlewares/audit";

const router: IRouter = Router();

router.get("/events", async (_req, res) => {
  const rows = await db
    .select()
    .from(eventsTable)
    .where(eq(eventsTable.published, true))
    .orderBy(desc(eventsTable.startsAt));
  return res.json(rows);
});

router.get("/events/:id", async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const rows = await db
    .select()
    .from(eventsTable)
    .where(and(eq(eventsTable.id, id), eq(eventsTable.published, true)))
    .limit(1);
  if (!rows[0]) return res.status(404).json({ error: "Not found" });
  return res.json(rows[0]);
});

router.post("/admin/events", requireAdmin, auditAdmin("event"), async (req, res) => {
  const parsed = insertEventSchema.safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.insert(eventsTable).values(parsed.data).returning();
  return res.status(201).json(row);
});

router.patch("/admin/events/:id", requireAdmin, auditAdmin("event"), async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const parsed = insertEventSchema.partial().safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db
    .update(eventsTable)
    .set(parsed.data)
    .where(eq(eventsTable.id, id))
    .returning();
  if (!row) return res.status(404).json({ error: "Not found" });
  return res.json(row);
});

router.delete("/admin/events/:id", requireAdmin, auditAdmin("event"), async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  await db.delete(eventsTable).where(eq(eventsTable.id, id));
  return res.status(204).end();
});

export default router;
