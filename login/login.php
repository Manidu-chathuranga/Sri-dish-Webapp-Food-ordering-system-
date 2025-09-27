<?php
session_start();
require_once 'db_connection.php';
$login_error = '';
$registration_success = isset($_SESSION['registration_success']) ? $_SESSION['registration_success'] : false;
unset($_SESSION['registration_success']);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: ../home/home.php");
                exit();
            } else {
                $login_error = "Incorrect username or password";
            }
        } else {
            $login_error = "Incorrect username or password";
        }
    } catch(PDOException $e) {
        $login_error = "Login error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sri Dish - Login</title>
    <link rel="stylesheet" href="../CSS/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Animated Background -->
    <div class="bg-slider">
        <div class="slide active" style="background-image: url('Log_img/bgg1.jpg');"></div>
        <div class="slide" style="background-image: url('Log_img/bgg2.jpg');"></div>
        <div class="slide" style="background-image: url('Log_img/bgg3.jpg');"></div>
        <div class="slide" style="background-image: url('Log_img/bgg4.jpg');"></div>
    </div>

    <!-- Go Back Button -->
    <a href="../index.php" class="go-back">
        <i class="fas fa-arrow-left"></i> Go Back
    </a>

    <!-- Login Container -->
    <div class="login-container">
        <!-- Logo that links back to landing page -->
        <a href="../index.php" class="login-logo">
            Sri Dish
        </a>

        <!-- Animated Welcome Message -->
        <div class="welcome-message">
            <span class="message-text">Welcome back!</span>
            <span class="message-text">Good to see you again</span>
            <span class="message-text">Let's get you logged in</span>
        </div>

        <?php if ($registration_success): ?>
            <div class="alert success">
                Registration successful! Please login.
            </div>
        <?php endif; ?>

        <?php if ($login_error): ?>
            <div class="alert error">
                <?php echo htmlspecialchars($login_error); ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form class="login-form" method="POST" action="">
            <div class="form-group">
                <label for="username">Username or Email</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <a href="forgot_password.php" class="forgot-password">Forgot password?</a>
            </div>
            
            <button type="submit" name="login" class="login-btn">Log In</button>
            
            <div class="divider">
                <span>or continue with</span>
            </div>
            
            <div class="social-login">
                <button type="button" class="social-btn google">
                    <img src="Log_img/google.png" alt="Google">
                </button>
                <button type="button" class="social-btn facebook">
                    <img src="Log_img/facebook.png" alt="Facebook">
                </button>
                <button type="button" class="social-btn apple">
                    <img src="Log_img/apple.png" alt="Apple">
                </button>
            </div>
            
            <div class="signup-link">
                Need an account? <a href="register.php">Sign up</a>
            </div>
        </form>
    </div>

    <script src="login.js"></script>
</body>
</html>