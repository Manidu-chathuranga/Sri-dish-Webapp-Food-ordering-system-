<?php
session_start();
require_once 'db_connection.php';

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters";
    } else {
        try {
            // Check if username or email already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $error = "Username or email already exists";
            } else {
                // Insert new user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                
                if ($stmt->execute()) {
                    $_SESSION['registration_success'] = true;
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Registration failed. Please try again.";
                }
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Dish - Register</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-slider">
        <div class="slide active" style="background-image: url('Log_img/bgs1.jpg');"></div>
        <div class="slide" style="background-image: url('Log_img/bgs2.jpg');"></div>
        <div class="slide" style="background-image: url('Log_img/bgs3.jpg');"></div>
        <div class="slide" style="background-image: url('Log_img/bgs4.jpg');"></div>
    </div>

    <!-- Go Back Button -->
    <a href="../index.php" class="go-back">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>

    <!-- Register Container -->
    <div class="login-container">
        <a href="../landpage/index.php" class="login-logo">
            Sri Dish
        </a>
        <h5 class="login-logo1" > One Place. <br>All Possibilities</h5>

        <div class="welcome-message">
            <span class="message-text">Create your account</span>
            <span class="message-text">Join Sri Dish today</span>
            <span class="message-text">Let's get started</span>
        </div>

        <?php if ($error): ?>
            <div class="alert error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form class="login-form" method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="login-btn">Register</button>
            
            <div class="signup-link">
                Already have an account? <a href="login.php">Log in</a>
            </div>
        </form>
    </div>

    <script src="login.js"></script>
</body>
</html>