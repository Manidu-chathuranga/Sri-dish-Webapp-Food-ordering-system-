<?php
require_once '../api/db_connect.php';
$search_query = isset($_GET['q']) ? trim($_GET['q']) : '';
$search_results = [];
$message = '';

if (!empty($search_query)) {
    try {
        $sql = "SELECT * FROM `restaurants` WHERE `name` LIKE ? OR `description` LIKE ? OR `city` LIKE ?";
        $sql = "SELECT * FROM `foods` WHERE `name` LIKE ? OR `description` LIKE ? OR `category` LIKE ?";
        $stmt = $pdo->prepare($sql);
        $search_term = "%$search_query%";
        $stmt->execute([$search_term, $search_term, $search_term]);
        $search_results = $stmt->fetchAll();

        if (empty($search_results)) {
            $message = "No restaurants found for '" . htmlspecialchars($search_query) . "'.";
        }

    } catch (PDOException $e) {
        $message = "An error occurred while searching: " . $e->getMessage();
        error_log($message);
    }
} else {
    $message = "Please enter a search query.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Sri Dish</title>
    <link rel="stylesheet" href="../CSS/search_results.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo-container">
                <div class="hamburger-menu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <a href="../index.php"><h1 class="logo">Sri Dish</h1></a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="../login/login.php" class="login-btn">Log in</a></li>
                    <li><a href="../login/register.php" class="signup-btn">Sign up</a></li>
                </ul>
            </nav>
        </div>
        <div class="dropdown-menu">
            <ul>
                <li><a href="../login/register.php">Sign up</a></li>
                <li><a href="../login/login.php ">Log in</a></li>
                <li><a href="helpandsupport.html">Help & Support</a></li>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="careers.html">Careers</a></li>
            </ul>
            <div class="app-download">
                <div class="app-logo">Sri Dish</div>
                <p>Enjoy more with the app</p>
                <div class="app-buttons">
                    <a href="#"><img src="iphone.png" alt="App Store"></a>
                    <a href="#"><img src="playstore.png" alt="Google Play"></a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="search-results-section">
            <div class="results-container">
                <?php if (!empty($search_results)): ?>
                    <h2 class="results-heading">Found <?php echo count($search_results); ?> restaurants for "<?php echo htmlspecialchars($search_query); ?>"</h2>
                    <div class="restaurant-grid">
                        <?php foreach ($search_results as $restaurant): ?>
                            <div class="restaurant-card">
                                <div class="restaurant-img" style="background-image: url('../<?php echo htmlspecialchars($restaurant['image_url']); ?>');"></div>
                                <h3><?php echo htmlspecialchars($restaurant['name']); ?></h3>
                                <div class="rating">
                                    
                                   
                                </div>
                                <p><?php echo htmlspecialchars($restaurant['description']); ?></p>
                                <p class="city-name"><?php echo htmlspecialchars($restaurant['name']); ?></p>
                                <a href="../login/login.php"><button class="menu-btn">View Menu</button></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <h2 class="results-heading"><?php echo htmlspecialchars($message); ?></h2>
                    <p class="no-results-text">Try searching for a different restaurant, cuisine, or location.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>

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
                    </ul> 
                </div> 
            </section> 
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
        <div class="copyright"> 
            <p>&copy; 2025 Sri Dish PVT LTD</p> 
        </div> 
    </footer> 

    <script src="index.js"></script>
</body>
</html>
