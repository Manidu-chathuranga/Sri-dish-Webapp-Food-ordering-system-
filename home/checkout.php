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
    <title>Sri Dish - Checkout</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/checkout.css">
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
                <li><a href="myorders.php"><i class="fas fa-clipboard-list"></i> My Orders</a></li>
                <li><a href="#"><i class="fas fa-heart"></i> Favorites</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> My Cart</a></li>
                <li><a href="help-support.html"><i class="fas fa-question-circle"></i> Help & Support</a></li>
                <li><a href="add_restaurant.php"><i class="fas fa-utensils"></i> Add Your Restaurant</a></li>
                <li><a href="sign_up_deliver.php"><i class="fas fa-motorcycle"></i> Sign Up to Deliver</a></li>
                <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </header>

    <main>
        <section class="checkout-section">
            <h2>Checkout</h2>
            <div class="checkout-container">
                <div class="checkout-form-container">
                    <h3>Delivery Details</h3>
                    <form id="checkout-form">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Delivery Address</label>
                            <textarea id="address" name="address" rows="3" required></textarea>
                        </div>
                        <h3>Payment Method</h3>
                        <div class="form-group payment-options">
                            <label><input type="radio" name="payment_method" value="card" checked> Credit/Debit Card</label>
                            <label><input type="radio" name="payment_method" value="cod"> Cash on Delivery</label>
                            <label><input type="radio" name="payment_method" value="crypto"> Crypto(USDT)</label>
                        </div>

                        <div id="card-details-form" class="card-details-form">
                            <div class="form-group">
                                <label for="card-number">Card Number</label>
                                <input type="text" id="card-number" name="card-number" placeholder="0000 0000 0000 0000" required>
                            </div>
                            <div class="form-group">
                                <label for="card-holder-name">Card Holder Name</label>
                                <input type="text" id="card-holder-name" name="card-holder-name" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="expiry-date">Expiry Date</label>
                                    <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY" required>
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="123" required>
                                </div>
                            </div>
                        </div>

                        <div id="crypto-details-form" class="crypto-details-form">
                            <h4>Pay with Crypto (USDT)</h4>
                            <p>Scan the QR code or send to the address below.</p>
                            <div class="qr-code-container">
                                <img src="home_image/qr.png" alt="USDT QR Code" class="qr-code-image">
                            </div>
                            <div class="form-group">
                                <label for="crypto-address">USDT Address (TRC20)</label>
                                <input type="text" id="crypto-address" name="crypto-address" value="0x1234567890abcdef1234567890abcdef" readonly>
                            </div>
                        </div>

                        <button type="submit" class="place-order-btn">Pay Now</button>
                    </form>
                </div>
                <div class="order-summary-container">
                    <h3>Order Summary</h3>
                    <div id="order-items-list">
                        </div>
                    <div class="order-summary-totals">
                        <p>Subtotal: LKR <span id="summary-subtotal">0.00</span></p>
                        <p>Delivery Fee: LKR <span id="summary-delivery">0.00</span></p>
                        <p class="total">Total: LKR <span id="summary-total">0.00</span></p>
                    </div>
                </div>
            </div>
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
    <script src="checkout.js"></script>
</body>
</html>