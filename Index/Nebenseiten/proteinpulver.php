
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Proteinpulver</title>
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
    <h1>Proteinpulver</h1>
    <div class="product-grid">
      
      <div class="product-card">
        <div class="product-image-wrapper">
          <img src="/Index/Bilder/perdbeere2.png" alt="Whey Protein">
        </div>
        <h2>Whey Protein</h2>
        <p>29,99€</p>
        <button onclick="addToCart('Whey Protein', 29.99)">In den Warenkorb</button>
      </div>

      <div class="product-card">
        <div class="product-image-wrapper">
          <img src="https://via.placeholder.com/300x200?text=Vegan+Protein" alt="Veganes Protein">
        </div>
        <h2>Veganes Protein</h2>
        <p>32,99€</p>
        <button onclick="addToCart('Veganes Protein', 32.99)">In den Warenkorb</button>
      </div>

    </div>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
