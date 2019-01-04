<?php
//real simple page.
include '../pages/dbcon/init.php';
$id=$_GET['id'];
$query="DELETE FROM webProducts WHERE ProductID='$id'";
mysqli_query($connection, $query);
(mysqli_affected_rows($connection) > 0) ? header("location: adminPanel.php") : header("location: adminPanel.php");		
?>
