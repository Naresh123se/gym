<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
} else {
    if(isset($_GET['del'])) {
        $id=$_GET['del'];
        $sql = "DELETE FROM tblclass WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id',$id, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Class deleted successfully');</script>";
        echo "<script>window.location.href ='manage-classes.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Manage Classes</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon CSS -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
    <!-- Navbar -->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar menu -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Manage Classes</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Manage Classes</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Class Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM tblclass";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if($query->rowCount() > 0) {
                                    foreach($results as $result) {
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($cnt);?></td>
                                    <td><?php echo htmlentities($result->ClassName);?></td>
                                    <td><?php echo htmlentities($result->ClassDescription);?></td>
                                    <td>
                                        <a href="edit-class.php?id=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary">Edit</button></a>
                                        <a href="manage-classes.php?del=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to delete?');"><button class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                                <?php $cnt++; }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Essential javascripts for application to work -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top -->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Data table plugin -->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#sampleTable').DataTable();
    </script>
</body>
</html>
<?php } ?>
