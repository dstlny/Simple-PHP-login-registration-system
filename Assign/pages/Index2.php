<?php
require_once  'header.php';
if(isset($_GET['id'])){
  $id = $_GET['id'];
  array_push($_SESSION['fav'], $id);
} elseif(!isset($_SESSION['fav'])){
    
} else{
    
}
?>

<script> history.replaceState({}, null, "../pages/Index2.php"); </script>

<div class="main">
    <div class="imageSpinner">
           
           <style>
               .animate-fading{
                animation:fading 10s infinite}
                @keyframes fading{0%{opacity:0}50%{opacity:1}100%{opacity:0}}
            
                .corouselContent{ 
                    margin-left: auto;
                    margin-right: auto;
                    margin-bottom: 10px;
                    margin-top: 0px;
                    max-width: 980px;
                }
                
                .corousel-container{
                    position:relative;
                }
                
           </style>
           <br><br>
            <div class="corouselContent corousel-container">
              <img class="mySlides animate-fading" src="../images/products/Banner1.jpg" style="width:100%" size="50%">
              <img class="mySlides animate-fading" src="../images/products/Banner2.jpg" style="width:100%" size="50%">
              <img class="mySlides animate-fading" src="../images/products/Banner3.png" style="width:100%" size="50%">
              <img class="mySlides animate-fading" src="../images/products/Banner4.png" style="width:100%" size="50%">
            </div>
            
            <script>
            var myIndex = 0;
                carousel();
                
                function carousel() {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    for (i = 0; i < x.length; i++) {
                       x[i].style.display = "none";  
                    }
                    myIndex++;
                    if (myIndex > x.length) {myIndex = 1}    
                    x[myIndex-1].style.display = "block";  
                    setTimeout(carousel, 9000);    
                }
            </script>
    </div>
     <div class="product-container" style="text-align: center; height: auto; padding-left: auto; padding-right: auto; padding-top: 30px; margin-left: 30px; margin-right: 30px; color: black; margin-top: 430px;">
        <div class="Categories" stye=" background-color: white; ">
        <div style="background-color:white; height: auto;">
              <div class="product-container" style="text-align: center; border: 2px solid gray; margin-left: 30px; margin-right: 30px; padding-left: auto; padding-right:auto;">
               <div stye="text-align: center;" class="selec-container">
          	     <form method="post" class="selections">
          	        <fieldset><h3 style="font-size: 30px; color: black">Filter Products</h3>
          	        <hr>
          	        <label>Order by</label>
          	        <select name="order" class="selection">
                          <option value="ProductName">A-Z</option>
                          <option value="ProductPrice">Price: Low to High</option>
                          <option value="ProductPrice DESC">Price: High to Low</option>
                    </select>
                    <label>Category</label>
          	        <select name="category" class="selection">
                          <option value="All">All Products...</option>
                          <option value="'AMDCPU' OR ProductCategory = 'INTELCPU'"<?php if(isset($_GET['cat']) && $_GET['cat'] == "'ALLCPU'"){ echo " selected";}?>>All CPUs...</option>
                          <option value="'AMDGPU' OR ProductCategory = 'NVIDIAGPU'"<?php if(isset($_GET['cat']) && $_GET['cat'] == "'ALLGPU'"){ echo " selected";}?>>All GPUs...</option>
                    <?php
                             include '../pages/dbcon/init.php';
                             $query = 'SELECT DISTINCT ProductCategory FROM webProducts';
                             $result = mysqli_query($connection, $query);
                             while($row = mysqli_fetch_assoc($result)){
                                 echo "\t" . "  ";
                                 echo '<option value="\'';?><?php echo $row['ProductCategory'] ;?><?php echo '\'"';?><?php if(isset($_GET['cat']) && $_GET['cat'] == "'".$row['ProductCategory']."'"){ echo "selected";}?><?php echo ">".$row['ProductCategory']."...</option>\n";?>
                    <?php
                       }
                    ?>
</select>
                    <label>Search</label>
                    <input type="text" placeholder="Enter Search.." name="txtTerm" />
                    <button type="submit" name="subUserQuery" value="submit">Submit Query</button>
                </fieldset>
                </form>
    	 </div>
              <?php
                if(isset($_POST['subUserQuery']) || isset($_POST['submitSearch']) || isset($_GET['cat'])){
                    require_once '../requires/SearchRecords.php';
                } else{
                      '../pages/dbcon/init.php';
                     $query  = "SELECT * FROM webProducts";
                     $result = mysqli_query($connection, $query);
                     $i = 0;
                     echo "\n\n     <!-- TABLE HTML CODE START -->";
                     echo "\n       <!-- TABLE HEADER START -->";
                     echo "\n".'        <table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>'."\n";
                     echo "         <!-- TABLE HEADER END -->\n\n";
                     while ($row = mysqli_fetch_assoc($result)) {
                            echo "\n           <!-- TABLE ROW ".$i." START -->\n";
                            echo '              <tr><td>' . $row['ProductName'] .'</td>'."\n".'              <td>' .'&pound;'.$row['ProductPrice'] . '</td>'."\n";
                            echo "              <td><img src='../images/products/" . $row['ProductImage'] . "'/></td>"."\n";
                            echo '              <td>' . $row['ProductDescription'] . '</td>'."\n";?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '              <td><a style="color: black; style: none; text-decoration: none;" href="?id='.$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>'."\n";}
                            echo "\n           <!-- TABLE ROW ".$i." END -->\n";$i++;?>
                            
                <?php
                     }
                    echo "\n     <!-- TABLE FOOTER START -->\n";
                    echo '              </table>';
                    echo "\n       <!-- TABLE FOOTER END -->\n";
                    echo "     <!-- TABLE HTML CODE END -->\n\n";
                }
                ?> 
              </div>
        </div>
    </div>
</div>
</div>
<?php
 require_once   'footer.php';
?>