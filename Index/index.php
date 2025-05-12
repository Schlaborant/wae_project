<?php
session_start();
?>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fitness Shop</title>
  <link rel="stylesheet" href="css/test.css"/>
  <script src="../javascript/script.js" defer></script>
</head>
<body>

  <?php
    session_start();
    echo $_SESSION["username"];
    echo password_hash("admin", PASSWORD_DEFAULT); 
  ?>

  <header>
    <nav class="navbar">
<<<<<<< Updated upstream
      <a href="#">Home</a>
      <a href="Nebenseiten/proteinpulver.html">Proteinpulver</a>
      <a href="Nebenseiten/vitalstoffe.html">Vitalstoffe</a>
      <a href="Nebenseiten/snacks-bars.html">Snacks & Bars</a>
      <a href="Nebenseiten/warenkorb.html">Warenkorb 🛒</a>
      <a href="Nebenseiten/login.php">Login</a>
=======
      <a href="index.php">Home</a>
      <a href="Nebenseiten/proteinpulver.php">Proteinpulver</a>
      <a href="Nebenseiten/vitalstoffe.php">Vitalstoffe</a>
      <a href="Nebenseiten/snacks-bars.php">Snacks & Bars</a>
      <a href="Nebenseiten/warenkorb.php">Warenkorb 🛒</a>
      <?php if (isset($_SESSION['username'])): ?>
        <a href="Nebenseiten/settings.php">Einstellungen</a>
        <a href="Nebenseiten/logout.php">Logout</a>
      <?php else: ?>
        <a href="Nebenseiten/login.php">Login</a>
      <?php endif; ?>
      
>>>>>>> Stashed changes
    </nav>
  </header>

  <main>
    <h1>Willkommen im Fitness Shop!</h1>
    <section class="category-grid">
      <a href="../Nebenseiten/proteinpulver.html" class="category-box">
        <img src="../Bilder/test.jpg" alt="Proteinpulver">
        <h2>Proteinpulver</h2>
      </a>
      <a href="../Nebenseiten/vitalstoffe.html" class="category-box">
        <img src="../Bilder/test.jpg" alt="Vitalstoffe">
        <h2>Vitalstoffe</h2>
      </a>
      <a href="../Nebenseiten/snacks-bars.html" class="category-box">
        <img src="../Bilder/test.jpg" alt="Snacks & Bars">
        <h2>Snacks & Bars</h2>
      </a>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
