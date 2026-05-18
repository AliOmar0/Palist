import { drizzle as drizzlePg } from "drizzle-orm/node-postgres";
import { drizzle as drizzleNeonHttp } from "drizzle-orm/neon-http";
import { neon } from "@neondatabase/serverless";
import pg from "pg";
import * as schema from "./schema";

if (!process.env.DATABASE_URL) {
  throw new Error(
    "DATABASE_URL must be set. Did you forget to provision a database?",
  );
}

const url = process.env.DATABASE_URL;
const isNeon = /neon\.tech/i.test(url);

type DbType = ReturnType<typeof drizzlePg<typeof schema>>;

let _db: DbType;
if (isNeon) {
  const sql = neon(url);
  _db = drizzleNeonHttp(sql, { schema }) as unknown as DbType;
} else {
  const pool = new pg.Pool({ connectionString: url });
  _db = drizzlePg(pool, { schema });
}

export const db: DbType = _db;

export * from "./schema";
