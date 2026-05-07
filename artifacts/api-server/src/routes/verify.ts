import { Router, type IRouter } from "express";
import { db, memberApplicationsTable } from "@workspace/db";
import { and, eq } from "drizzle-orm";

const router: IRouter = Router();

const UUID_RE = /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i;

router.get("/verify/:cardId", async (req, res) => {
  const cardId = String(req.params.cardId);
  if (!UUID_RE.test(cardId)) return res.status(400).json({ error: "Bad card id" });
  const rows = await db
    .select({
      fullName: memberApplicationsTable.fullName,
      fullNameEn: memberApplicationsTable.fullNameEn,
      membershipTier: memberApplicationsTable.membershipTier,
      membershipNumber: memberApplicationsTable.membershipNumber,
      status: memberApplicationsTable.status,
      expiresAt: memberApplicationsTable.expiresAt,
      reviewedAt: memberApplicationsTable.reviewedAt,
    })
    .from(memberApplicationsTable)
    .where(
      and(eq(memberApplicationsTable.cardId, cardId), eq(memberApplicationsTable.status, "approved")),
    )
    .limit(1);
  if (!rows[0]) return res.status(404).json({ error: "Not found", valid: false });
  const row = rows[0];
  const valid = !row.expiresAt || row.expiresAt > new Date();
  return res.json({ ...row, valid });
});

export default router;
