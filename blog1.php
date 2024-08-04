<?php 
session_start();
error_reporting(0);
include 'include/config.php';
$uid=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Post</title>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Management System Blog">
    <meta name="keywords" content="gym, blog, fitness, motivation">
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
        .blog-post {
            background: #fff;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            margin-top: 30px;
        }
        .blog-post img {
            border-radius: 10px;
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
        .blog-post h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .blog-post p {
            font-size: 16px;
            color: #777;
            line-height: 1.8;
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
                    <h2>Blog Post</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Post Section -->
    <section class="blog-post-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <div class="blog-post">
                        <?php
                        $id = intval($_GET['id']);
                        $sql = "SELECT * FROM tblblog WHERE id=:id";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':id', $id, PDO::PARAM_INT);
                        $query->execute();
                        $result = $query->fetch(PDO::FETCH_OBJ);
                        if ($result) {
                            ?>
                            <img src="admin/images/<?php echo htmlentities($result->image); ?>" alt="blog post image">
                            <h2><?php echo htmlentities($result->title); ?></h2>
                            <p><?php echo nl2br(htmlentities($result->content)); ?></p>
                            <?php
                        } else {
                            echo "<p>Blog post not found.</p>";
                        }
                        ?>
                    </div>
                </div>
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
