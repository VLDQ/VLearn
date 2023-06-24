<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnTutorSessionCounter']) == 0) {
        header('location:tutor-logout-auto.php'); //logs out the tutor if the tutor id in the session is being cleared
    }
    else {
        $tutorId = $_SESSION['VLearnTutorSessionCounter']; //stores tutor id from session
?>

<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Tutors | Marks & Feedbacks</title>
    <link rel="icon" type="image/png" href="images/VLearn-logo1.png" sizes="113x113">

    <!-- Styles -->
    <?php
        include('includes/head-styles.php'); //include head styles
    ?>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="css/datatables.css" type="text/css">
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
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Marks & Feedbacks</div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <?php
                            if(isset($_GET['subjectId']) && is_numeric($_GET['subjectId']) && isset($_GET['topicId']) && is_numeric($_GET['topicId'])) {
                                $subjectId = $_GET['subjectId']; //retrieves subject id from GET
                                $topicId = $_GET['topicId']; //retrieves topic id from GET
                                $qry = "SELECT subjectName, subjectCode FROM subjects WHERE subjectId=$subjectId";
                                $res = mysqli_query($con, $qry);
                                while($qrow = $res->fetch_assoc()) {
                                    $subjectName = $qrow['subjectName'];
                                    $subjectCode = $qrow['subjectCode'];
                                }
                        ?>
                        <br>
                        <h4><b><span class="fas fa-user-graduate" aria-hidden="true"></span><br>Enrolled Students for <?php echo $subjectName; ?> (<?php echo $subjectCode; ?>)</b></h4>
                        <br>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                        <!-- Column -->
                        <div class="col-md-10" style="width: 100%;">
                            <!-- Table -->
                            <table id="table15" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fas fa-user-graduate"></span><br>Student Name</th>
                                        <th style="text-align: center"><span class="fa fa-envelope"></span><br>Student Email</th>
                                        <th style="text-align: center"><span class="fa fa-check"></span><br>Update Marks & Feedbacks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT studentId FROM enrolments WHERE subjectId=$subjectId AND enrolmentIsActive=1 ORDER BY studentId";
                                        $result = mysqli_query($con, $sql);
                                        if(mysqli_num_rows($result) == 0) {
                                            echo "<p class='message'>There are no enrolled students for this subject.</p>"; //displays message if no records found
                                        }
                                        else {
                                            while($row = $result->fetch_assoc()) {
                                                $studentId = $row['studentId'];
                                                $query = "SELECT studentName, studentEmail FROM students WHERE studentId=$studentId";
                                                $ret = mysqli_query($con, $query);
                                                while($srow = $ret->fetch_assoc()) {
                                                    $studentName = $srow['studentName'];
                                                    $studentEmail = $srow['studentEmail'];
                                                }
                                    ?>
                                    <tr>
                                        <td><b><?php echo $studentName; ?></b></td>
                                        <td><?php echo $studentEmail; ?></td>
                                        <td><a href="tutor-update-marks-feedbacks.php?studentId=<?php echo $studentId; ?>&topicId=<?php echo $topicId; ?>&subjectId=<?php echo $subjectId; ?>"><button class="btn btn-primary">Go</button></a></td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                        </div>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                        <?php
                            }
                            else {
                                echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                            }
                        ?>
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
    <script>
        //DataTables
        $(document).ready(function () {
            $('#table15').DataTable();
        });
    </script>
    <script src="js/custom.js"></script>
</body>
<!-- end of body -->

</html>
<!-- end of html -->

<?php
    }
?>
