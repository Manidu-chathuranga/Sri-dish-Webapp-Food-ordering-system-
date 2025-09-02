<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}
$username = $_SESSION['username'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Dish - Your Cart</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="menu-container">
                <div class="hamburger-menu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <a href="home.php" class="logo">
                    <span class="logo-sri">Sri</span><span class="logo-dish">Dish</span>
                </a>
            </div>
            <div class="header-right">
                <a href="cart.php" class="cart-icon-container">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count" class="cart-count">0</span>
                </a>
                <div class="user-menu">
                    <span class="username"><?php echo htmlspecialchars($username); ?></span>
                    <div class="user-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown-menu">
            <ul>
                <li><a href="#"><i class="fas fa-clipboard-list"></i> My Orders</a></li>
                <li><a href="#"><i class="fas fa-heart"></i> Favorites</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> My Cart</a></li>
                <li><a href="help-support.html"><i class="fas fa-question-circle"></i> Help & Support</a></li>
                <li><a href="#"><i class="fas fa-utensils"></i> Add Your Restaurant</a></li>
                <li><a href="#"><i class="fas fa-motorcycle"></i> Sign Up to Deliver</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </header>
    <main>
        <section class="cart-section">
            <h2>Your Shopping Cart</h2>
            <ul id="cart-items-list">
                </ul>
            <div id="empty-cart-placeholder" class="empty-cart-message" style="display: none;">
                <p>Your cart is empty. <a href="home.php">Start adding some delicious food!</a></p>
            </div>
            <div class="cart-summary" id="cart-summary-section" style="display: none;">
                <p>Subtotal: LKR <span id="subtotal-amount">0.00</span></p>
                <p>Delivery Fee: LKR <span id="delivery-fee-amount">150.00</span></p>
                <p class="total">Total: LKR <span id="total-amount">0.00</span></p>
            </div>
            <button class="checkout-btn" id="checkout-button" style="display: none;">Proceed to Checkout</button>
        </section>
    </main>
    <footer>
        <div class="footer-container">
            </div>
        <div class="copyright">
            <p>&copy; 2025 Sri Dish. All rights reserved.</p>
        </div>
    </footer>
    <script src="home.js"></script>
    <script src="cart.js"></script>
</body>
</html>