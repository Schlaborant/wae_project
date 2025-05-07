<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vitalstoffe</title>
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
    <h1>Vitalstoffe</h1>
    <div class="product-grid">
      <div class="product-card">
        <img src="../Bilder/perdbeere2.png" alt="Multivitamin">
        <h3>Multivitamin</h3>
        <p>14,99€</p>
        <button onclick="addToCart('Multivitamin', 14.99)">In den Warenkorb</button>
      </div>
      <div class="product-card">
        <img src="../Bilder/perdbeere2.png" alt="Omega 3">
        <h3>Omega 3</h3>
        <p>19,99€</p>
        <button onclick="addToCart('Omega 3', 19.99)">In den Warenkorb</button>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
