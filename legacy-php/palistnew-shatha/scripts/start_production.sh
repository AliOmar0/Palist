#!/usr/bin/env bash
# Production entrypoint: brings up MariaDB, imports the database on first boot,
# starts the PHP backend, and runs nginx in the foreground as the web server.
# Used by the deployment run command (see .replit [deployment]).
set -uo pipefail

ROOT="/home/runner/workspace"
SOCKET="$ROOT/.mysql/run/mysqld.sock"
DUMP="$ROOT/attached_assets/palist_legion_1780332438076.sql"

cd "$ROOT"

# 1. Start MariaDB in the background.
bash scripts/start_mariadb.sh &

# 2. Wait for the server socket to become available (fail fast if it never does).
echo "[start_production] waiting for MariaDB socket..."
DB_UP=0
for i in $(seq 1 60); do
  if mariadb --socket="$SOCKET" -u root -e "SELECT 1" >/dev/null 2>&1; then
    echo "[start_production] MariaDB is up"
    DB_UP=1
    break
  fi
  sleep 1
done
if [ "$DB_UP" != "1" ]; then
  echo "[start_production] FATAL: MariaDB did not become ready in time" >&2
  exit 1
fi

# 3. Import the database on first boot (empty palist_legion => no tables yet).
TABLES=$(mariadb --socket="$SOCKET" -u root -N -B \
  -e "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='palist_legion'" 2>/dev/null || echo 0)
if [ "${TABLES:-0}" = "0" ]; then
  echo "[start_production] importing database from dump..."
  if ! mariadb --socket="$SOCKET" -u root palist_legion < "$DUMP"; then
    echo "[start_production] FATAL: database import failed" >&2
    exit 1
  fi
  echo "[start_production] import finished"
else
  echo "[start_production] database already has $TABLES tables; skipping import"
fi

# 4. Start the PHP backend (localhost only; nginx proxies to it).
PHP_CLI_SERVER_WORKERS=8 php -d mysqli.default_socket="$SOCKET" \
  -d display_errors=0 -S 127.0.0.1:8080 router.php &

# 5. Run nginx in the foreground on the public port.
exec bash scripts/start_nginx.sh
