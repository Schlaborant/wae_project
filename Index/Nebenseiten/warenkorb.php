<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Warenkorb</title>
  <link rel="stylesheet" href="../css/styles.css"/>
  <script src="../javascript/script.js" defer></script>
</head>
<body>
<header>
  <nav class="navbar">
    <div class="nav-left">
      <a href="../index.php" class="logo">
        <img src="../Bilder/logo5.png" alt="Logo">
      </a>
    </div>
    <div class="nav-right">
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
        <a href="login.php">Login</a>
      <?php endif; ?>
    </div>
  </nav>
</header>

  <main>
    <h1>Dein Warenkorb</h1>
    <ul id="cart-items"></ul>
    <div class="cart-summary">
  <p id="cart-total">Gesamt: 0€</p>
</div>
      <button id="export-json" class="btn"> 
    Bestellung absenden & JSON herunterladen
  </button>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
