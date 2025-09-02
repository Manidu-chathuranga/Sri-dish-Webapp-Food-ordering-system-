<?php
header('Content-Type: application/json');
session_start();

require_once 'db_connect.php'; 

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$food_id = filter_var($data['food_id'] ?? null, FILTER_VALIDATE_INT);
$change = filter_var($data['change'] ?? 0, FILTER_VALIDATE_INT); // +1 or -1

if (!$food_id || ($change !== 1 && $change !== -1)) {
    $response['message'] = 'Invalid input for quantity update.';
    echo json_encode($response);
    exit();
}

$session_id = session_id();
$user_id = $_SESSION['user_id'] ?? null;

try {
    $pdo->beginTransaction();

    // Get current quantity
    $stmt = $pdo->prepare("SELECT id, quantity FROM cart_items WHERE (session_id = ? OR user_id = ?) AND food_id = ?");
    $stmt->execute([$session_id, $user_id, $food_id]);
    $item = $stmt->fetch();

    if ($item) {
        $new_quantity = $item['quantity'] + $change;

        if ($new_quantity <= 0) {
            // If new quantity is 0 or less, remove item
            $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ?");
            $stmt->execute([$item['id']]);
            $response['success'] = true;
            $response['message'] = 'Item removed from cart.';
        } else {
            // Update quantity
            $stmt = $pdo->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
            $stmt->execute([$new_quantity, $item['id']]);
            $response['success'] = true;
            $response['message'] = 'Quantity updated successfully.';
        }
    } else {
        $response['message'] = 'Item not found in cart.';
    }

    $pdo->commit();

} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Cart quantity update error: " . $e->getMessage());
    $response['message'] = 'Database error when updating quantity.';
}

echo json_encode($response);
?>