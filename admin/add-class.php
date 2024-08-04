<?php
session_start();
error_reporting(0);
include 'include/config.php'; 

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit(); // Ensure script stops execution after redirect
}

if(isset($_POST['submit'])) {
    $classname = $_POST['classname'];
    $description = $_POST['description'];
    
    try {
        $sql = "INSERT INTO tblclass (ClassName, ClassDescription) VALUES (:classname, :description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':classname', $classname, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        
        if ($lastInsertId) {
            echo "<script>alert('Class added successfully');</script>";
            echo "<script>window.location.href ='manage-classes.php';</script>";
            exit(); // Ensure script stops execution after redirect
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); // Display error message for debugging
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Add Class</title>
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
                <h1><i class="fa fa-dashboard"></i> Add Class</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Add Class</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="classname">Class Name</label>
                                <input type="text" class="form-control" name="classname" id="classname" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" required></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Add Class</button>
                        </form>
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
</body>
</html>

