<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.html");
    exit;
}

$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(["email" => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user["password"])) {
    $_SESSION["user"] = $user["username"];
    header("Location: index.php");
    exit;
}

// якщо дійшли сюди — логін не вдався
header("Location: login.html?error=invalid");
exit;
