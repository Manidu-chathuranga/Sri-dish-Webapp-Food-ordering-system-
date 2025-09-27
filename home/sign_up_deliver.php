<?php
session_start();
$username = $_SESSION['username'] ?? 'Guest';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../api/db_connect.php';

    $response = ['success' => false, 'message' => 'An unknown error occurred.'];
    
    // Get and sanitize form data
    $rider_name = filter_input(INPUT_POST, 'rider_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $contact_email = filter_input(INPUT_POST, 'contact_email', FILTER_VALIDATE_EMAIL);
    $contact_phone = filter_input(INPUT_POST, 'contact_phone', FILTER_SANITIZE_SPECIAL_CHARS);
    $vehicle_type = filter_input(INPUT_POST, 'vehicle_type', FILTER_SANITIZE_SPECIAL_CHARS);
    $license_number = filter_input(INPUT_POST, 'license_number', FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($rider_name) || empty($contact_email) || empty($contact_phone) || empty($vehicle_type) || empty($license_number)) {
        $response['message'] = 'Please fill in all required fields.';
    } else {
        try {
            $sql = "INSERT INTO `rider_applications` (`rider_name`, `contact_email`, `contact_phone`, `vehicle_type`, `license_number`) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$rider_name, $contact_email, $contact_phone, $vehicle_type, $license_number]);

            $response['success'] = true;
            $response['message'] = 'Application submitted successfully! We will review it shortly.';
            
        } catch (PDOException $e) {
            error_log("Rider application submission error: " . $e->getMessage());
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
    <title>Sign Up to Deliver - Sri Dish</title>
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .rider-form-section {
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
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            color: var(--dark-text-color);
            transition: border-color 0.3s ease;
        }
        .form-group input:focus,
        .form-group select:focus {
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
        <section class="rider-form-section">
            <div class="form-card">
                <h2>Join Sri Dish as a Rider</h2>
                <p>Ready to earn? Fill out the form below to become a delivery partner!</p>
                <form id="rider-form">
                    <div class="form-group">
                        <label for="rider-name">Full Name</label>
                        <input type="text" id="rider-name" name="rider_name" required>
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
                        <label for="vehicle-type">Vehicle Type</label>
                        <select id="vehicle-type" name="vehicle_type" required>
                            <option value="">Select a vehicle...</option>
                            <option value="motorcycle">Motorcycle</option>
                            <option value="bicycle">Bicycle</option>
                            <option value="car">Car</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="license-number">License Number</label>
                        <input type="text" id="license-number" name="license_number" required>
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
            const form = document.getElementById('rider-form');

            form.addEventListener('submit', async (e) => {
                e.preventDefault();

                const formData = new FormData(form);
                const applicationData = Object.fromEntries(formData.entries());

                try {
                    const response = await fetch('sign_up_deliver.php', {
                        method: 'POST',
                        body: new URLSearchParams(applicationData)
                    });

                    const data = await response.json();

                    if (data.success) {
                        alert("Application submitted successfully! We will review it shortly.");
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