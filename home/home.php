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
    <title>Sri Dish - Home</title>
    <link rel="stylesheet" href="../CSS/home.css">
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
                <a href="../index.php" class="logo">
                    <span class="logo-sri" style="color: #FF9494;">Sri</span><span class="logo-dish">Dish</span>
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
                <li><a href="delivery_dashboard.php"><i class="fas fa-heart"></i> Deliver orders</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i> My Cart</a></li>
                <li><a href="../landpage/helpandsupport.html"><i class="fas fa-question-circle"></i> Help & Support</a></li>
                <li><a href="add_restaurant.php"><i class="fas fa-utensils"></i> Add Your Restaurant</a></li>
                <li><a href="sign_up_deliver.php"><i class="fas fa-motorcycle"></i> Sign Up to Deliver</a></li>
                <li><a href="../index.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    </header>
    <section class="hero-banner">
        <div class="hero-content">
            <h1 class="hero-title">Delicious Food, Delivered Fast</h1>
            
        </div>
        <div class="hero-particles" id="particles"></div>
    </section>
    
    
    <section class="coupon-section" id="services-bg">
        <div class="hero-particles" id="particles"></div>
        <div class="section-header">
            <h2 class="section-title">Our Services</h2>
            <a href="#" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="coupon-container">
            <div class="coupon-card animate">
                <h3>Add Your Restaurant</h3>
                <p>List your restaurant and start getting orders.</p>
                <button class="copy-btn" onclick="document.location='add_restaurant.php'"> Add Now</button>
            </div>
            <div class="coupon-card animate">
                <h3>Sign Up to Deliver</h3>
                <p>Join as a rider and start earning today.</p>
                <button class="copy-btn" onclick="document.location='sign_up_deliver.php'"> Join the Team</button>
            </div>
            <div class="coupon-card animate">
                <h3>Grow up Your Business</h3>
                <p>Boost sales and reach more customers.</p>
                <button class="copy-btn" onclick="document.location='grow_business.php'"> Explore Tools</button>
            </div>
            
        </div>
    </section>
    <section class="restaurant-section">
        <div class="section-header">
            <h2 class="section-title" style="color: #FF9494;">Popular Restaurants</h2>
            <a href="#" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <h3 class="category-title"><i class="fas fa-flag"></i> Sri Lankan Cuisine</h3>
        <div class="restaurant-grid">
            <div class="restaurant-card animate" data-restaurant-id="1">
                <div class="restaurant-badge">★ TOP RATED</div>
                <img src="../assets/images/restaurants/spice-garden.jpg" alt="Spice Garden" class="restaurant-img">
                <div class="restaurant-info">
                    <h3 class="restaurant-name">Spice Garden</h3>
                    <div class="restaurant-meta">
                        <span class="restaurant-rating">★★★★☆ 4.6</span>
                        <span class="restaurant-delivery">30-45 min</span>
                    </div>
                    <p class="restaurant-cuisine">Traditional Sri Lankan, Rice & Curry</p>
                    <p class="restaurant-location">Colombo 03</p>
                    <button class="order-now-btn" data-restaurant-id="1">Order Now</button>
                </div>
            </div>
            <div class="restaurant-card animate" data-restaurant-id="2">
                <div class="restaurant-badge">♨️ SPICY</div>
                <img src="../assets/images/restaurants/kottu-shop.jpg" alt="The Kottu Shop" class="restaurant-img">
                <div class="restaurant-info">
                    <h3 class="restaurant-name">The Kottu Shop</h3>
                    <div class="restaurant-meta">
                        <span class="restaurant-rating">★★★★★ 4.9</span>
                        <span class="restaurant-delivery">20-35 min</span>
                    </div>
                    <p class="restaurant-cuisine">Kottu, Short Eats</p>
                    <p class="restaurant-location">Nugegoda</p>
                    <button class="order-now-btn" data-restaurant-id="2">Order Now</button>
                </div>
            </div>
            <div class="restaurant-card animate" data-restaurant-id="3">
                <img src="../assets/images/restaurants/hoppers-house.jpg" alt="Hoppers House" class="restaurant-img">
                <div class="restaurant-info">
                    <h3 class="restaurant-name">Hoppers House</h3>
                    <div class="restaurant-meta">
                        <span class="restaurant-rating">★★★★☆ 4.5</span>
                        <span class="restaurant-delivery">25-40 min</span>
                    </div>
                    <p class="restaurant-cuisine">Hoppers, String Hoppers</p>
                    <p class="restaurant-location">Kandy</p>
                    <button class="order-now-btn" data-restaurant-id="3">Order Now</button>
                </div>
            </div>
        </div>
        <h3 class="category-title"><i class="fas fa-globe-asia"></i> International Cuisine</h3>
        <div class="restaurant-grid">
            <div class="restaurant-card animate" data-restaurant-id="4">
                <div class="restaurant-badge">🍕 POPULAR</div>
                <img src="../assets/images/restaurants/pizza-hut.jpg" alt="Pizza Hut" class="restaurant-img">
                <div class="restaurant-info">
                    <h3 class="restaurant-name">Pizza Hut</h3>
                    <div class="restaurant-meta">
                        <span class="restaurant-rating">★★★★☆ 4.2</span>
                        <span class="restaurant-delivery">30-45 min</span>
                    </div>
                    <p class="restaurant-cuisine">Pizza, Pasta</p>
                    <p class="restaurant-location">Colombo 05</p>
                    <button class="order-now-btn" data-restaurant-id="4">Order Now</button>
                </div>
            </div>
            <div class="restaurant-card animate" data-restaurant-id="5">
                <div class="restaurant-badge">🍔 TRENDING</div>
                <img src="../assets/images/restaurants/burger-king.jpg" alt="Burger King" class="restaurant-img">
                <div class="restaurant-info">
                    <h3 class="restaurant-name">Burger King</h3>
                    <div class="restaurant-meta">
                        <span class="restaurant-rating">★★★★☆ 4.3</span>
                        <span class="restaurant-delivery">20-35 min</span>
                    </div>
                    <p class="restaurant-cuisine">Burgers, Fast Food</p>
                    <p class="restaurant-location">Battaramulla</p>
                    <button class="order-now-btn" data-restaurant-id="5">Order Now</button>
                </div>
            </div>
            <div class="restaurant-card animate" data-restaurant-id="6">
                <img src="../assets/images/restaurants/sushi-palace.jpg" alt="Sushi Palace" class="restaurant-img">
                <div class="restaurant-info">
                    <h3 class="restaurant-name">Sushi Palace</h3>
                    <div class="restaurant-meta">
                        <span class="restaurant-rating">★★★★★ 4.8</span>
                        <span class="restaurant-delivery">40-55 min</span>
                    </div>
                    <p class="restaurant-cuisine">Japanese, Sushi</p>
                    <p class="restaurant-location">Colombo 07</p>
                    <button class="order-now-btn" data-restaurant-id="6">Order Now</button>
                </div>
            </div>
        </div>
    </section>
    <section class="how-it-works">
        <div class="section-header-center">
            <h2 class="section-title">How Sri Dish Works</h2>
            <p class="section-subtitle">Get your favorite food delivered in just a few simple steps</p>
        </div>
        <div class="steps-container">
            <div class="step-card animate">
                <div class="step-number">1</div>
                <i class="fas fa-search-location step-icon"></i>
                <h3>Search & Select</h3>
                <p>Browse restaurants in your area and select your favorite dishes</p>
            </div>
            <div class="step-card animate">
                <div class="step-number">2</div>
                <i class="fas fa-cash-register step-icon"></i>
                <h3>Checkout</h3>
                <p>Review your order and proceed to secure payment</p>
            </div>
            <div class="step-card animate">
                <div class="step-number">3</div>
                <i class="fas fa-motorcycle step-icon"></i>
                <h3>Track Delivery</h3>
                <p>Follow your order in real-time as we prepare and deliver it</p>
            </div>
            <div class="step-card animate">
                <div class="step-number">4</div>
                <i class="fas fa-utensils step-icon"></i>
                <h3>Enjoy Your Meal</h3>
                <p>Receive your food and enjoy a delicious dining experience</p>
            </div>
        </div>
    </section>
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
                    <li><a href="home.php">Restaurants</a></li>
                    <li><a href="offers.php">Deals & Offers</a></li>
                    <li><a href="myaccount.php">My Account</a></li>
                    <li><a href="gift.php">Gift Cards</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul>
                    <li><a href="help-support.html">Help Center</a></li>
                    <li><a href="../landpage/helpandsupport.html">Contact Us</a></li>
                    <li><a href="../landpage/helpandsupport.html">FAQs</a></li>
                    <li><a href="../landpage/terms.html">Privacy Policy</a></li>
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
</body>
</html>