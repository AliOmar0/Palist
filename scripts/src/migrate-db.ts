import pg from "pg";

const { Pool } = pg;

const SOURCE = process.env.SOURCE_DATABASE_URL;
const TARGET = process.env.TARGET_DATABASE_URL;

if (!SOURCE || !TARGET) {
  console.error(
    "Set SOURCE_DATABASE_URL (current Replit DB) and TARGET_DATABASE_URL (new Neon DB) before running.",
  );
  process.exit(1);
}

const TABLES = [
  "users",
  "news",
  "events",
  "event_registrations",
  "trainings",
  "publications",
  "jobs",
  "job_applications",
  "member_applications",
  "newsletter_subscribers",
  "contact_submissions",
  "admin_audit_log",
];

async function copyTable(
  source: pg.Pool,
  target: pg.Pool,
  table: string,
): Promise<void> {
  const { rows } = await source.query(`SELECT * FROM "${table}"`);
  if (rows.length === 0) {
    console.log(`  ${table}: 0 rows (skipped)`);
    return;
  }

  await target.query(`TRUNCATE TABLE "${table}" RESTART IDENTITY CASCADE`);

  const columns = Object.keys(rows[0]);
  const colList = columns.map((c) => `"${c}"`).join(", ");

  for (const row of rows) {
    const values = columns.map((c) => row[c]);
    const placeholders = columns.map((_, i) => `$${i + 1}`).join(", ");
    await target.query(
      `INSERT INTO "${table}" (${colList}) VALUES (${placeholders})`,
      values,
    );
  }

  console.log(`  ${table}: ${rows.length} rows copied`);
}

async function main(): Promise<void> {
  const source = new Pool({ connectionString: SOURCE });
  const target = new Pool({ connectionString: TARGET, ssl: { rejectUnauthorized: false } });

  try {
    console.log("Copying data from source -> target...");
    for (const table of TABLES) {
      try {
        await copyTable(source, target, table);
      } catch (err) {
        console.error(`  ${table}: FAILED`, err instanceof Error ? err.message : err);
      }
    }
    console.log("Done.");
  } finally {
    await source.end();
    await target.end();
  }
}

main().catch((err) => {
  console.error(err);
  process.exit(1);
});
