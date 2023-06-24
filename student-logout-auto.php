<?php
    session_start(); //starts the session
    session_unset(); //frees all session variables currently registered
    session_destroy(); //destroys the session

    header('location:student-login.php'); //redirects to student login page
    //header('location:student-login.php');
?>
