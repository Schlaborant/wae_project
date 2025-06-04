// script.js

let cart = JSON.parse(localStorage.getItem("cart")) || [];

function updateCartCount() {
  const countElement = document.getElementById("cart-count");
  if (countElement) countElement.textContent = cart.length;
}

function addToCart(name, price) {
  cart.push({ name, price });
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartCount();
  alert(`${name} wurde dem Warenkorb hinzugefügt! 🛒`);
}

function renderCartItems() {
  const cartItems = document.getElementById("cart-items");
  const cartTotal = document.getElementById("cart-total");

  if (!cartItems || !cartTotal) return;

  cartItems.innerHTML = "";
  let total = 0;

  cart.forEach((item, index) => {
    const li = document.createElement("li");
    li.innerHTML = `
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <span>${item.name} - ${item.price.toFixed(2)}€</span>
        <button onclick="removeFromCart(${index})">🗑️</button>
      </div>
    `;
    cartItems.appendChild(li);
    total += item.price;
  });

  cartTotal.textContent = `Gesamt: ${total.toFixed(2)}€`;
}

function removeFromCart(index) {
  cart.splice(index, 1);
  localStorage.setItem("cart", JSON.stringify(cart));
  renderCartItems();
  updateCartCount();
}

document.addEventListener("DOMContentLoaded", () => {
  updateCartCount();
  renderCartItems();

  const loginForm = document.querySelector(".login-form");
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const email = document.getElementById("email").value;
      const password = document.getElementById("password").value;
      if (email && password) {
        alert("Login erfolgreich! ✨");
        loginForm.reset();
      } else {
        alert("Bitte fülle alle Felder aus.");
      }
    });
  }


  // Export-Button Funktionalität
  const exportBtn = document.getElementById("export-json");
  if (exportBtn) {
    exportBtn.addEventListener("click", () => {
          console.log("Export-Button wurde geklickt!"); // <-- Hier siehst du es in der Konsole


      const orderData = {
        items: cart,
        total: cart.reduce((sum, item) => sum + item.price, 0)
      };
      const jsonStr = JSON.stringify(orderData, null, 2);

      // Blob erstellen und Download-Link generieren
      const blob = new Blob([jsonStr], { type: "application/json" });
      const url = URL.createObjectURL(blob);

      // Temporären Link erzeugen und "klicken"
      const a = document.createElement("a");
      a.href = url;
      a.download = "bestellung.json";
      document.body.appendChild(a);
      a.click();

      // Aufräumen
      document.body.removeChild(a);
      URL.revokeObjectURL(url);
    });
  }
});


    function showSlides(n) {
      if (!slides) slides = document.getElementsByClassName("slide");
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex = (n + slides.length) % slides.length;
      slides[slideIndex].style.display = "block";
    }

    function plusSlides(n) {
      clearInterval(slideTimer);
      showSlides(slideIndex + n);
      startAutoSlide();
    }

    function startAutoSlide() {
      slideTimer = setInterval(() => {
        showSlides(slideIndex + 1);
      }, 4000);
    }

    document.addEventListener("DOMContentLoaded", () => {
      slides = document.getElementsByClassName("slide");
      showSlides(slideIndex);
      startAutoSlide();
    });