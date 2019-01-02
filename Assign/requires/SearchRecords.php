<?php
require_once '../pages/dbcon/init.php';

if(isset($_POST['submitSearch']) && !empty($_POST['txtTerm'])){
        $searchName = $_POST['txtTerm'];
        mysqli_real_escape_string($connection, $searchName);
        $query      = "SELECT * FROM webProducts WHERE ProductName OR ProductDescription REGEXP '$searchName'";
        $result = mysqli_query($connection, $query);
        $rows=mysqli_num_rows($result);
        if($rows < 1){
            echo "<b style=\"color: red; font-size: 30px;\">".$rows. " products matching your search criteria.</b>";
            echo "<br><b style=\"color: red; font-size: 30px;\">However, here are some products you may like.</b><br><br>";
            $query  = "SELECT * FROM webProducts";
            $result = mysqli_query($connection, $query);
            echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                   echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                   echo '<td>';
                   echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                   echo '</td>';
                   echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
            }
            echo '</table>';
        } else {
            echo "<b style=\"color: black; font-size: 35px; padding: 15px; float:left;\">Search Results for $searchName</b><br><br>";
            echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                   echo '<tr><td>' . $row['ProductName'] . '</td><td>' .'&pound;'.$row['ProductPrice'] . '</td>';
                   echo '<td>';
                   echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                   echo '</td>';
                   echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
            } 
            echo '</table>';
        }
} elseif(isset($_GET['cat']) && !empty($_GET['cat'])){
        if($_GET['cat']){
            $searchName = $_GET['cat'];
            if($searchName == "'ALLCPU'"){
                $query      = "SELECT * FROM webProducts WHERE ProductCategory = 'AMDCPU' OR ProductCategory = 'INTELCPU'";
            } elseif($searchName == "'ALLGPU'"){
                $query      = "SELECT * FROM webProducts WHERE ProductCategory = 'AMDGPU' OR ProductCategory = 'NVIDIAGPU'";
            } else{
                $query      = "SELECT * FROM webProducts WHERE ProductCategory = $searchName";
            }
            $result = mysqli_query($connection, $query);
            //Just making sure Cetegories are named correctly         
            if($searchName === "'NVIDIAGPU'"){$searchName = "Nvidia GPU";} elseif($searchName === "'AMDGPU'"){$searchName = "AMD GPU";} elseif($searchName === "'INTELCPU'"){$searchName = "INTEL CPU";} elseif($searchName === "'AMDCPU'"){$searchName = "AMD CPU";} elseif($searchName === "'HDD-SSD'"){ $searchName = "HDD and SSD";} elseif($searchName === "'MON'"){$searchName = "Monitor";}elseif($searchName == "'ALLCPU'"){$searchName="CPU";}elseif($searchName == "'ALLGPU'"){$searchName="GPU";}
            
            $rows=mysqli_num_rows($result);
            if($rows < 1){
                echo "<b style=\"color: red; font-size: 20px;\">".$rows. " products found with a name similar to $searchName!</b>";
                echo "<br><b style=\"color: red; font-size: 30px;\">However, here are some products you may like.</b><br><br>";
                $query  = "SELECT * FROM webProducts";
                $result = mysqli_query($connection, $query);
                echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                       echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                       echo '<td>';
                       echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                       echo '</td>';
                       echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
                }
                        echo '</table>';
            }elseif(isset($_POST['subUserQuery']) && isset($_GET['cat']) && !empty($_GET['cat'])){
                    unset($_GET['cat']);
                    $query="SELECT * FROM webProducts";
                    $order = $_POST['order'];
                    $category  = $_POST['category'];
                    $search = $_POST['txtTerm'];
                    if($category !== "All"){
                       $query=$query." WHERE ProductCategory = $category";}
                    if($category !== "All" && (!empty($search))){
                       $query=$query." AND ProductName OR ProductDescription REGEXP '$search'";}
                    if($category == "All" && (!empty($search))){
                       $query=$query." WHERE ProductName OR ProductDescription REGEXP '$search'";}
                    if(!empty($order)){
                       $query=$query." ORDER BY $order";}
                    $result = mysqli_query($connection, $query);
                    $rows=mysqli_num_rows($result);
                    if($rows < 0){
                        echo "<b style=\"color: red; font-size: 30px;\">".$rows. " products matching your search criteria.</b>";
                        echo "<br><b style=\"color: red; font-size: 30px;\">However, here are some products you may like.</b><br><br>";
                        $query  = "SELECT * FROM webProducts";
                        $result = mysqli_query($connection, $query);
                        echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
                        while ($row = mysqli_fetch_assoc($result)) {
                               echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                               echo '<td>';
                               echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                               echo '</td>';
                               echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
                        }
                        echo '</table>';
                    } else{
                        echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
                        while ($row = mysqli_fetch_assoc($result)) {
                               echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                               echo '<td>';
                               echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                               echo '</td>';
                               echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
                        }
                        echo '</table>';
                   }
            } elseif($rows > 0) {
                    echo "<br><br><b style=\"color: black; font-size: 40px; padding:20px;\">$searchName category</b><br><br>";
                    echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
                    while ($row = mysqli_fetch_assoc($result)) {
                           echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                           echo '<td>';
                           echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                           echo '</td>';
                           echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
                    }
                    echo '</table>';
            }
        }
} elseif(isset($_POST['subUserQuery'])){
        $query="SELECT * FROM webProducts";
        $order = $_POST['order'];
        $category  = $_POST['category'];
        $search = $_POST['txtTerm'];
        if($category !== "All"){
           $query=$query." WHERE ProductCategory = $category";}
        if($category !== "All" && (!empty($search))){
           $query=$query." AND ProductName OR ProductDescription REGEXP '$search'";}
        if($category == "All" && (!empty($search))){
           $query=$query." WHERE ProductName OR ProductDescription REGEXP '$search'";}
        if(!empty($order)){
           $query=$query." ORDER BY $order";}
        $result = mysqli_query($connection, $query);
        $rows=mysqli_num_rows($result);
        if($rows < 1){
           echo "<b style=\"color: red; font-size: 30px;\">".$rows. " products matching your search criteria.</b>";
           echo "<br><b style=\"color: red; font-size: 30px;\">However, here are some products you may like.</b><br><br>";
           $query  = "SELECT * FROM webProducts";
           $result = mysqli_query($connection, $query);
           echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
           while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                  echo '<td>';
                  echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                  echo '</td>';
                  echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
           }
           echo '</table>';
        } else{
            echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                   echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                   echo '<td>';
                   echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                   echo '</td>';
                   echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
            }
            echo '</table>';
       }
} elseif(isset($_POST['subAdminQuery'])){
        $query="SELECT * FROM webProducts";
        $order = $_POST['order'];
        $category  = $_POST['category'];
        $search = $_POST['txtTerm'];
        if($category !== "All"){
           $query=$query." WHERE ProductCategory='$category'";}
        if($category !== "All" && (!empty($search))){
           $query=$query." AND ProductName OR ProductDescription REGEXP '$search'";}
        if($category == "All" && (!empty($search))){
           $query=$query." WHERE ProductName OR ProductDescription REGEXP '$search'";}
        if(!empty($order)){
           $query=$query." ORDER BY $order";}
        $result = mysqli_query($connection, $query);
        
        $rows=mysqli_num_rows($result);
        if($rows < 1){
           echo "<b style=\"color: red; font-size: 30px;\">".$rows. " products matching your search criteria.</b>";
           echo "<br><b style=\"color: red; font-size: 30px;\">However, here are some products you may like.</b><br><br>";
           $query  = "SELECT * FROM webProducts";
           $result = mysqli_query($connection, $query);
           echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
           while ($row = mysqli_fetch_assoc($result)) {
                  echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                  echo '<td>';
                  echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                  echo '</td>';
                  echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
           }
            echo '</table>';
        } else{
            echo '<table><tr><th>Product Name</th><th>Product Price</th><th>Product Image</th><th>Product Description</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                   echo '<tr><td>' . $row['ProductName'] . '</td><td>' . '&pound;'.$row['ProductPrice'] . '</td>';
                   echo '<td>';
                   echo "<img src='../images/products/" . $row['ProductImage'] . "'/></td>";
                   echo '</td>';
                   echo '<td>' . $row['ProductDescription'] . '</td>';?><?php if($_SESSION['userBool'] == TRUE && !empty(isset($_SESSION['userBool']))){ echo '<td><a style="color: black; style: none; text-decoration: none;" href="Index2.php?id=' .$row['ProductID'].'">Favourite Product</a></td>';}else{echo '</tr>';}
            }
            echo '</table>';
        }
    
}
?> 
