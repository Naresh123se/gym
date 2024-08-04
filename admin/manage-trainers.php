<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
  exit(); // Ensure script stops here if user is not authenticated
}

if (isset($_GET['del'])) {
  $id = $_GET['del'];
  $sql = "DELETE FROM tbltrainer WHERE id=:id";
  $query = $dbh->prepare($sql);
  $query->bindParam(':id', $id, PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('Trainer deleted');</script>";
  echo "<script>window.location.href='manage-trainers.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin | Manage Trainers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>
<body class="app sidebar-mini rtl">
  <?php include 'include/header.php'; ?>
  <?php include 'include/sidebar.php'; ?>
  <main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-users"></i> Manage Trainers</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Trainer Name</th>
                  <th>Experience</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM tbltrainer";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {
                    ?>
                    <tr>
                      <td><?php echo htmlentities($cnt); ?></td>
                      <td><?php echo htmlentities($result->trainername); ?></td>
                      <td><?php echo htmlentities($result->experience); ?> years</td>
                      <td><?php echo htmlentities($result->email); ?></td>
                      <td><?php echo htmlentities($result->phone); ?></td>
                      <td><?php echo htmlentities($result->description); ?></td>
                      <td><img src="admin/images/<?php echo htmlentities($result->photo); ?>" alt="Image" width="100"></td>
                      <td>
                        <a href="edit-trainer.php?id=<?php echo $result->id; ?>"><i class="fa fa-edit"></i></a>
                        <a href="manage-trainers.php?del=<?php echo $result->id; ?>" onclick="return confirm('Do you really want to delete this trainer?');"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $cnt = $cnt + 1;
                  }
                } else {
                  ?>
                  <tr>
                    <td colspan="8">No trainers found.</td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
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
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#sampleTable').DataTable();
    });
  </script>
</body>
</html>
