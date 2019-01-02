<?php
require_once  '../pages/dbcon/init.php';
if(empty($_SESSION['fav'])){
   header("Location: ../pages/Index2.php");
}
?>

<script> history.replaceState({}, null, "../requires/favPanel.php"); </script>

<?php
require_once  '../pages/header.php';
?>

<style>

    .scrollable {
       height: 1000px;
       overflow-y: scroll;
     }

    .admin-register-container  input[type=text],  input[type=password], input[type=checkbox], select{
        padding: 6px;
        margin-top: 8px;
        font-size: 15px;
        margin-left: 0px;
        border: 2px solid white;
        background: lightgray;
        width: 300px;
    }

    .admin-register-container button {
        padding: 25px;
        font-size: 15px;
        margin-left: 0px;
        border: 2px solid white;
        background: #ddd;
        cursor: pointer;
        color: gray;
    }

     .admin-register-container button:hover{
        background: #ccc;
    }

    .admin-register-container h3 {
      color: #000;
      margin-bottom: 0px;
      font-size: 20px;
      padding-bottom: 0px;
      padding-top: 0px;
      padding-right: 0px;
    }

    .admin-register-container{
        padding-right:0px;
    }

    .product-container{
        padding-right:0px;
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

    table, td, th {
        border: 1px solid #ddd;
        text-align: center;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 0px;
    }

    th, td {
        padding: 15px;
    }

    .addProduct button, .form button{
      padding: 6px;
        margin-top: 8px;
        font-size: 15px;
        margin-left: 0px;
        border: 2px solid white;
        background: #ddd;
        cursor: pointer;
        color: gray;
    }


    .addProduct button:hover, .form button:hover{
        background: #ccc;
    }

    .form input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 15px;
        margin-left: 0px;
        border: 2px solid white;
        background: lightgray;
    }

</style>

<div class="main" cstyle="height: auto;">
    <div class="product-container" style="text-align: center; height: auto; padding-left: auto; padding-right: auto; padding-top: 30px; margin-left: 30px; margin-right: 30px; color: black;">
        <div style="background-color:white; height: auto;">
            <h3 style="padding:0px; font-size: 30px;">Favourite Products</h3>
            <hr style="width: 600px;">
              <div class="product-container scrollable" style="text-align: center; border: 2px solid gray; margin-top: 30px; margin-left: 30px; margin-right: 30px; padding-left: auto; padding-right:auto;">
              <?php
                    
                    if($_GET['id']){
                        $index = array_search($_GET['id'], $_SESSION['fav']);
                        array_splice($_SESSION['fav'], $index, 1);
                        error_reporting(0);
                        header("Location: ".$_SERVER['PHP_SELF']);
                    }
                    
                    if(empty($_SESSION['fav'])){
                        echo '<meta http-equiv="refresh" content="0;url=../pages/Index2.php">';
                    }
                    
                    if(isset($_GET['ClearAll'])){
                        $_SESSION['fav'] = array();
                        echo '<meta http-equiv="refresh" content="0;url=../pages/Index2.php">';
                    }
                    echo '<table>';
                    echo '<tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Category</th><th>Product Description</th><th><a style="color: black;" href="?ClearAll">Delete All</a></th></tr>';
                    foreach($_SESSION['fav'] as $key=>$value){
                        $query = "SELECT * FROM webProducts WHERE ProductID='$value'";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                               echo '<tr><td>' . $row['ProductName'] . '</td><td>' . $row['ProductPrice'] . '</td>';
                               echo '<td>';
                               echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                               echo '</td>';
                               echo '<td>' . $row['ProductCategory'] . '</td><td>' . $row['ProductDescription'] . '</td>
                               <td><a style="color: black;" href="?id='.$row['ProductID'].'">Delete favourite</a></td></tr>';
                        }
                    }
                    echo '</table>';
                ?>
              </div>
        </div>
    </div>
        </div>
    </div>
</div>

<?php
require_once  '../pages/footer.php';
?>