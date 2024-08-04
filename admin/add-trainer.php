<?php
session_start();
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
  exit(); // Ensure script stops here if user is not authenticated
}

if (isset($_POST['submit'])) {
  // Input validation and sanitization
  $trainername = htmlspecialchars(trim($_POST['trainername']));
  $experience = htmlspecialchars(trim($_POST['experience']));
  $email = htmlspecialchars(trim($_POST['email']));
  $phone = htmlspecialchars(trim($_POST['phone']));
  $description = htmlspecialchars(trim($_POST['description']));

  // File upload handling
  $photo = $_FILES["image"]["name"];
  $extension = strtolower(pathinfo($photo, PATHINFO_EXTENSION));
  $allowed_extensions = array("jpg", "jpeg", "png", "gif");

  if (!in_array($extension, $allowed_extensions)) {
    echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";
  } else {
    // Generate a new filename
    $newfilename = md5($photo . time()) . '.' . $extension;
    $target_dir = "admin/images/";
    $target_file = $target_dir . $newfilename;

    // Ensure the images directory exists
    if (!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      // Prepare and execute the SQL statement
      $sql = "INSERT INTO tbltrainer (trainername, experience, email, phone, description, photo) VALUES (:trainername, :experience, :email, :phone, :description, :photo)";
      $query = $dbh->prepare($sql);
      $query->bindParam(':trainername', $trainername, PDO::PARAM_STR);
      $query->bindParam(':experience', $experience, PDO::PARAM_INT);
      $query->bindParam(':email', $email, PDO::PARAM_STR);
      $query->bindParam(':phone', $phone, PDO::PARAM_STR);
      $query->bindParam(':description', $description, PDO::PARAM_STR);
      $query->bindParam(':photo', $newfilename, PDO::PARAM_STR);

      if ($query->execute()) {
        echo "<script>alert('Trainer details have been added.');</script>";
        echo "<script>window.location.href='manage-trainers.php'</script>";
      } else {
        echo "<script>alert('An error occurred. Please try again.');</script>";
      }
    } else {
      error_log('File upload error: ' . print_r($_FILES, true));
      echo "<script>alert('An error occurred while uploading the image. Please try again.');</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin | Add Trainer</title>
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
        <h1><i class="fa fa-user-plus"></i> Add Trainer</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="trainername">Trainer Name</label>
                <input class="form-control" type="text" name="trainername" id="trainername" required>
              </div>
              <div class="form-group">
                <label for="experience">Experience (in years)</label>
                <input class="form-control" type="number" name="experience" id="experience" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control" type="text" name="phone" id="phone" required>
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
