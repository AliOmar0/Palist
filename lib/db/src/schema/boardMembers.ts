import { boolean, integer, pgTable, serial, text, timestamp } from "drizzle-orm/pg-core";
import { createInsertSchema } from "drizzle-zod";
import { z } from "zod/v4";

export const boardMembersTable = pgTable("board_members", {
  id: serial("id").primaryKey(),
  nameAr: text("name_ar").notNull(),
  nameEn: text("name_en"),
  positionAr: text("position_ar"),
  positionEn: text("position_en"),
  email: text("email"),
  photoUrl: text("photo_url"),
  bioAr: text("bio_ar"),
  bioEn: text("bio_en"),
  displayOrder: integer("display_order").notNull().default(0),
  active: boolean("active").notNull().default(true),
  createdAt: timestamp("created_at", { withTimezone: true }).notNull().defaultNow(),
  updatedAt: timestamp("updated_at", { withTimezone: true })
    .notNull()
    .defaultNow()
    .$onUpdate(() => new Date()),
});

export const insertBoardMemberSchema = createInsertSchema(boardMembersTable).omit({
  id: true,
  createdAt: true,
  updatedAt: true,
});
export type InsertBoardMember = z.infer<typeof insertBoardMemberSchema>;
export type BoardMember = typeof boardMembersTable.$inferSelect;
