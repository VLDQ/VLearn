<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnStudentSessionCounter']) == 0) {
        header('location:student-logout-auto.php'); //logs out the student if the student id in the session is being cleared
    }
    else {
        $studentId = $_SESSION['VLearnStudentSessionCounter']; //stores student id from session

        if(isset($_POST['submit'])) {
            $currentPassword = md5($_POST['currentPassword']); //retrieves form data
		    $newPassword = md5($_POST['newPassword']); //retrieves form data
		    $confirmPassword = md5($_POST['confirmPassword']); //retrieves form data

            /*
            //test output
            echo "$currentPassword <br>";
            echo "$newPassword <br>";
            echo "$confirmPassword";
            */

		    $query = mysqli_query($con, "SELECT studentId FROM students WHERE studentId=$studentId AND studentPassword='$currentPassword'"); //defines query to check the correctness of current password
		    $row = mysqli_fetch_array($query); //fetches result

            if($row > 0) {
                if($newPassword != $currentPassword) {
                    $ret = mysqli_query($con, "UPDATE students SET studentPassword='$newPassword' WHERE studentId=$studentId"); //defines query to update student password based on student id
                    echo "<script>alert('Your password has been successfully changed!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('student-profile-update.php');</script>"; //redirects to profile update page
                }
                else {
                    echo "<script>alert('Similar password detected! Please retry with a new password.');</script>"; //displays error message via alert box
                }
            }
            else {
                echo "<script>alert('Your current password is wrong! Please try again.');</script>"; //displays error message via alert box
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
	<title>VLearn for Students | Password Change</title>
    <link rel="icon" type="image/png" href="images/VLearn-logo1.png" sizes="113x113">

    <!-- Styles -->
    <?php
        include('includes/head-styles.php'); //include head styles
    ?>
</head>
<!-- end of head -->

<!-- start of body -->
<body>
    <!-- Header & Sidebar -->
	<?php
	    define('PAGE', 'ProfileUpdate'); //defines a named constant
		include_once('includes/student-header.php'); //include the header
		include_once('includes/student-sidebar.php'); //include the sidebar
    ?>

    <div class="col-sm-9 offset-sm-3 col-lg-10 offset-lg-2">
        <!-- Row -->
        <div class="row main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="student-home.php"><em class="fa fa-home" style="font-size: 14px; color: #0066cc;"></em></a></li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Profile Update</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Password Change</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Password Change</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <!-- Password Change Form -->
                    <form role="form" action="" method="post" id="" name="passwordChangeForm" onsubmit="return validatePasswordChange();">
                        <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                        <fieldset>
                            <!-- Current Password -->
                            <div class="form-group">
                                <p class="form-field-title">Current Password:</p>
                                <input type="password" class="form-control" name="currentPassword" placeholder="Enter current password" id="currentPassword" required="true">
                                <input type="checkbox" onclick="showCurrentPassword()">&nbsp<small>Show Password</small>
                            </div>
                            <!-- New Password -->
                            <div class="form-group">
                                <p class="form-field-title">New Password:</p>
                                <input type="password" class="form-control" name="newPassword" placeholder="Enter new password" id="newPassword" required="true">
                                <input type="checkbox" onclick="showNewPassword()">&nbsp<small>Show Password</small>
                            </div>
                            <!-- Confirm Password -->
                            <div class="form-group">
                                <p class="form-field-title">Confirm Password:</p>
                                <input type="password" class="form-control" name="confirmPassword" placeholder="Enter new password again" id="confirmPassword" required="true">
                                <input type="checkbox" onclick="showConfirmPassword()">&nbsp<small>Show Password</small>
                            </div>
                            <!-- Change Password Button -->
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>CHANGE PASSWORD</b></button>
                                <br><br><br>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>

	<!-- Footer -->
	<?php
        include_once('includes/footer-enhanced.php'); //include the footer
    ?>

    <!-- JavaScript -->
    <script src="js/student-password-change-validation.js"></script>
    <script src="js/custom.js"></script>
</body>
<!-- end of body -->

</html>
<!-- end of html -->

<?php
    }
?>
