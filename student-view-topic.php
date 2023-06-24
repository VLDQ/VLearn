<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnStudentSessionCounter']) == 0) {
        header('location:student-logout-auto.php'); //logs out the student if the student id in the session is being cleared
    }
    else {
        $studentId = $_SESSION['VLearnStudentSessionCounter']; //stores student id from session
?>

<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Students | View Topic Details</title>
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
                <li>My Subjects</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Topic List</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>View Topic Details</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">View Topic Details</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <?php
                        if(isset($_GET['topicId']) && is_numeric($_GET['topicId'])) {
                            $topicId = $_GET['topicId']; //retrieves topic id from GET
                            $res = mysqli_query($con, "SELECT topicName, topicDescription, topicNotes, topicHomework, topicMarksAvailable FROM topics WHERE topicId=$topicId"); //defines query to retrieve topic record based on topic id
	                        while($row = mysqli_fetch_array($res)) {
                    ?>
                    <!-- View Topic Details Area -->
                    <form role="form" action="" method="post" id="">
                        <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                        <fieldset>
                            <!-- Topic Name -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Name:</p>
                                <p class="message" style="color: black;"><?php echo $row['topicName']; ?></p>
                            </div>
                            <hr>
                            <!-- Topic Description -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Description:</p>
                                <p class="message" style="color: black;"><?php echo $row['topicDescription']; ?></p>
                            </div>
                            <hr>
                            <!-- Topic Notes -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Notes:</p>
                                <p class="message" style="color: black;"><?php echo $row['topicNotes']; ?></p>
                            </div>
                            <hr>
                            <!-- Topic Homework -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Homework:</p>
                                <p class="message" style="color: black;"><?php echo $row['topicHomework']; ?></p>
                            </div>
                            <hr>
                            <?php
                                $sqlm = mysqli_query($con, "SELECT markObtained, markUpdateDate FROM marks WHERE studentId=$studentId AND topicId=$topicId"); //defines query to retrieve mark record based on student id & topic id
                                $sqlf = mysqli_query($con, "SELECT feedbackObtained, feedbackUpdateDate FROM feedbacks WHERE studentId=$studentId AND topicId=$topicId"); //defines query to retrieve feedback record based on student id & topic id
                                if(mysqli_num_rows($sqlm) == 0 && mysqli_num_rows($sqlf) == 0) {
                            ?>
                            <!-- Marks Obtained -->
                            <div class="form-group">
                                <p class="form-field-title">Marks Obtained:</p>
                                <p style="margin-top: -10px;"><small>(Maximum marks available: <?php echo $row['topicMarksAvailable']; ?>)</small></p>
                                <p class="message" style="color: black;">N/A</p>
                            </div>
                            <hr>
                            <!-- Feedbacks Obtained -->
                            <div class="form-group">
                                <p class="form-field-title">Feedbacks Obtained:</p>
                                <p class="message" style="color: black;">N/A</p>
                            </div>
                            <?php
                                }
                                else {
                            ?>
                            <!-- Marks Obtained -->
                            <div class="form-group">
                                <p class="form-field-title">Marks Obtained:</p>
                                <p style="margin-top: -10px;"><small>(Maximum marks available: <?php echo $row['topicMarksAvailable']; ?>)</small></p>
                                <?php
                                    while($rowm = mysqli_fetch_array($sqlm)) {
                                        $markObtained = $rowm['markObtained'];
                                        $markUpdateDate = $rowm['markUpdateDate'];
                                    }
                                ?>
                                <p class="message" style="color: black;"><?php echo $markObtained; ?> (Last updated on <?php echo $markUpdateDate; ?>)</p>
                            </div>
                            <hr>
                            <!-- Feedbacks Obtained -->
                            <div class="form-group">
                                <p class="form-field-title">Feedbacks Obtained:</p>
                                <?php
                                    while($rowf = mysqli_fetch_array($sqlf)) {
                                        $feedbackObtained = $rowf['feedbackObtained'];
                                        $feedbackUpdateDate = $rowf['feedbackUpdateDate'];
                                    }
                                ?>
                                <p class="message" style="color: black;"><?php echo $feedbackObtained; ?> (Last updated on <?php echo $feedbackUpdateDate; ?>)</p>
                            </div>
                            <?php
                                }
                            ?>
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
