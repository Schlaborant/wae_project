<?php
<<<<<<< HEAD
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['userid'] = $id;
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit;
        } else {
            echo "Falsches Passwort.";
        }
    } else {
        echo "Benutzer nicht gefunden.";
    }

    $stmt->close();
=======
session_start(); // Session starten

if($_SERVER["REQUEST_METHOD"] == "POST") { // Anfordern die per POST gesendet wurde.
    require("../db.php");

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $mysql->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $userExists = $stmt->fetch(); // fetchAll() durch fetch() ersetzt, da wir nur einen Datensatz erwarten

    if ($userExists) {
        $passwordHashed = $userExists["password"];
        $checkPassword = password_verify($password, $passwordHashed);

        if($checkPassword === true){
            $_SESSION["username"] = $username;
            header("Location: ../index.html");
            exit; // Vergessen Sie nicht exit nach header.
        } else {
            echo "Login fehlgeschlagen (Passwort)";
        }
    } else {
        echo "Login fehlgeschlagen (Benutzername)";
    }
} else {
    echo "Kein POST-Daten empfangen";
>>>>>>> 6b9fe20393d47f88a3fad7db8de0f05b3f45740d
}
?>

<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="login-container">
            <h3 class="text-center mb-4">Login</h3>
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Benutzername</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Passwort</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Einloggen</button>
                <div class="text-center">
                    <a href="passwort-vergessen.php" class="btn btn-link">Passwort vergessen?</a>
                </div>
                <div class="text-center">
                    <a href="registrieren.php" class="btn btn-link">Registrieren</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../javascript/login.js" defer></script>
</body>
</html>