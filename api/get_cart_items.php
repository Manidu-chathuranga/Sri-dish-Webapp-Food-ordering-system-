<?php
header('Content-Type: application/json');
session_start();

require_once 'db_connect.php';

$response = ['success' => false, 'message' => 'An unknown error occurred.', 'data' => []];

$session_id = session_id();
$user_id = $_SESSION['user_id'] ?? null;

try {
    $stmt = $pdo->prepare("SELECT ci.id AS cart_item_id, ci.food_id, ci.quantity, ci.price_at_time, f.name AS food_name, f.description, f.image_url
                           FROM cart_items ci
                           JOIN foods f ON ci.food_id = f.id
                           WHERE ci.session_id = ? OR ci.user_id = ?
                           ORDER BY ci.added_at DESC");
    $stmt->execute([$session_id, $user_id]);
    $cart_items = $stmt->fetchAll();

    $response['success'] = true;
    $response['message'] = 'Cart items retrieved successfully.';
    $response['data'] = $cart_items;

} catch (PDOException $e) {
    error_log("Cart retrieval error: " . $e->getMessage());
    $response['message'] = 'Database error when retrieving cart items.';
}

echo json_encode($response);
?>