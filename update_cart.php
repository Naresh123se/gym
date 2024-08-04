<?php
session_start();
error_reporting(0);
include 'include/config.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Update cart quantities
if (isset($_POST['cart'])) {
    foreach ($_POST['cart'] as $product_id => $data) {
        $quantity = intval($data['quantity']);
        $price = floatval($data['price']);

        // Update session cart
        if ($quantity > 0) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }
}

// Redirect back to cart page
header("Location: cart.php");
exit();
?>
