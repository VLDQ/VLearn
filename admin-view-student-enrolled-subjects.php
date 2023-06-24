<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnAdminSessionCounter']) == 0) {
        header('location:admin-logout-auto.php'); //logs out the admin if the info in the session is being cleared
    }
    else {
        $adminName = $_SESSION['VLearnAdminSessionCounter']; //stores info from session
?>

<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Admin | View Student's Enrolled Subject(s)</title>
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
                <li>View Student's Enrolled Subject(s)</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">View Student's Enrolled Subject(s)</div>
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
                            if(isset($_GET['studentId']) && is_numeric($_GET['studentId'])) {
                                $studentId = $_GET['studentId']; //retrieves student id from GET
                                $qry = "SELECT studentName, studentEmail FROM students WHERE studentId=$studentId";
                                $res = mysqli_query($con, $qry);
                                while($qrow = $res->fetch_assoc()) {
                                    $studentName = $qrow['studentName'];
                                    $studentEmail = $qrow['studentEmail'];
                                }
                        ?>
                        <br>
                        <h4><b><span class="fa fa-book" aria-hidden="true"></span><br>Enrolled Subject(s) for <?php echo $studentName; ?> (<?php echo $studentEmail; ?>)</b></h4>
                        <br>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                        <!-- Column -->
                        <div class="col-md-10" style="width: 100%;">
                            <!-- Table -->
                            <table id="table11" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fa fa-book"></span><br>Subject Name</th>
                                        <th style="text-align: center"><span class="fas fa-code"></span><br>Subject Code</th>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Subject Stage</th>
                                        <th style="text-align: center"><span class="fas fa-layer-group"></span><br>Subject Category</th>
                                        <th style="text-align: center"><span class="fas fa-clock"></span><br>Subject Session</th>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Student Enrolment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT subjectId, enrolmentDate FROM enrolments WHERE studentId=$studentId AND enrolmentIsActive=1 ORDER BY subjectId";
                                        $result = mysqli_query($con, $sql);
                                        if(mysqli_num_rows($result) == 0) {
                                            echo "<p class='message'>There are no enrolled subjects for this student.</p>"; //displays message if no records found
                                        }
                                        else {
                                            while($row = $result->fetch_assoc()) {
                                                $subjectId = $row['subjectId'];
                                                $query = "SELECT subjectName, subjectCode, subjectStage, subjectCategory, subjectSession FROM subjects WHERE subjectId=$subjectId";
                                                $ret = mysqli_query($con, $query);
                                                while($srow = $ret->fetch_assoc()) {
                                                    $subjectName = $srow['subjectName'];
                                                    $subjectCode = $srow['subjectCode'];
                                                    $subjectStage = $srow['subjectStage'];
                                                    $subjectCategory = $srow['subjectCategory'];
                                                    $subjectSession = $srow['subjectSession'];
                                                }
                                    ?>
                                    <tr>
                                        <td><b><?php echo $subjectName; ?></b></td>
                                        <td><?php echo $subjectCode; ?></td>
                                        <td><?php echo $subjectStage; ?></td>
                                        <td><?php echo $subjectCategory; ?></td>
                                        <td><?php echo $subjectSession; ?></td>
                                        <td><?php echo $row['enrolmentDate']; ?></td>
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
            $('#table11').DataTable();
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
