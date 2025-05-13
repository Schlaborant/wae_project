<?php

require '../db.php';
require 'session.php';

if (!isset($_SESSION["userid"])) {
    header("Location: login.php");
    exit;
}


$userId = $_SESSION['userid'] ?? null;
if (!$userId) {
    header("Location: login.php");
    exit;
}

// Formular verarbeiten
$success = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['timeout'])) {
        $newTimeout = (int)$_POST['timeout'];
        if ($newTimeout >= 10 && $newTimeout <= 3600) {
            $stmt = $mysql->prepare("UPDATE users SET timeout_seconds = :timeout WHERE id = :id");
            $stmt->execute([':timeout' => $newTimeout, ':id' => $userId]);
            $success = "Timeout erfolgreich gespeichert.";
        } else {
            $error = "Timeout muss zwischen 10 und 3600 Sekunden liegen.";
        }
    }

    if (isset($_POST['old_password'], $_POST['new_password'])) {
        $stmt = $mysql->prepare("SELECT password_hash FROM users WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($_POST['old_password'], $user['password_hash'])) {
            $newHash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $stmt = $mysql->prepare("UPDATE users SET password_hash = :hash WHERE id = :id");
            $stmt->execute([':hash' => $newHash, ':id' => $userId]);
            $success = "Passwort erfolgreich geändert.";
        } else {
            $error = "Altes Passwort ist falsch.";
        }
    }
}

// aktuellen Timeout aus DB laden
$stmt = $mysql->prepare("SELECT timeout_seconds FROM users WHERE id = :id");
$stmt->execute([':id' => $userId]);
$currentTimeout = $stmt->fetchColumn() ?? 100;
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Einstellungen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/test.css"/>
  <style>
    body { background-color: #f8f9fa; }
    .container { max-width: 600px; margin-top: 50px; }
  </style>
</head>
<body>
    <header>
    <nav class="navbar">
      <a href="../index.php">Home</a>
      <a href="proteinpulver.php">Proteinpulver</a>
      <a href="vitalstoffe.php">Vitalstoffe</a>
      <a href="snacks-bars.php">Snacks & Bars</a>
      <a href="warenkorb.php">Warenkorb 🛒</a>
      <?php if (isset($_SESSION['username'])): ?>
      <a href="settings.php">Einstellungen</a>
      <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="Nebenseiten/login.php">Login</a>
      <?php endif; ?>
    </nav>
  </header>
<div class="container">
  <h2 class="mb-4">Benutzereinstellungen</h2>

  <?php if ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="post" class="mb-4">
    <h5>🕒 Automatischer Logout (Timeout)</h5>
    <div class="mb-3">
      <label for="timeout" class="form-label">Inaktivitätszeit (Sekunden)</label>
      <input type="number" class="form-control" id="timeout" name="timeout" value="<?= htmlspecialchars($currentTimeout) ?>" min="10" max="3600" required>
    </div>
    <button type="submit" class="btn btn-primary">Speichern</button>
  </form>

  <form method="post">
    <h5>🔒 Passwort ändern</h5>
    <div class="mb-3">
      <label for="old_password" class="form-label">Altes Passwort</label>
      <input type="password" class="form-control" id="old_password" name="old_password" required>
    </div>
    <div class="mb-3">
      <label for="new_password" class="form-label">Neues Passwort</label>
      <input type="password" class="form-control" id="new_password" name="new_password" required>
    </div>
    <button type="submit" class="btn btn-warning">Passwort ändern</button>
  </form>
</div>
</body>
</html>