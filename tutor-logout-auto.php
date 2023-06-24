<?php
    session_start(); //starts the session
    session_unset(); //frees all session variables currently registered
    session_destroy(); //destroys the session

    header('location:tutor-login.php'); //redirects to tutor login page
    //header('location:tutor-login.php');
?>
