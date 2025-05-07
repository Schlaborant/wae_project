<?php
include("../db.php");

$stmt = $mysql->prepare("
  SELECT name, price, image_url
  FROM products 
  WHERE category = ?");
$stmt->execute(['proteinpulver']);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Proteinpulver</title>
  <link rel="stylesheet" href="/Index/css/styles.css"/>
  <script src="/Index/javascript/script.js" defer></script>
</head>
<body>
  <header>
    <nav class="navbar">
      <a href="/Index/index.html">Home</a>
      <a href="proteinpulver.html">Proteinpulver</a>
      <a href="vitalstoffe.html">Vitalstoffe</a>
      <a href="snacks-bars.html">Snacks & Bars</a>
      <a href="warenkorb.html">Warenkorb 🛒</a>
      <a href="login.html">Login</a>
    </nav>
  </header>

  <main>
    <h1>Proteinpulver</h1>
<!-- EIN Wrapper für alle Cards -->
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
              <img src="<?= $img ?>" alt="<?= $name ?>">
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
  </main>
  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>