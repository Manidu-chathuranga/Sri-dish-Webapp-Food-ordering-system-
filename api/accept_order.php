<?php
header('Content-Type: application/json');
session_start();
require_once 'db_connect.php';
$response = ['success' => false, 'message' => 'An unknown error occurred.'];
$order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
if (!$order_id) {
    http_response_code(400);
    $response['message'] = 'Invalid Order ID.';
    echo json_encode($response);
    exit();
}
try {
    // Update the order status to 'accepted'
    $sql = "UPDATE `orders` SET `status` = 'accepted' WHERE `id` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$order_id]);

    if ($stmt->rowCount() > 0) {
        $response['success'] = true;
        $response['message'] = 'Order status updated to Accepted.';
    } else {
        $response['message'] = 'Order not found or already accepted.';
    }

} catch (PDOException $e) {
    error_log("Order acceptance SQL error: " . $e->getMessage());
    http_response_code(500);
    $response['message'] = 'Database error: ' . $e->getMessage();
}

echo json_encode($response);
?>