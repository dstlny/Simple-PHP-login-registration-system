<?php
    session_start();
    $_SESSION = array();
    header('location:../pages/Index2.php');
    session_destroy();
?>
