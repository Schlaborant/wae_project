<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Vitalstoffe</title>
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
    <h1>Vitalstoffe</h1>
    <div class="product-grid">
      <div class="product-card">
        <img src="https://via.placeholder.com/300x200?text=Multivitamin" alt="Multivitamin">
        <h3>Multivitamin</h3>
        <p>14,99€</p>
        <button onclick="addToCart('Multivitamin', 14.99)">In den Warenkorb</button>
      </div>
      <div class="product-card">
        <img src="https://via.placeholder.com/300x200?text=Omega+3" alt="Omega 3">
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
