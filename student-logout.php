<?php
    if(isset($_GET['logout'])) {
        session_start(); //starts the session
        session_unset(); //frees all session variables currently registered
        session_destroy(); //destroys the session

        echo "<script>alert('You have successfully logged out!');</script>"; //displays success message via alert box
        echo "<script>location.replace('student-login.php');</script>"; //redirects to student login page
        //header('location:student-login.php');
        exit();
    }
?>
