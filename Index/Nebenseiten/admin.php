<?php
// IN BEARBEITUNG 
require '../db.php';
require 'session.php';

if ($_SESSION['role'] !== "admin") {
    header('Location: ../index.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Einstellungen</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/test.css"/>
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

<main class="container mt-5">
  <h1>Benutzerverwaltung</h1>

  <h3>Neuen Benutzer anlegen</h3>
  <form method="post" class="row g-3">
    <input type="hidden" name="add_user" value="1">
    <div class="col-md-4">
      <input type="text" class="form-control" name="username" placeholder="Benutzername" required>
    </div>
    <div class="col-md-4">
      <input type="email" class="form-control" name="email" placeholder="E-Mail" required>
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
        <th>E-Mail</th>
        <th>Rolle</th>
        <th>Aktionen</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <form method="post">
          <td><?= htmlspecialchars($user['id']) ?></td>
          <td><input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" class="form-control"></td>
          <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control"></td>
          <td>
            <select name="role" class="form-select">
              <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
              <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
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

</body>
</html>