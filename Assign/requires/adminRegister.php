<?php
require_once  '../pages/dbcon/init.php';

if(isset($_POST['register'])){

    if(empty(trim($_POST['txtAdminUser'])) && empty(trim($_POST['txtPass'])) && empty(trim($_POST['txtPassRe'])) && empty(trim($_POST['txtEmail']))){
         $error_check['empty'] = "<br><b style=\"color: red\">All fields are empty!</b>";
         $_SESSION['errors'] = $error_check;
         header("location: adminPanel.php");
         exit();
    } else{
    
        if(empty(trim($_POST['txtAdminUser']))){
            $error_check['name'] = "<br><b style=\"color: red\">Please enter the desired Admin Username!</b>";
           } else {
            
            unset($_SESSION['errors']);
            $error_check = array();
            // Prepare a select statement
            $sql = "SELECT * FROM webAdmins WHERE adminUserName=?";
            
            if($stmt = mysqli_prepare($connection, $sql)){
                // Bind variables to the prepared statement as parameters
                // Set parameters
                $adminUserName=$_POST['txtAdminUser'];
                mysqli_stmt_bind_param($stmt, "s", $adminUserName);
                
                //Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) > 0){
                        $error_check['name'] = "<br><b style=\"color: red\">An Admin with this username already exists!</b>";
                    } else{
                        $adminUserName=$_POST['txtAdminUser'];
                        $param_username = $adminUserName;
                }
            } else{
                $error_check['sqlError'] = "<br><b style=\"color: red\">An SQL error occured!</b>";
            }
        }
    
        // Validate password
        $password = trim($_POST['txtPass']);
        if(empty($_POST['txtPass'])){
            $error_check['pass'] = "<br><b style=\"color: red\">First password canot be empty!</b>";
        } elseif(!preg_match('((?=.*[A-Z])(?=.*[a-z])(?=.*\d).{7,21})', $password)){
            $error_check['pass'] = "<br><b style=\"color: red\">Password is invalid. Password must include atleast ONE capital letter, a number and a symbol!</b>";
        }
        
        $confirm_password = trim($_POST["txtPassRe"]);
        if(empty(trim($_POST["txtPassRe"]))){
            $error_check['passRe'] = "<br><b style=\"color: red\">Please confirm your password!</b>";
        } elseif($password != $confirm_password){
             $error_check['passRe'] = "<br><b style=\"color: red\">Passwords do not match!</b>";
        }
        
        // Validate email
        if(empty($_POST['txtEmail'])){
           $error_check['email'] = "<br><b style=\"color: red\">Email is empty!</b>";
        } elseif(!filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL)){
            $error_check['email'] = "<br><b style=\"color: red\">Email is of incorrect format!</b>";
            } else {
                // Prepare a select statement
            $sql = "SELECT * FROM webAdmins WHERE adminEmail=?";
            
            if($stmt = mysqli_prepare($connection, $sql)){
                
                // Set parameters
                $param_email = trim($_POST['txtEmail']);
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) > 0){
                        $error_check['email'] = "<br><b style=\"color: red\">Email aleady registered!</b>";
                        $email = $param_email;
                        $_SESSION['email'] = $email;
                    } else{
                        $error_check['email'] = "<br><b style=\"color: red\">Email aleady registered!</b>";
                        $email = $param_email;
                        $_SESSION['email'] = $email;
                    }
                } else{
                     $error_check['sqlError'] = "<br><b style=\"color: red\">An SQL error occured!</b>";
                }
            }
            }
    
        // Check input errors before inserting in database
         if(empty($error_check)){
            $adminID= ' ';
            // Prepare an insert statement
            $sql = "INSERT INTO webAdmins (adminID, adminEmail, adminUserName, adminPassword) VALUES (?,?,?,?)";
            
            if($stmt = mysqli_prepare($connection, $sql)){
                // Bind variables to the prepared statement as parameters
                $param_id = $adminID;
                $param_username = $adminUserName;
                $param_password = hash('sha512', $password).hash('sha384', $password).hash('whirlpool', $password);
                $param_email = $email;
                mysqli_stmt_bind_param($stmt, "ssss", $param_id, $param_email, $param_username, $param_password);
                $_SESSION['adminUserName']=$param_username;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $error_check['registration'] = "<br><b style=\"color: red\">Registration was a success!</b>";
                    header("location: adminPanel.php");
                    exit();
                } else{
                    $error_check['sqlError'] = "<br><b style=\"color: red\">An SQL error occured!</b>";
                }
            }
            mysqli_stmt_close($stmt);
            header("location: adminPanel.php");
            exit();
        }
      }
    }
}
?>
