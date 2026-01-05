<?php
session_start();          
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":email" => $email,
        ":password" => $password
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["user"] = $user["username"];

        header("Location: index.php");
        exit;
    } else {
        echo "Invalid email or password";
    }
}
