<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(isset($_POST['submit'])) {
        $tutorEmail = $_POST['tutorEmail']; //retrieves form data
        $tutorPassword = md5($_POST['tutorPassword']); //retrieves form data (with MD5 hash algorithm)

        /*
        //test output
        echo "$tutorEmail <br>";
        echo "$tutorPassword";
        */

        $query = mysqli_query($con, "SELECT tutorId FROM tutors WHERE tutorEmail='$tutorEmail' AND tutorPassword='$tutorPassword'"); //defines query to get the tutor id that matches the tutor email and the tutor password
        $ret = mysqli_fetch_array($query); //fetches result

        if($ret > 0) {
            $_SESSION['VLearnTutorSessionCounter'] = $ret['tutorId']; //stores tutor id into session
            header('location:tutor-home.php'); //redirects to tutor home page
        }
        else {
            echo "<script>alert('Invalid credentials! Please try again.');</script>"; //displays error message via alert box
        }
    }
?>

<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Tutors | Login</title>
    <link rel="icon" type="image/png" href="images/VLearn-logo1.png" sizes="113x113">

    <!-- Styles -->
    <?php
        include('includes/head-styles.php'); //include head styles
    ?>
</head>
<!-- end of head -->

<!-- start of body -->
<body>
    <!-- Header -->
	<?php
        //include_once('includes/tutor-header.php');
    ?>

    <div class="container">
        <!-- Row -->
        <div class="row">
            <h1 align="center"><a href="index.php"><img src="images/VLearn-logo2.png" width="180px"/></a></h1>
            <h1 align="center"><b>VLearn for Tutors</b></h1>
            <br><br><br><br>

            <!-- Column -->
            <div class="col-xs-10 offset-xs-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                <div class="style-primary">
                    <br>
                    <!-- Login Form Title -->
                    <div class="panel-heading">Tutor Login</div>
                    <hr>
                    <div class="panel">
                        <!-- Login Form -->
                        <form role="form" action="" method="post" id="" name="loginForm">
                            <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                            <fieldset>
                                <!-- Email -->
                                <div class="form-group">
                                    <p class="form-field-title">Email:</p>
                                    <input type="email" class="form-control" name="tutorEmail" placeholder="Enter email" required="true">
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <p class="form-field-title">Password:</p>
                                    <input type="password" class="form-control" name="tutorPassword" placeholder="Enter password" id="tutorPassword" required="true">
                                    <input type="checkbox" onclick="showTutorPassword()">&nbsp<small>Show Password</small>
                                </div>
                                <!-- Login Button -->
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>LOGIN</b></button>
                                    <br><br><br>
                                    <p style="text-align: center;"><b>Not registered? <a href="tutor-register.php" style="color: #0066cc;">Register Now</a></b></p>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>

	<!-- Footer -->
	<?php
        include_once('includes/footer.php');
    ?>

    <!-- JavaScript -->
    <script src="js/tutor-register-validation.js"></script>
</body>
<!-- end of body -->

</html>
<!-- end of html -->
