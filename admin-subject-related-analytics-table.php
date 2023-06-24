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
	<title>VLearn for Admin | Subject-Related Analytics</title>
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
	    define('PAGE', 'Dashboard'); //defines a named constant
		include_once('includes/admin-header.php'); //include the header
		include_once('includes/admin-sidebar.php'); //include the sidebar
    ?>

    <div class="col-sm-9 offset-sm-3 col-lg-10 offset-lg-2">
        <!-- Row (Breadcrumb) -->
        <div class="row main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="admin-home.php"><em class="fa fa-home" style="font-size: 14px; color: #0066cc;"></em></a></li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Dashboard</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Subject-Related Analytics</li>
            </ol>
        </div>
        <!-- Row (Subject-Related Analytics p1) -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-orange">
                    <div class="panel-heading" style="text-align: left;">&nbsp;<em class="fa-solid fa-chart-pie">&nbsp;</em> Subject-Related Analytics</div>
                </div>
            </div>
        </div>
        <!-- Row (Subject-Related Analytics p2) -->
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
                            <!-- Table -->
                            <table id="table19" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fa fa-book"></span><br>Subject Name</th>
                                        <th style="text-align: center"><span class="fas fa-code"></span><br>Subject Code</th>
                                        <th style="text-align: center"><span class="fas fa-layer-group"></span><br>Subject Education Level</th>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Subject Creation Date</th>
                                        <th style="text-align: center"><span class="fas fa-eye"></span><br>View Stats</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT subjectName, subjectCode, subjectEducationLevel, subjectCreationDate, subjectId FROM subjects ORDER BY subjectCode";
                                        $res = mysqli_query($con, $query);
                                        while($arow = $res->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><b><?php echo $arow['subjectName']; ?></b></td>
                                        <td><?php echo $arow['subjectCode']; ?></td>
                                        <td><?php echo $arow['subjectEducationLevel']; ?></td>
                                        <td><?php echo $arow['subjectCreationDate']; ?></td>
                                        <td><a href="admin-subject-related-analytics.php?subjectId=<?php echo $arow['subjectId']; ?>"><button class="btn btn-primary">Go</button></a></td>
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
            $('#table19').DataTable();
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
