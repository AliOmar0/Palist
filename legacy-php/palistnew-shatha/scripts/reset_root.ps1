# Elevated helper: resets local MariaDB 'root'@'localhost' to an empty password.
# Method: inject `init-file` into my.ini, restart the service (runs the reset SQL
# on startup with full privileges), then revert my.ini and restart again.
$ErrorActionPreference = 'Continue'
$base = 'C:\Users\user\Desktop\palistnew\scripts'
$log  = Join-Path $base 'reset_root.log'
$ini  = 'C:\Program Files\MariaDB 11.8\data\my.ini'
$srcSql = 'C:\Users\user\Desktop\palistnew\scripts\reset_root.sql'
# The MariaDB service account can't read the user's Desktop; stage the SQL in
# the data dir (which the service account owns/can read).
$dstSql = 'C:\Program Files\MariaDB 11.8\data\reset_root.sql'
$sql  = 'C:/Program Files/MariaDB 11.8/data/reset_root.sql'
$line = "init-file=$sql"

function L($m) { Add-Content -Path $log -Value ("[" + (Get-Date -Format o) + "] " + $m) }

Set-Content -Path $log -Value ("[" + (Get-Date -Format o) + "] reset started")

try {
    $orig = Get-Content -Path $ini -Raw
    L "backing up my.ini"
    Set-Content -Path ($ini + '.bak') -Value $orig -NoNewline

    L "staging reset SQL into data dir"
    Copy-Item -Path $srcSql -Destination $dstSql -Force

    # Insert init-file right after the [mysqld] header.
    $patched = $orig -replace '(\[mysqld\]\s*\r?\n)', "`$1$line`r`n"
    Set-Content -Path $ini -Value $patched -NoNewline
    L "patched my.ini with init-file"

    L "restarting service to apply reset"
    Restart-Service -Name 'MariaDB' -Force -ErrorAction Stop
    Start-Sleep -Seconds 8
    L ("service status after reset start: " + (Get-Service MariaDB).Status)

    L "reverting my.ini"
    Set-Content -Path $ini -Value $orig -NoNewline

    L "restarting service with original config"
    Restart-Service -Name 'MariaDB' -Force -ErrorAction Stop
    Start-Sleep -Seconds 6
    L ("service status final: " + (Get-Service MariaDB).Status)

    L "verifying empty-password root login"
    $verify = & 'C:\Program Files\MariaDB 11.8\bin\mysql.exe' -u root -e "SELECT CONCAT('LOGIN_OK:', CURRENT_USER());" 2>&1
    L ("verify: " + ($verify -join ' '))
    Remove-Item -Path $dstSql -Force -ErrorAction SilentlyContinue
    L "DONE"
}
catch {
    L ("ERROR: " + $_.Exception.Message)
    # best effort: restore original config and bring the service back up
    if ($orig) { Set-Content -Path $ini -Value $orig -NoNewline }
    try { Restart-Service -Name 'MariaDB' -Force -ErrorAction SilentlyContinue } catch {}
}
