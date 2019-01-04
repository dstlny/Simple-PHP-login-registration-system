<?php
//Make connection to database
include '../pages/dbcon/init.php';

//Gather id from $_GET[]
$id=$_GET['id'];

$query="DELETE FROM webProducts WHERE ProductID='$id'";
//Construct DELETE query to remove record where WHERE id provided equals the id in the table

//run $query
mysqli_query($connection, $query);

(mysqli_affected_rows($connection) > 0) ? header("location: adminPanel.php") : header("location: adminPanel.php");		
?>
