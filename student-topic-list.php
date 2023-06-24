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
	<title>VLearn for Students | Topic List</title>
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
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Topic List</div>
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
                            if(isset($_GET['subjectId']) && is_numeric($_GET['subjectId'])) {
                                $subjectId = $_GET['subjectId']; //retrieves subject id from GET
                                $query = "SELECT topicId, topicMarksAvailable FROM topics WHERE subjectId=$subjectId AND topicShowOrHide=1 ORDER BY topicId";
                                $sqlt = mysqli_query($con, $query);
                                if(mysqli_num_rows($sqlt) == 0) {
                                    $totalMarksObtained = "N/A"; //sets TMO
                                    $totalMarksAvailable = "N/A"; //sets TMA
                                    $overallGradeObtained = "N/A"; //sets OGO
                                }
                                else {
                                    $totalMarksObtained = 0; //sets TMO
                                    $totalMarksAvailable = 0; //sets TMA

                                    while($rowt = $sqlt->fetch_assoc()) {
                                        $topicId = $rowt['topicId'];
                                        $topicMarksAvailable = $rowt['topicMarksAvailable'];

                                        $sqlm = mysqli_query($con, "SELECT markObtained FROM marks WHERE studentId=$studentId AND topicId=$topicId"); //defines query to retrieve mark record based on student id & topic id
                                        if(mysqli_num_rows($sqlm) > 0) {
                                            while($rowm = $sqlm->fetch_assoc()) {
                                                $markObtained = $rowm['markObtained'];
                                                $totalMarksObtained = $totalMarksObtained + $markObtained; //increments TMO
                                                $totalMarksAvailable = $totalMarksAvailable + $topicMarksAvailable; //increments TMA
                                            }
                                        }
                                    }

                                    if($totalMarksObtained == 0 && $totalMarksAvailable == 0) {
                                        $totalMarksObtained = "N/A"; //sets TMO
                                        $totalMarksAvailable = "N/A"; //sets TMA
                                        $overallGradeObtained = "N/A"; //sets OGO
                                    }
                                    else {
                                        $finalMarks = 100*($totalMarksObtained/$totalMarksAvailable); //calculates final marks (over 100)
                                        $finalMarksRounded = number_format($finalMarks, 2); //rounds to 2 decimal places

                                        //sets OGO
                                        if($finalMarksRounded >= 90.00) {
                                            $overallGradeObtained = "A+";
                                        }
                                        else if($finalMarksRounded >= 80.00) {
                                            $overallGradeObtained = "A";
                                        }
                                        else if($finalMarksRounded >= 70.00) {
                                            $overallGradeObtained = "A-";
                                        }
                                        else if($finalMarksRounded >= 65.00) {
                                            $overallGradeObtained = "B+";
                                        }
                                        else if($finalMarksRounded >= 60.00) {
                                            $overallGradeObtained = "B";
                                        }
                                        else if($finalMarksRounded >= 55.00) {
                                            $overallGradeObtained = "C+";
                                        }
                                        else if($finalMarksRounded >= 50.00) {
                                            $overallGradeObtained = "C";
                                        }
                                        else if($finalMarksRounded >= 45.00) {
                                            $overallGradeObtained = "D";
                                        }
                                        else if($finalMarksRounded >= 40.00) {
                                            $overallGradeObtained = "E";
                                        }
                                        else if($finalMarksRounded >= 0.00) {
                                            $overallGradeObtained = "G";
                                        }
                                    }
                                }
                        ?>
                        <?php
                                $sqlg = mysqli_query($con, "SELECT overallGradeObtained FROM overallgrades WHERE studentId=$studentId AND subjectId=$subjectId"); //defines query to retrieve overall grade record based on student id & subject id
                                if(mysqli_num_rows($sqlg) == 0) {
                                    //adds a new overall grade record to database
                                    $queryg = mysqli_query($con, "INSERT INTO overallgrades(studentId, subjectId, overallGradeObtained) value('$studentId', '$subjectId', '$overallGradeObtained')"); //defines query to insert a new overall grade record
                                    if(!$queryg) {
                                        echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                                    }
                                }
                                else {
                                    //updates an existing overall grade record in database
                                    $queryg = mysqli_query($con, "UPDATE overallgrades SET overallGradeObtained='$overallGradeObtained' WHERE studentId=$studentId AND subjectId=$subjectId"); //defines query to update an overall grade record
                                    if(!$queryg) {
                                        echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
                                    }
                                }
                        ?>
                        <!-- Marks & Grade -->
                        <div class="row main">
                            <div class="col-md-6">
                                <p style="font-size: 20px; color: black;" align="left">
                                    <?php
                                        $sqls = "SELECT subjectName, subjectCode FROM subjects WHERE subjectId=$subjectId";
                                        $ress = mysqli_query($con, $sqls);
                                        while($rows = $ress->fetch_assoc()) {
                                            $subjectName = $rows['subjectName'];
                                            $subjectCode = $rows['subjectCode'];
                                        }
                                    ?>
                                    <b><?php echo "$subjectName"; ?> (<?php echo "$subjectCode"; ?>)</b>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p style="font-size: 20px; color: black;" align="right">
                                    <?php
                                        if($totalMarksObtained != "N/A" && $totalMarksAvailable != "N/A") {
                                            $totalMarksObtained = number_format($totalMarksObtained, 2); //rounds to 2 decimal places
                                            $totalMarksAvailable = number_format($totalMarksAvailable, 2); //rounds to 2 decimal places
                                        }
                                    ?>
                                    Marks: <b><?php echo "$totalMarksObtained"; ?> / <?php echo "$totalMarksAvailable"; ?></b>
                                    &nbsp; | &nbsp;
                                    Grade: <b><?php echo "$overallGradeObtained"; ?></b>
                                </p>
                            </div>
                        </div>
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
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <?php
                            if(isset($_GET['subjectId']) && is_numeric($_GET['subjectId'])) {
                                $subjectId = $_GET['subjectId']; //retrieves subject id from GET
                                $qry = "SELECT subjectName, subjectCode FROM subjects WHERE subjectId=$subjectId";
                                $res = mysqli_query($con, $qry);
                                while($qrow = $res->fetch_assoc()) {
                                    $subjectName = $qrow['subjectName'];
                                    $subjectCode = $qrow['subjectCode'];
                                }
                        ?>
                        <br>
                        <h4><b><span class="fa-solid fa-book-open" aria-hidden="true"></span><br>Topic(s) under <?php echo $subjectName; ?> (<?php echo $subjectCode; ?>)</b></h4>
                        <br>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                        <!-- Column -->
                        <div class="col-md-10" style="width: 100%;">
                            <!-- Table -->
                            <table id="table17" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fa-solid fa-book-open"></span><br>Topic Name</th>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Topic Creation Date</th>
                                        <th style="text-align: center"><span class="fas fa-eye"></span><br>View Topic Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT topicName, topicCreationDate, topicId FROM topics WHERE subjectId=$subjectId AND topicShowOrHide=1 ORDER BY topicId";
                                        $result = mysqli_query($con, $sql);
                                        if(mysqli_num_rows($result) == 0) {
                                            echo "<p class='message'>There are no topics under this subject.</p>"; //displays message if no records found
                                        }
                                        else {
                                            while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $row['topicName']; ?></b></td>
                                        <td><?php echo $row['topicCreationDate']; ?></td>
                                        <td><a href="student-view-topic.php?topicId=<?php echo $row['topicId']; ?>"><button class="btn btn-primary">Go</button></a></td>
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
            $('#table17').DataTable();
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
