import { boolean, integer, pgTable, serial, text, timestamp, uuid, varchar } from "drizzle-orm/pg-core";
import { createInsertSchema } from "drizzle-zod";
import { z } from "zod/v4";

export const memberApplicationsTable = pgTable("member_applications", {
  id: serial("id").primaryKey(),
  userId: varchar("user_id", { length: 64 }),

  fullName: text("full_name").notNull(),
  fullNameEn: text("full_name_en"),
  email: text("email").notNull(),
  confirmEmail: text("confirm_email"),
  phone: varchar("phone", { length: 40 }),
  nationalId: varchar("national_id", { length: 40 }),
  gender: varchar("gender", { length: 16 }),
  dateOfBirth: varchar("date_of_birth", { length: 16 }),
  placeOfBirth: varchar("place_of_birth", { length: 120 }),
  socialStatus: varchar("social_status", { length: 40 }),

  city: varchar("city", { length: 100 }),
  provinceResidence: varchar("province_residence", { length: 80 }),
  governorateAbroad: varchar("governorate_abroad", { length: 120 }),
  motherProvince: varchar("mother_province", { length: 80 }),
  homeAddress: text("home_address"),
  country: varchar("country", { length: 80 }),

  university: text("university"),
  branch: varchar("branch", { length: 80 }),
  major: text("major"),
  average: varchar("average", { length: 16 }),
  graduationYear: varchar("graduation_year", { length: 8 }),

  employer: text("employer"),
  jobTitle: text("job_title"),
  yearsExperience: varchar("years_experience", { length: 16 }),

  membershipTier: varchar("membership_tier", { length: 40 }),
  notes: text("notes"),
  declarationAccepted: boolean("declaration_accepted").notNull().default(false),

  status: varchar("status", { length: 20 }).notNull().default("pending"),
  cardId: uuid("card_id").notNull().defaultRandom(),
  membershipNumber: varchar("membership_number", { length: 32 }),
  expiresAt: timestamp("expires_at", { withTimezone: true }),
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
  cardId: true,
  membershipNumber: true,
  expiresAt: true,
  reviewedBy: true,
  reviewedAt: true,
  createdAt: true,
  updatedAt: true,
});
export type InsertMemberApplication = z.infer<typeof insertMemberApplicationSchema>;
export type MemberApplication = typeof memberApplicationsTable.$inferSelect;

void integer;
