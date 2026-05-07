import { Router, type IRouter } from "express";
import {
  db,
  jobsTable,
  insertJobSchema,
  jobApplicationsTable,
  insertJobApplicationSchema,
  memberApplicationsTable,
} from "@workspace/db";
import { and, desc, eq, gt, isNull, or } from "drizzle-orm";
import { requireAuth, requireAdmin, type AuthedRequest } from "../middlewares/auth";
import { auditAdmin } from "../middlewares/audit";

const router: IRouter = Router();

// Public job projection — strips contactEmail and createdBy (PII / internal).
const PUBLIC_JOB_COLS = {
  id: jobsTable.id,
  titleAr: jobsTable.titleAr,
  titleEn: jobsTable.titleEn,
  descriptionAr: jobsTable.descriptionAr,
  descriptionEn: jobsTable.descriptionEn,
  company: jobsTable.company,
  companyLogo: jobsTable.companyLogo,
  location: jobsTable.location,
  employmentType: jobsTable.employmentType,
  category: jobsTable.category,
  applyUrl: jobsTable.applyUrl,
  expiresAt: jobsTable.expiresAt,
  createdAt: jobsTable.createdAt,
};

router.get("/jobs", async (_req, res) => {
  const now = new Date();
  const rows = await db
    .select(PUBLIC_JOB_COLS)
    .from(jobsTable)
    .where(
      and(
        eq(jobsTable.published, true),
        or(isNull(jobsTable.expiresAt), gt(jobsTable.expiresAt, now)),
      ),
    )
    .orderBy(desc(jobsTable.createdAt));
  return res.json(rows);
});

router.get("/jobs/:id", async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const rows = await db
    .select(PUBLIC_JOB_COLS)
    .from(jobsTable)
    .where(eq(jobsTable.id, id))
    .limit(1);
  if (!rows[0]) return res.status(404).json({ error: "Not found" });
  return res.json(rows[0]);
});

// Members-only apply: must have an approved, non-expired member application.
router.post("/jobs/:id/apply", requireAuth, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const userId = (req as AuthedRequest).userId!;
  const now = new Date();

  const approved = await db
    .select({ id: memberApplicationsTable.id })
    .from(memberApplicationsTable)
    .where(
      and(
        eq(memberApplicationsTable.userId, userId),
        eq(memberApplicationsTable.status, "approved"),
        or(
          isNull(memberApplicationsTable.expiresAt),
          gt(memberApplicationsTable.expiresAt, now),
        ),
      ),
    )
    .limit(1);
  if (approved.length === 0) {
    return res.status(403).json({ error: "Active membership required", code: "not_a_member" });
  }

  // Prevent duplicate applications to the same job by the same user.
  const existing = await db
    .select({ id: jobApplicationsTable.id })
    .from(jobApplicationsTable)
    .where(and(eq(jobApplicationsTable.jobId, id), eq(jobApplicationsTable.userId, userId)))
    .limit(1);
  if (existing.length > 0) {
    return res.status(409).json({ error: "Already applied", code: "duplicate_application" });
  }

  const parsed = insertJobApplicationSchema.safeParse({ ...req.body, jobId: id });
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db
    .insert(jobApplicationsTable)
    .values({ ...parsed.data, userId })
    .returning();
  return res.status(201).json(row);
});

router.post("/admin/jobs", requireAdmin, auditAdmin("job"), async (req, res) => {
  const parsed = insertJobSchema.safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db
    .insert(jobsTable)
    .values({ ...parsed.data, createdBy: (req as AuthedRequest).userId })
    .returning();
  return res.status(201).json(row);
});

router.patch("/admin/jobs/:id", requireAdmin, auditAdmin("job"), async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const parsed = insertJobSchema.partial().safeParse(req.body);
  if (!parsed.success) return res.status(400).json({ error: parsed.error.issues });
  const [row] = await db.update(jobsTable).set(parsed.data).where(eq(jobsTable.id, id)).returning();
  if (!row) return res.status(404).json({ error: "Not found" });
  return res.json(row);
});

router.delete("/admin/jobs/:id", requireAdmin, auditAdmin("job"), async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  await db.delete(jobsTable).where(eq(jobsTable.id, id));
  return res.status(204).end();
});

router.get("/admin/jobs/:id/applications", requireAdmin, async (req, res) => {
  const id = Number(req.params.id);
  if (!Number.isFinite(id)) return res.status(400).json({ error: "Bad id" });
  const rows = await db
    .select()
    .from(jobApplicationsTable)
    .where(eq(jobApplicationsTable.jobId, id))
    .orderBy(desc(jobApplicationsTable.createdAt));
  return res.json(rows);
});

export default router;
