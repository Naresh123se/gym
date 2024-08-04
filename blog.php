<?php 
session_start();
error_reporting(0);
include 'include/config.php';
$uid=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Gym Management System</title>
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
		.post-item {
			background: #fff;
			box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
			margin-bottom: 30px;
			transition: transform 0.3s;
		}
		.post-item:hover {
			transform: translateY(-10px);
		}
		.post-thumbnail img {
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
			width: 100%;
			height: 200px;
			object-fit: cover;
		}
		.post-content {
			padding: 20px;
		}
		.post-content h3 {
			font-size: 24px;
			font-weight: 700;
			margin-bottom: 10px;
		}
		.post-content p {
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
					<h2>BLOG</h2>
				</div>
			</div>
		</div>
	</section>

	<!-- Blog Section -->
	<section class="blog-section spad">
		<div class="container">
			<div class="row">
				<?php
				$sql = "SELECT * FROM tblblog ORDER BY create_date DESC";
				$query = $dbh->prepare($sql);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_OBJ);
				if ($query->rowCount() > 0) {
					$count = 0;
					foreach ($results as $result) {
						if ($count % 3 == 0 && $count != 0) {
							echo '</div><div class="row">';
						}
						?>
						<div class="col-lg-4 col-md-6">
							<div class="post-item">
								<div class="post-thumbnail">
									<img src="admin/images/<?php echo htmlentities($result->image); ?>" alt="blog post image">
								</div>
								<div class="post-content">
									<h3><?php echo htmlentities($result->title); ?></h3>
									<p><?php echo htmlentities(substr($result->content, 0, 150)); ?>...</p>
									<a href="blog1.php?id=<?php echo htmlentities($result->id); ?>" class="read-more">Read More</a>
								</div>
							</div>
						</div>
						<?php
						$count++;
					}
				} else {
					echo "<p>No blog posts available.</p>";
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
