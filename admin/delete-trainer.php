<?php
session_start();
error_reporting(0);
include 'include/config.php';

if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {
    if(isset($_GET['tid'])) {
        $tid = $_GET['tid'];
        
        $sql = "DELETE FROM tbltrainer WHERE id = :tid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':tid', $tid, PDO::PARAM_INT);
        $query->execute();
        
        echo "<script>alert('Trainer deleted successfully');</script>";
        echo "<script>window.location.href ='manage-trainers.php';</script>";
    } else {
        header('location:manage-trainers.php');
        exit;
    }
}
?>
