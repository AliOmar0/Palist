import { Router, type IRouter } from "express";
import { db, boardMembersTable, insertBoardMemberSchema } from "@workspace/db";
import { asc, eq } from "drizzle-orm";
import { requireAdmin } from "../middlewares/auth";
import { auditAdmin } from "../middlewares/audit";

const router: IRouter = Router();

router.get("/board-members", async (_req, res) => {
  const rows = await db
    .select()
    .from(boardMembersTable)
    .where(eq(boardMembersTable.active, true))
    .orderBy(asc(boardMembersTable.displayOrder), asc(boardMembersTable.id));
  return res.json(rows);
});

router.get("/admin/board-members", requireAdmin, async (_req, res) => {
  const rows = await db
    .select()
    .from(boardMembersTable)
    .orderBy(asc(boardMembersTable.displayOrder), asc(boardMembersTable.id));
  return res.json(rows);
});

router.post("/admin/board-members", requireAdmin, auditAdmin("board_member"), async (req, res) => {
  const parsed = insertBoardMemberSchema.safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.insert(boardMembersTable).values(parsed.data).returning();
  return res.status(201).json(row);
});

router.patch("/admin/board-members/:id", requireAdmin, auditAdmin("board_member"), async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const parsed = insertBoardMemberSchema.partial().safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db
    .update(boardMembersTable)
    .set(parsed.data)
    .where(eq(boardMembersTable.id, id))
    .returning();
  if (!row) return res.status(404).json({ error: "Not found" });
  return res.json(row);
});

router.delete("/admin/board-members/:id", requireAdmin, auditAdmin("board_member"), async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  await db.delete(boardMembersTable).where(eq(boardMembersTable.id, id));
  return res.status(204).end();
});

export default router;
