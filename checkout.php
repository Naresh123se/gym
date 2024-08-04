<?php
session_start();
error_reporting(0);
include 'include/config.php';

// Redirect to login page if not logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}

// Initialize total price
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Gym Management System - Checkout</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Management System">
    <meta name="keywords" content="gym, fitness, training">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/nice-select.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/slicknav.min.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <!-- Main Stylesheets -->
    <link rel="stylesheet" href="css/style.css" />
    <style>
        .checkout-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkout-item img {
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }

        .checkout-item h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .checkout-item p {
            margin-bottom: 10px;
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

        .khalti img {
            padding: 8px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include 'include/header.php'; ?>
    <!-- Header Section end -->

    <!-- Checkout Section -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>Checkout</h2>
                <p>Review your order and complete the purchase.</p>
            </div>
            <div class="row">
                <?php
                $total_price = 0;
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    foreach ($_SESSION['cart'] as $product_id => $product) {
                        $total_price += $product['price'] * $product['quantity'];

                ?>
                        <div class="col-lg-12">
                            <div class="checkout-item">
                                <img src="admin/images/<?php echo $product['image']; ?>" alt="<?php echo htmlentities($product['name']); ?>">
                                <div class="checkout-info">
                                    <h3><?php echo htmlentities($product['name']); ?></h3>
                                    <p>Price: $<?php echo htmlentities($product['price']); ?></p>
                                    <p>Quantity: <?php echo htmlentities($product['quantity']); ?></p>
                                    <p>Total: $<?php echo htmlentities($product['price'] * $product['quantity']); ?></p>
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

            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) : ?>
                <div class="text-center">
                    <p id="priceIn" data-price="<?php echo $total_price; ?>">
                        <strong>Total Price: $<?php echo number_format($total_price, 2); ?></strong>
                    </p>
                    <button id="payButton" class="khalti"><img src="./khalti.svg" alt="ok" width="80">Pay with Khalti</button>
                </div>
            <?php endif; ?>
        </div>

        <script>
            document.getElementById('payButton').addEventListener('click', function() {
                
                const priceElement = document.getElementById('priceIn');
                const total_price = priceElement.getAttribute('data-price');
                const productIds = "<?php echo $product_id; ?>";
              console.log(productIds);
                const data = {
                    price: total_price,
                    email: 'ram@gmail.com',
                    name: 'ram',
                    product_ids: productIds
                };

                fetch('khalti.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data),
                    })
                    .then(response => response.json())
                    .then(responseData => {
                        if (responseData.payment_url) {
                            window.location.href = responseData.payment_url;
                        } else if (responseData.error) {
                            alert('Error: ' + responseData.error);
                            console.error('Error details:', responseData.response || 'No additional information');
                        } else {
                            alert('Unexpected error occurred.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while initiating payment.');
                    });
            });
        </script>
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
