<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnAdminSessionCounter']) == 0) {
        header('location:admin-logout-auto.php'); //logs out the admin if the info in the session is being cleared
    }
    else {
        $adminName = $_SESSION['VLearnAdminSessionCounter']; //stores info from session

        if(isset($_GET['year']) && is_numeric($_GET['year'])) {
            $year = $_GET['year']; //retrieves year from GET

            //GET TOTAL NO OF STUDENTS, NO OF PRIMARY SCHOOL STUDENTS, NO OF SECONDARY SCHOOL STUDENTS
            $sql = "SELECT * FROM students WHERE YEAR(studentRegistrationDate)='$year'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalStudentsCount = 0;
                $primaryStudentsCount = 0;
                $secondaryStudentsCount = 0;
            }
            else {
                $totalStudentsCount = 0;
                $primaryStudentsCount = 0;
                $secondaryStudentsCount = 0;

                while($row = $result->fetch_assoc()) {
                    $totalStudentsCount++;

                    if($row['studentEducationLevel'] == "Primary") {
                        $primaryStudentsCount++;
                    }
                    else if($row['studentEducationLevel'] == "Secondary") {
                        $secondaryStudentsCount++;
                    }
                }
            }

            //GET TOTAL NO OF TUTORS
            $sql = "SELECT * FROM tutors WHERE YEAR(tutorStartDate)='$year'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalTutorsCount = 0;
            }
            else {
                $totalTutorsCount = 0;

                while($row = $result->fetch_assoc()) {
                    $totalTutorsCount++;
                }
            }

            //GET TOTAL NO OF SUBJECTS, NO OF PRIMARY SCHOOL SUBJECTS, NO OF SECONDARY SCHOOL SUBJECTS
            $sql = "SELECT * FROM subjects WHERE YEAR(subjectCreationDate)='$year'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalSubjectsCount = 0;
                $primarySubjectsCount = 0;
                $secondarySubjectsCount = 0;
            }
            else {
                $totalSubjectsCount = 0;
                $primarySubjectsCount = 0;
                $secondarySubjectsCount = 0;

                while($row = $result->fetch_assoc()) {
                    $totalSubjectsCount++;

                    if($row['subjectEducationLevel'] == "Primary") {
                        $primarySubjectsCount++;
                    }
                    else if($row['subjectEducationLevel'] == "Secondary") {
                        $secondarySubjectsCount++;
                    }
                }
            }
        }
        else {
            echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
            header('location:admin-home.php'); //redirects to homepage
        }
?>

<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Admin | General Analytics</title>
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
                <li>General Analytics</li>
            </ol>
        </div>
        <!-- Row (General Analytics p1) -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-teal">
                    <div class="panel-heading" style="text-align: left;">&nbsp;<em class="fa-solid fa-chart-pie">&nbsp;</em> General Analytics (Year: <?php echo $year; ?>)</div>
                </div>
            </div>
        </div>
        <!-- Row (General Analytics p2) -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <div class="row main">
                            <div class="col-md-12">
                                <h4><span class="fas fa-user-graduate" aria-hidden="true"></span></h4>
                                <h1 style="font-weight: 800; color: #999999;"><?php echo $totalStudentsCount; ?></h1>
                                <h5>new students</h5>
                            </div>
                        </div>
                        <div class="row main">
                            <div class="col-md-6">
                                <h2 style="font-weight: 800; color: #999999;"><?php echo $primaryStudentsCount; ?></h2>
                                <h6>primary</h6>
                            </div>
                            <div class="col-md-6">
                                <h2 style="font-weight: 800; color: #999999;"><?php echo $secondaryStudentsCount; ?></h2>
                                <h6>secondary</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <div class="row main">
                            <div class="col-md-12">
                                <h4><span class="fas fa-chalkboard-teacher" aria-hidden="true"></span></h4>
                                <h1 style="font-weight: 800; color: #999999;"><?php echo $totalTutorsCount; ?></h1>
                                <h5>new tutors</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <div class="row main">
                            <div class="col-md-12">
                                <h4><span class="fa fa-book" aria-hidden="true"></span></h4>
                                <h1 style="font-weight: 800; color: #999999;"><?php echo $totalSubjectsCount; ?></h1>
                                <h5>new subjects</h5>
                            </div>
                        </div>
                        <div class="row main">
                            <div class="col-md-6">
                                <h2 style="font-weight: 800; color: #999999;"><?php echo $primarySubjectsCount; ?></h2>
                                <h6>primary</h6>
                            </div>
                            <div class="col-md-6">
                                <h2 style="font-weight: 800; color: #999999;"><?php echo $secondarySubjectsCount; ?></h2>
                                <h6>secondary</h6>
                            </div>
                        </div>
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
