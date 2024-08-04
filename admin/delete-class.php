<?php
session_start();
error_reporting(0);
include 'include/config.php'; 
if (strlen($_SESSION['adminid'] == 0)) {
  header('location:logout.php');
} else {
$cid = intval($_GET['cid']);
$sql = "DELETE from tblclass where id = :cid";
$query = $dbh->prepare($sql);
$query->bindParam(':cid', $cid, PDO::PARAM_STR);
$query->execute();
echo "<script>alert('Class deleted successfully');</script>";
echo "<script>window.location.href ='manage-classes.php';</script>";
}
?>
