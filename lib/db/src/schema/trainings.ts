import { boolean, integer, pgTable, serial, text, timestamp, varchar } from "drizzle-orm/pg-core";
import { createInsertSchema } from "drizzle-zod";
import { z } from "zod/v4";

export const trainingsTable = pgTable("trainings", {
  id: serial("id").primaryKey(),
  titleAr: text("title_ar").notNull(),
  titleEn: text("title_en"),
  descriptionAr: text("description_ar"),
  descriptionEn: text("description_en"),
  coverImage: text("cover_image"),
  category: varchar("category", { length: 80 }),
  durationHours: integer("duration_hours"),
  startsAt: timestamp("starts_at", { withTimezone: true }),
  registrationUrl: text("registration_url"),
  published: boolean("published").notNull().default(true),
  createdAt: timestamp("created_at", { withTimezone: true }).notNull().defaultNow(),
  updatedAt: timestamp("updated_at", { withTimezone: true })
    .notNull()
    .defaultNow()
    .$onUpdate(() => new Date()),
});

export const insertTrainingSchema = createInsertSchema(trainingsTable).omit({
  id: true,
  createdAt: true,
  updatedAt: true,
});
export type InsertTraining = z.infer<typeof insertTrainingSchema>;
export type Training = typeof trainingsTable.$inferSelect;
