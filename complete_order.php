<?php
// Start the session
session_start();

// Retrieve the session variable
$product_ids = isset($_SESSION['product_ids']) ? $_SESSION['product_ids'] : [];
 print_r($product_ids); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page 2</title>
</head>
<body>
    <h1>Product IDs</h1>
    <?php if (!empty($product_ids)): ?>
        <ul>
            <?php foreach ($product_ids as $id): ?>
                <li><?php echo htmlspecialchars($id); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No product IDs found in session.</p>
    <?php endif; ?>
</body>
</html>
