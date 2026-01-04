document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("registerForm");

    const username = document.getElementById("username");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
    const country = document.getElementById("country");
    const terms = document.getElementById("terms");

    form.addEventListener("submit", function (e) {
        let isValid = true;

        clearErrors();

        // Username
        if (username.value.trim().length < 3) {
            showError("usernameError", "Username must be at least 3 characters");
            isValid = false;
        }

        // Email
        if (!validateEmail(email.value)) {
            showError("emailError", "Please enter a valid email");
            isValid = false;
        }

        // Password
        if (password.value.length < 6) {
            showError("passwordError", "Password must be at least 6 characters");
            isValid = false;
        }

        // Confirm password
        if (password.value !== confirmPassword.value) {
            showError("confirmPasswordError", "Passwords do not match");
            isValid = false;
        }

        // Country
        if (country.value === "") {
            showError("countryError", "Please select a country");
            isValid = false;
        }

        // Terms
        if (!terms.checked) {
            showError("termsError", "You must accept the terms");
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });

    function showError(id, message) {
        document.getElementById(id).innerText = message;
    }

    function clearErrors() {
        const errors = document.querySelectorAll(".error");
        errors.forEach(error => error.innerText = "");
    }

    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

});


document.addEventListener("DOMContentLoaded", () => {

    // ===== CART STORAGE =====
    function getCart() {
        return JSON.parse(localStorage.getItem("cart")) || [];
    }

    function saveCart(cart) {
        localStorage.setItem("cart", JSON.stringify(cart));
        updateCartCount();
    }

    // ===== CART COUNT =====
    function updateCartCount() {
    const cart = getCart();
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    const counter = document.getElementById("cart-count");

    if (counter) {
        counter.innerText = count;

        counter.classList.remove("cart-animate");
        void counter.offsetWidth; // trick to restart animation
        counter.classList.add("cart-animate");
    }
    }

    // ===== ADD TO CART =====
    const buttons = document.querySelectorAll(".add-to-cart");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const name = btn.dataset.name;
            const price = Number(btn.dataset.price);

            let cart = getCart();
            const existing = cart.find(item => item.id === id);

            if (existing) {
                existing.quantity++;
            } else {
                cart.push({ id, name, price, quantity: 1 });
            }

            saveCart(cart);
        });
    });

    // ===== RENDER CART PAGE =====
    function renderCart() {
        const cartItems = document.getElementById("cart-items");
        const totalEl = document.getElementById("cart-total");

        if (!cartItems || !totalEl) return;

        const cart = getCart();
        cartItems.innerHTML = "";
        let total = 0;

        cart.forEach(item => {
            total += item.price * item.quantity;

            const div = document.createElement("div");
            div.classList.add("cart-item");

            div.innerHTML = `
            <img src="images/${item.id}.jpg" alt="${item.name}">
            <div class="cart-item-info">
            <strong>${item.name}</strong>
            <span>${item.quantity} × ${item.price} PLN</span>
            </div>
            <button data-id="${item.id}">Remove</button>
            `;

            cartItems.appendChild(div);
        });

        totalEl.innerText = total;

        // Remove buttons
        cartItems.querySelectorAll("button").forEach(btn => {
            btn.addEventListener("click", () => {
                let cart = getCart().filter(i => i.id !== btn.dataset.id);
                saveCart(cart);
                renderCart();
            });
        });
    }

    // ===== CLEAR CART =====
    const clearBtn = document.getElementById("clear-cart");
    if (clearBtn) {
        clearBtn.addEventListener("click", () => {
            localStorage.removeItem("cart");
            updateCartCount();
            renderCart();
        });
    }

    updateCartCount();
    renderCart();
});
