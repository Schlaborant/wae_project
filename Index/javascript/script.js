let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Export-Button ein-/ausblenden
function toggleExportButton() {
  const exportBtn = document.getElementById("export-json");
  if (exportBtn) {
    exportBtn.style.display = cart.length > 0 ? "" : "none";
  }
}

// Cart-Zähler aktualisieren
function updateCartCount() {
  const countElement = document.getElementById("cart-count");
  if (!countElement) return;
  const totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
  countElement.textContent = totalQty;
}

// Artikel hinzufügen
function addToCart(name, price) {
  cart.push({ name, price, quantity: 1 });
  localStorage.setItem("cart", JSON.stringify(cart));
  syncCartToServer();
  updateCartCount();
  alert(`${name} wurde dem Warenkorb hinzugefügt!`);
}

// Artikel entfernen
function removeFromCart(index) {
  cart.splice(index, 1);
  localStorage.setItem("cart", JSON.stringify(cart));
  syncCartToServer();
  renderCartItems();
  updateCartCount();
}

// Menge direkt ändern
function changeQuantity(index, newValue) {
  let qty = parseInt(newValue);
  if (isNaN(qty) || qty < 1) qty = 1;
  cart[index].quantity = qty;
  localStorage.setItem("cart", JSON.stringify(cart));
  syncCartToServer();
  renderCartItems();
  updateCartCount();
}

// Menge erhöhen
function increaseQuantity(index) {
  cart[index].quantity += 1;
  localStorage.setItem("cart", JSON.stringify(cart));
  syncCartToServer();
  renderCartItems();
  updateCartCount();
}

// Menge verringern
function decreaseQuantity(index) {
  if (cart[index].quantity > 1) {
    cart[index].quantity -= 1;
    localStorage.setItem("cart", JSON.stringify(cart));
    syncCartToServer();
    renderCartItems();
    updateCartCount();
  }
}

// Warenkorb anzeigen
function renderCartItems() {
  const cartItems = document.getElementById("cart-items");
  const cartTotal = document.getElementById("cart-total");
  if (!cartItems || !cartTotal) return;

  cartItems.innerHTML = "";
  let total = 0;

  if (cart.length === 0) {
    const emptyMsg = document.createElement("p");
    emptyMsg.textContent = "Dein Warenkorb ist leer.";
    emptyMsg.style.margin = "1rem";
    cartItems.appendChild(emptyMsg);
    cartTotal.textContent = "Gesamt: 0,00€";
    toggleExportButton();
    return;
  }

  cart.forEach((item, index) => {
    const li = document.createElement("li");
    li.classList.add("cart-item");

    li.innerHTML = `
      <div class="cart-card">
        <div class="cart-details">
          <h3>${item.name}</h3>
          <p>Einzelpreis: ${item.price.toFixed(2)}€</p>
          <div>
            <p>Anzahl: 
              <input 
                type="number"
                value="${item.quantity}"
                min="1"
                max="10"
                onchange="changeQuantity(${index}, this.value)"
              >
            </p>
          </div>
        </div>
        <button onclick="removeFromCart(${index})">🗑️</button>
      </div>
    `;
    cartItems.appendChild(li);
    total += item.price * item.quantity;
  });

  cartTotal.textContent = `Gesamt: ${total.toFixed(2)}€`;
  toggleExportButton();
}

// AJAX: Warenkorb vom Server laden
function loadCartFromServer() {
  fetch("get-cart.php")
    .then(res => res.json())
    .then(data => {
      cart = data;
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCartItems();
      updateCartCount();
    })
    .catch(err => console.error("Fehler beim Laden:", err));
}

// AJAX: Warenkorb zum Server senden
function syncCartToServer() {
  fetch("update-cart.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ cart: cart })
  });
}

// Warenkorb leeren
function clearCart() {
  cart = [];
  localStorage.removeItem("cart");
  syncCartToServer();
  updateCartCount();
  renderCartItems();
}

// Export-Logik
document.addEventListener("DOMContentLoaded", () => {
  loadCartFromServer();

  const exportBtn = document.getElementById("export-json");
  if (exportBtn) {
    exportBtn.addEventListener("click", () => {
      const statusEl = document.getElementById("user-status");
      const isLoggedIn = statusEl?.dataset.loggedin === "true";

      if (!isLoggedIn) {
        alert("❗ Du musst eingeloggt sein um zu Bestellen");
        return;
      }

      const orderData = {
        items: cart,
        total: cart.reduce((sum, item) => sum + item.price * item.quantity, 0)
      };

      const blob = new Blob([JSON.stringify(orderData, null, 2)], { type: "application/json" });
      const url = URL.createObjectURL(blob);
      const a = document.createElement("a");
      a.href = url;
      a.download = "bestellung.json";
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
      URL.revokeObjectURL(url);

      clearCart();
    });
  }
});
