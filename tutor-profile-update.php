<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnTutorSessionCounter']) == 0) {
        header('location:tutor-logout-auto.php'); //logs out the tutor if the tutor id in the session is being cleared
    }
    else {
        $tutorId = $_SESSION['VLearnTutorSessionCounter']; //stores tutor id from session

        if(isset($_POST['submit'])) {
            $tutorName = $_POST['tutorName']; //retrieves form data
            $tutorEmail = $_POST['tutorEmail']; //retrieves form data

            /*
            //test output
            echo "$tutorName <br>";
            echo "$tutorEmail";
            */

            $ret = mysqli_query($con, "SELECT tutorEmail FROM tutors WHERE tutorEmail='$tutorEmail' AND tutorId!=$tutorId"); //defines query to check for the duplication of email
            $result = mysqli_fetch_array($ret); //fetches result

            if($result > 0) {
                echo "<script>alert('This email is already associated with another account.');</script>"; //displays error message via alert box
            }
            else {
                $query = mysqli_query($con, "UPDATE tutors SET tutorName='$tutorName', tutorEmail='$tutorEmail' WHERE tutorId=$tutorId"); //defines query to update a tutor record

                if($query) {
                    //$sqlGetTutorId = mysqli_query($con, "SELECT tutorId AS id FROM tutors WHERE tutorEmail='$tutorEmail'"); //defines query for id validation
                    //$tutor = mysqli_fetch_assoc($sqlGetTutorId); //fetches result
                    //$tutorId = $tutor['id'];

                    echo "<script>alert('The tutor details have been successfully updated!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('tutor-profile-update.php');</script>"; //redirects to profile update page
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
	<title>VLearn for Tutors | Profile Update</title>
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
		include_once('includes/tutor-header.php'); //include the header
		include_once('includes/tutor-sidebar.php'); //include the sidebar
    ?>

    <div class="col-sm-9 offset-sm-3 col-lg-10 offset-lg-2">
        <!-- Row -->
        <div class="row main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="tutor-home.php"><em class="fa fa-home" style="font-size: 14px; color: #0066cc;"></em></a></li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Profile Update</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Profile Update</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <?php
                        $res = mysqli_query($con, "SELECT tutorName, tutorEmail FROM tutors WHERE tutorId=$tutorId"); //defines query to retrieve tutor record based on tutor id
	                    while($row = mysqli_fetch_array($res)) {
                    ?>
                    <!-- Profile Update Form -->
                    <form role="form" action="" method="post" id="" name="profileUpdateForm" onsubmit="return validateProfileUpdate();">
                        <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                        <fieldset>
                            <!-- Name -->
                            <div class="form-group">
                                <p class="form-field-title">Name:</p>
                                <input type="text" class="form-control" name="tutorName" value="<?php echo $row['tutorName']; ?>" placeholder="Enter name" required="true">
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <p class="form-field-title">Email:</p>
                                <input type="email" class="form-control" name="tutorEmail" value="<?php echo $row['tutorEmail']; ?>" placeholder="Enter email" required="true">
                            </div>
                            <!-- Change Password Button -->
                            <div class="form-group">
                                <p class="form-field-title">Change Password:</p>
                                <button class="btn btn-primary"><a href="tutor-password-change.php" style="color: white; text-decoration: none;">Change</a></button>
                            </div>
                            <!-- Update Profile Button -->
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>UPDATE PROFILE</b></button>
                                <br><br><br>
                            </div>
                        </fieldset>
                    </form>
                    <?php
                        }
                    ?>
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
    <script>
        /*-------------------------------------------------------------
          Function which is called on onsubmit in profile update form
        -------------------------------------------------------------*/
        function validateProfileUpdate() {
            var tutorName = document.profileUpdateForm.tutorName; //stores tutor name retrieved from profile update form

            //calls other function used for validation
            if(validateTutorName(tutorName)) {
                return true; //returns true if the validation function returns true (form will be submitted)
            }
            else {
                return false; //returns false if the validation function returns false (form will not be submitted)
            }
        }

        /*---------------------------------
          Function to validate tutor name
        ---------------------------------*/
        function validateTutorName(tutorName) {
            var condition = /^[a-zA-Z ]*$/; //stores the condition (alphabets and whitespace only)

            if(tutorName.value.match(condition)) {
                return true; //returns true if the tutor name matches the condition
            }
            else {
                alert("Only alphabets and whitespace are allowed for Name!"); //displays message via alert box
                tutorName.focus(); //puts focus on the input field for tutor name
                return false; //returns false if the tutor name does not match the condition
            }
        }
    </script>
    <script src="js/custom.js"></script>
</body>
<!-- end of body -->

</html>
<!-- end of html -->

<?php
    }
?>
