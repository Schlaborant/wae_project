<?php
session_start();
require '../db.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Benutzername validieren – nur Buchstaben, Zahlen und Unterstrich erlaubt
    if (!preg_match('/^[a-zA-Z0-9_]{3,}$/', $username)) {
        $error = "Ungültiger Benutzername. Nur Buchstaben, Zahlen und _ sind erlaubt.";
    } else {
        $stmt = $mysql->prepare("SELECT id, password_hash, role FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['userid'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            header("Location: ../index.php");
            exit;
        } else {
            $error = "Benutzername oder Passwort falsch.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../css/styles.css"/>
  <style>
    .login-container {
      max-width: 420px;
      margin: 100px auto;
      padding: 40px 30px;
      border-radius: 16px;
      background-color: rgba(20, 20, 20, 0.95);
      box-shadow: 0 8px 32px rgba(154, 125, 81, 0.7);
      color: #f0e6d2;
    }

    .login-container h2 {
      color: #e8d8b4;
      font-family: 'Georgia', serif;
      font-weight: bold;
    }

    .login-container .form-label {
      color: #e8d8b4;
      font-weight: bold;
    }

    .login-container .form-control {
      background-color: #1f1e1e;
      border: 1px solid #a98258;
      color: #f0e6d2;
    }

    .login-container .form-control:focus {
      background-color: rgba(255, 255, 255, 0.15);
      border-color: #e8d8b4;
      color: #fff;
    }

    .btn-primary {
      background-color: #a98258;
      border: none;
      font-weight: bold;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-primary:hover {
      background-color: #8a6c4b;
      transform: scale(1.03);
    }

    .btn-link {
      color: #e8d8b4;
      text-decoration: underline;
    }

    .btn-link:hover {
      color: #fff;
    }

    .form-text {
      font-size: 0.9rem;
    }
  </style>
</head>
<body class="login-page">
<header>
  <nav class="navbar">
    <div class="nav-left">
      <a class="logo" href="../index.php">
        <img src="../Bilder/logo5.png" alt="Logo" />
      </a>
    </div>
    <div class="nav-right">
      <a href="../index.php">Home</a>
      <a href="proteinpulver.php">Proteinpulver</a>
      <a href="vitalstoffe.php">Vitalstoffe</a>
      <a href="snacks-bars.php">Snacks & Bars</a>
      <a href="warenkorb.php">Warenkorb 🛒</a>
      <?php if (isset($_SESSION['username'])): ?>
        <a href="Nebenseiten/settings.php">Einstellungen</a>
        <?php if ($_SESSION['role'] === "admin"): ?>
          <a href="admin.php">Adminbereich</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a>
      <?php endif; ?>
    </div>
  </nav>
</header>

<div class="container">
  <div class="login-container">
    <h2 class="text-center mb-4">Login</h2>

    <?php if ($error): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" onsubmit="return validateUsername();">
      <div class="mb-3">
        <label for="username" class="form-label">Benutzername</label>
        <input type="text" class="form-control" id="username" name="username" required oninput="checkUsernameLive()">
        <div id="username-error" class="form-text text-danger mt-1" style="display: none;">
          Benutzername muss mindestens 3 Zeichen lang sein und darf nur Buchstaben, Zahlen und Unterstriche (_) enthalten.
        </div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Passwort</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary w-100 mb-2">Einloggen</button>
    </form>
  </div>
</div>

<script>
  function checkUsernameLive() {
    const username = document.getElementById("username").value;
    const errorDiv = document.getElementById("username-error");
    const regex = /^[a-zA-Z0-9_]{3,}$/;

    if (!regex.test(username)) {
      errorDiv.style.display = "block";
    } else {
      errorDiv.style.display = "none";
    }
  }

  function validateUsername() {
    const username = document.getElementById("username").value;
    const errorDiv = document.getElementById("username-error");
    const regex = /^[a-zA-Z0-9_]{3,}$/;

    if (!regex.test(username)) {
      errorDiv.style.display = "block";
      return false;
    }
    return true;
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
