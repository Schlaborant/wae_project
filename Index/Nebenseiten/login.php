<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <link rel="stylesheet" href="../css/styles.css"/>
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
    <h1>Login</h1>
    <form class="login-form">
      <label for="email">E-Mail:</label>
      <input type="email" id="email" required />
      <label for="password">Passwort:</label>
      <input type="password" id="password" required />
      <button type="submit">Einloggen</button>
    </form>
  </main>

  <footer>
    <p>&copy; 2025 Fitness Shop</p>
  </footer>
</body>
</html>
