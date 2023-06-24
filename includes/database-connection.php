<?php
    /* ~ temp db ~ */
    $con = mysqli_connect("localhost", "root", "", "fyp_test"); //connects to database (host, username, password, dbname)

    if(mysqli_connect_errno()) {
        echo "Database Connection Fail".mysqli_connect_error(); //displays error message
    }

    date_default_timezone_set('Asia/Kuala_Lumpur'); //sets default timezone
?>
