<?php
//Make connection to database
include '../pages/dbcon/init.php';

//Gather id from $_GET[]
$id=$_GET['id'];

$query="DELETE FROM webProducts WHERE ProductID='$id'";
//Construct DELETE query to remove record where WHERE id provided equals the id in the table

//run $query
mysqli_query($connection, $query);

// check to see if any rows were affected
if (mysqli_affected_rows($connection) > 0) {
      //If yes , return to calling page(stored in the server variables)
      header("location: adminPanel.php");
} else {
      header("location: adminPanel.php");
      exit ;
}		
?>
