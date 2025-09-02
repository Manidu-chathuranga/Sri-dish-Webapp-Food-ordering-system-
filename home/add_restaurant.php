<?php
session_start();
$username = $_SESSION['username'] ?? 'Guest';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../api/db_connect.php';

    $response = ['success' => false, 'message' => 'An unknown error occurred.'];
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $restaurant_name = filter_var($data['restaurant_name'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $owner_name = filter_var($data['owner_name'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $contact_email = filter_var($data['contact_email'] ?? '', FILTER_VALIDATE_EMAIL);
    $contact_phone = filter_var($data['contact_phone'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $restaurant_address = filter_var($data['restaurant_address'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_var($data['description'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($restaurant_name) || empty($owner_name) || empty($contact_email) || empty($contact_phone) || empty($restaurant_address)) {
        $response['message'] = 'Please fill in all required fields.';
    } else {
        try {
            $sql = "INSERT INTO `restaurant_applications` (`restaurant_name`, `owner_name`, `contact_email`, `contact_phone`, `restaurant_address`, `description`) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$restaurant_name, $owner_name, $contact_email, $contact_phone, $restaurant_address, $description]);

            $response['success'] = true;
            $response['message'] = 'Application submitted successfully! We will get back to you shortly.';
            
        } catch (PDOException $e) {
            error_log("Restaurant application submission error: " . $e->getMessage());
            $response['message'] = 'Database error during application submission: ' . $e->getMessage();
        }
    }
    echo json_encode($response);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Your Restaurant - Sri Dish</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .add-restaurant-section {
            padding: 100px 1.5rem 4rem;
            display: flex;
            justify-content: center;
            background-color: var(--light-bg-color);
        }

        .form-card {
            background-color: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .form-card h2 {
            color: var(--dark-text-color);
            margin-bottom: 0.5rem;
        }

        .form-card p {
            color: var(--text-light);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark-text-color);
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            color: var(--dark-text-color);
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #CD5656;
            transform: translateY(-3px);
        }
    </style>
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
        <section class="add-restaurant-section">
            <div class="form-card">
                <h2>Join Sri Dish as a Partner</h2>
                <p>Fill out the form below and we'll get back to you to get your restaurant set up on our platform.</p>
                <form id="add-restaurant-form">
                    <div class="form-group">
                        <label for="restaurant-name">Restaurant Name</label>
                        <input type="text" id="restaurant-name" name="restaurant_name" required>
                    </div>
                    <div class="form-group">
                        <label for="owner-name">Owner's Name</label>
                        <input type="text" id="owner-name" name="owner_name" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-email">Contact Email</label>
                        <input type="email" id="contact-email" name="contact_email" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-phone">Contact Phone</label>
                        <input type="tel" id="contact-phone" name="contact_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="restaurant-address">Restaurant Address</label>
                        <textarea id="restaurant-address" name="restaurant_address" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Short Description</label>
                        <textarea id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="submit-btn">Submit Application</button>
                </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('add-restaurant-form');
        
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
        
                const formData = new FormData(form);
                const applicationData = Object.fromEntries(formData.entries());
        
                try {
                    const response = await fetch('add_restaurant.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(applicationData)
                    });
        
                    const data = await response.json();
        
                    if (data.success) {
                        alert("Application submitted successfully! We will get back to you shortly.");
                        form.reset();
                    } else {
                        alert(`Submission failed: ${data.message}`);
                    }
        
                } catch (error) {
                    console.error('Error submitting application:', error);
                    alert('An unexpected error occurred. Please try again.');
                }
            });
        });
    </script>
</body>
</html>