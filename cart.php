<?php
session_start();
error_reporting(0);
include 'include/config.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Gym Management System - Cart</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Management System">
    <meta name="keywords" content="gym, fitness, training">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="css/nice-select.css"/>
    <link rel="stylesheet" href="css/magnific-popup.css"/>
    <link rel="stylesheet" href="css/slicknav.min.css"/>
    <link rel="stylesheet" href="css/animate.css"/>
    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="css/style.css"/>
    <style>
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }
        .cart-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .cart-item p {
            margin-bottom: 10px;
        }
        .cart-item .remove-btn {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
        }
        .cart-item .remove-btn:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }
        .quantity-input {
            width: 60px;
            text-align: center;
        }
        .update-btn {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
        }
        .update-btn:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }
        .checkout-btn {
            display: block;
            margin: 20px 0;
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
            text-align: center;
        }
        .checkout-btn:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <?php include 'include/header.php';?>
    <!-- Header Section end -->

    <!-- Cart Section -->
    <section class="cart-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>Your Cart</h2>
                <p>Review your selected items and proceed to checkout.</p>
            </div>
            <form method="post" action="update_cart.php">
                <div class="row">
                    <?php 
                    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                        foreach($_SESSION['cart'] as $product_id => $product) {
                    ?>
                    
                    <div class="col-lg-12">
                        <div class="cart-item">
                            <img src="admin/images/<?php echo $product['image']; ?>" alt="<?php echo htmlentities($product['name']); ?>">
                            <div class="cart-info">
                                <h3><?php echo htmlentities($product['name']); ?></h3>
                                <p>Price: $<?php echo htmlentities($product['price']); ?></p>
                                <p>
                                    Quantity: 
                                    <input type="number" name="cart[<?php echo $product_id; ?>][quantity]" class="quantity-input" value="<?php echo htmlentities($product['quantity']); ?>" min="1">
                                    <input type="hidden" name="cart[<?php echo $product_id; ?>][price]" value="<?php echo htmlentities($product['price']); ?>">
                                </p>
                                <a class="remove-btn" href="remove_from_cart.php?product_id=<?php echo htmlentities($product_id); ?>">Remove</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    } else {
                        echo "<p>Your cart is empty.</p>";
                    }
                    ?>
                </div>
                <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <input class="update-btn" type="submit" name="update_cart" value="Update Cart">
                <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
                <?php endif; ?>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <?php include 'include/footer.php'; ?>
    <!-- Footer Section end -->

    <div class="back-to-top"><img src="img/icons/up-arrow.png" alt=""></div>

    <!-- Javascripts & Jquery -->
    <script src="js/vendor/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
