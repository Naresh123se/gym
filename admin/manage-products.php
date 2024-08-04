<?php
session_start();
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
  header('location:logout.php');
  exit;
} else {
  if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM tblproducts WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Product deleted');</script>";
    echo "<script>window.location.href='manage-products.php'</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin | Manage Products</title>
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
        <h1><i class="fa fa-th-list"></i> Manage Products</h1>
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
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM tblproducts";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                  foreach ($results as $result) {
                    ?>
                    <tr>
                      <td><?php echo htmlentities($cnt); ?></td>
                      <td><?php echo htmlentities($result->ProductName); ?></td>
                      <td><?php echo htmlentities($result->Price); ?></td>
                      <td><?php echo htmlentities($result->Description); ?></td>
                      <td><img src="images/<?php echo htmlentities($result->ProductImage); ?>" alt="Image" width="100"></td>
                      <td>
                        <a href="edit-product.php?id=<?php echo $result->id; ?>"><i class="fa fa-edit"></i></a>
                        <a href="manage-products.php?del=<?php echo $result->id; ?>" onclick="return confirm('Do you really want to delete?');"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php $cnt = $cnt + 1;
                  }
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
  <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript">$('#sampleTable').DataTable();</script>
</body>
</html>
