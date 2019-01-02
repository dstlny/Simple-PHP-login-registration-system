<?php 
session_start();

$servername="localhost";
$dbUserName="root";
$dbPassword="";
$dbName="c3518706";

$connection = mysqli_connect($servername, $dbUserName, $dbPassword, $dbName);

if(!$connection){
    die("Connection failed: " .mysqli_connect_error());
}
?>
