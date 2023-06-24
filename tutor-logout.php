<?php
    if(isset($_GET['logout'])) {
        session_start(); //starts the session
        session_unset(); //frees all session variables currently registered
        session_destroy(); //destroys the session

        echo "<script>alert('You have successfully logged out!');</script>"; //displays success message via alert box
        echo "<script>location.replace('tutor-login.php');</script>"; //redirects to tutor login page
        //header('location:tutor-login.php');
        exit();
    }
?>
