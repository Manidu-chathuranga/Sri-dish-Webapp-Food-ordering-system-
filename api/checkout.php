<?php
header('Content-Type: application/json');
session_start();

if (!file_exists('db_connect.php')) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection file not found.']);
    exit();
}
require_once 'db_connect.php';

$response = ['success' => false, 'message' => 'An unknown error occurred.', 'order_id' => null];

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    $response['message'] = 'Authentication required.';
    echo json_encode($response);
    exit();
}

$user_id = $_SESSION['user_id'];
$session_id = session_id();

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$customer_name = htmlspecialchars(trim($data['name'] ?? ''));
$customer_phone = htmlspecialchars(trim($data['phone'] ?? ''));
$customer_address = htmlspecialchars(trim($data['address'] ?? ''));
$payment_method = htmlspecialchars(trim($data['payment_method'] ?? ''));
$card_number = htmlspecialchars(trim($data['card-number'] ?? ''));
$card_holder_name = htmlspecialchars(trim($data['card-holder-name'] ?? ''));
$expiry_date = htmlspecialchars(trim($data['expiry-date'] ?? ''));
$cvv = htmlspecialchars(trim($data['cvv'] ?? ''));
$crypto_address = htmlspecialchars(trim($data['crypto-address'] ?? '')); // New

if (empty($customer_name) || empty($customer_phone) || empty($customer_address) || empty($payment_method)) {
    http_response_code(400);
    $response['message'] = 'All delivery and payment fields are required.';
    echo json_encode($response);
    exit();
}

if ($payment_method === 'card') {
    if (empty($card_number) || empty($card_holder_name) || empty($expiry_date) || empty($cvv)) {
        http_response_code(400);
        $response['message'] = 'Card details are required for card payment.';
        echo json_encode($response);
        exit();
    }
} elseif ($payment_method === 'crypto') {
    if (empty($crypto_address)) {
        http_response_code(400);
        $response['message'] = 'Crypto address is required for crypto payment.';
        echo json_encode($response);
        exit();
    }
    // Simulate a crypto payment success
}

try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("SELECT ci.food_id, ci.quantity, ci.price_at_time, f.name AS food_name
                           FROM `cart_items` ci
                           JOIN `foods` f ON ci.food_id = f.id
                           WHERE `user_id` = ? OR `session_id` = ?");
    $stmt->execute([$user_id, $session_id]);
    $cart_items = $stmt->fetchAll();

    if (empty($cart_items)) {
        $response['message'] = 'Your cart is empty. Nothing to checkout.';
        $pdo->rollBack();
        echo json_encode($response);
        exit();
    }

    $total_amount = 0;
    foreach ($cart_items as $item) {
        $total_amount += ($item['quantity'] * $item['price_at_time']);
    }

    $delivery_fee = 150.00;
    $total_amount += $delivery_fee;

    $stmt = $pdo->prepare("INSERT INTO `orders` (`user_id`, `session_id`, `total_amount`, `payment_method`, `customer_name`, `customer_address`, `customer_phone`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->execute([$user_id, $session_id, $total_amount, $payment_method, $customer_name, $customer_address, $customer_phone]);
    $order_id = $pdo->lastInsertId();

    $stmt_detail = $pdo->prepare("INSERT INTO `order_details` (`order_id`, `food_id`, `quantity`, `price_per_item`) VALUES (?, ?, ?, ?)");
    foreach ($cart_items as $item) {
        $stmt_detail->execute([$order_id, $item['food_id'], $item['quantity'], $item['price_at_time']]);
    }

    $stmt_clear_cart = $pdo->prepare("DELETE FROM `cart_items` WHERE `user_id` = ? OR `session_id` = ?");
    $stmt_clear_cart->execute([$user_id, $session_id]);

    $pdo->commit();

    $response['success'] = true;
    $response['message'] = 'Order placed successfully!';
    $response['order_id'] = $order_id;

} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Checkout error: " . $e->getMessage());
    http_response_code(500);
    $response['message'] = 'An error occurred during checkout: ' . $e->getMessage();
}

echo json_encode($response);