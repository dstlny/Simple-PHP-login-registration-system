<?php
//Make connection to database
include '../pages/dbcon/init.php';
unset($_SESSION['errors']);
$error_check = array();
$_SESSION['errors'] = $error_check;
$id=$_SESSION['id'];

if(isset($_POST['upProd']) && empty($_POST['txtNewName']) && empty($_POST['txtNewPrice']) && empty($_POST['txtNewCategory']) && empty($_POST['txtNewDesc']) && empty($_POST['txtNewImage'])){
   $error_check['error1'] = "<br><b style=\"color: red\">All fields are empty.</b>";
   $_SESSION['errors'] = $error_check;
   header("Location:  AmendProduct.php?id=".$id);
   exit();
} else {

   if(empty($_POST['txtNewName'])){
      $error_check['error2'] = "<br><b style=\"color: red\">Product name empty.</b>";
      $_SESSION['errors'] = $error_check;
   }
   
   $_SESSION['name'] = $_POST['txtNewName'];
   
   if(empty($_POST['txtNewPrice'])){
      $error_check['error3'] = "<br><b style=\"color: red\">Empty product price.</b>";
   }
   
   $_SESSION['price'] = $_POST['txtNewPrice'];
   
   if(empty($_POST['txtNewCategory'])){
      $error_check['error4'] = "<br><b style=\"color: red\">Empty product category.</b>";
   }
   
   $_SESSION['category'] = $_POST['txtNewCategory'];
   
   if(empty($_POST['txtNewDesc'])){
      $error_check['error5'] = "<br><b style=\"color: red\">Description empty.</b>";
   }
   
   $_SESSION['description'] = $_POST['txtNewDesc'];
   
   if(empty($_POST['txtNewImage'])){
      $error_check['error6'] = "<br><b style=\"color: red\">Image name is empty.</b>";
   }

   $_SESSION['image'] = $_POST['txtNewImage'];
   
   if(empty($error_check)){
       $id=$_POST['txtID'];
       $name=$_POST['txtNewName'];
       $price=$_POST['txtNewPrice'];
       $category=$_POST['txtNewCategory'];
       $description=$_POST['txtNewDesc'];
       $image=$_POST['txtNewImage'];
       $query = "UPDATE webProducts SET ProductName='$name', ProductCategory='$category',  ProductDescription='$description', ProductPrice = '$price', ProductImage='$image' WHERE ProductID='$id'";
       mysqli_query($connection, $query);
       $error_check['error7'] = "<br><b style=\"color: lightgreen\">Successfully Amended product!</b>";
       $_SESSION['errors'] = $error_check;
       header("Location:  AmendProduct.php?id=".$id);
       exit();
   }else{
      $_SESSION['errors'] = $error_check;
      header("Location:  AmendProduct.php?id=".$id);
      exit();
   }
}
?>