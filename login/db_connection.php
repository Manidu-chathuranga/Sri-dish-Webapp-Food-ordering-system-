<?php
// Database Configuration
$host = 'localhost';
$dbname = 'sri_dish_db';
$username = 'root';
$password = '';

// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if PDO is available
if (!extension_loaded('pdo')) {
    die('PDO extension is not loaded. Please enable it in php.ini');
}

// Check if PDO MySQL driver is available
if (!extension_loaded('pdo_mysql')) {
    die('PDO MySQL driver is not loaded. Please install php-mysql package');
}

try {
    // Create PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set error mode (compatibility check)
    if (defined('PDO::ATTR_ERRMODE')) {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    // Set default fetch mode
    if (defined('PDO::ATTR_DEFAULT_FETCH_MODE')) {
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    
    // Set charset
    $conn->exec("SET NAMES utf8");
    
} catch (PDOException $e) {
    // Log error to file
    file_put_contents('db_errors.log', date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
    
    // User-friendly message
    die('Database connection failed. Please try again later. Error reference: ' . uniqid());
}

// Alternative connection test
function test_db_connection() {
    global $conn;
    try {
        $stmt = $conn->query("SELECT 1");
        return $stmt->fetchColumn() === 1;
    } catch (PDOException $e) {
        return false;
    }
}

// Verify connection on include
if (!test_db_connection()) {
    die('Database verification failed. Please check your credentials.');
}
?>