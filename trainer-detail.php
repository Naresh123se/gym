<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (isset($_GET['id'])) {
    $trainer_id = $_GET['id'];

    // Fetch trainer details from the database
    $sql = "SELECT * FROM tbltrainer WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $trainer_id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo "<p>Trainer not found.</p>";
        exit;
    }
} else {
    echo "<p>No trainer ID specified.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Trainer Details</title>
    <meta charset="UTF-8">
    <meta name="description" content="Trainer Details">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
    <!-- Header Section -->
    <?php include 'include/header.php'; ?>
    <!-- Header Section end -->

    <!-- Trainer Details Section -->
    <section class="trainer-details-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="admin/admin/images/<?php echo htmlentities($result['photo']); ?>" alt="<?php echo htmlentities($result['trainername']); ?>" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <h2><?php echo htmlentities($result['trainername']); ?></h2>
                    <p><?php echo htmlentities($result['description']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlentities($result['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlentities($result['phone']); ?></p>
                    <!-- Add more details as needed -->
                </div>
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
