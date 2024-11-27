<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/.env.local')) {
    $dotenv = Dotenv::createImmutable(__DIR__, ['.env.local']);
} else {
    $dotenv = Dotenv::createImmutable(__DIR__);
}

$dotenv->load();

$host = $_ENV['MYSQL_HOST'];
$db = $_ENV['MYSQL_DATABASE'];
$username = $_ENV['MYSQL_USER'];
$password = $_ENV['MYSQL_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}