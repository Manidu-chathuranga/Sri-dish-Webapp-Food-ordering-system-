<?php
header('Content-Type: application/json');
session_start();

require_once 'db_connect.php';

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$food_id = filter_var($data['food_id'] ?? null, FILTER_VALIDATE_INT);

if (!$food_id) {
    $response['message'] = 'Invalid food item ID.';
    echo json_encode($response);
    exit();
}

$session_id = session_id();
$user_id = $_SESSION['user_id'] ?? null;

try {
    $stmt = $pdo->prepare("DELETE FROM cart_items WHERE (session_id = ? OR user_id = ?) AND food_id = ?");
    $stmt->execute([$session_id, $user_id, $food_id]);

    if ($stmt->rowCount() > 0) {
        $response['success'] = true;
        $response['message'] = 'Food item removed from cart.';
    } else {
        $response['message'] = 'Food item not found in cart.';
    }

} catch (PDOException $e) {
    error_log("Cart remove error: " . $e->getMessage());
    $response['message'] = 'Database error when removing from cart.';
}

echo json_encode($response);
?>