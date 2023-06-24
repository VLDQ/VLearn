<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection
?>

<!-- Sidebar -->
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <!-- Profile -->
    <div class="profile-sidebar">
        <!-- Student Icon -->
        <div class="profile-userpic">
            <img src="images/student-icon.png" class="img-responsive">
        </div>
        <!-- Student Name & Logout -->
        <div class="profile-usertitle">
            <?php
                $studentId = $_SESSION['VLearnStudentSessionCounter']; //stores student id from session
                $ret = mysqli_query($con, "SELECT studentName FROM students WHERE studentId=$studentId"); //defines query to get the student name that matches the student id
                $row = mysqli_fetch_array($ret); //fetches result
                $studentName = $row['studentName']; //stores the student name
            ?>
            <div class="profile-usertitle-name">
                <?php
                    echo $studentName; //displays student name
                ?>
            </div>
            <div class="profile-usertitle-status">
                <span class="indicator label-success"></span>Online
            </div>
            <div class="profile-logout">
                <a href="student-logout.php?logout=true"><i class="fa fa-power-off fa-lg" style="font-size: 12px; color: #0066cc;" aria-hidden="true">&nbsp;</i> Logout</a>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Nav Menu -->
    <ul class="nav menu">
        <!-- My Subjects -->
        <li
            <?php
                if(PAGE == 'MySubjects') {
                    echo "class='active'"; //sets as active if the named constant matches
                }
            ?>
        >
            <a href="student-home.php"><em class="fa fa-book">&nbsp;</em> My Subjects</a>
        </li>
        <!-- Profile Update -->
        <li
            <?php
                if(PAGE == 'ProfileUpdate') {
                    echo "class='active'"; //sets as active if the named constant matches
                }
            ?>
        >
            <a href="student-profile-update.php"><em class="fa-solid fa-user-pen">&nbsp;</em> Profile Update</a>
        </li>
    </ul>
</div>
