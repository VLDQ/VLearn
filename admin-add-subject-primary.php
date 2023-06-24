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
            $tutorId = $_POST['tutorId']; //retrieves form data
            $subjectName = $_POST['subjectName']; //retrieves form data
            $subjectCode = $_POST['subjectCode']; //retrieves form data
            $subjectEducationLevel = "Primary"; //sets as primary
            $subjectStage = $_POST['subjectStage']; //retrieves form data
            $subjectCategory = $_POST['subjectCategory']; //retrieves form data
            $subjectSession = $_POST['subjectSession']; //retrieves form data
            $subjectCreationDate = date("Y-m-d"); //gets current date
            $subjectShowOrHide = $_POST['subjectShowOrHide']; //retrieves form data

            /*
            //test output
            echo "$tutorId <br>";
            echo "$subjectName <br>";
            echo "$subjectCode <br>";
            echo "$subjectEducationLevel <br>";
            echo "$subjectStage <br>";
            echo "$subjectCategory <br>";
            echo "$subjectSession <br>";
            echo "$subjectCreationDate <br>";
            echo "$subjectShowOrHide";
            */

            $ret = mysqli_query($con, "SELECT subjectCode FROM subjects WHERE subjectCode='$subjectCode'"); //defines query to check for the duplication of subject code
            $result = mysqli_fetch_array($ret); //fetches result

            if($result > 0) {
                echo "<script>alert('This subject code is already associated with another subject.');</script>"; //displays error message via alert box
            }
            else {
                $query = mysqli_query($con, "INSERT INTO subjects(tutorId, subjectName, subjectCode, subjectEducationLevel, subjectStage, subjectCategory, subjectSession, subjectCreationDate, subjectShowOrHide) value('$tutorId', '$subjectName', '$subjectCode', '$subjectEducationLevel', '$subjectStage', '$subjectCategory', '$subjectSession', '$subjectCreationDate', '$subjectShowOrHide')"); //defines query to insert a new subject record

                if($query) {
                    $sqlGetSubjectId = mysqli_query($con, "SELECT subjectId AS id FROM subjects WHERE subjectCode='$subjectCode'"); //defines query for id validation
                    $subject = mysqli_fetch_assoc($sqlGetSubjectId); //fetches result
                    $subjectId = $subject['id'];

                    echo "<script>alert('A new subject has been successfully added!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('admin-subject-list.php');</script>"; //redirects to subject list page
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
	<title>VLearn for Admin | Add Subject</title>
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
	    define('PAGE', 'SubjectList'); //defines a named constant
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
                <li>Subject List</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Add Subject</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Add Subject</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <!-- Add Subject Form -->
                    <form role="form" action="" method="post" id="" name="addSubjectForm" onsubmit="return validateAddSubject();">
                        <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                        <fieldset>
                            <!-- Subject Name -->
                            <div class="form-group">
                                <p class="form-field-title">Subject Name:</p>
                                <input type="text" class="form-control" name="subjectName" placeholder="Enter subject name" required="true">
                            </div>
                            <!-- Subject Code -->
                            <div class="form-group">
                                <p class="form-field-title">Subject Code (E.g., ENG_S1_M):</p>
                                <input type="text" class="form-control" name="subjectCode" placeholder="Enter subject code" required="true">
                            </div>
                            <!-- Subject Stage -->
                            <div class="form-group">
                                <p class="form-field-title">Subject Stage:</p>
                                <label class="radio-container">Standard 1
                                    <input type="radio" name="subjectStage" value="Standard 1" checked="checked">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 2
                                    <input type="radio" name="subjectStage" value="Standard 2">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 3
                                    <input type="radio" name="subjectStage" value="Standard 3">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 4
                                    <input type="radio" name="subjectStage" value="Standard 4">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 5
                                    <input type="radio" name="subjectStage" value="Standard 5">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Standard 6
                                    <input type="radio" name="subjectStage" value="Standard 6">
                                    <span class="radio-checkmark"></span>
                                </label>
                            </div>
                            <!-- Subject Category -->
                            <div class="form-group">
                                <p class="form-field-title">Subject Category:</p>
                                <label class="radio-container">English
                                    <input type="radio" name="subjectCategory" value="English" checked="checked">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Mathematics
                                    <input type="radio" name="subjectCategory" value="Mathematics">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Science
                                    <input type="radio" name="subjectCategory" value="Science">
                                    <span class="radio-checkmark"></span>
                                </label>
                            </div>
                            <!-- Subject Session -->
                            <div class="form-group">
                                <p class="form-field-title">Subject Session:</p>
                                <label class="radio-container">Morning
                                    <input type="radio" name="subjectSession" value="Morning" checked="checked">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Afternoon
                                    <input type="radio" name="subjectSession" value="Afternoon">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Night
                                    <input type="radio" name="subjectSession" value="Night">
                                    <span class="radio-checkmark"></span>
                                </label>
                            </div>
                            <!-- Subject Show Or Hide (Subject Visibility) -->
                            <div class="form-group">
                                <p class="form-field-title">Subject Visibility:</p>
                                <label class="radio-container">Hide from students
                                    <input type="radio" name="subjectShowOrHide" value="0" checked="checked">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Show to students
                                    <input type="radio" name="subjectShowOrHide" value="1">
                                    <span class="radio-checkmark"></span>
                                </label>
                            </div>
                            <!-- Subject Tutor -->
                            <div class="form-group">
                                <p class="form-field-title">Subject Tutor (Email & Speciality):</p>
                                <?php
                                    $sql = "SELECT tutorId, tutorName, tutorEmail, tutorSpeciality FROM tutors WHERE tutorIsActive=1 ORDER BY tutorEmail";
                                    $result = mysqli_query($con, $sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                <label class="radio-container"><b><?php echo $row['tutorName']; ?></b>&nbsp; | &nbsp;<?php echo $row['tutorEmail']; ?>&nbsp; | &nbsp;<?php echo $row['tutorSpeciality']; ?>
                                    <input type="radio" name="tutorId" value="<?php echo $row['tutorId']; ?>" checked="checked">
                                    <span class="radio-checkmark"></span>
                                </label>
                                <?php
                                    }
                                ?>
                            </div>
                            <!-- Add Subject Button -->
                            <div class="form-group">
                                <br>
                                <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>ADD SUBJECT</b></button>
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
    <script>
        /*-----------------------------------------------------------
          Function which is called on onsubmit in add subject form
        -----------------------------------------------------------*/
        function validateAddSubject() {
            var subjectCode = document.addSubjectForm.subjectCode; //stores subject code retrieved from add subject form

            //calls other function used for validation
            if(validateSubjectCode(subjectCode)) {
                return true; //returns true if the validation function returns true (form will be submitted)
            }
            else {
                return false; //returns false if the validation function returns false (form will not be submitted)
            }
        }

        /*-----------------------------------
          Function to validate subject code
        -----------------------------------*/
        function validateSubjectCode(subjectCode) {
            var condition = /^[A-Za-z0-9_@./#&+-]*$/; //stores the condition (alphabets, numbers, and special characters only)

            if(subjectCode.value.match(condition)) {
                return true; //returns true if the subject code matches the condition
            }
            else {
                alert("Whitespace is not allowed for Subject Code!"); //displays message via alert box
                subjectCode.focus(); //puts focus on the input field for subject code
                return false; //returns false if the subject code does not match the condition
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
