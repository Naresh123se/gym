<?php
session_start(); // Start the session

// Get the value from the 'status' parameter in the URL
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Check if the status is 'completed'
if ($status === 'Completed') {
    // Print a JavaScript alert and then redirect to the home page
    echo '<script type="text/javascript">';
    echo 'alert("Payment Successful.");';
    echo 'window.location.href = "http://localhost/gym/";';
    echo '</script>';
    
    // Unset the 'cart' session variable after redirecting
    $cart = $_SESSION['cart'];
    unset($_SESSION['cart']);
    exit();
} else {
    // If status is not 'completed', you can handle it accordingly
    echo "Status is not completed.";
}
?>
