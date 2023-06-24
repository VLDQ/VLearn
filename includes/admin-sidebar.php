<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection
?>

<!-- Sidebar -->
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <!-- Profile -->
    <div class="profile-sidebar">
        <!-- Admin Icon -->
        <div class="profile-userpic">
            <img src="images/admin-icon.png" class="img-responsive">
        </div>
        <!-- Admin Name & Logout -->
        <div class="profile-usertitle">
            <?php
                $adminName = $_SESSION['VLearnAdminSessionCounter']; //stores info from session
            ?>
            <div class="profile-usertitle-name">
                <?php
                    echo $adminName; //displays admin name
                ?>
            </div>
            <div class="profile-usertitle-status">
                <span class="indicator label-success"></span>Online
            </div>
            <div class="profile-logout">
                <a href="admin-logout.php?logout=true"><i class="fa fa-power-off fa-lg" style="font-size: 12px; color: #0066cc;" aria-hidden="true">&nbsp;</i> Logout</a>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Nav Menu -->
    <ul class="nav menu">
        <!-- Dashboard -->
        <li
            <?php
                if(PAGE == 'Dashboard') {
                    echo "class='active'"; //sets as active if the named constant matches
                }
            ?>
        >
            <a href="admin-home.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
        </li>
        <!-- Student List -->
        <li
            <?php
                if(PAGE == 'StudentList') {
                    echo "class='active'"; //sets as active if the named constant matches
                }
            ?>
        >
            <a href="admin-student-list.php"><em class="fas fa-user-graduate">&nbsp;</em> Student List</a>
        </li>
        <!-- Tutor List -->
        <li
            <?php
                if(PAGE == 'TutorList') {
                    echo "class='active'"; //sets as active if the named constant matches
                }
            ?>
        >
            <a href="admin-tutor-list.php"><em class="fas fa-chalkboard-teacher">&nbsp;</em> Tutor List</a>
        </li>
        <!-- Subject List -->
        <li
            <?php
                if(PAGE == 'SubjectList') {
                    echo "class='active'"; //sets as active if the named constant matches
                }
            ?>
        >
            <a href="admin-subject-list.php"><em class="fa fa-book">&nbsp;</em> Subject List</a>
        </li>
        <!-- Enrolment -->
        <li
            <?php
                if(PAGE == 'Enrolment') {
                    echo "class='active'"; //sets as active if the named constant matches
                }
            ?>
        >
            <a href="admin-enrolment.php"><em class="fa fa-user-plus">&nbsp;</em> Enrolment</a>
        </li>
    </ul>
</div>
