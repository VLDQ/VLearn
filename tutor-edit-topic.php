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
            $topicId = $_POST['topicId']; //retrieves form data
            $subjectId = $_POST['subjectId']; //retrieves form data
            $topicName = $_POST['topicName']; //retrieves form data
            $topicDescription = $_POST['topicDescription']; //retrieves form data
            $topicNotes = $_POST['topicNotes']; //retrieves form data
            $topicHomework = $_POST['topicHomework']; //retrieves form data
            $topicMarksAvailable = $_POST['topicMarksAvailable']; //retrieves form data
            $topicShowOrHide = $_POST['topicShowOrHide']; //retrieves form data

            $topicMarksAvailableRounded = number_format($topicMarksAvailable, 2); //2 decimal places

            /*
            //test output
            echo "$topicId <br>";
            echo "$topicName <br>";
            echo "$topicDescription <br>";
            echo "$topicNotes <br>";
            echo "$topicHomework <br>";
            echo "$topicMarksAvailable <br>";
            echo "$topicShowOrHide <br>";
            echo "$topicMarksAvailableRounded";
            */

            $ret = mysqli_query($con, "SELECT topicId FROM topics WHERE topicId=$topicId AND topicMarksAvailable=$topicMarksAvailableRounded"); //defines query to check for the update of marks available
            $result = mysqli_fetch_array($ret); //fetches result

            if($result > 0) {
                $query = mysqli_query($con, "UPDATE topics SET topicName='$topicName', topicDescription='$topicDescription', topicNotes='$topicNotes', topicHomework='$topicHomework', topicMarksAvailable=$topicMarksAvailableRounded, topicShowOrHide=$topicShowOrHide WHERE topicId=$topicId"); //defines query to update a topic record

                if($query) {
                    //$sqlGetTopicId = mysqli_query($con, "SELECT topicId AS id FROM topics WHERE "); //defines query for id validation
                    //$topic = mysqli_fetch_assoc($sqlGetTopicId); //fetches result
                    //$topicId = $topic['id'];

                    echo "<script>alert('The topic has been successfully updated!');</script>"; //displays success message via alert box
                    echo "<script>location.replace('tutor-topic-list.php?subjectId=$subjectId');</script>"; //redirects to topic list page
                }
                else {
                    echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                }
            }
            else {
                //resets students marks if there is a new value for the marks available
                $markUpdateDate = date("Y-m-d"); //gets current date
                $query = mysqli_query($con, "UPDATE marks SET markObtained=0.00, markUpdateDate='$markUpdateDate' WHERE topicId=$topicId"); //defines query to update marks records

                if($query) {
                    $qry = mysqli_query($con, "UPDATE topics SET topicName='$topicName', topicDescription='$topicDescription', topicNotes='$topicNotes', topicHomework='$topicHomework', topicMarksAvailable=$topicMarksAvailableRounded, topicShowOrHide=$topicShowOrHide WHERE topicId=$topicId"); //defines query to update a topic record

                    if($qry) {
                        //$sqlGetTopicId = mysqli_query($con, "SELECT topicId AS id FROM topics WHERE "); //defines query for id validation
                        //$topic = mysqli_fetch_assoc($sqlGetTopicId); //fetches result
                        //$topicId = $topic['id'];

                        echo "<script>alert('The topic has been successfully updated!');</script>"; //displays success message via alert box
                        echo "<script>location.replace('tutor-topic-list.php?subjectId=$subjectId');</script>"; //redirects to topic list page
                    }
                    else {
                        echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                    }
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
	<title>VLearn for Tutors | Edit Topic</title>
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
                <li>Edit Topic</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Edit Topic</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <?php
                        if(isset($_GET['topicId']) && is_numeric($_GET['topicId']) && isset($_GET['subjectId']) && is_numeric($_GET['subjectId'])) {
                            $topicId = $_GET['topicId']; //retrieves topic id from GET
                            $subjectId = $_GET['subjectId']; //retrieves subject id from GET
                            $res = mysqli_query($con, "SELECT topicName, topicDescription, topicNotes, topicHomework, topicMarksAvailable, topicShowOrHide FROM topics WHERE topicId=$topicId"); //defines query to retrieve topic record based on topic id
	                        while($row = mysqli_fetch_array($res)) {
                    ?>
                    <!-- Edit Topic Form -->
                    <form role="form" action="" method="post" id="" name="editTopicForm">
                        <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                        <fieldset>
                            <!-- Topic Name -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Name:</p>
                                <input type="text" class="form-control" name="topicName" value="<?php echo $row['topicName']; ?>" placeholder="Enter topic name" required="true">
                            </div>
                            <!-- Topic Description -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Description:</p>
                                <textarea class="form-control" name="topicDescription" placeholder="Enter topic description" required="true"><?php echo $row['topicDescription']; ?></textarea>
                            </div>
                            <!-- Topic Notes -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Notes:</p>
                                <p style="margin-top: -10px;"><small>(Tips: You may enter the Google Drive link that contains the notes, or leave a brief message about the notes to your students.)</small></p>
                                <input type="text" class="form-control" name="topicNotes" value="<?php echo $row['topicNotes']; ?>" placeholder="Enter topic notes" required="true">
                            </div>
                            <!-- Topic Homework -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Homework:</p>
                                <p style="margin-top: -10px;"><small>(Tips: You may enter the Google Drive link that contains the homework, or leave a brief message about the homework to your students.)</small></p>
                                <input type="text" class="form-control" name="topicHomework" value="<?php echo $row['topicHomework']; ?>" placeholder="Enter topic homework" required="true">
                            </div>
                            <!-- Topic Marks Available -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Marks Available:</p>
                                <p style="margin-top: -10px;"><small>(Note: The marks will be automatically rounded to 2 decimal places.)</small></p>
                                <input type="number" class="form-control" name="topicMarksAvailable" value="<?php echo $row['topicMarksAvailable']; ?>" placeholder="Enter topic marks available" step="0.01" min="0" required="true">
                            </div>
                            <!-- Topic Show Or Hide (Topic Visibility) -->
                            <div class="form-group">
                                <p class="form-field-title">Topic Visibility:</p>
                                <label class="radio-container">Hide from students
                                    <input type="radio" name="topicShowOrHide" value="0" 
                                        <?php
                                            if($row['topicShowOrHide'] == 0) {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                                <label class="radio-container">Show to students
                                    <input type="radio" name="topicShowOrHide" value="1" 
                                        <?php
                                            if($row['topicShowOrHide'] == 1) {
                                                echo "checked='checked'";
                                            }
                                        ?>
                                    >
                                    <span class="radio-checkmark"></span>
                                </label>
                            </div>
                            <!-- Update Topic Button -->
                            <div class="form-group">
                                <br>
                                <input type="hidden" name="topicId" value="<?php echo $topicId; ?>">
                                <input type="hidden" name="subjectId" value="<?php echo $subjectId; ?>">
                                <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>UPDATE TOPIC</b></button>
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
