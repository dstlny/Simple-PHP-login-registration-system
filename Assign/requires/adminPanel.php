<?php
require_once  '../pages/header.php';

(!isset($_SESSION['adminBool'])) ? header ('location: ../pages/Index2.php') : null;
?>

<script> history.replaceState({}, null, "../requires/adminPanel.php"); </script>

<?php
require_once  '../pages/header.php';
?>

<style>
    .main{
      height: 2100px;
    }

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
    
    input[type=text]{
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
    
    input[type=text] {
        padding: 6px;
        margin-top: 8px;
        font-size: 15px;
        margin-left: 0px;
        border: 2px solid white;
        background: lightgray;
    }
    
</style>

<div class="main">
    <div class="product-container" style="text-align: center; height:  1950px; padding-left: auto; padding-right: auto; padding-top: 30px; margin-left: 30px; margin-right: 30px; color: black; background-color: white;">
        <div style="background-color:white; height: auto;">
            <div stye="text-align: center;" class="selec-container">
          	     <form method="post" class="selections">
          	        <h3 style="padding:0px; font-size: 30px; margin-top: 0px; margin-bottom: 10px;">ADMIN PANEL</h3>
          	        <fieldset><h3 style="padding:0px; font-size: 30px;">Amend, Delete or Filter Products</h3>
          	        <hr>
          	        <label>Order by</label>
          	        <select name="order" class="selection">
                          <option value="ProductName">A-Z</option>
                          <option value="ProductPrice">Price: Low to High</option>
                          <option value="ProductPrice DESC">Price: High to Low</option>
                          <option value="ProductID DESC">Product ID:  High to Low</option>
                          <option value="ProductID">Product ID: Low to High</option>
                    </select>
                    <label>Category</label>
          	        <select name="category" class="selection">
                          <option value="All">All</option>
                          <?php
                             include '../pages/dbcon/init.php';
                             $query = 'SELECT DISTINCT ProductCategory FROM webProducts';
                             $result = mysqli_query($connection, $query);
                             while($row = mysqli_fetch_assoc($result)){
                                 echo '<option value="'.$row['ProductCategory'].'">'.$row['ProductCategory'].'</option>';
                             }
                          ?>
                    </select>
                    <label>Search</label>
                    <input type="text" placeholder="Enter Search.." name="txtTerm">
                    <button type="submit" name="subAdminQuery" value="submit">Submit Query</button>
                </form>
            </fieldset>

              <div class="product-container scrollable" style="text-align: center; border: 2px solid gray; margin-top: 30px; margin-left: 30px; margin-right: 30px; padding-left: auto; padding-right:auto;">
              <?php
                if(isset($_POST['subAdminQuery'])){
                    require_once '../requires/SearchRecords.php';
                } else{
                     require_once '../pages/dbcon/init.php';
                     $query  = "SELECT * FROM webProducts";
                     $result = mysqli_query($connection, $query);
                     while ($row = mysqli_fetch_assoc($result)) {
                            echo '<table><tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
                            echo '<tr>'; ?><?php if($_SESSION['adminBool'] == TRUE && !empty(isset($_SESSION['adminBool']))){ echo '<td>'.$row['ProductID'].'</td>';}?><?php echo'<td>' . $row['ProductName'] . '</td><td>' .'&pound;'.$row['ProductPrice'] . '</td>';
                            echo '<td>';
                            echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                            echo '</td>';
                            echo '<td>' . $row['ProductDescription'] . '</td>';?>
                            <?php if($_SESSION['adminBool'] == TRUE && !empty(isset($_SESSION['adminBool'])))
                            { echo '<td><a style="color: black;" href="DeleteProduct.php?id='.$row['ProductID'].'">Delete</a></td><td><a style="color: black;" href="AmendProduct.php?id='.$row['ProductID'].'">Amend</a></td></tr></table>';}?><?php
                     }
                }
                ?> 
              </div>
              <?php
                  echo '<div class="addProduct" style=" padding-top:0px; border: 2px solid gray; margin-left: 30px; margin-right: 30px;"><h3 style="padding:0px; font-size: 30px;">Add New Product</h3>';
                  echo '<form method="post" action="InsertRecord.php">';
                  echo '<table style="padding-bottom:0px; margin-top:10px;"><tr style="padding:10px;">
                       <th style="padding:10px;">Product Name</th>
                       <th style="padding:10px;">Product Price</th>
                       <th style="padding:10px;">Product Image</th>
                       <th style="padding:10px;">Product Category</th>
                       <th style="padding:10px;">Product Description</th>
                       </tr>'
                       ?>
              <?php  echo '<tr>';?>
              <?php  echo "<td style=\"padding:0px; padding-bottom:0px;\"> <textarea name=\"txtProdName\" placeholder=\"Product name...\" rows=\"6\" cols=\"23\" value="?><?php if(isset($_GET['txtProdName'])){ echo $_GET['txtProdName']; } echo"></textarea></td>";?>
              <?php  echo "<td style=\"padding:0px; padding-bottom:0px;\"> <textarea name=\"txtprodPrice\" placeholder=\"Product price...\" rows=\"6\" cols=\"23\" value="?><?php if(isset($_GET['txtprodPrice'])){ echo $_GET['txtprodPrice']; } echo "></textarea></td>"; ?>  
              <?php  echo "<td style=\"padding:0px; padding-bottom:0px;\"> <textarea name=\"txtprodImageName\" placeholder=\"Product image name...\" rows=\"6\" cols=\"23\" value="?><?php if(isset($_GET['txtprodImageName'])){ echo $_GET['txtprodImageName']; } echo"></textarea> </td>"; ?> 
              <?php  echo "<td style=\"padding:0px; padding-bottom:0px;\"> <textarea name=\"txtProdCategory\" placeholder=\"Product category...\" rows=\"6\" cols=\"23\"  value="?><?php if(isset($_GET['txtProdCategory'])){ echo $_GET['txtProdCategory']; } echo "></textarea> </td>"; ?> 
              <?php  echo "<td style=\"padding:0px; \"> <textarea name=\"txtProdDesc\" placeholder=\"Product description...\" rows=\"6\" cols=\"23\"  value="?><?php if(isset($_GET['txtProdDesc'])){ echo $_GET['txtProdDesc']; } echo "></textarea></td>"; ?> 
              <?php  echo "<td><button style=\"padding:30px;\" type=\"submit\" name=\"insertProd\" value=\"submit\">Insert Record</button></td></tr>";?> 
              <?php  echo "</table>";?> 
              <?php     
              if(isset($_GET['prodcreation']) && $_GET['prodcreation'] == "Success"){
                       echo "<br><b style=\"color: lightgreen\">Product Creation successfull!</b> ";
               }  elseif($_GET['creation'] == "failed"){
                         echo "<br><b style=\"color: red\">Adding this product has failed, please try again!</b>";
               }
               
               if(isset($_GET['error'])){
                   if($_GET['error'] == "prodName"){
                         echo "<br><b style=\"color: red\">Product name cannot be empty!</b><br><br>";
                    }elseif($_GET['error'] == "ProdNameTaken"){
                         echo "<br><b style=\"color: red\">Product name is already taken!</b><br><br>";
                    }elseif($_GET['error'] == "empProdPrice"){
                         echo "<br><b style=\"color: red\">Product price cannot be empty!</b><br><br>";
                    }elseif($_GET['error'] == "empProdCat"){
                         echo "<br><b style=\"color: red\">Product category cannot be empty!</b><br><br>";
                    }elseif($_GET['error'] == "empProdDesc"){
                         echo "<br><b style=\"color: red\">Product description cannot be empty!</b><br><br>";
                    }elseif($_GET['error'] == "empProdImg"){
                         echo "<br><b style=\"color: red\">Product image name cannot be empty!</b><br><br>";
                    }elseif($_GET['error'] == "AllEmpty"){
                         echo "<br><b style=\"color: red\">All fields are empty!</b><br><br>";
                    }
               }
                 echo '</form>';
                 echo'</div>';
              ?>
        </div>
    </div>
        
        <div class="admin-register-container" style=" text-align: center; float: left; margin-left: 45px;">
        <div style="background-color:white;  display: inline-block; padding: 50px; padding-right: 30px;  padding-top:10px;  border: 2px solid gray; padding-bottom:30px;">
            <h3 style="padding:0px; font-size: 30px;">Register New Admin Account</h3>
            <hr>
            <form method="post" action="adminRegister.php">
              <input type="text" placeholder="Admin Username..." name="txtAdminUser" value="<?php if(isset($_POST['txtAdminUser'])){ echo $_POST['txtAdminUser']; } ?>" ><br>
              <div>
              <?php 
                if(isset($_SESSION['errors']['name'])){
                    echo $_SESSION['errors']['name'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                    echo $_SESSION['errors']['sqlError'];
                }
              ?>
              </div>
              <input type="password" placeholder="Admin Password..." name="txtPass" ><br>
              <div>
              <?php 
                if(isset($_SESSION['errors']['pass'])){
                    echo $_SESSION['errors']['pass'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                    echo $_SESSION['errors']['sqlError'];
                }
              ?>
              </div>
              <input type="password" placeholder="Re-enter Password..." name="txtPassRe" ><br>
              <div>
              <?php 
                if(isset($_SESSION['errors']['passRe'])){
                    echo $_SESSION['errors']['passRe'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                    echo $_SESSION['errors']['sqlError'];
                }
              ?>
              </div>
              <input type="text" placeholder="Admin Email..." name="txtEmail" value="<?php if(isset($_POST['txtEmail'])){ echo $_POST['txtEmail']; } ?>"><br>
              <div>
               <?php 
                if(isset($_SESSION['errors']['email'])){
                    echo $_SESSION['errors']['email'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                    echo $_SESSION['errors']['sqlError'];
                }
                ?>
              </div>
              <br>
              <button type="submit" name="register" value="submit">Create New Admin</button>
                <div>
                <?php 
                if(isset($_SESSION['errors']['empty'])){
                    echo $_SESSION['errors']['empty'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                    echo $_SESSION['errors']['sqlError'];
                }
                ?>
              	</div>
            </form>
        </div>
    </div>
</div>
</div>
<?php
require_once  '../pages/footer.php';
?>
