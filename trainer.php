<?php 
session_start();
error_reporting(0);
include 'include/config.php';
$uid=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trainers - Gym Management System</title>
    <meta charset="UTF-8">
    <meta name="description" content="Trainers at Gym Management System">
    <meta name="keywords" content="gym, fitness, trainers">
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
        .trainer-thumbnail img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .trainer-content {
            padding: 20px;
        }
        .trainer-content h3 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .trainer-content p {
            margin-bottom: 10px;
            color: #777;
        }
        .read-more {
            background: linear-gradient(to right, #ff416c, #ff4b2b);
            border: none;
            color: white;
            display: inline-block;
            padding: 10px 30px;
            border-radius: 5px;
            transition: background 0.3s;
            text-decoration: none;
        }
        .read-more:hover {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <?php include 'include/header.php';?>
    <!-- Header Section end -->

    <!-- Page top Section -->
    <section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto text-white">
                    <h2>Our Trainers</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Trainer Section -->
    <section class="trainer-section spad">
        <div class="container">
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
                        <div class="trainer-thumbnail">
                            <img src="admin/images/<?php echo htmlentities($result->image); ?>" alt="trainer image">
                        </div>
                        <div class="trainer-content">
                            <h3><?php echo htmlentities($result->trainername); ?></h3>
                            <p><strong>Experience:</strong> <?php echo htmlentities($result->experience); ?> years</p>
                            <p><strong>Email:</strong> <?php echo htmlentities($result->email); ?></p>
                            <p><strong>Phone:</strong> <?php echo htmlentities($result->phone); ?></p>
                            <p><?php echo htmlentities(substr($result->description, 0, 150)); ?>...</p>
                            <!-- Link to view trainer details -->
                            <a href="trainer-detail.php?id=<?php echo htmlentities($result->id); ?>" class="read-more">Read More</a>
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
