<?php
//Make connection to database
include '../pages/dbcon/init.php';

if(isset($_POST['insertProd']) && !empty($_POST['txtProdName']) && !empty($_POST['txtprodPrice']) && !empty($_POST['txtProdCategory']) && !empty($_POST['txtprodImageName'])){
    if(empty(trim($_POST['txtProdName']))){
       header("location: adminPanel.php?error=prodName");
       exit();
       } else {
        // Prepare a select statement
        $sql = "SELECT * FROM webProducts WHERE ProductName LIKE ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            // Set parameters
            $name=$_POST['txtProdName'];
            mysqli_stmt_bind_param($stmt, "s", $name);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    header("location: adminPanel.php?error=ProdNameTaken&txtProdName=".$name);
                    exit();
                }
            } else{
                $name=$_POST['txtProdName'];
            }
        }
       }

    $price=$_POST['txtprodPrice'];
    if(empty($_POST['txtprodPrice'])){
        header("location: adminPanel.php?error=empProdPrice&txtprodPrice=".$price);
        exit();
    } else {
          $price=$_POST['txtprodPrice'];
    }
    
    $category=$_POST['txtProdCategory'];
    if(empty($_POST['txtProdCategory'])){
        header("location: adminPanel.php?error=empProdCat&txtProdCategory=".$price);
        exit();
    } else {
          $category=$_POST['txtProdCategory'];
    }
    
    $description=$_POST['txtProdDesc'];
    if(empty($_POST['txtProdDesc'])){
        header("location: adminPanel.php?error=empProdDesc&txtProdDesc=".$description);
        exit();
    } else {
          $description=$_POST['txtProdDesc'];
    }
    
    $image=$_POST['txtprodImageName'];
    if(empty($_POST['txtprodImageName'])){
        header("location: adminPanel.php?error=empProdImg&txtprodImageName=".$image);
        exit();
    } else {
          $image=$_POST['txtprodImageName'];
    }
    
    // Check input errors before inserting in database
    if(empty($_GET['ProdNameTaken']) && empty($_GET['empProdPrice']) && empty($_GET['empProdDesc']) && empty($_GET['empProdImg'])){
        $prodID= ' ';
        // Prepare an insert statement
        $sql = "INSERT INTO webProducts (ProductID, ProductName, ProductCategory, ProductDescription, ProductPrice, ProductImage) VALUES (?,?,?,?,?,?)";
 
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            $prodID= ' ';
            $name=$_POST['txtProdName'];
            $price=$_POST['txtprodPrice'];
            $category=$_POST['txtProdCategory'];
            $description=$_POST['txtProdDesc'];
            $image=$_POST['txtprodImageName'];
            mysqli_stmt_bind_param($stmt, "ssssss", $prodID, $name, $category, $description, $price, $image);
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: adminPanel.php?prodcreation=Success");
                exit();
            } else{
                header("location: adminPanel.php?prodcreation=failed&txtProdName=".$name."&txtprodPrice=".$price."&txtProdCategory=".$category."&txtProdDesc=".$description."&txtprodImageName=".$image);
                exit();
            }
        }
        mysqli_stmt_close($stmt);
        header("location: adminPanel.php");
        exit();
    }
    
} elseif(isset($_POST['insertProd']) && empty($_POST['txtProdName']) && empty($_POST['txtprodPrice']) && empty($_POST['txtProdCategory']) && empty($_POST['txtprodImageName'])) { 
    header("location: adminPanel.php?error=AllEmpty");
}
?>
