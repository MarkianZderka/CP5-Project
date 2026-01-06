<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart - Simple Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Simple Shop</h1>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if (isset($_SESSION["user"])): ?>
            <li>Hello, <?= htmlspecialchars($_SESSION["user"]) ?></li>
            <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
            <li><a href="register.html">Register</a></li>
            <li><a href="login.html">Log in</a></li>
            <?php endif; ?>
            <li><a href="cart.php">Cart</a></li>
        </ul>
    </nav>

</header>

<main>
    <h2>Your Cart</h2>

    <div id="cart-items"></div>

    <h3 style="text-align:center; margin-top: 20px;">Total: <span id="cart-total">0</span> PLN</h3>

    <button id="clear-cart">Clear cart</button>
</main>


<footer>
    <p>&copy; 2026 Simple Shop. Educational project.</p>
</footer>
<script src="script.js"></script>
</body>
</html>
