import { boolean, pgTable, serial, text, timestamp, varchar } from "drizzle-orm/pg-core";
import { createInsertSchema } from "drizzle-zod";
import { z } from "zod/v4";

export const publicationsTable = pgTable("publications", {
  id: serial("id").primaryKey(),
  titleAr: text("title_ar").notNull(),
  titleEn: text("title_en"),
  summaryAr: text("summary_ar"),
  summaryEn: text("summary_en"),
  fileUrl: text("file_url"),
  coverImage: text("cover_image"),
  category: varchar("category", { length: 80 }),
  publishedAt: timestamp("published_at", { withTimezone: true }).notNull().defaultNow(),
  published: boolean("published").notNull().default(true),
  createdAt: timestamp("created_at", { withTimezone: true }).notNull().defaultNow(),
  updatedAt: timestamp("updated_at", { withTimezone: true })
    .notNull()
    .defaultNow()
    .$onUpdate(() => new Date()),
});

export const insertPublicationSchema = createInsertSchema(publicationsTable).omit({
  id: true,
  createdAt: true,
  updatedAt: true,
});
export type InsertPublication = z.infer<typeof insertPublicationSchema>;
export type Publication = typeof publicationsTable.$inferSelect;
