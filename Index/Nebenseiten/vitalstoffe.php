<?php
session_start();
include("../db.php");
$stmt = $mysql->prepare("
  SELECT name, price, image_url
  FROM products 
  WHERE category = ?");
$stmt->execute(['Vitalstoffe']);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vitalstoffe</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h1>Vitalstoffe</h1>
    <div class="product-grid">
      <?php if (empty($products)): ?>
        <p>Keine Produkte gefunden.</p>
      <?php else: ?>
        <?php foreach ($products as $p):
          $name  = htmlspecialchars($p['name'],    ENT_QUOTES);
          $price = number_format($p['price'], 2, ',', '.');
          $img   = htmlspecialchars($p['image_url'],ENT_QUOTES);
          $js    = addslashes($p['name']);
        ?>
          <!-- für jedes Produkt NUR eine product-card -->
          <div class="product-card">
            <div class="product-image-wrapper">
              <img src="../Bilder/<?= $img ?>" alt="<?= $name ?>">
            </div>
            <h2><?= $name ?></h2>
            <p><?= $price ?>€</p>
            <button onclick="addToCart('<?= $js ?>', <?= $p['price'] ?>)">
              In den Warenkorb
            </button>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Alert oben mittig -->
    <div id="cart-alert" class="alert custom-alert alert-dismissible fade show" role="alert" style="display: none;">
      <span id="cart-alert-message" class="small"></span>
      <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

  </main>
  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
