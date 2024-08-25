<?php
session_start();
error_reporting(0);
include 'include/config.php';

$uid = $_SESSION['uid'];

if(isset($_POST['Booking']))
{ 
$pid=$_POST['pid'];


$sql="INSERT INTO tblbooking (package_id,userid) Values(:pid,:uid)";

$query = $dbh -> prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Package has been booked.');</script>";
echo "<script>window.location.href='booking-history.php'</script>";

}

if (isset($_POST['add_to_cart'])) {
    if ($uid) {
        $product_id = $_POST['product_id'];

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $sql = "SELECT * FROM tblproducts WHERE id = :product_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':product_id', $product_id, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $_SESSION['cart'][$product_id] = [
                    "name" => $result['ProductName'],
                    "price" => $result['Price'],
                    "quantity" => 1,
                    "image" => $result['ProductImage']
                ];
            }
        }

        echo "<script>alert('Product added to cart');</script>";
        echo "<script>window.location.href='cart.php'</script>";
    } else {
        echo "<script>alert('You need to login first to add products to cart');</script>";
        echo "<script>window.location.href='login.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Gym Management System</title>
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
        .trainer-item {
            background: #fff;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 30px;
            transition: transform 0.3s;
        }

        .trainer-item:hover {
            transform: translateY(-10px);
        }

        .trainer-img {
            position: relative;
            overflow: hidden;
            border-radius: 10px 10px 0 0;
        }

        .trainer-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .trainer-content {
            padding: 20px;
        }

        .trainer-content h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .trainer-content .read-more {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: none;
            color: white;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
        }

        .trainer-content .read-more:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }

        .pricing-item {
            background: #fff;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 30px;
            transition: transform 0.3s;
        }

        .pricing-item:hover {
            transform: translateY(-10px);
        }

        .pi-top h4 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .pi-price {
            padding: 20px;
        }

        .pi-price h3 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .pi-price p {
            margin-bottom: 10px;
        }

        .pi-desc {
            padding: 20px;
        }

        .pi-desc ul {
            list-style-type: none;
            padding: 0;
        }

        .pi-desc ul li {
            margin-bottom: 10px;
        }

        .pi-btn {
            text-align: center;
            padding: 20px;
        }

        .pi-btn .site-btn {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: none;
            color: white;
            display: inline-block;
            padding: 10px 30px;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
        }

        .pi-btn .site-btn:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }

        .product-item {
            background: #fff;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-bottom: 30px;
            transition: transform 0.3s;
        }

        .product-item:hover {
            transform: translateY(-10px);
        }

        .product-img {
            position: relative;
            overflow: hidden;
            border-radius: 10px 10px 0 0;
        }

        .product-img img {
            width: 100%;
            height: auto;
            display: block;
        }

        .product-content {
            padding: 20px;
        }

        .product-content h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .product-content .read-more {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: none;
            color: white;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
        }

        .product-content .read-more:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include 'include/header.php'; ?>
    <!-- Header Section end -->

    <!-- Page top Section -->
    <section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto text-white">
                    <h2>Home</h2>
                    <p>Physical Activity Can Improve Your Health</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Trainer Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>Trainers</h2>
                <p>Meet our experienced trainers who are dedicated to helping you achieve your fitness goals.</p>
            </div>
            <div class="row">
                <?php
                $sql = "SELECT * FROM tbltrainer";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="trainer-item">
                                <div class="trainer-img">
                                    <img src="admin/images/<?php echo htmlentities($result->photo); ?>"
                                        alt="trainer image">
                                </div>
                                <div class="trainer-content">
                                    <h3><?php echo htmlentities($result->trainername); ?></h3>
                                    <a href="trainer-detail.php?id=<?php echo htmlentities($result->id); ?>"
                                        class="read-more">Read More</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No trainers available.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>Pricing plans</h2>
                <p>Choose a package that suits your fitness goals and start your journey today!</p>
            </div>
            <div class="row">
                <?php
                $sql = "SELECT id, category, titlename, PackageType, PackageDuratiobn, Price, uploadphoto, Description, create_date from tbladdpackage";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="pricing-item begginer">
                                <div class="pi-top">
                                    <h4><?php echo $result->titlename; ?></h4>
                                </div>
                                <div class="pi-price">
                                    <h3><?php echo htmlentities($result->Price); ?></h3>
                                    <p><?php echo $result->PackageDuratiobn; ?></p>
                                </div>
                                <div class="pi-desc">
                                    <ul>
                                        <?php echo $result->Description; ?>
                                    </ul>
                                </div>
                                <div class="pi-btn">
                                    <?php if (strlen($_SESSION['uid']) == 0): ?>
                                        <a href="login.php" class="site-btn">Book Now</a>
                                    <?php else: ?>
                                        <form method='post'>
                                            <input type='hidden' name='pid' value='<?php echo htmlentities($result->id); ?>'>
                                            <input class='site-btn' type='submit' name='Booking' value='Book Now'>
                                        </form>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </div>
    </section>

    <!-- Product Section -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="section-title text-center">
                <h2>Products</h2>
                <p>Explore our range of gym products and merchandise.</p>
                <!-- Add this where you want the "View Cart" link to appear -->
                <a href="view_cart.php" class="nav-link">View Cart</a>

            </div>
            <div class="row">
                <?php
                $sql = "SELECT id, ProductName, Description, Price, ProductImage FROM tblproducts";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="product-item">
                                <div class="product-img">
                                    <img src="admin/images/<?php echo $result->ProductImage; ?>"
                                        alt="<?php echo htmlentities($result->ProductName); ?>">
                                </div>
                                <div class="product-content">
                                    <h3><?php echo htmlentities($result->ProductName); ?></h3>
                                    <p><?php echo $result->Description; ?></p>
                                    <div class="pi-price">
                                        <h3>$<?php echo htmlentities($result->Price); ?></h3>
                                    </div>
                                    <div class="pi-btn">
                                        <?php if (strlen($_SESSION['uid']) == 0): ?>
                                            <a href="login.php" class="site-btn">Add to Cart</a>
                                        <?php else: ?>
                                            <form method="post">
                                                <input type="hidden" name="product_id"
                                                    value="<?php echo htmlentities($result->id); ?>">
                                                <input class="site-btn" type="submit" name="add_to_cart" value="Add to Cart">
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No products available.</p>";
                }
                ?>
            </div>
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