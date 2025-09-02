<?php
header('Content-Type: application/json');
session_start();
if (!file_exists('db_connect.php')) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection file not found.']);
    exit();
}
require_once 'db_connect.php';

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Get and validate required data from the request
$food_id = filter_var($data['food_id'] ?? null, FILTER_VALIDATE_INT);
$quantity = filter_var($data['quantity'] ?? 1, FILTER_VALIDATE_INT);
$price_at_time = filter_var($data['price'] ?? null, FILTER_VALIDATE_FLOAT);

// Get user ID and session ID for cart identification
$session_id = session_id();
$user_id = $_SESSION['user_id'] ?? null;

// Before doing anything, make sure we have a valid way to identify the user
if (!$user_id && !$session_id) {
    http_response_code(400);
    $response['message'] = 'Could not establish a user session.';
    echo json_encode($response);
    exit();
}

// Perform basic validation of the incoming data
if (!$food_id || $quantity <= 0 || !$price_at_time) {
    http_response_code(400); // Bad Request
    $response['message'] = 'Invalid food item, quantity, or price data.';
    echo json_encode($response);
    exit();
}

try {
    // Check if the food_id exists in the foods table to prevent foreign key errors
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `foods` WHERE `id` = ?");
    $stmt->execute([$food_id]);
    if ($stmt->fetchColumn() == 0) {
        http_response_code(404); // Not Found
        $response['message'] = 'The selected food item does not exist.';
        echo json_encode($response);
        exit();
    }

    // Check if the item already exists in the cart for this user/session
    $stmt = $pdo->prepare("SELECT id, quantity FROM `cart_items` WHERE (`user_id` = ? OR `session_id` = ?) AND `food_id` = ?");
    $stmt->execute([$user_id, $session_id, $food_id]);
    $existing_item = $stmt->fetch();

    if ($existing_item) {
        // If the item exists, update its quantity
        $new_quantity = $existing_item['quantity'] + $quantity;
        $sql = "UPDATE `cart_items` SET `quantity` = ?, `price_at_time` = ?, `added_at` = NOW() WHERE `id` = ?";
        $params = [$new_quantity, $price_at_time, $existing_item['id']];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $response['success'] = true;
        $response['message'] = 'Food item quantity updated in cart.';
    } else {
        // If the item doesn't exist, insert a new row
        $sql = "INSERT INTO `cart_items` (`user_id`, `session_id`, `food_id`, `quantity`, `price_at_time`) VALUES (?, ?, ?, ?, ?)";
        $params = [$user_id, $session_id, $food_id, $quantity, $price_at_time];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $response['success'] = true;
        $response['message'] = 'Food item added to cart.';
    }

} catch (PDOException $e) {
    // Handle database-specific errors gracefully
    error_log("Cart add/update SQL error: " . $e->getMessage());
    http_response_code(500); // Internal Server Error
    $response['message'] = 'Database error when adding to cart: ' . $e->getMessage();
}

echo json_encode($response);
?>