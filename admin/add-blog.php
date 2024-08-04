<?php
session_start();
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    // Input validation and sanitization
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));

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
        $sql = "INSERT INTO tblblog (title, content, image) VALUES (:title, :content, :image)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':content', $content, PDO::PARAM_STR);
        $query->bindParam(':image', $newfilename, PDO::PARAM_STR);

        if ($query->execute()) {
          echo "<script>alert('Blog post has been added.');</script>";
          echo "<script>window.location.href='manage-blog.php'</script>";
        } else {
          echo "<script>alert('An error occurred. Please try again.');</script>";
        }
      } else {
        error_log('File upload error: ' . print_r($_FILES, true));
        echo "<script>alert('An error occurred while uploading the image. Please try again.');</script>";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin | Add Blog Post</title>
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
        <h1><i class="fa fa-pencil"></i> Add Blog Post</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" required>
              </div>
              <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" rows="10" name="content" id="content" required></textarea>
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
