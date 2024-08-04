<?php  session_start();
error_reporting(0);
include  'include/config.php'; 
if (strlen($_SESSION['adminid']==0)) {
  header('location:logout.php');
  } else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>Admin | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include 'include/header.php'; ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include 'include/sidebar.php'; ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
          
        <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalcat FROM tblcategory;";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                       <a href="add-category.php">  
          <div class="widget-small info coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Listed Categories</h4>
              <p><b><?php echo $result->totalcat;?></b></p>
            </div>
          </div></a>
            <?php  } ?>
        </div>

  <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalpackagetype FROM tblcategory;";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                       <a href="add-package.php">  
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Listed Package Type</h4>
              <p><b><?php echo $result->totalpackagetype;?></b></p>
            </div>
          </div></a>
            <?php  } ?>
        </div>

        <div class="col-md-6 col-lg-6">
                <?php
                $sql="SELECT count(id) as totalpost FROM tblblog;";
                $query= $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0) {
                    foreach($results as $result) {
                ?>
                <a href="manage-blog.php">  
                    <div class="widget-small primary coloured-icon">
                        <i class=" icon fa fa-pencil fa-3x"></i>
                        <div class="info">
                            <h4>BLOG</h4>
                            <p><b><?php echo $result->totalpost; ?></b></p>
                        </div>
                    </div>
                </a>
                <?php $cnt=$cnt+1; } } ?>
            </div>

            <div class="col-md-6 col-lg-6">
                <?php
                $sql="SELECT count(id) as totalpost FROM tblproducts;";
                $query= $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0) {
                    foreach($results as $result) {
                ?>
                <a href="manage-products.php">  
                    <div class="widget-small primary coloured-icon">
                    <i class="icon fa fa-shopping-cart fa-3x"></i>
                        <div class="info">
                            <h4>PRODUCTS</h4>
                            <p><b><?php echo $result->totalpost; ?></b></p>
                        </div>
                    </div>
                </a>
                <?php $cnt=$cnt+1; } } ?>
            </div>


        <div class="col-md-6 col-lg-6">
                <?php
                $sql="SELECT count(id) as totalpost FROM tbltrainer;";
                $query= $dbh->prepare($sql);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount() > 0) {
                    foreach($results as $result) {
                ?>
                <a href="add-trainer.php">  
                    <div class="widget-small primary coloured-icon">
                 
                        <i class=" icon fas fa-dumbbell fa-3x"></i>

                         
                        <div class="info">
                            <h4>Trainer</h4>
                            <p><b><?php echo $result->totalpost; ?></b></p>
                        </div>
                    </div>
                </a>
                <?php $cnt=$cnt+1; } } ?>
            </div>

        <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalpost FROM tbladdpackage;";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  $cnt=1;
                  if($query -> rowCount() > 0)
                  {
                  foreach($results as $result)
                  {
                  ?>

                   <a href="manage-post.php">  
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-file fa-3x"></i>
            <div class="info">
              <h4>Listed Packages</h4>
              <p><b><?php echo $result->totalpost;?></b></p>
            </div>
          </div>
        </a>
            <?php  $cnt=$cnt+1; } } ?>
        </div>
      

        <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalbookings FROM tblbooking;";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                  <a href="booking-history.php"> 
          <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Total Bookings</h4>
              <p><b><?php echo $result->totalbookings;?></b></p>
            </div>
          </div>
        </a>
            <?php  } ?>
        </div>

    <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalbookings FROM tblbooking where  paymentType is null or paymentType=''";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                  <a href="new-bookings.php"> 
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-user fa-3x"></i>
            <div class="info">
              <h4>New Bookings</h4>
              <p><b><?php echo $result->totalbookings;?></b></p>
            </div>
          </div>
        </a>
            <?php  } ?>
        </div>


    <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalbookings FROM tblbooking where paymentType='Partial Payment'";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                  <a href="partial-payment-bookings.php"> 
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-user fa-3x"></i>
            <div class="info">
              <h4>Partial Payment Bookings</h4>
              <p><b><?php echo $result->totalbookings;?></b></p>
            </div>
          </div>
        </a>
            <?php  } ?>
        </div>


        
         <div class="col-md-6 col-lg-6">
          <?php
                  $sql="SELECT count(id) as totalbookings FROM tblbooking where paymentType='Full Payment'";
                  $query= $dbh->prepare($sql);
                  $query-> execute();
                  $results = $query -> fetchAll(PDO::FETCH_OBJ);
                  foreach($results as $result)
                  {
                  ?>
                  <a href="full-payment-bookings.php"> 
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-user fa-3x"></i>
            <div class="info">
              <h4>Full Payment Bookings</h4>
              <p><b><?php echo $result->totalbookings;?></b></p>
            </div>
          </div>
        </a>
            <?php  } ?>
        </div>

      

      
      </div>
     
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</sc<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid']) == 0) {
    header('location:logout.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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
                <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalcat FROM tblcategory";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="add-category.php">
                    <div class="widget-small info coloured-icon">
                        <i class="icon fa fa-files-o fa-3x"></i>
                        <div class="info">
                            <h4>Listed Categories</h4>
                            <p><b><?php echo $result['totalcat']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalpackagetype FROM tblpackagetype";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="add-package.php">
                    <div class="widget-small primary coloured-icon">
                        <i class="icon fa fa-files-o fa-3x"></i>
                        <div class="info">
                            <h4>Listed Package Types</h4>
                            <p><b><?php echo $result['totalpackagetype']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalpost FROM tblblog";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="manage-blog.php">
                    <div class="widget-small primary coloured-icon">
                        <i class="icon fa fa-pencil fa-3x"></i>
                        <div class="info">
                            <h4>BLOG Posts</h4>
                            <p><b><?php echo $result['totalpost']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totaltrainer FROM tbltrainer";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="add-trainer.php">
                    <div class="widget-small primary coloured-icon">
                        <i class="icon fas fa-dumbbell fa-3x"></i>
                        <div class="info">
                            <h4>Trainers</h4>
                            <p><b><?php echo $result['totaltrainer']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalpackage FROM tbladdpackage";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="manage-post.php">
                    <div class="widget-small primary coloured-icon">
                        <i class="icon fa fa-file fa-3x"></i>
                        <div class="info">
                            <h4>Listed Packages</h4>
                            <p><b><?php echo $result['totalpackage']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalbookings FROM tblbooking";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="booking-history.php">
                    <div class="widget-small info coloured-icon">
                        <i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                            <h4>Total Bookings</h4>
                            <p><b><?php echo $result['totalbookings']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalnewbookings FROM tblbooking WHERE paymentType IS NULL OR paymentType = ''";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="new-bookings.php">
                    <div class="widget-small danger coloured-icon">
                        <i class="icon fa fa-user fa-3x"></i>
                        <div class="info">
                            <h4>New Bookings</h4>
                            <p><b><?php echo $result['totalnewbookings']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalpartialpayments FROM tblbooking WHERE paymentType = 'Partial Payment'";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="partial-payment-bookings.php">
                    <div class="widget-small warning coloured-icon">
                        <i class="icon fa fa-user fa-3x"></i>
                        <div class="info">
                            <h4>Partial Payment Bookings</h4>
                            <p><b><?php echo $result['totalpartialpayments']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalfullpayments FROM tblbooking WHERE paymentType = 'Full Payment'";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="full-payment-bookings.php">
                    <div class="widget-small primary coloured-icon">
                        <i class="icon fa fa-user fa-3x"></i>
                        <div class="info">
                            <h4>Full Payment Bookings</h4>
                            <p><b><?php echo $result['totalfullpayments']; ?></b></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <?php
                $sql = "SELECT COUNT(id) AS totalproducts FROM tblproducts";
                $query = $dbh->prepare($sql);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                ?>
                <a href="manage-products.php">
                    <div class="widget-small primary coloured-icon">
                        <i class="icon fa fa-cubes fa-3x"></i>
                        <div class="info">
                            <h4>Listed Products</h4>
                            <p><b><?php echo $result['totalproducts']; ?></b></p>
                        </div>
                    </div>
                </a>
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
    <!-- DataTables JavaScript -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sampleTable').DataTable();
        });
    </script>
</body>
</html>
ript>
    
  </body>
</html>
<?php } ?>