---
name: MariaDB on Replit
description: How to run a self-hosted MySQL/MariaDB server in this Replit environment for PHP/mysqli apps
---

# Running MariaDB in this Replit environment

This project is a PHP CMS ("legion" framework) that uses `mysqli` to connect to a
local MySQL database named `palist_legion` (see `panel/core/conn.php`, host
`localhost`, user `root`, empty password). Replit has no managed MySQL, so we run
MariaDB ourselves.

## The key gotcha: the bash tool's syscall monitor kills mariadbd
Running `mariadb-install-db` or `mariadbd` (even `--bootstrap`) directly through the
**bash tool** reliably dies with:
`run process: run_parent ... handle_syscall ... openat: get fd path ffffffff ... /proc/PID/fd/-1`.
This is the bash tool's sandbox monitor crashing on a syscall MariaDB makes — NOT a
MariaDB error. It interrupts initialization partway (only a few system tables get
created).

**Fix:** run MariaDB from a **workflow** instead (workflows run outside that
monitor). See `scripts/start_mariadb.sh`, registered as the `MariaDB` workflow
(console output, no `waitForPort` — 3306 isn't a routable Replit port and the DB is
internal-only).

## Other required flags / steps
- `--innodb-use-native-aio=0` and `--innodb-flush-method=fsync`: io_uring is blocked
  (`kernel.io_uring_disabled=2`); without disabling native AIO, even the workflow
  bootstrap stalls right after InnoDB init.
- Bootstrap manually by piping the share SQL files (`mysql_system_tables.sql`,
  `mysql_system_tables_data.sql`, `mysql_performance_tables.sql`,
  `maria_add_gis_sp_bootstrap.sql`, `mysql_sys_schema.sql`) into
  `mariadbd --bootstrap` — the `mariadb-install-db` wrapper itself triggers the
  sandbox crash. The script does this once, guarded by `.mysql/run/.bootstrapped`.
- PHP `mysqli` with host `localhost` uses the socket at `/run/mysqld/mysqld.sock`.
  The start script symlinks that path to the actual socket in `.mysql/run/` so
  `conn.php` needs no change. (The workflow also passes
  `-d mysqli.default_socket=/run/mysqld/mysqld.sock`.)

## Data is NOT in the repo
The schema (per-module `panel/modules/*/others/TableSQL.php`) exists, but the
framework's own metadata tables (`modules`, `module_fields`, `module_actions`, ...)
plus the required `settings`/`languages`/`connections` rows live ONLY in the
database. There is no bundled installer that seeds them (the `settings/models/reset_*`
routines only patch an already-populated DB). So the app cannot boot without
importing the original `palist_legion` dump from the user's production server.
**Why:** `panel/core/config.php` reads `settings` (id=1) at boot to define every URL
and path constant; an empty DB fatals at `mysqli_set_charset` with an empty charset.
