// script.js

let cart = JSON.parse(localStorage.getItem("cart")) || [];

//Export-Button ein-/ausblenden
function toggleExportButton() {
  const exportBtn = document.getElementById("export-json");
  if (!exportBtn) return;
  if (cart.length > 0) {
    exportBtn.style.display = ""; // CSS-Default anzeigen
  } else {
    exportBtn.style.display = "none"; // ausblenden, wenn leer
  }
}

//Cart-Count anpassen
function updateCartCount() {
  const countElement = document.getElementById("cart-count");
  if (!countElement) return;
  // statt cart.length: Gesamtanzahl aller Items
  const totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
  countElement.textContent = totalQty;
}

// Beim Hinzufügen immer mit quantity: 1 anlegen
function addToCart(name, price) {
  cart.push({ name, price, quantity: 1 });
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartCount();
  alert(`${name} wurde dem Warenkorb hinzugefügt! 🛒`);
}

// Render-Funktion für den Warenkorb inkl. Mengensteuerung
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
                style="color:white; width: 100px; background-color: rgba(255, 255, 255, 0); border: none; border: 1px solid; border-radius: 5px; padding: 5px;"
                type="number" 
                class="quantity-input" 
                value="${item.quantity}"
                step="1"	 
                min="1" 
                max="10"
                onchange="changeQuantity(${index}, this.value)"
              >
            </p>
          </div>
        </div>
        <button class="remove-btn" onclick="removeFromCart(${index})">🗑️</button>
      </div>
    `;

    cartItems.appendChild(li);
    total += item.price * item.quantity;
  });

  cartTotal.textContent = `Gesamt: ${total.toFixed(2)}€`;
  toggleExportButton();
}

// Menge erhöhen
function increaseQuantity(index) {
  cart[index].quantity += 1;
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCartItems();
  updateCartCount();
}

// Menge verringern (mindestens 1)
function decreaseQuantity(index) {
  if (cart[index].quantity > 1) {
    cart[index].quantity -= 1;
    localStorage.setItem("cart", JSON.stringify(cart));
    renderCartItems();
    updateCartCount();
  }
}

// Menge direkt im Input-Feld ändern
function changeQuantity(index, newValue) {
  let qty = parseInt(newValue);
  if (isNaN(qty) || qty < 1) {
    qty = 1;
  }
  cart[index].quantity = qty;
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCartItems();
  updateCartCount();
}

// Item komplett entfernen
function removeFromCart(index) {
  cart.splice(index, 1);
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCartItems();
  updateCartCount();
}

document.addEventListener("DOMContentLoaded", () => {
  updateCartCount();
  renderCartItems(); // ruft toggleExportButton() intern auf

  //Export-Button
const exportBtn = document.getElementById("export-json");
if (exportBtn) {
  exportBtn.addEventListener("click", () => {
    const statusEl = document.getElementById("user-status");
    const isLoggedIn = statusEl?.dataset.loggedin === "true";

    if (!isLoggedIn) {
      alert("❗Du musst eingeloggt sein, um eine Bestellung abzusenden.");
      return;
    }

    console.log("Export-Button wurde geklickt!");

    const orderData = {
      items: cart,
      total: cart.reduce((sum, item) => sum + item.price * item.quantity, 0)
    };
    const jsonStr = JSON.stringify(orderData, null, 2);

    const blob = new Blob([jsonStr], { type: "application/json" });
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

//Warenkorb leeren
function clearCart() {
  cart = [];  // Array leeren
  localStorage.removeItem("cart");
  // UI aktualisieren
  updateCartCount();
  renderCartItems();
}
