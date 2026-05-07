import { Router, type IRouter } from "express";
import { db, adminAuditLogTable } from "@workspace/db";
import { desc } from "drizzle-orm";
import { requireAdmin } from "../middlewares/auth";

const router: IRouter = Router();

router.get("/admin/audit", requireAdmin, async (_req, res) => {
  const rows = await db
    .select()
    .from(adminAuditLogTable)
    .orderBy(desc(adminAuditLogTable.createdAt))
    .limit(200);
  return res.json(rows);
});

export default router;
