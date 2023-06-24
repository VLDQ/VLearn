<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(isset($_POST['submit'])) {
        $tutorName = $_POST['tutorName']; //retrieves form data
        $tutorEmail = $_POST['tutorEmail']; //retrieves form data
        $tutorPassword = md5($_POST['tutorPassword']); //retrieves form data (with MD5 hash algorithm)
        $tutorSpeciality = $_POST['tutorSpeciality']; //retrieves form data
        $tutorStartDate = date("Y-m-d"); //gets current date
        $tutorIsActive = 1; //sets as active

        /*
        //test output
        echo "$tutorName <br>";
        echo "$tutorEmail <br>";
        echo "$tutorPassword <br>";
        echo "$tutorSpeciality <br>";
        echo "$tutorStartDate <br>";
        echo "$tutorIsActive";
        */

        $ret = mysqli_query($con, "SELECT tutorEmail FROM tutors WHERE tutorEmail='$tutorEmail'"); //defines query to check for the duplication of email
        $result = mysqli_fetch_array($ret); //fetches result

        if($result > 0) {
            echo "<script>alert('This email is already associated with another account.');</script>"; //displays error message via alert box
        }
        else {
            $query = mysqli_query($con, "INSERT INTO tutors(tutorName, tutorEmail, tutorPassword, tutorSpeciality, tutorStartDate, tutorIsActive) value('$tutorName', '$tutorEmail', '$tutorPassword', '$tutorSpeciality', '$tutorStartDate', '$tutorIsActive')"); //defines query to insert a new tutor record

            if($query) {
                $sqlGetTutorId = mysqli_query($con, "SELECT tutorId AS id FROM tutors WHERE tutorEmail='$tutorEmail'"); //defines query for id validation
                $tutor = mysqli_fetch_assoc($sqlGetTutorId); //fetches result
                $tutorId = $tutor['id'];

                echo "<script>alert('You have successfully registered! You will be redirected to the Login page.');</script>"; //displays success message via alert box
                echo "<script>location.replace('tutor-login.php');</script>"; //redirects to tutor login page
            }
            else {
                echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
            }
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
	<title>VLearn for Tutors | Registration</title>
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
                    <!-- Registration Form Title -->
                    <div class="panel-heading">Tutor Registration</div>
                    <hr>
                    <div class="panel">
                        <!-- Registration Form -->
                        <form role="form" action="" method="post" id="" name="registrationForm" onsubmit="return validateRegistration();">
                            <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                            <fieldset>
                                <!-- Name -->
                                <div class="form-group">
                                    <p class="form-field-title">Name:</p>
                                    <input type="text" class="form-control" name="tutorName" placeholder="Enter name" required="true">
                                </div>
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
                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <p class="form-field-title">Confirm Password:</p>
                                    <input type="password" class="form-control" name="tutorConfirmPassword" placeholder="Enter password again" id="tutorConfirmPassword" required="true">
                                    <input type="checkbox" onclick="showTutorConfirmPassword()">&nbsp<small>Show Password</small>
                                </div>
                                <!-- Speciality -->
                                <div class="form-group">
                                    <p class="form-field-title">Speciality:</p>
                                    <label class="radio-container">English
                                        <input type="radio" name="tutorSpeciality" value="English" checked="checked">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Mathematics
                                        <input type="radio" name="tutorSpeciality" value="Mathematics">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Science
                                        <input type="radio" name="tutorSpeciality" value="Science">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Additional Mathematics
                                        <input type="radio" name="tutorSpeciality" value="Additional Mathematics">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Biology
                                        <input type="radio" name="tutorSpeciality" value="Biology">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Chemistry
                                        <input type="radio" name="tutorSpeciality" value="Chemistry">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Physics
                                        <input type="radio" name="tutorSpeciality" value="Physics">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                </div>
                                <!-- Register Button -->
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>REGISTER</b></button>
                                    <br><br><br>
                                    <p style="text-align: center;"><b>Already registered? <a href="tutor-login.php" style="color: #0066cc;">Login Now</a></b></p>
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
