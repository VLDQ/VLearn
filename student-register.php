<!DOCTYPE html>
<!-- start of html -->
<html lang="en">

<!-- start of head -->
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VLearn for Students | Registration</title>
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
        //include_once('includes/student-header.php');
    ?>

    <div class="container">
        <!-- Row 1 -->
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-2"></div>
            <!-- Column 2 -->
            <div class="col-md-8">
                <div class="panel-body easypiechart-panel">
                    <br>
                    <h2><i>I am a student from ...</i></h2>
                </div>
            </div>
            <!-- Column 3 -->
            <div class="col-md-2"></div>
        </div>
        <br><br><br>

        <!-- Row 2 -->
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-1"></div>
            <!-- Column 2 -->
            <div class="col-md-4">
                <a href="student-primary-register.php">
                    <div class="style-secondary">
                        <div class="panel-body easypiechart-panel">
                            <br>
                            <h4>PRIMARY SCHOOL</h4>
                            <br>
                            <p><img src="images/primarySchool-icon.png" width="200" height="200"></p>
                            <br>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Column 3 -->
            <div class="col-md-2"></div>
            <!-- Column 4 -->
            <div class="col-md-4">
                <a href="student-secondary-register.php">
                    <div class="style-secondary">
                        <div class="panel-body easypiechart-panel">
                            <br>
                            <h4>SECONDARY SCHOOL</h4>
                            <br>
                            <p><img src="images/secondarySchool-icon.png" width="200" height="200"></p>
                            <br>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Column 5 -->
            <div class="col-md-1"></div>
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
