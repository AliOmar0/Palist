import { drizzle as drizzlePg } from "drizzle-orm/node-postgres";
import { drizzle as drizzleNeon } from "drizzle-orm/neon-serverless";
import { Pool as NeonPool, neonConfig } from "@neondatabase/serverless";
import pg from "pg";
import ws from "ws";
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
  neonConfig.webSocketConstructor = ws;
  const pool = new NeonPool({ connectionString: url });
  _db = drizzleNeon(pool, { schema }) as unknown as DbType;
} else {
  const pool = new pg.Pool({ connectionString: url });
  _db = drizzlePg(pool, { schema });
}

export const db: DbType = _db;

export * from "./schema";
