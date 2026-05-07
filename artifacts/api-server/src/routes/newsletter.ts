import { Router, type IRouter } from "express";
import { db, newsletterSubscribersTable } from "@workspace/db";
import { desc } from "drizzle-orm";
import { requireAdmin } from "../middlewares/auth";

const router: IRouter = Router();

const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

router.post("/newsletter/subscribe", async (req, res) => {
  const email = String(req.body?.email ?? "").trim().toLowerCase();
  const langRaw = String(req.body?.lang ?? "ar");
  const lang = langRaw === "en" ? "en" : "ar";
  if (!email || email.length > 254 || !EMAIL_RE.test(email)) {
    return res.status(400).json({ error: "Invalid email" });
  }
  try {
    await db
      .insert(newsletterSubscribersTable)
      .values({ email, lang })
      .onConflictDoNothing();
    return res.status(201).json({ ok: true });
  } catch {
    return res.status(500).json({ error: "Failed to subscribe" });
  }
});

router.get("/admin/newsletter", requireAdmin, async (_req, res) => {
  const rows = await db
    .select()
    .from(newsletterSubscribersTable)
    .orderBy(desc(newsletterSubscribersTable.createdAt));
  return res.json(rows);
});

export default router;
