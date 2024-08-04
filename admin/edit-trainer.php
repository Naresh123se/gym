<?php
session_start();
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
  exit; // Ensure script stops here if trainer is not authenticated
} else {
  if (isset($_POST['submit'])) {
    // Input validation and sanitization
    $id = intval($_POST['id']);
    $trainername = htmlspecialchars(trim($_POST['trainername']));
    $experience = intval($_POST['experience']);
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $description = htmlspecialchars(trim($_POST['description']));

    // File upload handling
    $image = $_FILES["image"]["name"];
    $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $newfilename = '';

    if ($image) {
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
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
          error_log('File upload error: ' . print_r($_FILES, true));
          echo "<script>alert('An error occurred while uploading the image. Please try again.');</script>";
        }
      }
    }

    // Prepare and execute the SQL statement
    if ($newfilename) {
      $sql = "UPDATE tbltrainer SET trainername=:trainername, experience=:experience, email=:email, phone=:phone, description=:description, image=:image WHERE id=:id";
      $query = $dbh->prepare($sql);
      $query->bindParam(':image', $newfilename, PDO::PARAM_STR);
    } else {
      $sql = "UPDATE tbltrainer SET trainername=:trainername, experience=:experience, email=:email, phone=:phone, description=:description WHERE id=:id";
      $query = $dbh->prepare($sql);
    }
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':trainername', $trainername, PDO::PARAM_STR);
    $query->bindParam(':experience', $experience, PDO::PARAM_INT);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);

    if ($query->execute()) {
      echo "<script>alert('Trainer details have been updated.');</script>";
      echo "<script>window.location.href='manage-trainers.php'</script>";
    } else {
      echo "<script>alert('An error occurred. Please try again.');</script>";
    }
  }

  // Fetch existing trainer details
  if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM tbltrainer WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Trainer | Edit Profile</title>
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
        <h1><i class="fa fa-pencil"></i> Edit Profile</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <form method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo htmlentities($result['id']); ?>">
              <div class="form-group">
                <label for="trainername">Trainer Name</label>
                <input class="form-control" type="text" name="trainername" id="trainername" value="<?php echo htmlentities($result['trainername']); ?>" required>
              </div>
              <div class="form-group">
                <label for="experience">Experience (in years)</label>
                <input class="form-control" type="number" name="experience" id="experience" value="<?php echo htmlentities($result['experience']); ?>" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" value="<?php echo htmlentities($result['email']); ?>" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control" type="tel" name="phone" id="phone" value="<?php echo htmlentities($result['phone']); ?>" required>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" rows="5" name="description" id="description" required><?php echo htmlentities($result['description']); ?></textarea>
              </div>
              <div class="form-group">
                <label for="image">Profile Image</label>
                <input class="form-control" type="file" name="image" id="image">
                <?php if ($result['image']): ?>
                  <img src="admin/images/<?php echo htmlentities($result['image']); ?>" width="150" style="margin-top: 10px;" />
                <?php endif; ?>
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
