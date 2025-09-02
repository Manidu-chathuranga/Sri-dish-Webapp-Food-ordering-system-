<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Dish - Food Delivery Service</title>
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-slider">
        <div class="slide active" style="background-image: url('../landpage/Land_img/bg1.png');"></div>
        <div class="slide" style="background-image: url('../landpage/Land_img/bg2.png');"></div>
        <div class="slide" style="background-image: url('../landpage/Land_img/bg3.png');"></div>
        <div class="slide" style="background-image: url('../landpage/Land_img/bg4.png');"></div>
    </div>

    <!-- Header & Navigation -->
    <header>
        <div class="container">
            <div class="logo-container">
                <div class="hamburger-menu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <h1 class="logo">Sri Dish</h1>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="../login/login.php" class="login-btn">Log in</a></li>
                    <li><a href="../login/register.php" class="signup-btn">Sign up</a></li>
                </ul>
            </nav>
        </div>
        <!-- Dropdown Menu -->
        <div class="dropdown-menu">
            <ul>
                <li><a href="login/register.php">Sign up</a></li>
                <li><a href="login/login.php">Log in</a></li>
                <li><a href="landpage/helpandsupport.html">Help & Support</a></li>
                <li><a href="landpage/terms.html">Terms of Service</a></li>
                <li><a href="landpage/careers.html">Careers</a></li>
            </ul>
            <div class="app-download">
                <div class="app-logo">Sri Dish</div>
                <p>Enjoy more with the app</p>
                <div class="app-buttons">
                    <a href=""><img src="landpage/Land_img/iphone.png" alt="App Store"></a>
                    <a href=""><img src="landpage/Land_img/playstore.png" alt="Google Play"></a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="hero">
            <div class="headline-container">
                <h2 class="headline active">Delicious Food Delivered Fast</h2>
                <h2 class="headline">From Your Favorite Restaurants</h2>
                <h2 class="headline">Order Now, Enjoy Soon</h2>
            </div>
            <div class="search-container">
                <input type="text" placeholder="What Foods On Your Mind....">
                <button class="search-btn">Find Food</button>
            </div>
            
            <div class="features">
                <div class="feature-card">
                    <i class="fas fa-bolt"></i>
                    <h3>Fast Delivery</h3>
                    <p>Get your food in 30 minutes or less</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-utensils"></i>
                    <h3>100+ Restaurants</h3>
                    <p>Wide selection of cuisines</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-percent"></i>
                    <h3>Great Deals</h3>
                    <p>Daily discounts and offers</p>
                </div>
            </div>
        </section>
        
        <section class="popular-restaurants">
            <h2>Popular Restaurants</h2>
            <div class="restaurant-scroller">
                <div class="restaurant-grid">
                    <div class="restaurant-card">
                        <div class="restaurant-img" style="background-image: url('../landpage/Land_img/spicegarder.png');"></div>
                        <h3>Spice Garden</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.5</span>
                        </div>
                        <p>Indian, Chinese, Sri Lankan, Locals</p>
                        <button class="menu-btn">View Menu</button>
                    </div>
                    <div class="restaurant-card">
                        <div class="restaurant-img" style="background-image: url('../landpage/Land_img/Burger House.png');"></div>
                        <h3>Burger House</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>4.0</span>
                        </div>
                        <p>Burgers, Fast Food, French fries </p>
                        <button class="menu-btn">View Menu</button>
                    </div>
                    <div class="restaurant-card">
                        <div class="restaurant-img" style="background-image: url('../landpage/Land_img/Home Pizza.png');"></div>
                        <h3> Home Pizza</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span>5.0</span>
                        </div>
                        <p>Pizza, Italian, Pasta</p>
                        <button class="menu-btn">View Menu</button>
                    </div>
                    <div class="restaurant-card">
                        <div class="restaurant-img" style="background-image: url('../landpage/Land_img/cocosweets.png');"></div>
                        <h3> Coco Sweets</h3>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span>4.5</span>
                        </div>
                        <p>Sweets, Desserts  </p>
                        <button class="menu-btn">View Menu</button>
                    </div>
                    <!-- Add more restaurant cards as needed -->
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <section class="locations">
                <h3>Available Locations</h3>
                
                <div class="location-list">
                    <ul>
                        <li>Colombo</li>
                        <li>Kandy</li>
                        <li>Galle</li>
                        <li>Jaffna</li>
                        <li>Anuradhapura</li>
                        <li>Kalutara</li>
                        <li>Baththaramulla</li>
                    </ul>
                </div>
            </section>

            <!-- Services Section -->
            <section class="services">
                <h3>What We Offer</h3>
                <ul>
                    <li>Fast food delivery</li>
                    <li>Wide restaurant selection</li>
                    <li>Real-time order tracking</li>
                    <li>Secure payments</li>
                    <li>24/7 customer support</li>
                </ul>
            </section>

            <!-- Social Media -->
            <section class="social-media">
                <h3>Connect With Us</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
                <h3>Contact Info</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Food Street, Colombo, Sri Lanka</p>
                <p><i class="fas fa-phone"></i> +94 11 234 5678</p>
                <p><i class="fas fa-envelope"></i> support@sridish.lk</p>
                <p><i class="fas fa-clock"></i> 24/7 Customer Support</p>
            
            </section>
        </div>

        <!-- Copyright -->
        <div class="copyright">
            <p>&copy; 2025 Sri Dish PVT LTD</p>
        </div>
    </footer>

    <script src="../landpage/index.js"></script>
</body>ds
</html>