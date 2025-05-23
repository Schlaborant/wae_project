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
      <a href="../index.php">Home</a>
      <a href="warenkorb.php">Warenkorb 🛒</a>
      <a href="login.php">Login</a>
    </nav>
  </header>

  <main>
    <h1>Dein Warenkorb</h1>
    <ul id="cart-items"></ul>
    <p id="cart-total">Gesamt: 0€</p>
      <button id="export-json" class="btn"> 
    Bestellung absenden & JSON herunterladen
  </button>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
