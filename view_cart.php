<?php
session_start();
error_reporting(0);
include 'include/config.php';

$uid = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>View Cart - Gym Management System</title>
    <meta charset="UTF-8">
    <meta name="description" content="View Cart">
    <meta name="keywords" content="cart, shopping, gym">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <!-- Header Section -->
    <?php include 'include/header.php'; ?>
    <!-- Header Section end -->

    <!-- Cart Section -->
    <section class="cart-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>Your Cart</h2>
            </div>
            <div class="row">
                <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $total = 0;
                                foreach($_SESSION['cart'] as $product_id => $product): 
                                    $subtotal = $product['price'] * $product['quantity'];
                                    $total += $subtotal;
                                ?>
                                    <tr>
                                        <td><?php echo htmlentities($product['name']); ?></td>
                                        <td>$<?php echo htmlentities($product['price']); ?></td>
                                        <td><?php echo htmlentities($product['quantity']); ?></td>
                                        <td>$<?php echo htmlentities($subtotal); ?></td>
                                        <td>
                                            <a href="remove_cart_item.php?product_id=<?php echo $product_id; ?>" class="btn btn-danger">Remove</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td colspan="2"><strong>$<?php echo htmlentities($total); ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
                <?php else: ?>
                    <div class="col-lg-12">
                        <p>Your cart is empty.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>
    <!-- Footer Section end -->

    <!-- Javascripts & Jquery -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
