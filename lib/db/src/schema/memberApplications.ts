import { pgTable, serial, text, timestamp, varchar } from "drizzle-orm/pg-core";
import { createInsertSchema } from "drizzle-zod";
import { z } from "zod/v4";

export const memberApplicationsTable = pgTable("member_applications", {
  id: serial("id").primaryKey(),
  userId: varchar("user_id", { length: 64 }),
  fullName: text("full_name").notNull(),
  email: text("email").notNull(),
  phone: varchar("phone", { length: 40 }),
  nationalId: varchar("national_id", { length: 40 }),
  city: varchar("city", { length: 100 }),
  university: text("university"),
  major: text("major"),
  graduationYear: varchar("graduation_year", { length: 8 }),
  employer: text("employer"),
  jobTitle: text("job_title"),
  yearsExperience: varchar("years_experience", { length: 16 }),
  membershipTier: varchar("membership_tier", { length: 40 }),
  notes: text("notes"),
  status: varchar("status", { length: 20 }).notNull().default("pending"),
  reviewedBy: varchar("reviewed_by", { length: 64 }),
  reviewedAt: timestamp("reviewed_at", { withTimezone: true }),
  createdAt: timestamp("created_at", { withTimezone: true }).notNull().defaultNow(),
  updatedAt: timestamp("updated_at", { withTimezone: true })
    .notNull()
    .defaultNow()
    .$onUpdate(() => new Date()),
});

export const insertMemberApplicationSchema = createInsertSchema(memberApplicationsTable).omit({
  id: true,
  status: true,
  reviewedBy: true,
  reviewedAt: true,
  createdAt: true,
  updatedAt: true,
});
export type InsertMemberApplication = z.infer<typeof insertMemberApplicationSchema>;
export type MemberApplication = typeof memberApplicationsTable.$inferSelect;
