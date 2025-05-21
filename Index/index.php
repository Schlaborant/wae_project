<?php
session_start();
?>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fitness Shop</title>
  <link rel="stylesheet" href="css/test.css"/>
  <script src="javascript/script.js" defer></script>
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
      <?php if ($_SESSION['role'] === "admin"): ?>
        <a href="Nebenseiten/admin.php">Adminbereich</a>
      <?php endif; ?>
      <a href="Nebenseiten/logout.php">Logout</a>
      <?php else: ?>
        <a href="Nebenseiten/login.php">Login</a>
      <?php endif; ?>
    </nav>
  </header>

  <main>
    <h1>Willkommen im Fitness Shop!</h1>
    <section class="category-grid">
      
      <a href="Nebenseiten/proteinpulver.php" class="category-box">
        <div class="category-image-wrapper">
          <img src="Bilder/Proteinpulver.png" alt="Proteinpulver">
        </div>
        <h2>Proteinpulver</h2>
      </a>
      
      <a href="Nebenseiten/vitalstoffe.php" class="category-box">
        <div class="category-image-wrapper">
          <img src="Bilder/Vitalstoffe.jpeg" alt="Vitalstoffe">
        </div>
        <h2>Vitalstoffe</h2>
      </a>
      
      <a href="Nebenseiten/snacks-bars.php" class="category-box">
        <div class="category-image-wrapper">
          <img src="Bilder/SnacksBars.png" alt="Snacks & Bars">
        </div>
        <h2>Snacks & Bars</h2>
      </a>
      
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
