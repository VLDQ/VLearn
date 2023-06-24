<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn | Home</title>
    <link rel="icon" type="image/png" href="images/VLearn-logo1.png" sizes="113x113">

    <!-- Styles -->
    <?php
        include('includes/head-styles.php'); //include head styles
    ?>
</head>
<!-- end of head -->

<!-- start of body -->
<body>
    <!-- Header -->
	<?php
        //include_once('includes/header.php');
    ?>

    <div class="container">
        <!-- Row 1 -->
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-2"></div>
            <!-- Column 2 -->
            <div class="col-md-8 style-primary">
                <a href="index.php">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <br>
                            <p><img src="images/VLearn-logo1.png" width="230" height="230"></p>
                            <h1><b>VLearn</b></h1>
                            <h2>A Web-based Tuition Management System</h2>
                            <br>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Column 3 -->
            <div class="col-md-2"></div>
        </div>
        <br><br><br>

        <!-- Row 2 -->
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-4">
                <a href="student-home.php" target="_blank">
                    <div class="style-secondary">
                        <div class="panel-body easypiechart-panel">
                            <br>
                            <h4>STUDENT PORTAL</h4>
                            <br>
                            <p><img src="images/student-icon.png" width="200" height="200"></p>
                            <br>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Column 2 -->
            <div class="col-md-4">
                <a href="tutor-home.php" target="_blank">
                    <div class="style-secondary">
                        <div class="panel-body easypiechart-panel">
                            <br>
                            <h4>TUTOR PORTAL</h4>
                            <br>
                            <p><img src="images/tutor-icon.png" width="200" height="200"></p>
                            <br>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Column 3 -->
            <div class="col-md-4">
                <a href="admin-home.php" target="_blank">
                    <div class="style-secondary">
                        <div class="panel-body easypiechart-panel">
                            <br>
                            <h4>ADMIN PORTAL</h4>
                            <br>
                            <p><img src="images/admin-icon.png" width="200" height="200"></p>
                            <br>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <br><br><br>
    </div>

	<!-- Footer -->
	<?php
        include_once('includes/footer.php');
    ?>

    <!-- JavaScript -->
</body>
<!-- end of body -->

</html>
<!-- end of html -->
