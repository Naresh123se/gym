<?php
session_start();
error_reporting(0);
include 'include/config.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Remove item from cart
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Redirect back to cart page
header("Location: cart.php");
exit();
?>
