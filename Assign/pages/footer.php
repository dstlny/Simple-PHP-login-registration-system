<footer>
    <div class="footerContainer">
        <div class="column-container" style=" margin-right: 0px; ">
            <div id="column1" style="float: left; padding:40px; width:365px; margin-right: 0px; border: 1px solid lightgray; height: 200px; text-align: center;">
                <h3>Contact Details</h3>
                <hr>
                <Address>ADDRESS: DUMMY ADDRESS<BR>
                STREET: LOREM IPSUM SIT AMET<BR>
                POST CODE: DUMMY POSTCODE<BR>
                TELEPHONE: 1-800-123-4567<BR>
                EMAIL: INFO@DUMMY.COM</Address>
            </div>
            <div id="column2" style="padding:40px; width:365px; float:left; border: 1px solid lightgray;  height: 200px; text-align: center;">
                <h3>Copyright</h3>
                <hr>
                <address>Copyright © 2018 Example Site Limited</address>
                <address>Copyright © 2018 Luke Elam</address>
            </div> 
             <div id="column3" style="padding:40px; width:365px; float:left; border: 1px solid lightgray; height: 200px; text-align: center; ">
                <h3>Terms and Conditions</h3>
                <hr>
                <address>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</address>
            </div>
            <div id="column4" style="padding:40px; width:365px; float:left; border: 1px solid lightgray;  height: 200px; text-align: center;">
                <?php
                if($_SESSION['adminBool'] == TRUE){
                  echo '<h3>Useful Links</h3>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../pages/Index2.php">Home</a>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../requires/adminPanel.php">Admin Panel</a>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../requires/logout.php">Logout</a><br>';
                  echo "\n";
                } elseif($_SESSION['userBool'] == TRUE){
                  echo '<h3>Useful Links</h3>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../pages/Index2.php">Home</a><br>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../requires/favPanel.php">Favourites Page</a>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../requires/logout.php">Logout</a><br>';
                  echo "\n";
                } else {
                  echo '<h3>Useful Links</h3>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../pages/Index2.php">Home Page</a><br>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../pages/Index2.php#login-container">Login if you are an existing user</a>';
                  echo "\n\t\t\t    ".'<hr>';
                  echo "\n\t\t\t    ".'<a style="color: black; style: none; text-decoration: none; font-size: 15px;" href="../requires/register-form.php">Signup if you\'re a new user</a><br>';
                  echo "\n";
                }
                ?>
            </div>
        </div>    
    </div>
</footer>
</body>
</html>