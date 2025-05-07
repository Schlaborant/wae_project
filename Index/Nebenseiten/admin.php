<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registrierung erfolgreich. <a href='login.php'>Jetzt einloggen</a>";
    } else {
        echo "Fehler: Benutzername könnte bereits existieren.";
    }

    $stmt->close();
}
?>

<form method="post">
    <h2>Registrieren</h2>
    Benutzername: <input type="text" name="username" required><br>
    Passwort: <input type="password" name="password" required><br>
    <button type="submit">Registrieren</button>
</form>
