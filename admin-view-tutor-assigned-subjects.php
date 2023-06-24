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
	<title>VLearn for Admin | View Tutor's Assigned Subject(s)</title>
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
                <li>View Tutor's Assigned Subject(s)</li>
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">View Tutor's Assigned Subject(s)</div>
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
                            if(isset($_GET['tutorId']) && is_numeric($_GET['tutorId'])) {
                                $tutorId = $_GET['tutorId']; //retrieves tutor id from GET
                                $qry = "SELECT tutorName, tutorEmail FROM tutors WHERE tutorId=$tutorId";
                                $res = mysqli_query($con, $qry);
                                while($qrow = $res->fetch_assoc()) {
                                    $tutorName = $qrow['tutorName'];
                                    $tutorEmail = $qrow['tutorEmail'];
                                }
                        ?>
                        <br>
                        <h4><b><span class="fa fa-book" aria-hidden="true"></span><br>Assigned Subject(s) for <?php echo $tutorName; ?> (<?php echo $tutorEmail; ?>)</b></h4>
                        <br>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                        <!-- Column -->
                        <div class="col-md-10" style="width: 100%;">
                            <!-- Table -->
                            <table id="table12" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fa fa-book"></span><br>Subject Name</th>
                                        <th style="text-align: center"><span class="fas fa-code"></span><br>Subject Code</th>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Subject Stage</th>
                                        <th style="text-align: center"><span class="fas fa-layer-group"></span><br>Subject Category</th>
                                        <th style="text-align: center"><span class="fas fa-clock"></span><br>Subject Session</th>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Subject Creation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT subjectName, subjectCode, subjectStage, subjectCategory, subjectSession, subjectCreationDate FROM subjects WHERE tutorId=$tutorId ORDER BY subjectCode";
                                        $result = mysqli_query($con, $sql);
                                        if(mysqli_num_rows($result) == 0) {
                                            echo "<p class='message'>There are no assigned subjects for this tutor.</p>"; //displays message if no records found
                                        }
                                        else {
                                            while($row = $result->fetch_assoc()) {
                                                $subjectName = $row['subjectName'];
                                                $subjectCode = $row['subjectCode'];
                                                $subjectStage = $row['subjectStage'];
                                                $subjectCategory = $row['subjectCategory'];
                                                $subjectSession = $row['subjectSession'];
                                                $subjectCreationDate = $row['subjectCreationDate'];
                                    ?>
                                    <tr>
                                        <td><b><?php echo $subjectName; ?></b></td>
                                        <td><?php echo $subjectCode; ?></td>
                                        <td><?php echo $subjectStage; ?></td>
                                        <td><?php echo $subjectCategory; ?></td>
                                        <td><?php echo $subjectSession; ?></td>
                                        <td><?php echo $subjectCreationDate; ?></td>
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
            $('#table12').DataTable();
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
