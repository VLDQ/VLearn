<?php
    session_start(); //starts the session
    session_unset(); //frees all session variables currently registered
    session_destroy(); //destroys the session

    header('location:admin-login.php'); //redirects to admin login page
    //header('location:admin-login.php');
?>
