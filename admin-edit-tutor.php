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
            $tutorSpeciality = $_POST['tutorSpeciality']; //retrieves form data
            $tutorIsActive = $_POST['tutorIsActive']; //retrieves form data

            /*
            //test output
            echo "$tutorId <br>";
            echo "$tutorSpeciality <br>";
            echo "$tutorIsActive";
            */

            $sql = mysqli_query($con, "SELECT subjectId FROM subjects WHERE tutorId=$tutorId"); //defines query to check if the tutor already had assigned subject(s)
            $result = mysqli_fetch_array($sql); //fetches result

            if($result>0 && $tutorIsActive==0) {
                echo "<script>alert('Unable to set the status of the tutor as inactive, because there are assigned subject(s) under the tutor.');</script>"; //displays error message via alert box
            }
            else {
                $query = mysqli_query($con, "UPDATE tutors SET tutorSpeciality='$tutorSpeciality', tutorIsActive=$tutorIsActive WHERE tutorId=$tutorId"); //defines query to update a tutor record

                if($query) {
                    //$sqlGetTutorId = mysqli_query($con, "SELECT tutorId AS id FROM tutors WHERE tutorEmail='$tutorEmail'"); //defines query for id validation
                    //$tutor = mysqli_fetch_assoc($sqlGetTutorId); //fetches result
                    //$tutorId = $tutor['id'];

                    echo "<script>alert('The tutor details have been successfully updated!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('admin-tutor-list.php');</script>"; //redirects to tutor list page
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
	<title>VLearn for Admin | Edit Tutor Details</title>
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
	    define('PAGE', 'TutorList'); //defines a named constant
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
                <li>Tutor List</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Edit Tutor Details</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Edit Tutor Details</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <?php
                        if(isset($_GET['tutorId']) && is_numeric($_GET['tutorId'])) {
                            $tutorId = $_GET['tutorId']; //retrieves tutor id from GET
                            $ret = mysqli_query($con, "SELECT tutorName, tutorEmail, tutorSpeciality, tutorIsActive FROM tutors WHERE tutorId=$tutorId"); //defines query to retrieve tutor record based on tutor id
	                        while($row = mysqli_fetch_array($ret)) {
                    ?>
                    <!-- Edit Tutor Details Form -->
                    <form role="form" action="" method="post" id="" name="editTutorDetailsForm">
                        <br>
                        <h4 align="center"><b><?php echo $row['tutorName']; ?> (<?php echo $row['tutorEmail']; ?>)</b></h4>
                        <fieldset>
                            <!-- Speciality -->
                            <div class="form-group">
                                <p class="form-field-title">Speciality:</p>
                                <label class="radio-container">English
                                    <input type="radio" name="tutorSpeciality" value="English" 
                                        <?php
                                            if($row['tutorSpeciality'] == "English") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Mathematics
                                    <input type="radio" name="tutorSpeciality" value="Mathematics" 
                                        <?php
                                            if($row['tutorSpeciality'] == "Mathematics") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Science
                                    <input type="radio" name="tutorSpeciality" value="Science" 
                                        <?php
                                            if($row['tutorSpeciality'] == "Science") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Additional Mathematics
                                    <input type="radio" name="tutorSpeciality" value="Additional Mathematics" 
                                        <?php
                                            if($row['tutorSpeciality'] == "Additional Mathematics") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Biology
                                    <input type="radio" name="tutorSpeciality" value="Biology" 
                                        <?php
                                            if($row['tutorSpeciality'] == "Biology") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Chemistry
                                    <input type="radio" name="tutorSpeciality" value="Chemistry" 
                                        <?php
                                            if($row['tutorSpeciality'] == "Chemistry") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Physics
                                    <input type="radio" name="tutorSpeciality" value="Physics" 
                                        <?php
                                            if($row['tutorSpeciality'] == "Physics") {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                            </div>
                            <!-- Status -->
                            <div class="form-group">
                                <p class="form-field-title">Status:</p>
                                <label class="radio-container">Active
                                    <input type="radio" name="tutorIsActive" value="1" 
                                        <?php
                                            if($row['tutorIsActive'] == 1) {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Inactive
                                    <input type="radio" name="tutorIsActive" value="0" 
                                        <?php
                                            if($row['tutorIsActive'] == 0) {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                            </div>
                            <!-- Update Tutor Details Button -->
                            <div class="form-group">
                                <br>
                                <input type="hidden" name="tutorId" value="<?php echo $tutorId; ?>">
                                <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>UPDATE TUTOR DETAILS</b></button>
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
    <script src="js/custom.js"></script>
</body>
<!-- end of body -->

</html>
<!-- end of html -->

<?php
    }
?>
