<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(strlen($_SESSION['VLearnAdminSessionCounter']) == 0) {
        header('location:admin-logout-auto.php'); //logs out the admin if the info in the session is being cleared
    }
    else {
        $adminName = $_SESSION['VLearnAdminSessionCounter']; //stores info from session

        if(isset($_GET['subjectId']) && is_numeric($_GET['subjectId'])) {
            $subjectId = $_GET['subjectId']; //retrieves subject id from GET

            //GET SUBJECT NAME & SUBJECT CODE
            $sql = "SELECT subjectName, subjectCode FROM subjects WHERE subjectId=$subjectId";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $subjectName = "N/A";
                $subjectCode = "N/A";
            }
            else {
                while($row = $result->fetch_assoc()) {
                    $subjectName = $row['subjectName'];
                    $subjectCode = $row['subjectCode'];
                }
            }

            //GET TOTAL NO OF STUDENTS
            $sql = "SELECT * FROM overallgrades WHERE subjectId=$subjectId";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) == 0) {
                $totalStudentsCount = 0;
            }
            else {
                $totalStudentsCount = 0;

                while($row = $result->fetch_assoc()) {
                    $totalStudentsCount++;
                }
            }
        }
        else {
            echo "<script>alert('Something went wrong! Please try again.');</script>"; //displays error message via alert box
            header('location:admin-home.php'); //redirects to homepage
        }

        //GET COUNT OF EACH GRADE (p1)
        $naCount = 0;
        $apCount = 0;
        $aCount = 0;
        $amCount = 0;
        $bpCount = 0;
        $bCount = 0;
        $cpCount = 0;
        $cCount = 0;
        $dCount = 0;
        $eCount = 0;
        $gCount = 0;
?>

<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Admin | Subject-Related Analytics (Individual Stats)</title>
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
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Subject-Related Analytics</li>
                <li style="color: #999999;">&nbsp; / &nbsp;</li>
                <li>Subject-Related Analytics (Individual Stats)</li>
            </ol>
        </div>
        <!-- Row (Subject-Related Analytics p1) -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-orange">
                    <div class="panel-heading" style="text-align: left;">&nbsp;<em class="fa-solid fa-chart-pie">&nbsp;</em> Subject-Related Analytics (Subject: <?php echo $subjectName; ?> | <?php echo $subjectCode; ?>)</div>
                </div>
            </div>
        </div>
        <!-- Row (Subject-Related Analytics p2) -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <div class="row main">
                            <div class="col-md-12" style="text-align: left;">
                                <h5><span class="fas fa-user-graduate" aria-hidden="true"></span>&nbsp;Total number of students: </h5>
                                <h1 style="font-weight: 800; color: #999999;"><?php echo $totalStudentsCount; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row (Subject-Related Analytics p3) -->
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
                            <table id="table21" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="text-align: center"><span class="fas fa-user-graduate"></span><br>Student Name</th>
                                        <th style="text-align: center"><span class="fa fa-envelope"></span><br>Student Email</th>
                                        <th style="text-align: center"><span class="fa fa-check"></span><br>Grade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $qry = "SELECT studentId, overallGradeObtained FROM overallgrades WHERE subjectId=$subjectId";
                                        $res = mysqli_query($con, $qry);
                                        if(mysqli_num_rows($res) == 0) {
                                            echo "<p class='message'>No records found.</p>"; //displays message if no records found
                                        }
                                        else {
                                            while($grow = $res->fetch_assoc()) {
                                                $studentId = $grow['studentId'];
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
                                        <td><?php echo $grow['overallGradeObtained']; ?></td>
                                    </tr>
                                    <?php
                                                //GET COUNT OF EACH GRADE (p2)
                                                if($grow['overallGradeObtained'] == "N/A") {
                                                    $naCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "A+") {
                                                    $apCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "A") {
                                                    $aCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "A-") {
                                                    $amCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "B+") {
                                                    $bpCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "B") {
                                                    $bCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "C+") {
                                                    $cpCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "C") {
                                                    $cCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "D") {
                                                    $dCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "E") {
                                                    $eCount++;
                                                }
                                                else if($grow['overallGradeObtained'] == "G") {
                                                    $gCount++;
                                                }
                                            }
                                        }
                                    ?>
                                    <input type="hidden" id="naCount" value="<?php echo $naCount; ?>">
                                    <input type="hidden" id="apCount" value="<?php echo $apCount; ?>">
                                    <input type="hidden" id="aCount" value="<?php echo $aCount; ?>">
                                    <input type="hidden" id="amCount" value="<?php echo $amCount; ?>">
                                    <input type="hidden" id="bpCount" value="<?php echo $bpCount; ?>">
                                    <input type="hidden" id="bCount" value="<?php echo $bCount; ?>">
                                    <input type="hidden" id="cpCount" value="<?php echo $cpCount; ?>">
                                    <input type="hidden" id="cCount" value="<?php echo $cCount; ?>">
                                    <input type="hidden" id="dCount" value="<?php echo $dCount; ?>">
                                    <input type="hidden" id="eCount" value="<?php echo $eCount; ?>">
                                    <input type="hidden" id="gCount" value="<?php echo $gCount; ?>">
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
        <!-- Row (Subject-Related Analytics p4) -->
        <div class="row main">
            <!-- Column -->
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body easypiechart-panel">
                        <canvas id="myChart" style="width: 100%;"></canvas>
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
            $('#table21').DataTable();
        });
    </script>
    <script>
        //Chart.js
        var naCount = document.getElementById("naCount");
        var apCount = document.getElementById("apCount");
        var aCount = document.getElementById("aCount");
        var amCount = document.getElementById("amCount");
        var bpCount = document.getElementById("bpCount");
        var bCount = document.getElementById("bCount");
        var cpCount = document.getElementById("cpCount");
        var cCount = document.getElementById("cCount");
        var dCount = document.getElementById("dCount");
        var eCount = document.getElementById("eCount");
        var gCount = document.getElementById("gCount");

        var naCountValue = naCount.value;
        var apCountValue = apCount.value;
        var aCountValue = aCount.value;
        var amCountValue = amCount.value;
        var bpCountValue = bpCount.value;
        var bCountValue = bCount.value;
        var cpCountValue = cpCount.value;
        var cCountValue = cCount.value;
        var dCountValue = dCount.value;
        var eCountValue = eCount.value;
        var gCountValue = gCount.value;

        var xValues = ["N/A", "A+", "A", "A-", "B+", "B", "C+", "C", "D", "E", "G"];
        var yValues = [naCountValue, apCountValue, aCountValue, amCountValue, bpCountValue, bCountValue, cpCountValue, cCountValue, dCountValue, eCountValue, gCountValue];
        var barColors = [
        "#00008B",
        "#C94D6D",
        "#E4BF58",
        "#3C9D4E",
        "#00ABA9",
        "#4174C9",
        "#7031AC",
        "#E8C3B9",
        "#C1C1C1",
        "#804A00",
        "#3D3D3D"
        ];

        new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "Grade"
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
