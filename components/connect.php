<?php
$config = [];
if (file_exists(__DIR__ . '/config.php')) {
    $config = require __DIR__ . '/config.php';
}

$db_host = $config['DB_HOST'] ?? getenv('DB_HOST') ?? 'localhost';
$db_name_val = $config['DB_NAME'] ?? getenv('DB_NAME') ?? 'blog_db';
$user_name = $config['DB_USER'] ?? getenv('DB_USER') ?? 'root';
$user_password = $config['DB_PASS'] ?? getenv('DB_PASS') ?? '';

$db_name = "mysql:host=$db_host;dbname=$db_name_val;charset=utf8mb4";

try {
    $conn = new PDO($db_name, $user_name, $user_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit;
}

?>