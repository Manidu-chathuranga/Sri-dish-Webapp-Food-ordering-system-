<?php
// File: SRIDISH/home/foodorder.php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit();
}
$username = $_SESSION['username'] ?? 'Guest';
$restaurant_id = isset($_GET['restaurant_id']) ? intval($_GET['restaurant_id']) : 0;

// This array contains all the restaurant menu data.
$dummy_restaurants_menus = [
    1 => [
        'name' => 'Spice Garden',
        'menu' => [
            ['id' => 101, 'name' => 'Chicken Kottu', 'description' => 'Shredded flatbread, chicken, vegetables, and spices, chopped on a hot griddle.', 'price' => 850.00, 'image_url' => '../assets/images/food/chicken-kottu.jpg'],
            ['id' => 102, 'name' => 'Pol Roti & Lunumiris', 'description' => 'Traditional coconut flatbread with spicy onion sambol.', 'price' => 450.00, 'image_url' => '../assets/images/food/pol-roti.jpg'],
            ['id' => 103, 'name' => 'Fish Ambul Thiyal', 'description' => 'Sour fish curry, a signature Sri Lankan dish, served with rice.', 'price' => 950.00, 'image_url' => '../assets/images/food/fish-ambul.jpg'],
            ['id' => 104, 'name' => 'String Hoppers with Kiri Hodi', 'description' => 'Steamed rice flour noodles served with a creamy coconut gravy.', 'price' => 650.00, 'image_url' => '../assets/images/food/string-hoppers.jpg'],
            ['id' => 105, 'name' => 'Jaffna Crab Curry', 'description' => 'Fiery crab curry made with authentic Jaffna spices and coconut milk.', 'price' => 1500.00, 'image_url' => '../assets/images/food/jaffna-crab.jpg'],
            ['id' => 106, 'name' => 'Watalappan', 'description' => 'A sweet pudding made from coconut milk, jaggery, cashew nuts, and spices.', 'price' => 400.00, 'image_url' => '../assets/images/food/watalappan.jpg']
        ]
    ],
    2 => [
        'name' => 'The Kottu Shop',
        'menu' => [
            ['id' => 201, 'name' => 'Cheese Kottu', 'description' => 'Kottu with a generous layer of melted cheese.', 'price' => 950.00, 'image_url' => '../assets/images/food/cheese-kottu.jpg'],
            ['id' => 202, 'name' => 'Vegetable Kottu', 'description' => 'Mixed vegetables chopped and stir-fried with flatbread.', 'price' => 600.00, 'image_url' => '../assets/images/food/veg-kottu.jpg'],
            ['id' => 203, 'name' => 'Dolphin Kottu', 'description' => 'A special mix of kottu with chicken, cheese, and egg.', 'price' => 1200.00, 'image_url' => '../assets/images/food/dolphin-kottu.jpg'],
            ['id' => 204, 'name' => 'Pol Sambol Kottu', 'description' => 'Kottu with a unique flavor from fresh coconut sambol.', 'price' => 800.00, 'image_url' => '../assets/images/food/pol-sambol-kottu.jpg']
        ]
    ],
    3 => [
        'name' => 'Hoppers Kade',
        'menu' => [
            ['id' => 301, 'name' => 'Plain Hoppers', 'description' => 'Crispy, bowl-shaped pancakes made from fermented rice flour.', 'price' => 200.00, 'image_url' => '../assets/images/food/plain-hoppers.jpg', 'category' => 'Hoppers'],
            ['id' => 302, 'name' => 'Egg Hopper', 'description' => 'A plain hopper with a fried egg cooked into the center.', 'price' => 250.00, 'image_url' => '../assets/images/food/egg-hopper.jpg', 'category' => 'Hoppers'],
            ['id' => 303, 'name' => 'String Hoppers', 'description' => 'Steamed rice flour noodles served with curry.', 'price' => 300.00, 'image_url' => '../assets/images/food/string-hoppers.jpg', 'category' => 'Hoppers'],
            ['id' => 304, 'name' => 'Seafood String Hopper Biryani', 'description' => 'Layered with spiced rice, seafood, and vegetables.', 'price' => 850.00, 'image_url' => '../assets/images/food/seafood-hopper-biryani.jpg', 'Biryani'],
            ['id' => 305, 'name' => 'Milk Hopper with Treacle', 'description' => 'A sweet, soft hopper served with kithul treacle.', 'price' => 350.00, 'image_url' => '../assets/images/food/milk-hopper.jpg', 'category' => 'Hoppers'],
        ]
    ],
    4 => [
        'name' => 'Pizza Kotuwa',
        'menu' => [
            ['id' => 401, 'name' => 'Chicken Dominator Pizza', 'description' => 'Loaded with spicy chicken, onions, and capsicum.', 'price' => 1800.00, 'image_url' => '../assets/images/food/pizza-dominator.jpg', 'category' => 'Pizza'],
            ['id' => 402, 'name' => 'Garlic Bread', 'description' => 'Toasted bread with garlic butter and herbs.', 'price' => 400.00, 'image_url' => '../assets/images/food/garlic-bread.jpg', 'category' => 'Side'],
            ['id' => 403, 'name' => 'Veggie Supreme Pizza', 'description' => 'Mushrooms, onions, peppers, and olives on a classic crust.', 'price' => 1650.00, 'image_url' => '../assets/images/food/veggie-supreme.jpg', 'category' => 'Pizza'],
            ['id' => 404, 'name' => 'Spaghetti Bolognese', 'description' => 'Pasta with a rich meat and tomato sauce.', 'price' => 950.00, 'image_url' => '../assets/images/food/spaghetti.jpg', 'category' => 'Pasta'],
        ]
    ],
    5 => [
        'name' => 'Burger Rasaya',
        'menu' => [
            ['id' => 501, 'name' => 'Whopper', 'description' => 'Flame-grilled beef patty with fresh vegetables.', 'price' => 1100.00, 'image_url' => '../assets/images/food/whopper.jpg', 'category' => 'Burger'],
            ['id' => 502, 'name' => 'Chicken Royale', 'description' => 'Crispy chicken fillet with lettuce and mayo.', 'price' => 950.00, 'image_url' => '../assets/images/food/chicken-royale.jpg', 'category' => 'Burger'],
            ['id' => 503, 'name' => 'King Fries', 'description' => 'Crispy, golden French fries, perfectly salted.', 'price' => 350.00, 'image_url' => '../assets/images/food/king-fries.jpg', 'category' => 'Side'],
            ['id' => 504, 'name' => 'Onion Rings', 'description' => 'Crispy fried onion rings with a side of dipping sauce.', 'price' => 450.00, 'image_url' => '../assets/images/food/onion-rings.jpg', 'category' => 'Side'],
        ]
    ],
    6 => [
        'name' => 'Sushi Wasa',
        'menu' => [
            ['id' => 601, 'name' => 'California Roll', 'description' => 'Crab meat, avocado, and cucumber.', 'price' => 750.00, 'image_url' => '../assets/images/food/california-roll.jpg', 'category' => 'Sushi'],
            ['id' => 602, 'name' => 'Spicy Tuna Roll', 'description' => 'Fresh tuna mixed with spicy sauce.', 'price' => 850.00, 'image_url' => '../assets/images/food/spicy-tuna-roll.jpg', 'category' => 'Sushi'],
            ['id' => 603, 'name' => 'Salmon Sashimi', 'description' => 'Thinly sliced fresh raw salmon.', 'price' => 1200.00, 'image_url' => '../assets/images/food/salmon-sashimi.jpg', 'Sashimi'],
            ['id' => 604, 'name' => 'Dragon Roll', 'description' => 'Eel and cucumber topped with avocado.', 'price' => 1350.00, 'image_url' => '../assets/images/food/dragon-roll.jpg', 'Sushi'],
            ['id' => 605, 'name' => 'Edamame', 'description' => 'Steamed soybeans with sea salt.', 'price' => 400.00, 'image_url' => '../assets/images/food/edamame.jpg', 'Appetizer'],
        ]
    ]
];

$restaurant_name = "Restaurant Not Found";
$food_items = [];

if ($restaurant_id > 0 && isset($dummy_restaurants_menus[$restaurant_id])) {
    $restaurant_name = $dummy_restaurants_menus[$restaurant_id]['name'];
    $food_items = $dummy_restaurants_menus[$restaurant_id]['menu'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Dish - <?php echo htmlspecialchars($restaurant_name); ?> Menu</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/foodorder.css">
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
        <section class="food-items-section">
            <h2>Menu from <?php echo htmlspecialchars($restaurant_name); ?></h2>
            <div class="food-list">
                <?php if (empty($food_items)): ?>
                    <p class="empty-message">No food items available for this restaurant yet. Please check back later!</p>
                <?php else: ?>
                    <?php foreach ($food_items as $food): ?>
                        <div class="food-card">
                            <img src="<?php echo htmlspecialchars($food['image_url']); ?>" alt="<?php echo htmlspecialchars($food['name']); ?>">
                            <div class="food-card-content">
                                <h3><?php echo htmlspecialchars($food['name']); ?></h3>
                                <p><?php echo htmlspecialchars($food['description']); ?></p>
                                <div class="price">LKR <?php echo number_format($food['price'], 2); ?></div>
                                <button class="add-to-cart-btn"
                                        data-food-id="<?php echo $food['id']; ?>"
                                        data-food-name="<?php echo htmlspecialchars($food['name']); ?>"
                                        data-food-price="<?php echo $food['price']; ?>">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Sri Dish</h3>
                <p>Delivering happiness one meal at a time. Sri Lanka's favorite food delivery service since 2023.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">Restaurants</a></li>
                    <li><a href="#">Deals & Offers</a></li>
                    <li><a href="#">My Account</a></li>
                    <li><a href="#">Gift Cards</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="help-support.html">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="terms-of-service.html">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Food Street, Colombo, Sri Lanka</p>
                <p><i class="fas fa-phone"></i> +94 11 234 5678</p>
                <p><i class="fas fa-envelope"></i> support@sridish.lk</p>
                <p><i class="fas fa-clock"></i> 24/7 Customer Support</p>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Sri Dish. All rights reserved.</p>
        </div>
    </footer>
    <script src="home.js"></script>
    <script src="foodorder.js"></script>
</body>
</html>
