<?php
session_start();
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
  exit;
} else {
  if (isset($_POST['submit'])) {
    // Input validation and sanitization
    $productName = htmlspecialchars(trim($_POST['productName']));
    $price = floatval($_POST['price']);
    $description = htmlspecialchars(trim($_POST['description']));

    // File upload handling
    $image = $_FILES["image"]["name"];
    $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");

    if (!in_array($extension, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";
    } else {
      // Generate a new filename
      $newfilename = md5($image . time()) . '.' . $extension;
      $target_dir = "images/";
      $target_file = $target_dir . $newfilename;

      // Ensure the images directory exists
      if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
      }

      // Move the uploaded file
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Prepare and execute the SQL statement
        $sql = "INSERT INTO tblproducts (ProductName, Price, Description, ProductImage, Status) VALUES (:productName, :price, :description, :image, :status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':productName', $productName, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':image', $newfilename, PDO::PARAM_STR);
        $status = 1; // Assuming 1 means active
        $query->bindParam(':status', $status, PDO::PARAM_INT);

        if ($query->execute()) {
          echo "<script>alert('Product added successfully.');</script>";
          echo "<script>window.location.href='manage-products.php'</script>";
        } else {
          echo "<script>alert('An error occurred. Please try again.');</script>";
        }
      } else {
        echo "<script>alert('An error occurred while uploading the image. Please try again.');</script>";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin | Add Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
  <?php include 'include/header.php'; ?>
  <?php include 'include/sidebar.php'; ?>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-shopping-cart"></i> Add Product</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="productName">Product Name</label>
                <input class="form-control" type="text" name="productName" id="productName" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input class="form-control" type="number" step="0.01" min="0" name="price" id="price" required>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="5" name="description" id="description" required></textarea>
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <input class="form-control" type="file" name="image" id="image" required>
              </div>
              <div class="form-group">
                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/plugins/pace.min.js"></script>
</body>
</html>
