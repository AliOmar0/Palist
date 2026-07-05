-- Reset local MariaDB root to an empty password (matches app conn.php).
ALTER USER 'root'@'localhost' IDENTIFIED BY '';
FLUSH PRIVILEGES;
