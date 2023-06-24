<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnAdminSessionCounter']) == 0) {
        header('location:admin-logout-auto.php'); //logs out the admin if the info in the session is being cleared
    }
    else {
        $adminName = $_SESSION['VLearnAdminSessionCounter']; //stores info from session

        if(isset($_POST['submit'])) {
            $studentId = $_POST['studentId']; //retrieves form data
            $studentStage = $_POST['studentStage']; //retrieves form data
            $studentSubjects = $_POST['studentSubjects']; //retrieves form data

            foreach($studentSubjects as $studentSubjectsValue) {
                $studentSubjectsCombined .= $studentSubjectsValue . " "; //combines data into one single string
            }

            /*
            //test output
            echo "$studentId <br>";
            echo "$studentStage <br>";
            echo "$studentSubjectsCombined";
            */

            $query = mysqli_query($con, "UPDATE students SET studentStage='$studentStage', studentSubjects='$studentSubjectsCombined' WHERE studentId=$studentId"); //defines query to update a student record

            if($query) {
                //$sqlGetStudentId = mysqli_query($con, "SELECT studentId AS id FROM students WHERE studentEmail='$studentEmail'"); //defines query for id validation
                //$student = mysqli_fetch_assoc($sqlGetStudentId); //fetches result
                //$studentId = $student['id'];

                echo "<script>alert('The student details have been successfully updated!');</script>"; //displays success message via alert box
                echo "<script>location.replace('admin-student-list.php');</script>"; //redirects to student list page
            }
            else {
                echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
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
	<title>VLearn for Admin | Edit Student Details</title>
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
	    define('PAGE', 'StudentList'); //defines a named constant
		include_once('includes/admin-header.php'); //include the header
		include_once('includes/admin-sidebar.php'); //include the sidebar
    ?>

    <div class="col-sm-9 offset-sm-3 col-lg-10 offset-lg-2">
        <!-- Row -->
        <div class="row main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="admin-home.php"><em class="fa fa-home" style="font-size: 14px; color: #0066cc;"></em></a></li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Student List</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Edit Student Details</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Edit Student Details</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <?php
                        if(isset($_GET['studentId']) && is_numeric($_GET['studentId'])) {
                            $studentId = $_GET['studentId']; //retrieves student id from GET
                            $ret = mysqli_query($con, "SELECT studentName, studentEmail, studentStage, studentSubjects FROM students WHERE studentId=$studentId"); //defines query to retrieve student record based on student id
	                        while($row = mysqli_fetch_array($ret)) {
                    ?>
                    <!-- Edit Student Details Form -->
                    <form role="form" action="" method="post" id="" name="editStudentDetailsForm" onsubmit="return validateEditStudentDetails();">
                        <br>
                        <h4 align="center"><b><?php echo $row['studentName']; ?> (<?php echo $row['studentEmail']; ?>)</b></h4>
                        <fieldset>
                            <!-- Stage -->
                            <div class="form-group">
                                <p class="form-field-title">Stage:</p>
                                <label class="radio-container">Standard 1
                                    <input type="radio" name="studentStage" value="Standard 1" 
                                        <?php
                                            if($row['studentStage'] == "Standard 1") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 2
                                    <input type="radio" name="studentStage" value="Standard 2" 
                                        <?php
                                            if($row['studentStage'] == "Standard 2") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 3
                                    <input type="radio" name="studentStage" value="Standard 3" 
                                        <?php
                                            if($row['studentStage'] == "Standard 3") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 4
                                    <input type="radio" name="studentStage" value="Standard 4" 
                                        <?php
                                            if($row['studentStage'] == "Standard 4") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 5
                                    <input type="radio" name="studentStage" value="Standard 5" 
                                        <?php
                                            if($row['studentStage'] == "Standard 5") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 6
                                    <input type="radio" name="studentStage" value="Standard 6" 
                                        <?php
                                            if($row['studentStage'] == "Standard 6") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                            </div>
                            <!-- Subject(s) -->
                            <div class="form-group">
                                <p class="form-field-title">Subject(s):</p>
                                <label class="checkbox-container">English
                                    <input type="checkbox" name="studentSubjects[]" value="English" 
                                        <?php
                                            if(strpos($row['studentSubjects'], "English") !== false) {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="checkbox-checkmark"></span>
                                </label>
                                <label class="checkbox-container">Mathematics
                                    <input type="checkbox" name="studentSubjects[]" value="Mathematics" 
                                        <?php
                                            if(strpos($row['studentSubjects'], "Mathematics") !== false) {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="checkbox-checkmark"></span>
                                </label>
                                <label class="checkbox-container">Science
                                    <input type="checkbox" name="studentSubjects[]" value="Science" 
                                        <?php
                                            if(strpos($row['studentSubjects'], "Science") !== false) {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="checkbox-checkmark"></span>
                                </label>
                            </div>
                            <!-- Update Student Details Button -->
                            <div class="form-group">
                                <br>
                                <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                                <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>UPDATE STUDENT DETAILS</b></button>
                                <br><br><br>
                            </div>
                        </fieldset>
                    </form>
                    <?php
                            }
                        }
                        else {
                            echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
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
        /*-------------------------------------------------------------------
          Function which is called on onsubmit in edit student details form
        -------------------------------------------------------------------*/
        function validateEditStudentDetails() {
            //calls other function used for validation
            if(handleCheckboxData()) {
                return true; //returns true if the validation function returns true (form will be submitted)
            }
            else {
                return false; //returns false if the validation function returns false (form will not be submitted)
            }
        }

        /*---------------------------------------------------------------
          Function to validate at least one checkbox option is selected
        ---------------------------------------------------------------*/
        function handleCheckboxData() {
            var formData = new FormData(document.querySelector("form")); //stores the form data from the form element

            if(!formData.has("studentSubjects[]")) {
                alert("Please select at least one option for Subject(s)."); //displays message via alert box
                return false; //returns false if none of the checkbox options are selected
            }
            else {
                return true; //returns true if at least one checkbox option is selected
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
