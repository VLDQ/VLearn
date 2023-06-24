<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnAdminSessionCounter']) == 0) {
        header('location:admin-logout-auto.php'); //logs out the admin if the info in the session is being cleared
    }
    else {
        $adminName = $_SESSION['VLearnAdminSessionCounter']; //stores info from session

        //echo "<h1>Welcome to Admin Homepage, $adminName !</h1>"; //displays greeting message

        //echo "<a href='admin-logout.php?logout=true'><i class='fa fa-sign-out'></i>Logout</a>"; //logout

        //GET TOTAL NO OF STUDENTS, NO OF PRIMARY SCHOOL STUDENTS, NO OF SECONDARY SCHOOL STUDENTS
        $sql = "SELECT * FROM students";
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
        $sql = "SELECT * FROM tutors WHERE tutorIsActive=1";
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
        $sql = "SELECT * FROM subjects";
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
?>

<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Admin | Dashboard</title>
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

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
            </ol>
        </div>
        <!-- Row (Title Heading) -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Dashboard</div>
                </div>
            </div>
        </div>
        <br>
        <!-- Row (General Analytics p1) -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-teal">
                    <div class="panel-heading" style="text-align: left;">&nbsp;<em class="fa-solid fa-chart-pie">&nbsp;</em> General Analytics</div>
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
                                <h5>students</h5>
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
                        <div class="row main">
                            <div class="col-md-12">
                                <br>
                                <a href="admin-student-related-analytics-table.php"><button class="btn btn-primary" style="background-color: #f9243f; border: none;">View Student-Related Analytics</button></a>
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
                                <h5>tutors</h5>
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
                                <h5>subjects</h5>
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
                        <div class="row main">
                            <div class="col-md-12">
                                <br>
                                <a href="admin-subject-related-analytics-table.php"><button class="btn btn-primary" style="background-color: #ffb53e; border: none;">View Subject-Related Analytics</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row (General Analytics p3) -->
        <!--
        <div class="row main">
            <br>
            //Column
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <br>
                        //Column
                        <div class="col-md-1"></div>
                        //Column
                        <div class="col-md-10" style="width: 100%;">
                            //Table
                            <table id="table18" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fa fa-calendar"></span><br>Year</th>
                                        <th style="text-align: center"><span class="fas fa-eye"></span><br>View Stats</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        /*
                                        $year = 2023;
                                        while($year>=2023 && $year<=2099) {
                                        */
                                    ?>
                                    <tr>
                                        <td><?php //echo $year; ?></td>
                                        <td><a href="admin-general-analytics.php?year=<?php //echo $year; ?>"><button class="btn btn-primary">Go</button></a></td>
                                    </tr>
                                    <?php
                                        /*
                                            $year++;
                                        }
                                        */
                                    ?>
                                </tbody>
                            </table>
                            <br>
                        </div>
                        //Column
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
        -->
        <?php
            //GET NO OF PRIMARY SCHOOL STUDENTS, NO OF SECONDARY SCHOOL STUDENTS (2023)
            $sql = "SELECT * FROM students WHERE YEAR(studentRegistrationDate)='2023'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primaryStudentsCount2023 = 0;
                $secondaryStudentsCount2023 = 0;
            }
            else {
                $primaryStudentsCount2023 = 0;
                $secondaryStudentsCount2023 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['studentEducationLevel'] == "Primary") {
                        $primaryStudentsCount2023++;
                    }
                    else if($row['studentEducationLevel'] == "Secondary") {
                        $secondaryStudentsCount2023++;
                    }
                }
            }

            //GET NO OF PRIMARY SCHOOL STUDENTS, NO OF SECONDARY SCHOOL STUDENTS (2024)
            $sql = "SELECT * FROM students WHERE YEAR(studentRegistrationDate)='2024'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primaryStudentsCount2024 = 0;
                $secondaryStudentsCount2024 = 0;
            }
            else {
                $primaryStudentsCount2024 = 0;
                $secondaryStudentsCount2024 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['studentEducationLevel'] == "Primary") {
                        $primaryStudentsCount2024++;
                    }
                    else if($row['studentEducationLevel'] == "Secondary") {
                        $secondaryStudentsCount2024++;
                    }
                }
            }

            //GET NO OF PRIMARY SCHOOL STUDENTS, NO OF SECONDARY SCHOOL STUDENTS (2025)
            $sql = "SELECT * FROM students WHERE YEAR(studentRegistrationDate)='2025'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primaryStudentsCount2025 = 0;
                $secondaryStudentsCount2025 = 0;
            }
            else {
                $primaryStudentsCount2025 = 0;
                $secondaryStudentsCount2025 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['studentEducationLevel'] == "Primary") {
                        $primaryStudentsCount2025++;
                    }
                    else if($row['studentEducationLevel'] == "Secondary") {
                        $secondaryStudentsCount2025++;
                    }
                }
            }

            //GET NO OF PRIMARY SCHOOL STUDENTS, NO OF SECONDARY SCHOOL STUDENTS (2026)
            $sql = "SELECT * FROM students WHERE YEAR(studentRegistrationDate)='2026'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primaryStudentsCount2026 = 0;
                $secondaryStudentsCount2026 = 0;
            }
            else {
                $primaryStudentsCount2026 = 0;
                $secondaryStudentsCount2026 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['studentEducationLevel'] == "Primary") {
                        $primaryStudentsCount2026++;
                    }
                    else if($row['studentEducationLevel'] == "Secondary") {
                        $secondaryStudentsCount2026++;
                    }
                }
            }

            //GET NO OF PRIMARY SCHOOL STUDENTS, NO OF SECONDARY SCHOOL STUDENTS (2027)
            $sql = "SELECT * FROM students WHERE YEAR(studentRegistrationDate)='2027'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primaryStudentsCount2027 = 0;
                $secondaryStudentsCount2027 = 0;
            }
            else {
                $primaryStudentsCount2027 = 0;
                $secondaryStudentsCount2027 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['studentEducationLevel'] == "Primary") {
                        $primaryStudentsCount2027++;
                    }
                    else if($row['studentEducationLevel'] == "Secondary") {
                        $secondaryStudentsCount2027++;
                    }
                }
            }
        ?>
        <input type="hidden" id="primaryStudentsCount2023" value="<?php echo $primaryStudentsCount2023; ?>">
        <input type="hidden" id="secondaryStudentsCount2023" value="<?php echo $secondaryStudentsCount2023; ?>">
        <input type="hidden" id="primaryStudentsCount2024" value="<?php echo $primaryStudentsCount2024; ?>">
        <input type="hidden" id="secondaryStudentsCount2024" value="<?php echo $secondaryStudentsCount2024; ?>">
        <input type="hidden" id="primaryStudentsCount2025" value="<?php echo $primaryStudentsCount2025; ?>">
        <input type="hidden" id="secondaryStudentsCount2025" value="<?php echo $secondaryStudentsCount2025; ?>">
        <input type="hidden" id="primaryStudentsCount2026" value="<?php echo $primaryStudentsCount2026; ?>">
        <input type="hidden" id="secondaryStudentsCount2026" value="<?php echo $secondaryStudentsCount2026; ?>">
        <input type="hidden" id="primaryStudentsCount2027" value="<?php echo $primaryStudentsCount2027; ?>">
        <input type="hidden" id="secondaryStudentsCount2027" value="<?php echo $secondaryStudentsCount2027; ?>">
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <canvas id="myChart1" style="width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Row (General Analytics p4) -->
        <?php
            //GET TOTAL NO OF TUTORS (2023)
            $sql = "SELECT * FROM tutors WHERE tutorIsActive=1 AND YEAR(tutorStartDate)='2023'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalTutorsCount2023 = 0;
            }
            else {
                $totalTutorsCount2023 = 0;

                while($row = $result->fetch_assoc()) {
                    $totalTutorsCount2023++;
                }
            }

            //GET TOTAL NO OF TUTORS (2024)
            $sql = "SELECT * FROM tutors WHERE tutorIsActive=1 AND YEAR(tutorStartDate)='2024'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalTutorsCount2024 = 0;
            }
            else {
                $totalTutorsCount2024 = 0;

                while($row = $result->fetch_assoc()) {
                    $totalTutorsCount2024++;
                }
            }

            //GET TOTAL NO OF TUTORS (2025)
            $sql = "SELECT * FROM tutors WHERE tutorIsActive=1 AND YEAR(tutorStartDate)='2025'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalTutorsCount2025 = 0;
            }
            else {
                $totalTutorsCount2025 = 0;

                while($row = $result->fetch_assoc()) {
                    $totalTutorsCount2025++;
                }
            }

            //GET TOTAL NO OF TUTORS (2026)
            $sql = "SELECT * FROM tutors WHERE tutorIsActive=1 AND YEAR(tutorStartDate)='2026'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalTutorsCount2026 = 0;
            }
            else {
                $totalTutorsCount2026 = 0;

                while($row = $result->fetch_assoc()) {
                    $totalTutorsCount2026++;
                }
            }

            //GET TOTAL NO OF TUTORS (2027)
            $sql = "SELECT * FROM tutors WHERE tutorIsActive=1 AND YEAR(tutorStartDate)='2027'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalTutorsCount2027 = 0;
            }
            else {
                $totalTutorsCount2027 = 0;

                while($row = $result->fetch_assoc()) {
                    $totalTutorsCount2027++;
                }
            }
        ?>
        <input type="hidden" id="totalTutorsCount2023" value="<?php echo $totalTutorsCount2023; ?>">
        <input type="hidden" id="totalTutorsCount2024" value="<?php echo $totalTutorsCount2024; ?>">
        <input type="hidden" id="totalTutorsCount2025" value="<?php echo $totalTutorsCount2025; ?>">
        <input type="hidden" id="totalTutorsCount2026" value="<?php echo $totalTutorsCount2026; ?>">
        <input type="hidden" id="totalTutorsCount2027" value="<?php echo $totalTutorsCount2027; ?>">
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <canvas id="myChart2" style="width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Row (General Analytics p5) -->
        <?php
            //GET NO OF PRIMARY SCHOOL SUBJECTS, NO OF SECONDARY SCHOOL SUBJECTS (2023)
            $sql = "SELECT * FROM subjects WHERE YEAR(subjectCreationDate)='2023'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primarySubjectsCount2023 = 0;
                $secondarySubjectsCount2023 = 0;
            }
            else {
                $primarySubjectsCount2023 = 0;
                $secondarySubjectsCount2023 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['subjectEducationLevel'] == "Primary") {
                        $primarySubjectsCount2023++;
                    }
                    else if($row['subjectEducationLevel'] == "Secondary") {
                        $secondarySubjectsCount2023++;
                    }
                }
            }

            //GET NO OF PRIMARY SCHOOL SUBJECTS, NO OF SECONDARY SCHOOL SUBJECTS (2024)
            $sql = "SELECT * FROM subjects WHERE YEAR(subjectCreationDate)='2024'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primarySubjectsCount2024 = 0;
                $secondarySubjectsCount2024 = 0;
            }
            else {
                $primarySubjectsCount2024 = 0;
                $secondarySubjectsCount2024 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['subjectEducationLevel'] == "Primary") {
                        $primarySubjectsCount2024++;
                    }
                    else if($row['subjectEducationLevel'] == "Secondary") {
                        $secondarySubjectsCount2024++;
                    }
                }
            }

            //GET NO OF PRIMARY SCHOOL SUBJECTS, NO OF SECONDARY SCHOOL SUBJECTS (2025)
            $sql = "SELECT * FROM subjects WHERE YEAR(subjectCreationDate)='2025'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primarySubjectsCount2025 = 0;
                $secondarySubjectsCount2025 = 0;
            }
            else {
                $primarySubjectsCount2025 = 0;
                $secondarySubjectsCount2025 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['subjectEducationLevel'] == "Primary") {
                        $primarySubjectsCount2025++;
                    }
                    else if($row['subjectEducationLevel'] == "Secondary") {
                        $secondarySubjectsCount2025++;
                    }
                }
            }

            //GET NO OF PRIMARY SCHOOL SUBJECTS, NO OF SECONDARY SCHOOL SUBJECTS (2026)
            $sql = "SELECT * FROM subjects WHERE YEAR(subjectCreationDate)='2026'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primarySubjectsCount2026 = 0;
                $secondarySubjectsCount2026 = 0;
            }
            else {
                $primarySubjectsCount2026 = 0;
                $secondarySubjectsCount2026 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['subjectEducationLevel'] == "Primary") {
                        $primarySubjectsCount2026++;
                    }
                    else if($row['subjectEducationLevel'] == "Secondary") {
                        $secondarySubjectsCount2026++;
                    }
                }
            }

            //GET NO OF PRIMARY SCHOOL SUBJECTS, NO OF SECONDARY SCHOOL SUBJECTS (2027)
            $sql = "SELECT * FROM subjects WHERE YEAR(subjectCreationDate)='2027'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $primarySubjectsCount2027 = 0;
                $secondarySubjectsCount2027 = 0;
            }
            else {
                $primarySubjectsCount2027 = 0;
                $secondarySubjectsCount2027 = 0;

                while($row = $result->fetch_assoc()) {
                    if($row['subjectEducationLevel'] == "Primary") {
                        $primarySubjectsCount2027++;
                    }
                    else if($row['subjectEducationLevel'] == "Secondary") {
                        $secondarySubjectsCount2027++;
                    }
                }
            }
        ?>
        <input type="hidden" id="primarySubjectsCount2023" value="<?php echo $primarySubjectsCount2023; ?>">
        <input type="hidden" id="secondarySubjectsCount2023" value="<?php echo $secondarySubjectsCount2023; ?>">
        <input type="hidden" id="primarySubjectsCount2024" value="<?php echo $primarySubjectsCount2024; ?>">
        <input type="hidden" id="secondarySubjectsCount2024" value="<?php echo $secondarySubjectsCount2024; ?>">
        <input type="hidden" id="primarySubjectsCount2025" value="<?php echo $primarySubjectsCount2025; ?>">
        <input type="hidden" id="secondarySubjectsCount2025" value="<?php echo $secondarySubjectsCount2025; ?>">
        <input type="hidden" id="primarySubjectsCount2026" value="<?php echo $primarySubjectsCount2026; ?>">
        <input type="hidden" id="secondarySubjectsCount2026" value="<?php echo $secondarySubjectsCount2026; ?>">
        <input type="hidden" id="primarySubjectsCount2027" value="<?php echo $primarySubjectsCount2027; ?>">
        <input type="hidden" id="secondarySubjectsCount2027" value="<?php echo $secondarySubjectsCount2027; ?>">
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <canvas id="myChart3" style="width: 100%;"></canvas>
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
        //$(document).ready(function () {
            //$('#table18').DataTable();
            //$('#table19').DataTable();
            //$('#table20').DataTable();
        //});
    </script>
    <script>
        //Chart.js (Student)
        var primaryStudentsCount2023 = document.getElementById("primaryStudentsCount2023");
        var secondaryStudentsCount2023 = document.getElementById("secondaryStudentsCount2023");
        var primaryStudentsCount2024 = document.getElementById("primaryStudentsCount2024");
        var secondaryStudentsCount2024 = document.getElementById("secondaryStudentsCount2024");
        var primaryStudentsCount2025 = document.getElementById("primaryStudentsCount2025");
        var secondaryStudentsCount2025 = document.getElementById("secondaryStudentsCount2025");
        var primaryStudentsCount2026 = document.getElementById("primaryStudentsCount2026");
        var secondaryStudentsCount2026 = document.getElementById("secondaryStudentsCount2026");
        var primaryStudentsCount2027 = document.getElementById("primaryStudentsCount2027");
        var secondaryStudentsCount2027 = document.getElementById("secondaryStudentsCount2027");

        var primaryStudentsCount2023Value = primaryStudentsCount2023.value;
        var secondaryStudentsCount2023Value = secondaryStudentsCount2023.value;
        var primaryStudentsCount2024Value = primaryStudentsCount2024.value;
        var secondaryStudentsCount2024Value = secondaryStudentsCount2024.value;
        var primaryStudentsCount2025Value = primaryStudentsCount2025.value;
        var secondaryStudentsCount2025Value = secondaryStudentsCount2025.value;
        var primaryStudentsCount2026Value = primaryStudentsCount2026.value;
        var secondaryStudentsCount2026Value = secondaryStudentsCount2026.value;
        var primaryStudentsCount2027Value = primaryStudentsCount2027.value;
        var secondaryStudentsCount2027Value = secondaryStudentsCount2027.value;

        const xValuesStudent = [2023, 2024, 2025, 2026, 2027];
        const yValuesStudent1 = [primaryStudentsCount2023Value, primaryStudentsCount2024Value, primaryStudentsCount2025Value, primaryStudentsCount2026Value, primaryStudentsCount2027Value];
        const yValuesStudent2 = [secondaryStudentsCount2023Value, secondaryStudentsCount2024Value, secondaryStudentsCount2025Value, secondaryStudentsCount2026Value, secondaryStudentsCount2027Value];

        new Chart("myChart1", {
            type: "line",
            data: {
                labels: xValuesStudent,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "#0045a5",
                    borderColor: "#0045a5",
                    data: yValuesStudent1
                },
                {
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "#00c698",
                    borderColor: "#00c698",
                    data: yValuesStudent2
                }]
            },
            options: {
                legend: {display: false},
                scales: {
                    yAxes: [{ticks: {min: 0, max: 20}}]
                },
                title: {
                    display: true,
                    text: "Number of new students by year (Primary: Blue  |  Secondary: Green)"
                }
            }
        });
    </script>
    <script>
        //Chart.js (Tutor)
        var totalTutorsCount2023 = document.getElementById("totalTutorsCount2023");
        var totalTutorsCount2024 = document.getElementById("totalTutorsCount2024");
        var totalTutorsCount2025 = document.getElementById("totalTutorsCount2025");
        var totalTutorsCount2026 = document.getElementById("totalTutorsCount2026");
        var totalTutorsCount2027 = document.getElementById("totalTutorsCount2027");

        var totalTutorsCount2023Value = totalTutorsCount2023.value;
        var totalTutorsCount2024Value = totalTutorsCount2024.value;
        var totalTutorsCount2025Value = totalTutorsCount2025.value;
        var totalTutorsCount2026Value = totalTutorsCount2026.value;
        var totalTutorsCount2027Value = totalTutorsCount2027.value;

        const xValuesTutor = [2023, 2024, 2025, 2026, 2027];
        const yValuesTutor = [totalTutorsCount2023Value, totalTutorsCount2024Value, totalTutorsCount2025Value, totalTutorsCount2026Value, totalTutorsCount2027Value];

        new Chart("myChart2", {
            type: "line",
            data: {
                labels: xValuesTutor,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "#008ac5",
                    borderColor: "#008ac5",
                    data: yValuesTutor
                }]
            },
            options: {
                legend: {display: false},
                scales: {
                    yAxes: [{ticks: {min: 0, max: 20}}]
                },
                title: {
                    display: true,
                    text: "Number of new tutors by year"
                }
            }
        });
    </script>
    <script>
        //Chart.js (Subject)
        var primarySubjectsCount2023 = document.getElementById("primarySubjectsCount2023");
        var secondarySubjectsCount2023 = document.getElementById("secondarySubjectsCount2023");
        var primarySubjectsCount2024 = document.getElementById("primarySubjectsCount2024");
        var secondarySubjectsCount2024 = document.getElementById("secondarySubjectsCount2024");
        var primarySubjectsCount2025 = document.getElementById("primarySubjectsCount2025");
        var secondarySubjectsCount2025 = document.getElementById("secondarySubjectsCount2025");
        var primarySubjectsCount2026 = document.getElementById("primarySubjectsCount2026");
        var secondarySubjectsCount2026 = document.getElementById("secondarySubjectsCount2026");
        var primarySubjectsCount2027 = document.getElementById("primarySubjectsCount2027");
        var secondarySubjectsCount2027 = document.getElementById("secondarySubjectsCount2027");

        var primarySubjectsCount2023Value = primarySubjectsCount2023.value;
        var secondarySubjectsCount2023Value = secondarySubjectsCount2023.value;
        var primarySubjectsCount2024Value = primarySubjectsCount2024.value;
        var secondarySubjectsCount2024Value = secondarySubjectsCount2024.value;
        var primarySubjectsCount2025Value = primarySubjectsCount2025.value;
        var secondarySubjectsCount2025Value = secondarySubjectsCount2025.value;
        var primarySubjectsCount2026Value = primarySubjectsCount2026.value;
        var secondarySubjectsCount2026Value = secondarySubjectsCount2026.value;
        var primarySubjectsCount2027Value = primarySubjectsCount2027.value;
        var secondarySubjectsCount2027Value = secondarySubjectsCount2027.value;

        const xValuesSubject = [2023, 2024, 2025, 2026, 2027];
        const yValuesSubject1 = [primarySubjectsCount2023Value, primarySubjectsCount2024Value, primarySubjectsCount2025Value, primarySubjectsCount2026Value, primarySubjectsCount2027Value];
        const yValuesSubject2 = [secondarySubjectsCount2023Value, secondarySubjectsCount2024Value, secondarySubjectsCount2025Value, secondarySubjectsCount2026Value, secondarySubjectsCount2027Value];

        new Chart("myChart3", {
            type: "line",
            data: {
                labels: xValuesSubject,
                datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "#0045a5",
                    borderColor: "#0045a5",
                    data: yValuesSubject1
                },
                {
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "#00c698",
                    borderColor: "#00c698",
                    data: yValuesSubject2
                }]
            },
            options: {
                legend: {display: false},
                scales: {
                    yAxes: [{ticks: {min: 0, max: 20}}]
                },
                title: {
                    display: true,
                    text: "Number of new subjects by year (Primary: Blue  |  Secondary: Green)"
                }
            }
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
