<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $country = $_POST["country"] ?? null;

    if (empty($username) || empty($email) || empty($password)) {
        die("Required fields are missing.");
    }

    $sql = "INSERT INTO users (username, email, password, country)
            VALUES (:username, :email, :password, :country)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ":username" => $username,
        ":email" => $email,
        ":password" => $password,   // без хешу — для курсу ок
        ":country" => $country
    ]);

   header("Location: login.html");
   exit;

}
