<?php
require '../db.php';
require 'session.php';

$notification = "";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Neuen Benutzer hinzufügen
if (isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $timeout = 500;

    // Überprüfen, ob der Benutzername bereits existiert
    $checkStmt = $mysql->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $checkStmt->execute([$username]);
    $userExists = $checkStmt->fetchColumn();

    if ($userExists > 0) {
        $notification = "<script>
        document.getElementById('notification-area').innerHTML = `
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Fehler: Der Benutzername existiert bereits.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>`;
    </script>";
    } else {
        // Benutzer einfügen
        $stmt = $mysql->prepare("INSERT INTO users (username, password_hash, role, timeout_seconds) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $role, $timeout]);
        $notification = "<script>
        document.getElementById('notification-area').innerHTML = `
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                Benutzer wurde erfolgreich hinzugefügt.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>`;
      	</script>";
    }
}

// Benutzer löschen
if (isset($_POST['delete_user'])) {
    $id = $_POST['user_id'];
    if ($id == $_SESSION["userid"]) {
      $notification = "
    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        Du kannst dich nicht selbst löschen.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
    else {
      $stmt = $mysql->prepare("DELETE FROM users WHERE id = ?");
      $stmt->execute([$id]);
      $notification = "
    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Benutzer wurde erfolgreich gelöscht.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    }
}

// Benutzer bearbeiten
if (isset($_POST['edit_user'])) {
    $id = $_POST['user_id'];
    $role = $_POST['role'];
    $stmt = $mysql->prepare("UPDATE users SET `role` = ? WHERE id = ?");
    $stmt->execute([$role, $id]);
    $notification = "
<div class='alert alert-info alert-dismissible fade show' role='alert'>
    Benutzerrolle wurde erfolgreich aktualisiert.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}

// Benutzerliste abrufen
$stmt = $mysql->prepare("SELECT id, username, `role`, timeout_seconds, created_at FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);6
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Einstellungen</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">  <link rel="stylesheet" href="../css/test.css"/>
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
      <?php if ($_SESSION['role'] === "admin"): ?>
        <a href="admin.php">Adminbereich</a>
      <?php endif; ?>
      <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="Nebenseiten/login.php">Login</a>
      <?php endif; ?>
    </nav>
    </header>

  <div id="notification-area">
    <?= $notification ?>
  </div>

<main class="container mt-5">
  <h1>Benutzerverwaltung</h1>

  <h3>Neuen Benutzer anlegen</h3>
  <form method="post" class="row g-3">
    <input type="hidden" name="add_user" value="1">
    <div class="col-md-4">
      <input type="text" class="form-control" name="username" placeholder="Benutzername" required>
    </div>
    <div class="col-md-4">
      <input type="password" class="form-control" name="password" placeholder="Passwort" required>
    </div>
    <div class="col-md-2">
      <select name="role" class="form-select">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-success">Hinzufügen</button>
    </div>
  </form>

  <hr>

  <h3>Benutzerliste</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Benutzername</th>
        <th>Rolle</th>
        <th>Aktionen</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <form method="post">
          <td><?= htmlspecialchars($user['id']) ?></td>
          <td><?= htmlspecialchars($user['username']) ?></td>          
          <td>
            <select name="role" class="form-select">
              <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
              <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
            <input type="password" name="new_password" class="form-control" placeholder="Neues Passwort">
          </td>
          <td>
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
            <button type="submit" name="edit_user" class="btn btn-primary btn-sm">Speichern</button>
            <button type="submit" name="delete_user" class="btn btn-danger btn-sm" onclick="return confirm('Diesen Benutzer wirklich löschen?')">Löschen</button>
          </td>
        </form>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</main>
<!-- Bootstrap JS (für eventuelle Erweiterungen wie dismissible alerts) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script></body>
</html>