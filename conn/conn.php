<?php
require_once __DIR__ . '/security.php';

// Override with environment variables in production; defaults suit local XAMPP.
$host = getenv('DB_HOST') ?: 'localhost';
$uname = getenv('DB_USER') ?: 'root';
$passwd = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
$db = getenv('DB_NAME') ?: 'market';

$conn = mysqli_connect($host, $uname, $passwd, $db);
if (!$conn) {
    error_log('MySQL connection failed: ' . mysqli_connect_error());
    http_response_code(500);
    echo 'Error: Unable to connect to the database.';
    exit;
}
//กำหนดให้ใช็รูปแบบรหัสภาษา แบบ utf8
mysqli_set_charset($conn, 'utf8');
