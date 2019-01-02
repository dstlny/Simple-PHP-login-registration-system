<!DOCTYPE html>
<html lang="en">
<head>
<title>Assignment Website, Ecommerce Example</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="topnav">
	 <div class="topnav-container">
	  <div class="login-container" style="padding-right:20px;" id="login-container">
  	   <div class="login-inner">
    	     <?php
             //include init.php so session vars can be used
             require_once  'dbcon/init.php';
            
             if ($_SESSION['userBool'] == TRUE) {
             	 echo '<h3 class="welcome" style="padding-right:90px;">Hello,'."\n\t\t\t ".'<br>Welcome back '  .$_SESSION['userName']. '!'. '</h3><br>';
              	 echo "\n\t\t\t Today's date is: "; 
                 $today = date("l jS \of F\, Y"); 
                 echo '<b>'. $today. '</b><br><br>'."\n\t\t\t "; 
              	 echo '<a style="color: black; style: none; text-decoration: none;" href="../requires/logout.php">Logout</a><br>'."\n ";
             } elseif($_SESSION['adminBool'] == TRUE) {
                 echo '<h3 style="padding-right:60px; font-size: 20px;">Hello,<br>Welcome back '  .$_SESSION['adminUserName']. '!'. '</h3><br>';
              	 echo "Today's date is: "; 
                 $today = date("l jS \of F\, Y"); 
                 echo '<b>'. $today. '</b><br><br>'; 
              	 echo '<a style="color: black; style: none; text-decoration: none;" href="../requires/logout.php">Logout</a><br />';
             } else {
                 include '../requires/loginform.php';
                 if(isset($_SESSION['errors']['user'])){
                    echo $_SESSION['errors']['user'];
                 }  elseif(isset($_SESSION['errors']['sqlError'])){
                    echo $_SESSION['errors']['sqlError'];
                 }
             }
          	?>
  	   </div>
	  </div>
	  
	  <div class="fav-search-wrapper">
	   <div class="logo" style="float: left;">
        <img src="../images/logo.png" height="150px" width="410px">
		</div>
	    <div class="search-container" style="float: right;">
	     <h3>Search</h3> 
	     <form method="post">
	        <input type="text" placeholder="Search by keywords" name="txtTerm">
	          <button type="submit" name="submitSearch" value="submit">Search</button>
	      </form>
	    </div>
	   </div>
	   
	   <div class="nav-container" style="padding-left:30px;">
  	    <ul>
          <li><a href="../pages/Index2.php">HOME PAGE</a></li>
          <li><a href="../pages/Index2.php?cat='ALLCPU'" <?php if($_GET['cat'] == "'ALLCPU'"){ echo "style='background-color: white; color: #0092dd;'";}?> >CPU</a></li>
          <li><a href="../pages/Index2.php?cat='ALLGPU'" <?php if($_GET['cat'] == "'ALLGPU'"){ echo "style='background-color: white; color: #0092dd;'";}?> >GPU</a></li>
          <li><a href="../pages/Index2.php?cat='HDD-SSD'"  <?php if($_GET['cat'] == "'HDD-SSD'"){ echo "style='background-color: white; color: #0092dd;'";}?> >HDD/SDD</a></li>
          <li><a href="../pages/Index2.php?cat='MON'"  <?php if($_GET['cat'] == "'MON'"){ echo "style='background-color: white; color: #0092dd;'";}?> >MONITORS</a></li>
          <?php
              if($_SESSION['adminBool'] == TRUE){
                 echo '<li><a href="../requires/adminPanel.php">ADMIN PANEL</a></li>';
              } elseif($_SESSION['userBool'] == TRUE){
                  echo '<li><a href="../requires/favPanel.php">FAVOURITES</a></li>';
              } else {
                  
              }
          ?>
        </ul>
	    </div>
	  </div>
</div>
