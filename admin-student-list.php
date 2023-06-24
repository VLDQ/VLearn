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
	<title>VLearn for Admin | Student List</title>
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
            </ol>
        </div>
        <!-- Row -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Student List</div>
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
                        <h4><b><span class="fas fa-school" aria-hidden="true"></span><br>Primary School</b></h4>
                        <br>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                        <!-- Column -->
                        <div class="col-md-10" style="width: 100%;">
                            <!-- Table -->
                            <table id="table1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fas fa-user-graduate"></span><br>Name</th>
                                        <th style="text-align: center"><span class="fa fa-envelope"></span><br>Email</th>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Stage</th>
                                        <th style="text-align: center"><span class="fa fa-book"></span><br>Subject(s)</th>
                                        <th style="text-align: center"><span class="fa fa-registered"></span><br>Registration Date</th>
                                        <th style="text-align: center"><span class="fa fa-book"></span><br>Enrolled Subject(s)</th>
                                        <th style="text-align: center"><span class="fas fa-edit"></span><br>Edit Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT studentName, studentEmail, studentStage, studentSubjects, studentRegistrationDate, studentId FROM students WHERE studentEducationLevel='Primary' ORDER BY studentEmail";
                                        $result = mysqli_query($con, $sql);
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $row['studentName']; ?></b></td>
                                        <td><?php echo $row['studentEmail']; ?></td>
                                        <td><?php echo $row['studentStage']; ?></td>
                                        <td><?php echo $row['studentSubjects']; ?></td>
                                        <td><?php echo $row['studentRegistrationDate']; ?></td>
                                        <td><a href="admin-view-student-enrolled-subjects.php?studentId=<?php echo $row['studentId']; ?>"><button class="btn btn-primary">View</button></a></td>
                                        <td><a href="admin-edit-student-primary.php?studentId=<?php echo $row['studentId']; ?>"><button class="btn btn-primary">Edit</button></a></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                        </div>
                        <!-- Column -->
                        <div class="col-md-1"></div>
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
                        <br>
                        <h4><b><span class="fa fa-university" aria-hidden="true"></span><br>Secondary School</b></h4>
                        <br>
                        <!-- Column -->
                        <div class="col-md-1"></div>
                        <!-- Column -->
                        <div class="col-md-10" style="width: 100%;">
                            <!-- Table -->
                            <table id="table2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fas fa-user-graduate"></span><br>Name</th>
                                        <th style="text-align: center"><span class="fa fa-envelope"></span><br>Email</th>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Stage</th>
                                        <th style="text-align: center"><span class="fa fa-book"></span><br>Subject(s)</th>
                                        <th style="text-align: center"><span class="fa fa-registered"></span><br>Registration Date</th>
                                        <th style="text-align: center"><span class="fa fa-book"></span><br>Enrolled Subject(s)</th>
                                        <th style="text-align: center"><span class="fas fa-edit"></span><br>Edit Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT studentName, studentEmail, studentStage, studentSubjects, studentRegistrationDate, studentId FROM students WHERE studentEducationLevel='Secondary' ORDER BY studentEmail";
                                        $result = mysqli_query($con, $sql);
                                        while($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $row['studentName']; ?></b></td>
                                        <td><?php echo $row['studentEmail']; ?></td>
                                        <td><?php echo $row['studentStage']; ?></td>
                                        <td><?php echo $row['studentSubjects']; ?></td>
                                        <td><?php echo $row['studentRegistrationDate']; ?></td>
                                        <td><a href="admin-view-student-enrolled-subjects.php?studentId=<?php echo $row['studentId']; ?>"><button class="btn btn-primary">View</button></a></td>
                                        <td><a href="admin-edit-student-secondary.php?studentId=<?php echo $row['studentId']; ?>"><button class="btn btn-primary">Edit</button></a></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
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
    <script>
        //DataTables
        $(document).ready(function () {
            $('#table1').DataTable();
            $('#table2').DataTable();
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
