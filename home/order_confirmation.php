<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}
$username = $_SESSION['username'] ?? 'Guest';
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        main {
            padding-top: 100px;
            min-height: calc(100vh - 150px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .confirmation-box {
            text-align: center;
            background-color: #fff;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            max-width: 600px;
        }
        .confirmation-box i {
            color: var(--secondary-color);
            font-size: 4rem;
            margin-bottom: 20px;
            animation: bounceIn 1s ease-out;
        }
        .confirmation-box h2 {
            font-size: 2.5em;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        .confirmation-box p {
            font-size: 1.1em;
            color: var(--dark-text-color);
            margin-bottom: 25px;
        }
        .confirmation-box a {
            padding: 12px 25px;
            background-color: var(--primary-color);
            color: var(--light-bg-color);
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .confirmation-box a:hover {
            background-color: #e65c36;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="menu-container">
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
    </header>
    <main>
        <div class="confirmation-box">
            <i class="fas fa-check-circle"></i>
            <h2>Order Confirmed!</h2>
            <p>Thank you for your order. Your food is being prepared and will be delivered shortly.</p>
            <?php if ($order_id): ?>
                <p>Your order ID is: <strong><?php echo htmlspecialchars($order_id); ?></strong></p>
            <?php endif; ?>
            <a href="home.php">Back to Home</a>
        </div>
    </main>
    <footer>
        <div class="copyright">
            <p>&copy; 2025 Sri Dish. All rights reserved.</p>
        </div>
    </footer>
    <script src="home.js"></script>
</body>
</html>