import { pgTable, text, timestamp, varchar } from "drizzle-orm/pg-core";
import { createInsertSchema } from "drizzle-zod";
import { z } from "zod/v4";

export const usersTable = pgTable("users", {
  id: varchar("id", { length: 64 }).primaryKey(),
  email: text("email").notNull(),
  firstName: text("first_name"),
  lastName: text("last_name"),
  imageUrl: text("image_url"),
  fullNameAr: text("full_name_ar"),
  fullNameEn: text("full_name_en"),
  nationalId: varchar("national_id", { length: 40 }),
  nationalIdImageUrl: text("national_id_image_url"),
  specialty: text("specialty"),
  mobile: varchar("mobile", { length: 40 }),
  workplace: text("workplace"),
  alternateEmail: text("alternate_email"),
  accountStatus: varchar("account_status", { length: 20 }).notNull().default("pending"),
  approvedBy: varchar("approved_by", { length: 64 }),
  approvedAt: timestamp("approved_at", { withTimezone: true }),
  approvalNotifiedAt: timestamp("approval_notified_at", { withTimezone: true }),
  role: varchar("role", { length: 20 }).notNull().default("member"),
  createdAt: timestamp("created_at", { withTimezone: true }).notNull().defaultNow(),
  updatedAt: timestamp("updated_at", { withTimezone: true })
    .notNull()
    .defaultNow()
    .$onUpdate(() => new Date()),
});

export const insertUserSchema = createInsertSchema(usersTable).omit({
  createdAt: true,
  updatedAt: true,
});
export type InsertUser = z.infer<typeof insertUserSchema>;
export type User = typeof usersTable.$inferSelect;
