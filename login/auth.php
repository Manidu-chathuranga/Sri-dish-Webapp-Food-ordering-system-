<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Registration 
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $password]);
            
            echo json_encode(['success' => true, 'message' => 'Registration successful!']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()]);
        }
    } elseif (isset($_POST['login'])) {
        // Login 
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                echo json_encode(['success' => true, 'redirect' => '../landpage/index.php']);  ///// add the home page
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Login failed: ' . $e->getMessage()]);
        }
    }
}
?>