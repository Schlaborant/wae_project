
<?php
include("../db.php");

$stmt = $mysql->prepare("
  SELECT name, price, image_url
  FROM products 
  WHERE category = ?");
$stmt->execute(['snacks-bars']);
$products = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Snacks & Bars</title>
  <link rel="stylesheet" href="../css/styles.css"/>
  <script src="../javascript/script.js" defer></script>
</head>
<body>
  <header>
    <nav class="navbar">
      <a href="../index.php">Home</a>
      <a href="proteinpulver.php">Proteinpulver</a>
      <a href="vitalstoffe.php">Vitalstoffe</a>
      <a href="snacks-bars.php">Snacks & Bars</a>
      <a href="warenkorb.php">Warenkorb 🛒</a>
      <a href="login.php">Login</a>
    </nav>
  </header>

  <main>
    <h1>Snacks & Bars</h1>
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
  </main>
  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>



