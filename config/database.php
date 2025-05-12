<?php
// Solo en local: cargar desde .env si existe
if (file_exists(__DIR__ . '/../.env')) {
    $env = parse_ini_file(__DIR__ . '/../.env');
    foreach ($env as $key => $value) {
        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
}

session_start();
$DB_HOST = $_ENV["DB_HOST"] ?? '127.0.0.1';
$DB_USER = $_ENV["DB_USER"] ?? 'root';
$DB_PASSWORD = $_ENV["DB_PASSWORD"] ?? '';
$DB_NAME = $_ENV["DB_NAME"] ?? 'bitacora_crm';
$DB_PORT = $_ENV["DB_PORT"] ?? '3306';

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
