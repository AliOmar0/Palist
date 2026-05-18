import * as schema from "./schema";

if (!process.env.DATABASE_URL) {
  throw new Error(
    "DATABASE_URL must be set. Did you forget to provision a database?",
  );
}

const url = process.env.DATABASE_URL;
const isNeon = /neon\.tech/i.test(url);

type DbType = ReturnType<typeof import("drizzle-orm/node-postgres").drizzle<typeof schema>>;

async function makeDb(): Promise<DbType> {
  if (isNeon) {
    const { Pool, neonConfig } = await import("@neondatabase/serverless");
    const ws = (await import("ws")).default;
    neonConfig.webSocketConstructor = ws;
    const { drizzle } = await import("drizzle-orm/neon-serverless");
    const pool = new Pool({ connectionString: url });
    return drizzle(pool, { schema }) as unknown as DbType;
  }
  const pg = (await import("pg")).default;
  const { drizzle } = await import("drizzle-orm/node-postgres");
  const pool = new pg.Pool({ connectionString: url });
  return drizzle(pool, { schema });
}

export const db: DbType = await makeDb();

export * from "./schema";
