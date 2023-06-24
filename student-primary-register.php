<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(isset($_POST['submit'])) {
        $studentName = $_POST['studentName']; //retrieves form data
        $studentEmail = $_POST['studentEmail']; //retrieves form data
        $studentPassword = md5($_POST['studentPassword']); //retrieves form data (with MD5 hash algorithm)
        $studentEducationLevel = "Primary"; //sets as primary
        $studentStage = $_POST['studentStage']; //retrieves form data
        $studentRegistrationDate = date("Y-m-d"); //gets current date
        $studentSubjects = $_POST['studentSubjects']; //retrieves form data

        foreach($studentSubjects as $studentSubjectsValue) {
            $studentSubjectsCombined .= $studentSubjectsValue . " "; //combines data into one single string
        }

        /*
        //test output
        echo "$studentName <br>";
        echo "$studentEmail <br>";
        echo "$studentPassword <br>";
        echo "$studentEducationLevel <br>";
        echo "$studentStage <br>";
        echo "$studentRegistrationDate <br>";
        echo "$studentSubjectsCombined";
        */

        $ret = mysqli_query($con, "SELECT studentEmail FROM students WHERE studentEmail='$studentEmail'"); //defines query to check for the duplication of email
        $result = mysqli_fetch_array($ret); //fetches result
    
        if($result > 0) {
            echo "<script>alert('This email is already associated with another account.');</script>"; //displays error message via alert box
        }
        else {
            $query = mysqli_query($con, "INSERT INTO students(studentName, studentEmail, studentPassword, studentEducationLevel, studentStage, studentSubjects, studentRegistrationDate) value('$studentName', '$studentEmail', '$studentPassword', '$studentEducationLevel', '$studentStage', '$studentSubjectsCombined', '$studentRegistrationDate')"); //defines query to insert a new student record
    
            if($query) {
                $sqlGetStudentId = mysqli_query($con, "SELECT studentId AS id FROM students WHERE studentEmail='$studentEmail'"); //defines query for id validation
                $student = mysqli_fetch_assoc($sqlGetStudentId); //fetches result
                $studentId = $student['id'];

                echo "<script>alert('You have successfully registered! You will be redirected to the Login page.');</script>"; //displays success message via alert box
                echo "<script>location.replace('student-login.php');</script>"; //redirects to student login page
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
	<title>VLearn for Students | Registration</title>
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
        //include_once('includes/student-header.php');
    ?>

    <div class="container">
        <!-- Row -->
        <div class="row">
            <h1 align="center"><a href="index.php"><img src="images/VLearn-logo2.png" width="180px"/></a></h1>
            <h1 align="center"><b>VLearn for Students</b></h1>
            <br><br><br><br>

            <!-- Column -->
            <div class="col-xs-10 offset-xs-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                <div class="style-primary">
                    <br>
                    <!-- Registration Form Title -->
                    <div class="panel-heading">Student Registration</div>
                    <hr>
                    <div class="panel">
                        <!-- Registration Form -->
                        <form role="form" action="" method="post" id="" name="registrationForm" onsubmit="return validateRegistration();">
                            <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                            <fieldset>
                                <!-- Name -->
                                <div class="form-group">
                                    <p class="form-field-title">Name:</p>
                                    <input type="text" class="form-control" name="studentName" placeholder="Enter name" required="true">
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <p class="form-field-title">Email:</p>
                                    <input type="email" class="form-control" name="studentEmail" placeholder="Enter email" required="true">
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <p class="form-field-title">Password:</p>
                                    <input type="password" class="form-control" name="studentPassword" placeholder="Enter password" id="studentPassword" required="true">
                                    <input type="checkbox" onclick="showStudentPassword()">&nbsp<small>Show Password</small>
                                </div>
                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <p class="form-field-title">Confirm Password:</p>
                                    <input type="password" class="form-control" name="studentConfirmPassword" placeholder="Enter password again" id="studentConfirmPassword" required="true">
                                    <input type="checkbox" onclick="showStudentConfirmPassword()">&nbsp<small>Show Password</small>
                                </div>
                                <!-- Stage -->
                                <div class="form-group">
                                    <p class="form-field-title">Stage:</p>
                                    <label class="radio-container">Standard 1
                                        <input type="radio" name="studentStage" value="Standard 1" checked="checked">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Standard 2
                                        <input type="radio" name="studentStage" value="Standard 2">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Standard 3
                                        <input type="radio" name="studentStage" value="Standard 3">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Standard 4
                                        <input type="radio" name="studentStage" value="Standard 4">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Standard 5
                                        <input type="radio" name="studentStage" value="Standard 5">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                    <label class="radio-container">Standard 6
                                        <input type="radio" name="studentStage" value="Standard 6">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                </div>
                                <!-- Subject(s) -->
                                <div class="form-group">
                                    <p class="form-field-title">Subject(s):</p>
                                    <label class="checkbox-container">English
                                        <input type="checkbox" name="studentSubjects[]" value="English" checked="checked">
                                        <span class="checkbox-checkmark"></span>
                                    </label>
                                    <label class="checkbox-container">Mathematics
                                        <input type="checkbox" name="studentSubjects[]" value="Mathematics">
                                        <span class="checkbox-checkmark"></span>
                                    </label>
                                    <label class="checkbox-container">Science
                                        <input type="checkbox" name="studentSubjects[]" value="Science">
                                        <span class="checkbox-checkmark"></span>
                                    </label>
                                </div>
                                <!-- Register Button -->
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>REGISTER</b></button>
                                    <br><br><br>
                                    <p style="text-align: center;"><b>Already registered? <a href="student-login.php" style="color: #0066cc;">Login Now</a></b></p>
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
    <script src="js/student-register-validation.js"></script>
</body>
<!-- end of body -->

</html>
<!-- end of html -->
