<?php

$host = "localhost";
$port = "5432";
$dbname = "simple_shop";
$user = "postgres";
$password = "root"; // твій пароль

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
