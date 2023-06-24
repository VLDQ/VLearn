<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnTutorSessionCounter']) == 0) {
        header('location:tutor-logout-auto.php'); //logs out the tutor if the tutor id in the session is being cleared
    }
    else {
        $tutorId = $_SESSION['VLearnTutorSessionCounter']; //stores tutor id from session

        if(isset($_POST['edit'])) {
            $studentId = $_POST['studentId']; //retrieves form data
            $topicId = $_POST['topicId']; //retrieves form data
            $markObtained = $_POST['markObtained']; //retrieves form data
            $markUpdateDate = date("Y-m-d"); //gets current date
            $feedbackObtained = $_POST['feedbackObtained']; //retrieves form data
            $feedbackUpdateDate = date("Y-m-d"); //gets current date
            $subjectId = $_POST['subjectId']; //retrieves form data

            $markObtainedRounded = number_format($markObtained, 2); //2 decimal places

            /*
            //test output
            echo "$studentId <br>";
            echo "$topicId <br>";
            echo "$markObtained <br>";
            echo "$markUpdateDate <br>";
            echo "$feedbackObtained <br>";
            echo "$feedbackUpdateDate <br>";
            echo "$subjectId <br>";
            echo "$markObtainedRounded";
            */

            $query = mysqli_query($con, "UPDATE marks SET markObtained=$markObtainedRounded, markUpdateDate='$markUpdateDate' WHERE studentId=$studentId AND topicId=$topicId"); //defines query to update a mark record

            if($query) {
                //$sqlGetMarkId = mysqli_query($con, "SELECT markId AS id FROM marks WHERE studentId=$studentId AND topicId=$topicId"); //defines query for id validation
                //$mark = mysqli_fetch_assoc($sqlGetMarkId); //fetches result
                //$markId = $mark['id'];

                $qry = mysqli_query($con, "UPDATE feedbacks SET feedbackObtained='$feedbackObtained', feedbackUpdateDate='$feedbackUpdateDate' WHERE studentId=$studentId AND topicId=$topicId"); //defines query to update a feedback record

                if($qry) {
                    //$sqlGetFeedbackId = mysqli_query($con, "SELECT feedbackId AS id FROM feedbacks WHERE studentId=$studentId AND topicId=$topicId"); //defines query for id validation
                    //$feedback = mysqli_fetch_assoc($sqlGetFeedbackId); //fetches result
                    //$feedbackId = $feedback['id'];

                    echo "<script>alert('The marks and feedbacks for the student have been successfully updated!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('tutor-marks-feedbacks.php?subjectId=$subjectId&topicId=$topicId');</script>"; //redirects to marks & feedbacks page
                }
                else {
                    echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                }
            }
            else {
                echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
            }
        }
        else if(isset($_POST['add'])) {
            $studentId = $_POST['studentId']; //retrieves form data
            $topicId = $_POST['topicId']; //retrieves form data
            $markObtained = $_POST['markObtained']; //retrieves form data
            $markUpdateDate = date("Y-m-d"); //gets current date
            $feedbackObtained = $_POST['feedbackObtained']; //retrieves form data
            $feedbackUpdateDate = date("Y-m-d"); //gets current date
            $subjectId = $_POST['subjectId']; //retrieves form data

            $markObtainedRounded = number_format($markObtained, 2); //2 decimal places

            /*
            //test output
            echo "$studentId <br>";
            echo "$topicId <br>";
            echo "$markObtained <br>";
            echo "$markUpdateDate <br>";
            echo "$feedbackObtained <br>";
            echo "$feedbackUpdateDate <br>";
            echo "$subjectId <br>";
            echo "$markObtainedRounded";
            */

            $query = mysqli_query($con, "INSERT INTO marks(studentId, topicId, markObtained, markUpdateDate) value('$studentId', '$topicId', '$markObtainedRounded', '$markUpdateDate')"); //defines query to insert a new mark record

            if($query) {
                $sqlGetMarkId = mysqli_query($con, "SELECT markId AS id FROM marks WHERE studentId=$studentId AND topicId=$topicId"); //defines query for id validation
                $mark = mysqli_fetch_assoc($sqlGetMarkId); //fetches result
                $markId = $mark['id'];

                $qry = mysqli_query($con, "INSERT INTO feedbacks(studentId, topicId, feedbackObtained, feedbackUpdateDate) value('$studentId', '$topicId', '$feedbackObtained', '$feedbackUpdateDate')"); //defines query to insert a new feedback record

                if($qry) {
                    $sqlGetFeedbackId = mysqli_query($con, "SELECT feedbackId AS id FROM feedbacks WHERE studentId=$studentId AND topicId=$topicId"); //defines query for id validation
                    $feedback = mysqli_fetch_assoc($sqlGetFeedbackId); //fetches result
                    $feedbackId = $feedback['id'];

                    echo "<script>alert('The marks and feedbacks for the student have been successfully updated!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('tutor-marks-feedbacks.php?subjectId=$subjectId&topicId=$topicId');</script>"; //redirects to marks & feedbacks page
                }
                else {
                    echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                }
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
	<title>VLearn for Tutors | Update Marks & Feedbacks</title>
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
	    define('PAGE', 'MySubjects'); //defines a named constant
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
                <li>My Subjects</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Topic List</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Marks & Feedbacks</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Update Marks & Feedbacks</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Update Marks & Feedbacks</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <?php
                        if(isset($_GET['studentId']) && is_numeric($_GET['studentId']) && isset($_GET['topicId']) && is_numeric($_GET['topicId']) && isset($_GET['subjectId']) && is_numeric($_GET['subjectId'])) {
                            $studentId = $_GET['studentId']; //retrieves student id from GET
                            $topicId = $_GET['topicId']; //retrieves topic id from GET
                            $subjectId = $_GET['subjectId']; //retrieves subject id from GET

                            $ret = "SELECT studentName, studentEmail FROM students WHERE studentId=$studentId";
                            $res = mysqli_query($con, $ret);
                            while($qrow = $res->fetch_assoc()) {
                                $studentName = $qrow['studentName'];
                                $studentEmail = $qrow['studentEmail'];
                            }

                            $ret = "SELECT subjectName, subjectCode FROM subjects WHERE subjectId=$subjectId";
                            $res = mysqli_query($con, $ret);
                            while($qrow = $res->fetch_assoc()) {
                                $subjectName = $qrow['subjectName'];
                                $subjectCode = $qrow['subjectCode'];
                            }

                            $ret = "SELECT topicName, topicMarksAvailable FROM topics WHERE topicId=$topicId";
                            $res = mysqli_query($con, $ret);
                            while($qrow = $res->fetch_assoc()) {
                                $topicName = $qrow['topicName'];
                                $topicMarksAvailable = $qrow['topicMarksAvailable'];
                            }
                    ?>
                    <br>
                    <p style="font-size: 20px; color: black;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Student:  <b><?php echo $studentName; ?> (<?php echo $studentEmail; ?>)</b>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subject:  <b><?php echo $subjectName; ?> (<?php echo $subjectCode; ?>)</b>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Topic:  <b><?php echo $topicName; ?></b>
                    </p>
                    <hr>
                    <?php
                            $sqlm = mysqli_query($con, "SELECT markObtained, markUpdateDate FROM marks WHERE studentId=$studentId AND topicId=$topicId"); //defines query to retrieve mark record based on student id & topic id
                            $sqlf = mysqli_query($con, "SELECT feedbackObtained, feedbackUpdateDate FROM feedbacks WHERE studentId=$studentId AND topicId=$topicId"); //defines query to retrieve feedback record based on student id & topic id
	                        if(mysqli_num_rows($sqlm) == 0 && mysqli_num_rows($sqlf) == 0) {
                    ?>
                    <!-- Update Marks & Feedbacks Form -->
                    <form role="form" action="" method="post" id="" name="updateMarksFeedbacksForm">
                        <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                        <fieldset>
                            <!-- Marks -->
                            <div class="form-group">
                                <p class="form-field-title">Marks (Out of <?php echo $topicMarksAvailable; ?>):</p>
                                <p style="margin-top: -10px;"><small>(Note: The marks will be automatically rounded to 2 decimal places.)</small></p>
                                <input type="number" class="form-control" name="markObtained" placeholder="Enter marks" step="0.01" min="0" max="<?php echo $topicMarksAvailable; ?>" required="true">
                            </div>
                            <!-- Feedbacks -->
                            <div class="form-group">
                                <p class="form-field-title">Feedbacks:</p>
                                <textarea class="form-control" name="feedbackObtained" placeholder="Enter feedbacks" required="true"></textarea>
                            </div>
                            <!-- Update Marks & Feedbacks Button -->
                            <div class="form-group">
                                <br>
                                <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                                <input type="hidden" name="topicId" value="<?php echo $topicId; ?>">
                                <input type="hidden" name="subjectId" value="<?php echo $subjectId; ?>">
                                <button type="submit" class="btn btn-primary btn-submit" name="add" value="add"><b>UPDATE MARKS & FEEDBACKS</b></button>
                                <br><br><br>
                            </div>
                        </fieldset>
                    </form>
                    <?php
                            }
                            else {
                    ?>
                    <!-- Update Marks & Feedbacks Form -->
                    <form role="form" action="" method="post" id="" name="updateMarksFeedbacksForm">
                        <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                        <fieldset>
                            <!-- Marks -->
                            <div class="form-group">
                                <p class="form-field-title">Marks (Out of <?php echo $topicMarksAvailable; ?>):</p>
                                <p style="margin-top: -10px;"><small>(Note: The marks will be automatically rounded to 2 decimal places.)</small></p>
                                <?php
                                    while($rowm = mysqli_fetch_array($sqlm)) {
                                        $markObtained = $rowm['markObtained'];
                                        $markUpdateDate = $rowm['markUpdateDate'];
                                    }
                                ?>
                                <input type="number" class="form-control" name="markObtained" value="<?php echo $markObtained; ?>" placeholder="Enter marks" step="0.01" min="0" max="<?php echo $topicMarksAvailable; ?>" required="true">
                                <p><small>Last updated on <?php echo $markUpdateDate; ?></small></p>
                            </div>
                            <!-- Feedbacks -->
                            <div class="form-group">
                                <p class="form-field-title">Feedbacks:</p>
                                <?php
                                    while($rowf = mysqli_fetch_array($sqlf)) {
                                        $feedbackObtained = $rowf['feedbackObtained'];
                                        $feedbackUpdateDate = $rowf['feedbackUpdateDate'];
                                    }
                                ?>
                                <textarea class="form-control" name="feedbackObtained" placeholder="Enter feedbacks" required="true"><?php echo $feedbackObtained; ?></textarea>
                                <p><small>Last updated on <?php echo $feedbackUpdateDate; ?></small></p>
                            </div>
                            <!-- Update Marks & Feedbacks Button -->
                            <div class="form-group">
                                <br>
                                <input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
                                <input type="hidden" name="topicId" value="<?php echo $topicId; ?>">
                                <input type="hidden" name="subjectId" value="<?php echo $subjectId; ?>">
                                <button type="submit" class="btn btn-primary btn-submit" name="edit" value="edit"><b>UPDATE MARKS & FEEDBACKS</b></button>
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
