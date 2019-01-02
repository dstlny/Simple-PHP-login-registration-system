<?php
if(isset($_SESSION['adminBool']) && $_SESSION['adminBool'] == TRUE){
    header ('location: ../requires/AmendProduct.php');
}
?>

<?php
    require_once  '../pages/header.php';
?>

<style>
    input[type=text],  input[type=password], input[type=checkbox], select{
      padding: 6px;
      margin-top: 8px;
      font-size: 15px;
      margin-left:0px;
      border: 2px solid lightgray;
      background-color: white;
      width: 370px;
    }
    
    .scrollable {
       height: auto;
       overflow-y: scroll;
     }
     
    .product-container{
        padding-right:0px;
        magin-bottom: 0px;
    }
    
    .product-container h3 {
      color: #000;
      margin-bottom: 0px;
      font-size: 20px;
      padding-bottom: 0px;
      padding-top: 0px;
      padding-right: 0px;
    }
    
    .product-container input[type=text]{
      padding: 6px;
      margin-top: 8px;
      font-size: 15px;
      margin-left:0px;
      border: 2px solid lightgray;
      background-color: white;
      width: 150px;
    }
    
    select{
      padding: 6px;
      margin-top: 8px;
      font-size: 15px;
      margin-left:0px;
      border: 2px solid lightgray;
      background-color: white;
      width: 200px;
    }
    
    .product-container img{
        height: 150px;
        width: 300px;
    }
    
    table, td, th {    
        border: 1px solid #ddd;
        text-align: left;
    }
    
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 0px;
    }
    
    th, td {
        padding: 15px;
    }
    
    button{
      padding: 6px;
        margin-top: 8px;
        font-size: 15px;
        margin-left: 0px;
        border: 2px solid white;
        background: #ddd;
        cursor: pointer;
        color: gray;
    }
    
    button:hover{
        background: #ccc;
    }

</style>

<div style="height: 750px;" class="main">
    <div class="product-container" style="text-align: center; height: 700px; padding-left: auto; padding-right: auto; padding-top: 30px; margin-left: 30px; margin-right: 30px; color: black;">
        <div style="background-color:white; height: auto;">
              <div class="product-container scrollable" style="text-align: center; border: 2px solid gray; margin-top: 30px; margin-left: 30px; margin-right: 30px; padding-left: auto; padding-right:auto;">
              <?php
                require_once  '../pages/dbcon/init.php';       
                $id=$_GET['id'];
                $_SESSION['id'] =$id;
                $query = "SELECT * FROM webProducts WHERE ProductID = '$id'";
                $result = mysqli_query($connection, $query);
                $rows = mysqli_num_rows($result);
                echo "<br><b style=\"color: black; font-size: 30px;\">Current details in database about the product you have selected to amend</b><br><br>";
                while ($row = mysqli_fetch_assoc($result)) {
                       echo '<table><tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Category</th><th>Product Description</th></tr>';
                       echo '<tr><td>'.$row['ProductID'].'</td><td>'.$row['ProductName'].'</td><td>'.$row['ProductPrice'] .'</td>';
                       echo '<td>';
                       echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                       echo '<td>'.$row['ProductCategory'].'</td><td>'.$row['ProductDescription'].'</td></tr>';
                       echo '</table>';
                } 
                
                echo '<br><br>';
                echo "<div style=\"padding: 20px; border: 1px solid gray;\"><b style=\"color: black; font-size: 30px;\">New Product Details:</b><br><br>";
                echo '<form method="post" action="updateAmend.php">';?>
                <?php  echo '<input type="hidden" name="txtID" '?><?php echo 'value="'?><?php if(isset($_GET['id'])){ echo $_GET['id']; } echo '">';?>
                <?php echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Category</th><th>Product Description</th></tr>';?>
                <?php  echo '<td><textarea name="txtNewName" placeholder="New product name..." rows="4" cols="20"></textarea>';?>
                <?php
                    if(isset($_SESSION['errors']['error2'])){
                       echo $_SESSION['errors']['error2'];
                    }
                echo "</td>";?>
                <?php  echo "<td><textarea name=\"txtNewPrice\" placeholder=\"New product price...\" rows=\"4\" cols=\"20\">"?><?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}  echo"</textarea>";?>
                <?php
                    if(isset($_SESSION['errors']['error3'])){
                       echo $_SESSION['errors']['error3'];
                    }
                echo "</td>";?>
                <?php  echo "<td><textarea name=\"txtNewImage\" placeholder=\"New product image name...\" rows=\"4\" cols=\"20\">"?><?php if(isset($_SESSION['image'])){echo $_SESSION['image'];}  echo"</textarea>";?>
                <?php
                    if(isset($_SESSION['errors']['error6'])){
                       echo $_SESSION['errors']['error6'];
                    }
                echo "</td>";?>
                <?php  echo "<td><textarea name=\"txtNewCategory\" placeholder=\"New product category...\" rows=\"4\" cols=\"20\">"?><?php if(isset($_SESSION['category'])){echo $_SESSION['category'];}  echo"</textarea>";?>
                <?php
                    if(isset($_SESSION['errors']['error4'])){
                       echo $_SESSION['errors']['error4'];
                    }
                echo "</td>";?>
                <?php  echo "<td><textarea name=\"txtNewDesc\" placeholder=\"New product description...\" rows=\"4\" cols=\"20\">"?><?php if(isset($_SESSION['description'])){echo $_SESSION['description'];}  echo"</textarea>";?>
                <?php
                    if(isset($_SESSION['errors']['error5'])){
                       echo $_SESSION['errors']['error5'];
                    }
                echo "</td>";?>
                <?php  echo "<td><button type=\"submit\" name=\"upProd\" value=\"submit\">Insert Updated Record</button></td></tr>";?>
                <?php  echo "</table></div>"; ?>
                <?php if(isset($_SESSION['errors']['error7'])){
                       echo $_SESSION['errors']['error7'];
                    }elseif(isset($_SESSION['errors']['error1'])){
                        echo $_SESSION['errors']['error1'];
                    } ;?> 
    </div>
    </div>
    </div>
</div>

<?php
  require_once  '../pages/footer.php';
?>       
