import { boolean, pgTable, serial, text, timestamp, varchar } from "drizzle-orm/pg-core";
import { createInsertSchema } from "drizzle-zod";
import { z } from "zod/v4";

export const jobsTable = pgTable("jobs", {
  id: serial("id").primaryKey(),
  titleAr: text("title_ar").notNull(),
  titleEn: text("title_en"),
  company: text("company").notNull(),
  companyLogo: text("company_logo"),
  location: varchar("location", { length: 160 }),
  employmentType: varchar("employment_type", { length: 40 }),
  category: varchar("category", { length: 80 }),
  descriptionAr: text("description_ar"),
  descriptionEn: text("description_en"),
  applyUrl: text("apply_url"),
  contactEmail: text("contact_email"),
  createdBy: varchar("created_by", { length: 64 }),
  published: boolean("published").notNull().default(true),
  expiresAt: timestamp("expires_at", { withTimezone: true }),
  createdAt: timestamp("created_at", { withTimezone: true }).notNull().defaultNow(),
  updatedAt: timestamp("updated_at", { withTimezone: true })
    .notNull()
    .defaultNow()
    .$onUpdate(() => new Date()),
});

export const insertJobSchema = createInsertSchema(jobsTable).omit({
  id: true,
  createdBy: true,
  createdAt: true,
  updatedAt: true,
});
export type InsertJob = z.infer<typeof insertJobSchema>;
export type Job = typeof jobsTable.$inferSelect;

export const jobApplicationsTable = pgTable("job_applications", {
  id: serial("id").primaryKey(),
  jobId: serial("job_id").notNull(),
  userId: varchar("user_id", { length: 64 }).notNull(),
  fullName: text("full_name").notNull(),
  email: text("email").notNull(),
  phone: varchar("phone", { length: 40 }),
  coverLetter: text("cover_letter"),
  resumeUrl: text("resume_url"),
  createdAt: timestamp("created_at", { withTimezone: true }).notNull().defaultNow(),
});

export const insertJobApplicationSchema = createInsertSchema(jobApplicationsTable).omit({
  id: true,
  userId: true,
  createdAt: true,
});
export type InsertJobApplication = z.infer<typeof insertJobApplicationSchema>;
export type JobApplication = typeof jobApplicationsTable.$inferSelect;
