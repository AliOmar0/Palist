#!/usr/bin/env bash
set -uo pipefail

ROOT="/home/runner/workspace"
DATADIR="$ROOT/.mysql/data"
RUNDIR="$ROOT/.mysql/run"
SOCKET="$RUNDIR/mysqld.sock"
SHARE="$(dirname "$(dirname "$(readlink -f "$(command -v mariadbd)")")")/share/mysql"

mkdir -p "$DATADIR" "$RUNDIR"

COMMON_OPTS=(
  --no-defaults
  --datadir="$DATADIR"
  --innodb-use-native-aio=0
  --innodb-flush-method=fsync
  --innodb-buffer-pool-size=64M
)

# Initialize system tables if missing.
if [ ! -f "$DATADIR/mysql/user.frm" ] && [ ! -f "$DATADIR/mysql/user.MYD" ] && [ ! -d "$DATADIR/mysql/user" ] && [ ! -f "$DATADIR/mysql/global_priv.frm" ]; then
  echo "[start_mariadb] no system tables found; will bootstrap"
fi

if [ ! -f "$RUNDIR/.bootstrapped" ]; then
  echo "[start_mariadb] bootstrapping system tables..."
  rm -rf "$DATADIR"
  mkdir -p "$DATADIR"
  BOOT="/tmp/mariadb_bootstrap.sql"
  {
    echo "CREATE DATABASE IF NOT EXISTS mysql;"
    echo "USE mysql;"
    cat "$SHARE/mysql_system_tables.sql"
    cat "$SHARE/mysql_system_tables_data.sql"
    cat "$SHARE/mysql_performance_tables.sql"
    cat "$SHARE/maria_add_gis_sp_bootstrap.sql"
    cat "$SHARE/mysql_sys_schema.sql"
    echo "CREATE DATABASE IF NOT EXISTS palist_legion CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;"
    echo "CREATE USER IF NOT EXISTS 'root'@'localhost' IDENTIFIED VIA mysql_native_password USING '';"
    echo "CREATE USER IF NOT EXISTS 'root'@'127.0.0.1' IDENTIFIED VIA mysql_native_password USING '';"
    echo "GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost' WITH GRANT OPTION;"
    echo "GRANT ALL PRIVILEGES ON *.* TO 'root'@'127.0.0.1' WITH GRANT OPTION;"
    echo "FLUSH PRIVILEGES;"
  } > "$BOOT"

  mariadbd "${COMMON_OPTS[@]}" --bootstrap --skip-grant-tables < "$BOOT"
  echo "[start_mariadb] bootstrap finished"
  touch "$RUNDIR/.bootstrapped"
fi

# Expose the socket at PHP's default mysqli socket path so connections to
# 'localhost' resolve correctly without changing application code.
mkdir -p /run/mysqld 2>/dev/null || true
ln -sf "$SOCKET" /run/mysqld/mysqld.sock 2>/dev/null || true

echo "[start_mariadb] starting server..."
exec mariadbd "${COMMON_OPTS[@]}" \
  --socket="$SOCKET" \
  --port=3306 \
  --bind-address=127.0.0.1 \
  --pid-file="$RUNDIR/mysqld.pid" \
  --log-error="$RUNDIR/mysqld.err"
