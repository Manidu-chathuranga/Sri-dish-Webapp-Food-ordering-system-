<?php
header('Content-Type: application/json');
session_start();

if (!file_exists('db_connect.php')) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection file not found.']);
    exit();
}
require_once 'db_connect.php';

$response = ['success' => false, 'message' => 'An unknown error occurred.', 'data' => []];

$user_id = $_SESSION['user_id'] ?? null;
$session_id = session_id();

if (!$user_id && !$session_id) {
    http_response_code(401);
    $response['message'] = 'Authentication required.';
    echo json_encode($response);
    exit();
}

try {
    // Fetch all orders for the current user
    $stmt = $pdo->prepare("SELECT id, total_amount, status, order_date FROM `orders` WHERE `user_id` = ? OR `session_id` = ? ORDER BY `order_date` DESC");
    $stmt->execute([$user_id, $session_id]);
    $orders = $stmt->fetchAll();

    $all_orders = [];

    // For each order, fetch its details (the individual food items)
    foreach ($orders as $order) {
        $stmt_details = $pdo->prepare("SELECT od.quantity, od.price_per_item, f.name AS food_name FROM `order_details` od JOIN `foods` f ON od.food_id = f.id WHERE `order_id` = ?");
        $stmt_details->execute([$order['id']]);
        $items = $stmt_details->fetchAll();

        $all_orders[] = [
            'order_id' => $order['id'],
            'order_date' => $order['order_date'],
            'total_amount' => $order['total_amount'],
            'status' => $order['status'],
            'items' => $items
        ];
    }

    $response['success'] = true;
    $response['data'] = $all_orders;

} catch (PDOException $e) {
    error_log("Get orders SQL error: " . $e->getMessage());
    http_response_code(500);
    $response['message'] = 'Database error when retrieving orders: ' . $e->getMessage();
}

echo json_encode($response);