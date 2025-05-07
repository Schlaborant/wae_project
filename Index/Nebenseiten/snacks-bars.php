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
    <div class="product-grid">
      <div class="product-card">
        <img src="https://via.placeholder.com/300x200?text=Protein+Riegel" alt="Proteinriegel">
        <h3>Protein Riegel</h3>
        <p>2,99€</p>
        <button onclick="addToCart('Protein Riegel', 2.99)">In den Warenkorb</button>
      </div>
      <div class="product-card">
        <img src="https://via.placeholder.com/300x200?text=Energiebällchen" alt="Energiebällchen">
        <h3>Energiebällchen</h3>
        <p>3,99€</p>
        <button onclick="addToCart('Energiebällchen', 3.99)">In den Warenkorb</button>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
