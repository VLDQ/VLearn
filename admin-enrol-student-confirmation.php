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
            $subjectId = $_POST['subjectId']; //retrieves form data
            $enrolmentDate = date("Y-m-d"); //gets current date
            $enrolmentIsActive = 1; //sets as active

            /*
            //test output
            echo "$studentId <br>";
            echo "$subjectId <br>";
            echo "$enrolmentDate <br>";
            echo "$enrolmentIsActive";
            */

            $ret = mysqli_query($con, "SELECT enrolmentId FROM enrolments WHERE studentId=$studentId AND subjectId=$subjectId AND enrolmentIsActive=1"); //defines query to check for the duplication of enrolment
            $result = mysqli_fetch_array($ret); //fetches result

            if($result > 0) {
                echo "<script>alert('This student has already enrolled to this subject.');</script>"; //displays error message via alert box
            }
            else {
                $query = mysqli_query($con, "INSERT INTO enrolments(studentId, subjectId, enrolmentDate, enrolmentIsActive) value('$studentId', '$subjectId', '$enrolmentDate', '$enrolmentIsActive')"); //defines query to insert a new enrolment record

                if($query) {
                    $sqlGetEnrolmentId = mysqli_query($con, "SELECT enrolmentId AS id FROM enrolments WHERE studentId=$studentId AND subjectId=$subjectId AND enrolmentIsActive=1"); //defines query for id validation
                    $enrolment = mysqli_fetch_assoc($sqlGetEnrolmentId); //fetches result
                    $enrolmentId = $enrolment['id'];

                    echo "<script>alert('The student has been successfully enrolled to the subject!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('admin-enrolment.php');</script>"; //redirects to enrolment page
                }
                else {
                    echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                }
            }
        }
        else if(isset($_POST['cancel'])) {
            echo "<script>location.replace('admin-enrolment.php');</script>"; //redirects to enrolment page
        }
?>

<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Admin | Enrol Student</title>
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
	    define('PAGE', 'Enrolment'); //defines a named constant
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
                <li>Enrolment</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Enrol Student</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Enrol Student Confirmation</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Enrol Student Confirmation</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <br>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                        <!-- Column -->
                        <div class="col-md-10" style="width: 100%;">
                            <?php
                                if(isset($_GET['studentId']) && isset($_GET['subjectId']) && is_numeric($_GET['studentId']) && is_numeric($_GET['subjectId'])) {
                                    $studentId = $_GET['studentId']; //retrieves student id from GET
                                    $qry = "SELECT studentName, studentEmail FROM students WHERE studentId=$studentId"; //defines query to retrieve student name & student email based on student id
                                    $res = mysqli_query($con, $qry); //fetches result
                                    while($row = $res->fetch_assoc()) {
                                        $studentName = $row['studentName']; //stores student name
                                        $studentEmail = $row['studentEmail']; //stores student email
                                    }

                                    $subjectId = $_GET['subjectId']; //retrieves subject id from GET
                                    $qry = "SELECT subjectName, subjectCode FROM subjects WHERE subjectId=$subjectId"; //defines query to retrieve subject name & subject code based on subject id
                                    $res = mysqli_query($con, $qry); //fetches result
                                    while($row = $res->fetch_assoc()) {
                                        $subjectName = $row['subjectName']; //stores subject name
                                        $subjectCode = $row['subjectCode']; //stores subject code
                                    }
                            ?>
                            <!-- Enrol Student Confirmation Form -->
                            <form role="form" action="" method="post" id="" name="enrolStudentConfirmationForm">
                                <fieldset>
                                    <!-- Confirmation Message -->
                                    <div class="form-group">
                                        <p class="message" style="color: black;" align="center">Enrol student <b><?php echo $studentName; ?> (<?php echo $studentEmail; ?>)</b> to subject <b><?php echo $subjectName; ?> (<?php echo $subjectCode; ?>)</b>?</p>
                                    </div>
                                    <!-- Enrol Button & Cancel Button -->
                                    <div class="form-group">
                                        <br>
                                        <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                                        <input type="hidden" name="subjectId" value="<?php echo $subjectId; ?>">
                                        <button type="submit" class="btn btn-success" name="submit" value="submit"><b>ENROL</b></button>
                                        <button type="submit" class="btn btn-default" style="color: white;" name="cancel" value="cancel"><b>CANCEL</b></button>
                                        <br><br><br>
                                    </div>
                                </fieldset>
                            </form>
                            <?php
                                }
                                else {
                                    echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                                }
                            ?>
                            <br>
                        </div>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                    </div>
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
