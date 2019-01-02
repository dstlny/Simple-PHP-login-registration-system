/*
* Created by dstlny on 8/12/2018
*/

<?php
require_once  '../pages/dbcon/init.php';
    
    if(isset($_POST['agreeChk']) && isset($_POST['register'])){
    
        if(empty(trim($_POST['txtUserFirst'])) && empty(trim($_POST['txtUserFirst'])) && empty(trim($_POST['txtUserFirst'])) && empty(trim($_POST['txtUserFirst'])) && empty(trim($_POST['txtUserFirst']))){
            $error_check['empty'] = "<br><b style=\"color: red\">All fields are empty!</b>";
            $_SESSION['errors'] = $error_check;
            header("location: register-form.php");
            exit();
        } else { 

        unset($_SESSION['errors']);
        $error_check = array();
        // Validate username
            if(empty(trim($_POST['txtUserFirst']))){
                $error_check['firname'] = "<br><b style=\"color: red\">Please enter your first name!</b>";
            } elseif(!ctype_alpha($_POST['txtUserFirst'])){
                $error_check['firname'] = "<br><b style=\"color: red\">First name must be alphabetic characters only</b>";
            } 
            
            if(empty(trim($_POST['txtUserLast']))){
                $error_check['secname'] = "<br><b style=\"color: red\">Please enter your second name!</b>";
            } elseif(!ctype_alpha($_POST['txtUserLast'])){
                $error_check['secname'] = "<br><b style=\"color: red\">Second name must be alphabetic characters only</b>";
            } else {
                // Prepare a select statement
                $sql = "SELECT * FROM webUser WHERE userName = ?";
                
                if($stmt = mysqli_prepare($connection, $sql)){
                    // Bind variables to the prepared statement as parameters
                    // Set parameters
                    $firstname=$_POST['txtUserFirst'];
                    $_SESSION['firsName'] = $firstname;
                    $lastname=$_POST['txtUserLast'];
                    $_SESSION['lasName'] = $lastname;
                    $newusername=$firstname.$lastname;
                    $param_username = $newusername;
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
                    //Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_store_result($stmt);
                        
                        if(mysqli_stmt_num_rows($stmt) > 0){
                            $error_check['firsecname'] = "<br><b style=\"color: red\">A user with this frst and second name already exists!</b>";
                        } else {
                            $username = $param_username;
                        }
                    } else {
                        $error_check['sqlError'] = "<br><b style=\"color: red\">An SQL error occured!</b>";
                    }
                }
               }
        
            // Validate password
            $password = trim($_POST['txtPass']);
            if(empty(trim($_POST['txtPass']))){
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
                $sql = "SELECT * FROM webUser WHERE userEmail = ?";
                if($stmt = mysqli_prepare($connection, $sql)){
                    // Set parameters
                    $param_email = trim($_POST['txtEmail']);
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "s", $param_email);
                    
                    // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                        /* store result */
                        mysqli_stmt_store_result($stmt);
                        
                        if(mysqli_stmt_num_rows($stmt)  > 0){
                            $error_check['email'] = "<br><b style=\"color: red\">Email aleady registered!</b>";
                            $email = trim($_POST['txtEmail']);
                            $_SESSION['email'] = $email;
                        } else {
                            $email = trim($_POST['txtEmail']);
                            $_SESSION['email'] = $email;
                        }
                    } else {
                        $error_check['sqlError'] = "<br><b style=\"color: red\">An SQL error occured!</b>";
                    }
                }
            }
        
            if($_POST['ageDrop'] === "Select"){
                $error_check['age'] = "<br><b style=\"color: red\">Select a different option!</b>";
            } else {
                $ageRange = $_POST['ageDrop'];
                $_SESSION['age'] = $ageRange;
            }
                // Check input errors before inserting in database
                if(empty($error_check)){
                    $userID = ' ';
                    // Prepare an insert statement
                    $sql = "INSERT INTO webUser (userID, userName, userPass, userFirstName, userSecondName, userEmail, userAge) VALUES (?,?,?,?,?,?,?)";
            
                    if($stmt = mysqli_prepare($connection, $sql)){
                        // Bind variables to the prepared statement as parameters
                        $param_id = $userID;
                        $param_username = $username;
                        $param_password = hash('sha512', $password).hash('sha384', $password).hash('whirlpool', $password);
                        $param_firstname = $firstname;
                        $param_secondname = $lastname;
                        $param_email = $email;
                        $param_age=$ageRange;
                        mysqli_stmt_bind_param($stmt, "sssssss", $param_id, $param_username, $param_password, $param_firstname, $param_secondname, $param_email, $param_age);
                        $_SESSION['userName']=$param_username;
                        // Attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt)){
                            $error_check['registration'] = "<br><b style=\"color: red\">Registration was a success!</b>";
                            header("location: register-form.php");
                            $_SESSION['errors'] = $error_check;
                            exit();
                        } else{
                            $error_check['sqlError'] = "<br><b style=\"color: red\">An SQL error occured!</b>";
                        }
                    }
                    mysqli_stmt_close($stmt);
                    header("location: register-form.php");
                    exit();
                } else {
                    $_SESSION['errors'] = $error_check;
                    header("location: register-form.php");
                    exit();  
               }
        }
    } else {
        $error_check['check'] = "<br><b style=\"color: red\">Please tick the checkbox to agree to our terms!</b>";
        header("location: register-form.php");
        $_SESSION['errors'] = $error_check;
        exit();
    }
?>
