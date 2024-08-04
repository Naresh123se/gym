<?php
session_start();
error_reporting(0);
include 'include/config.php'; // Include your database connection and other necessary files

// Redirect to login page if admin session is not active
if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}

// Fetch all products from database
$sql = "SELECT * FROM tblproducts";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navbar -->
<?php include 'include/header.php'; ?>

<!-- Sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<?php include 'include/sidebar.php'; ?>

<!-- Main Content -->
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cubes"></i> Manage Products</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Manage Products</a></li>
        </ul>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
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
                                    $cnt = 1;
                                    foreach ($results as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($row['ProductName']); ?></td>
                                        <td><?php echo htmlentities($row['Price']); ?></td>
                                        <td><?php echo htmlentities($row['Description']); ?></td>
                                        <td>
                                            <?php if ($row['ProductImage']) { ?>
                                                <img src="<?php echo htmlentities($row['ProductImage']); ?>" alt="Product Image" style="max-width: 100px; max-height: 100px;">
                                            <?php } else { ?>
                                                <img src="images/no-image.jpg" alt="No Image" style="max-width: 100px; max-height: 100px;">
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="edit-product.php?id=<?php echo htmlentities($row['id']); ?>"><i class="fa fa-edit"></i></a>
                                            <a href="delete-product.php?id=<?php echo htmlentities($row['id']); ?>" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                        $cnt++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        $('#sampleTable').DataTable();
    });
</script>
</body>
</html>
