<?php 
session_start();

$servername="";
$dbUserName="";
$dbPassword="";
$dbName="";

$connection = mysqli_connect($servername, $dbUserName, $dbPassword, $dbName);

if(!$connection){
    die("Connection failed: " .mysqli_connect_error());
}
?>
