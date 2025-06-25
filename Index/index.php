<?php
session_start();
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Fitness Shop</title>
  <link rel="stylesheet" href="css/index.css"/>
  <script src="javascript/script.js" defer></script>
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="nav-left">
        <a class="logo">
          <img src="Bilder/logo5.png" alt="Logo" />
        </a>
      </div>
      <div class="nav-right">
        <a href="index.php">Home</a>
        <a href="Nebenseiten/proteinpulver.php">Proteinpulver</a>
        <a href="Nebenseiten/vitalstoffe.php">Vitalstoffe</a>
        <a href="Nebenseiten/snacks-bars.php">Snacks & Bars</a>
        <a href="Nebenseiten/warenkorb.php">Warenkorb 🛒</a>
        <?php if (isset($_SESSION['username'])): ?>
          <a href="Nebenseiten/settings.php">Einstellungen</a>
          <?php if ($_SESSION['role'] === "admin"): ?>
            <a href="Nebenseiten/admin.php">Adminbereich</a>
          <?php endif; ?>
          <a href="Nebenseiten/logout.php">Logout</a>
        <?php else: ?>
          <a href="Nebenseiten/login.php">Login</a>
        <?php endif; ?>
      </div>
    </nav>
  </header>

  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-box">
      
      <!-- Linke Seite -->
      <div class="hero-left">
        <h1>Mealy<br>Supplements<br>Products</h1>
        <p class="hero-description">
          Entdecke hochwertige Supplements für Muskelaufbau, Energie und Regeneration.
        </p>
        <a href="#" class="hero-contact">Contact Us</a>
      </div>

      <!-- Strich in der Mitte -->
      <div class="hero-divider"></div>

      <!-- Rechte Seite -->
      <div class="hero-right">
        <img src="Bilder/test2.png" alt="Sample 1">
        <img src="Bilder/test3.png" alt="Sample 2">
        <img src="Bilder/fintess.png" alt="Sample 3">
      </div>

    </div>
  </section>

  <!-- PRODUCT SECTION -->
  <main class="products">
    <h2 class="section-heading">Unsere Produkte</h2>

    <div class="product-entry">
      <img src="Bilder/test4.png" alt="Flooring">
      <div class="product-info">
        <h3>Proteinpulver</h3>
        <p><b>Starte jetzt durch – mit hochwertigem Proteinpulver für maximale Ergebnisse!</b><br>
        Du willst Muskeln aufbauen, deine Regeneration verbessern oder einfach deine Eiweißzufuhr 
        gezielt unterstützen? Unser Premium-Proteinpulver bietet dir genau das, was du brauchst!</p>
        <a href="Nebenseiten/proteinpulver.php">Shop Online</a>
      </div>
    </div>

    <div class="product-entry reverse">
      <img src="Bilder/test5.png" alt="Features">
      <div class="product-info">
        <h3>Vitalstoffe</h3>
        <p><b>Bring deinen Körper in Balance – mit hochwertigen Vitalstoffen für mehr Energie und Wohlbefinden!</b><br>
        Egal ob du dein Immunsystem stärken, Müdigkeit bekämpfen oder deine Ernährung gezielt ergänzen möchtest – unsere Premium-Vitalstoffprodukte 
        unterstützen dich dabei, dich rundum vital und leistungsfähig zu fühlen!</p>
        <a href="Nebenseiten/vitalstoffe.php">Shop Online</a>
      </div>
    </div>

    <div class="product-entry">
      <img src="Bilder/test6.png" alt="Flooring">
      <div class="product-info">
        <h3>Snack & Bars</h3>
        <p><b>Snacken mit gutem Gewissen – unsere Proteinriegel liefern dir Power für unterwegs!</b><br>
        Ob nach dem Training, im Büro oder zwischendurch – unsere leckeren Proteinriegel versorgen dich mit hochwertigem Eiweiß, sättigen langanhaltend und schmecken einfach fantastisch. Perfekt für alle, die bewusst snacken wollen!</p>
        <a href="Nebenseiten/snacks-bars.php">Shop Online</a>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
