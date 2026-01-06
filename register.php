<?php
session_start();
require "db.php";

$username = $_POST["username"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$country = $_POST["country"];

try {
    $stmt = $pdo->prepare("
        INSERT INTO users (username, email, password, country)
        VALUES (:username, :email, :password, :country)
    ");

    $stmt->execute([
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "country" => $country
    ]);

    
    header("Location: login.html");
    exit;

} catch (PDOException $e) {

    
    if ($e->getCode() === "23505") {
        header("Location: register.html?error=email_exists");
        exit;
    }

    
    die("Something went wrong.");
}
