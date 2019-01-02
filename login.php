/*
* Created by dstlny on 9/12/2018
*/

<?php
$_SESSION['errors'] = $error_check;
if (isset($_POST['subLogin'])) {
    require_once  '../pages/dbcon/init.php';
    unset($_SESSION['errors']);
    $error_check = array();
    $_SESSION['errors'] = $error_check;
    
    $mailuid=trim($_POST['txtUser']);
    $pass=trim($_POST['txtPass']);
    $hash = hash('sha512', $pass).hash('sha384', $pass).hash('whirlpool', $pass);
    
    if(empty($_POST['txtUser']) && empty($_POST['txtPass'])){
        $error_check['user'] = "<b style=\"color: red;\">Login fields cannot be empty!</b>";
        $_SESSION['errors'] = $error_check;
        header("location: ../pages/Index2.php");
        exit();
    } else {
        if(empty($_POST['txtUser'])){
            $error_check['user'] = "<b style=\"color: red\">Please enter your username!</b>";
            $_SESSION['errors'] = $error_check;
            header("location: ../pages/Index2.php");
            exit();
        } elseif(empty($_POST['txtPass'])){
            $error_check['user'] = "<b style=\"color: red\">Please enter your password!</b>";
            $_SESSION['errors'] = $error_check;
            header("location: ../pages/Index2.php");
            exit();
        } else {
        
         $query  = "SELECT * FROM webUser WHERE userName=? OR userEmail=?";
         $stmt = mysqli_stmt_init($connection);
         if(mysqli_stmt_prepare($stmt, $query)){
             mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
             mysqli_stmt_execute($stmt);
             $result = mysqli_stmt_get_result($stmt);
             if($row = mysqli_fetch_assoc($result)){
                 if($hash === $row["userPass"]){
                    session_start();
                    $_SESSION['userBool'] = TRUE;
                    $_SESSION['adminBool'] = FALSE;
                    $_SESSION['userName'] = $row['userName'];
                    $_SESSION['fav'] = array();
                    header("location: ../pages/Index2.php");
                    exit();
                 } elseif($hash !== $row['userPass']){
                     $error_check['user'] = "<b style=\"color: red\">Password incorrect!</b>";
                     $_SESSION['errors'] = $error_check;
                     header("location: ../pages/Index2.php");
                     exit();
                 } else{
                    $error_check['sqlError'] = "<b style=\"color: red\">An SQL error occured!</b>";
                    $_SESSION['errors'] = $error_check;
                    header("location: ../pages/Index2.php");
                    exit();
                 }
                
             } else{
                 $query = "SELECT * FROM webAdmins WHERE adminUserName=? OR adminEmail=?";
                 $stmt = mysqli_stmt_init($connection);
                 if(mysqli_stmt_prepare($stmt, $query)){
                     mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
                     mysqli_stmt_execute($stmt);
                     $result = mysqli_stmt_get_result($stmt);
                     if($row = mysqli_fetch_assoc($result)){
                         $hash = hash('sha512', $pass).hash('sha384', $pass).hash('whirlpool', $pass);
                         if($hash === $row['adminPassword']){
                            session_start();
                            $_SESSION['adminBool'] = TRUE;
                            $_SESSION['userBool'] = FALSE;
                            $_SESSION['adminUserName'] = $row['adminUserName'];
                            header("location: ../pages/Index2.php");
                            exit();
                         } elseif($hash !== $row['adminPassword']){
                                 $error_check['user'] = "<b style=\"color: red\">Password incorrect!</b>";
                                 $_SESSION['errors'] = $error_check;
                                 header("location: ../pages/Index2.php");
                                 exit();
                         } else{
                            $error_check['sqlError'] = "<b style=\"color: red\">An SQL error occured!</b>";
                            $_SESSION['errors'] = $error_check;
                            header("location: ../pages/Index2.php");
                            exit();
                         }
                 } else{
                    $error_check['user'] = "<b style=\"color: red\">Account not recognised!</b>";
                    $_SESSION['errors'] = $error_check;
                    header("location: ../pages/Index2.php");
                    exit();
                 }
             } else {
                $error_check['sqlError'] = "<b style=\"color: red\">An SQL error occured!</b>";
                $_SESSION['errors'] = $error_check;
                header("location: ../pages/Index2.php");
                exit();
             }
            }
            mysqli_stmt_close($stmt);   
            mysqli_close($conn);
            header("location: ../pages/Index2.php");
            exit();
         }
     }
    }
} else {
    exit();
}
?>
