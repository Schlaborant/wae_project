<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

<<<<<<< Updated upstream
<<<<<<< Updated upstream
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
=======
    $stmt = $mysql->prepare("SELECT id, password_hash FROM users WHERE username = :username");
=======
    $stmt = $mysql->prepare("SELECT id, password_hash, `role` FROM users WHERE username = :username");
>>>>>>> Stashed changes
    $stmt->execute([':username' => $username]);
>>>>>>> Stashed changes

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];
        $_SESSION['last_activity'] = time();
        header("Location: ../index.php");
        exit;
    } else {
        echo "Benutzername oder Passwort falsch.";
    }
}

$message = '';
if (isset($_GET['timeout'])) {
    $message = "⏳ Du wurdest wegen Inaktivität ausgeloggt.";
}
?>


<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="../css/test.css"/>
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
    <header>
    <nav class="navbar">
      <a href="index.php">Home</a>
      <a href="Nebenseiten/proteinpulver.php">Proteinpulver</a>
      <a href="Nebenseiten/vitalstoffe.php">Vitalstoffe</a>
      <a href="Nebenseiten/snacks-bars.php">Snacks & Bars</a>
      <a href="Nebenseiten/warenkorb.php">Warenkorb 🛒</a>
      <?php if (isset($_SESSION['username'])): ?>
      <a href="Nebenseiten/settings.php">Einstellungen</a>
      <a href="Nebenseiten/logout.php">Logout</a>
      <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === "admin"): ?>
      <a href="Nebenseiten/admin.php">Adminbereich</a>
      <?php endif; ?>
    </nav>
  </header>

    <div class="container">
        <div class="login-container">
            <h3 class="text-center mb-4">Login</h3>
            <form method="POST" action="login.php">
                <?php if($message): ?>
        	        <div class="alert alert-warning text-center"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>
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

            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../javascript/login.js" defer></script>
</body>
</html>