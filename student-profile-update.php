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
            $studentName = $_POST['studentName']; //retrieves form data
            $studentEmail = $_POST['studentEmail']; //retrieves form data

            /*
            //test output
            echo "$studentName <br>";
            echo "$studentEmail";
            */

            $ret = mysqli_query($con, "SELECT studentEmail FROM students WHERE studentEmail='$studentEmail' AND studentId!=$studentId"); //defines query to check for the duplication of email
            $result = mysqli_fetch_array($ret); //fetches result

            if($result > 0) {
                echo "<script>alert('This email is already associated with another account.');</script>"; //displays error message via alert box
            }
            else {
                $query = mysqli_query($con, "UPDATE students SET studentName='$studentName', studentEmail='$studentEmail' WHERE studentId=$studentId"); //defines query to update a student record

                if($query) {
                    //$sqlGetStudentId = mysqli_query($con, "SELECT studentId AS id FROM students WHERE studentEmail='$studentEmail'"); //defines query for id validation
                    //$student = mysqli_fetch_assoc($sqlGetStudentId); //fetches result
                    //$studentId = $student['id'];

                    echo "<script>alert('The student details have been successfully updated!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('student-profile-update.php');</script>"; //redirects to profile update page
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
	<title>VLearn for Students | Profile Update</title>
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
                        $res = mysqli_query($con, "SELECT studentName, studentEmail FROM students WHERE studentId=$studentId"); //defines query to retrieve student record based on student id
	                    while($row = mysqli_fetch_array($res)) {
                    ?>
                    <!-- Profile Update Form -->
                    <form role="form" action="" method="post" id="" name="profileUpdateForm" onsubmit="return validateProfileUpdate();">
                        <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                        <fieldset>
                            <!-- Name -->
                            <div class="form-group">
                                <p class="form-field-title">Name:</p>
                                <input type="text" class="form-control" name="studentName" value="<?php echo $row['studentName']; ?>" placeholder="Enter name" required="true">
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <p class="form-field-title">Email:</p>
                                <input type="email" class="form-control" name="studentEmail" value="<?php echo $row['studentEmail']; ?>" placeholder="Enter email" required="true">
                            </div>
                            <!-- Change Password Button -->
                            <div class="form-group">
                                <p class="form-field-title">Change Password:</p>
                                <button class="btn btn-primary"><a href="student-password-change.php" style="color: white; text-decoration: none;">Change</a></button>
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
            var studentName = document.profileUpdateForm.studentName; //stores student name retrieved from profile update form

            //calls other function used for validation
            if(validateStudentName(studentName)) {
                return true; //returns true if the validation function returns true (form will be submitted)
            }
            else {
                return false; //returns false if the validation function returns false (form will not be submitted)
            }
        }

        /*-----------------------------------
          Function to validate student name
        -----------------------------------*/
        function validateStudentName(studentName) {
            var condition = /^[a-zA-Z ]*$/; //stores the condition (alphabets and whitespace only)

            if(studentName.value.match(condition)) {
                return true; //returns true if the student name matches the condition
            }
            else {
                alert("Only alphabets and whitespace are allowed for Name!"); //displays message via alert box
                studentName.focus(); //puts focus on the input field for student name
                return false; //returns false if the student name does not match the condition
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
