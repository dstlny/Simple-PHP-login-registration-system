<?php
    require_once   '../pages/header.php';
?>

<style>
    .main{
      height: auto;
    }
    
    .main .register-container input[type=text],
    .main .register-container input[type=password] {
        padding: 6px;
        margin-top: 8px;
        font-size: 15px;
        margin-left: 0px;
        border: 1px solid white;
        background-color: lightgray;
        width: 300px;
    }
    
    .main .register-container select {
        padding: 6px;
        margin-top: 8px;
        font-size: 15px;
        margin-left: 0px;
        border: 1px solid white;
        background-color: lightgray;
        width: 300px;
    }
    
    .main .register-container{
        padding-bottom: 30px;
    }
</style>

<div class="main">
    <div class="register-container" style="text-align: center">
        <div style="background-color:white; display: inline-block; left: 50%; padding: 50px; padding-top:10px; padding-right: 90px;margin-top: 30px; border: 5px solid gray; padding-bottom:22px;">
            <h3 style="padding:0px; font-size: 30px;">Register Account</h3>
            <form method="post" action="register.php">
              <input type="text" placeholder="Firstname..." name="txtUserFirst" value="<?php if(isset($_SESSION['firsName'])){ echo $_SESSION['firsName']; } ?>"><br>
              <div>
              <?php 
                if(isset($_SESSION['errors']['firname'])){
                    echo $_SESSION['errors']['firname'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                     echo $_SESSION['errors']['sqlError'];
                }
              ?>
              </div>
              <input type="text" placeholder="Lastname..." name="txtUserLast" value="<?php if(isset($_SESSION['lasName'])){ echo $_SESSION['lasName']; } ?>"><br>
              <div>
              <?php
                if(isset($_SESSION['errors']['secname'])){
                    echo $_SESSION['errors']['secname'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                     echo $_SESSION['errors']['sqlError'];
                } elseif(isset($_SESSION['errors']['firsecname'])){
                    echo $_SESSION['errors']['firsecname'];
                }
              ?>
              </div>
              <input type="password" placeholder="Password..." name="txtPass"><br>
              <div>
              <?php
                if(isset($_SESSION['errors']['pass'])){
                    echo $_SESSION['errors']['pass'];
                }
              ?>
              </div>
              <input type="password" placeholder="Re-enter Password..." name="txtPassRe"><br>
              <div>
              <?php
                if(isset($_SESSION['errors']['passRe'])){
                    echo $_SESSION['errors']['passRe'];
                }
              ?>
              </div>
              <input type="text" placeholder="Email..." name="txtEmail" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email']; } ?>"><br>
              <div>
              <?php
                if(isset($_SESSION['errors']['email'])){
                    echo $_SESSION['errors']['email'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                     echo $_SESSION['errors']['sqlError'];
                }
              ?>
              </div>
              <select name = "ageDrop">
                  <option value="Select">Please select an appropriate age range</option>
                  <option value="18-30" 
                  <?php
                  if(isset($_SESSION['age']) && $_SESSION['age'] == '18-30'){
                      echo "selected";
                  }
                  ?>
                  >18-30</option>
                  <option value="30-40"
                  <?php
                  if(isset($_SESSION['age']) && $_SESSION['age'] == '30-40'){
                      echo "selected";
                  }
                  ?>
                  >30-40</option>
                  <option value="40-50"
                  <?php
                  if(isset($_SESSION['age']) && $_SESSION['age'] == '40-50'){
                      echo "selected";
                  }
                  ?>
                  >40-50</option>
              </select>
              <div>
              <?php
                if(isset($_SESSION['errors']['age'])){
                    echo $_SESSION['errors']['age'];
                } elseif(isset($_SESSION['errors']['sqlError'])){
                     echo $_SESSION['errors']['sqlError'];
                }
              ?>
              </div>
              <br>
              <b style="color:black;"><input type="checkbox" style="padding: 0px; width:20px;" name="agreeChk" value="agree">I agree with the websites terms and conditions</b>
              <div>
              <?php
                if(isset($_SESSION['errors']['check'])){
                    echo $_SESSION['errors']['check'];
                }
              	?>
              </div>
              <br>
              <button type="submit" name="register" value="submit">Create</button>
                <div>
                <?php
                 if(isset($_SESSION['errors']['registration'])){
                    echo $_SESSION['errors']['registration'];
                 }  elseif(isset($_SESSION['errors']['sqlError'])){
                     echo $_SESSION['errors']['sqlError'];
                 } elseif(isset($_SESSION['errors']['empty'])){
                     echo $_SESSION['errors']['empty'];
                 }
                ?>
              	</div>
            </form>
        </div>
    </div>
</div>

<?php
  require_once  '../pages/footer.php';
?>