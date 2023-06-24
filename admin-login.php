<?php
    session_start(); //starts the session
    error_reporting(0); //turns off error reporting

    include('includes/database-connection.php'); //include database connection

    if(isset($_POST['submit'])) {
        $adminEmail = $_POST['adminEmail']; //retrieves form data
        $adminPassword = md5($_POST['adminPassword']); //retrieves form data (with MD5 hash algorithm)

        /*
        //test output
        echo "$adminEmail <br>";
        echo "$adminPassword";
        */

        if($adminEmail=="admin@vlearn.com" && $adminPassword==md5("admin_vlearn")) {
            $_SESSION['VLearnAdminSessionCounter'] = "Admin"; //stores into session
            header('location:admin-home.php'); //redirects to admin home page if the email and password are correct
        }
        else {
            echo "<script>alert('Invalid credentials! Please try again.');</script>"; //displays error message via alert box
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
	<title>VLearn for Admin | Login</title>
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
        //include_once('includes/admin-header.php');
    ?>

    <div class="container">
        <!-- Row -->
        <div class="row">
            <h1 align="center"><a href="index.php"><img src="images/VLearn-logo2.png" width="180px"/></a></h1>
            <h1 align="center"><b>VLearn for Admin</b></h1>
            <br><br><br><br>

            <!-- Column -->
            <div class="col-xs-10 offset-xs-1 col-sm-8 offset-sm-2 col-md-6 offset-md-3">
                <div class="style-primary">
                    <br>
                    <!-- Login Form Title -->
                    <div class="panel-heading">Admin Login</div>
                    <hr>
                    <div class="panel">
                        <!-- Login Form -->
                        <form role="form" action="" method="post" id="" name="loginForm">
                            <p class="message" align="center"> <?php //if($msg) { echo $msg; } ?> </p>
                            <fieldset>
                                <!-- Email -->
                                <div class="form-group">
                                    <p class="form-field-title">Email:</p>
                                    <input type="email" class="form-control" name="adminEmail" placeholder="Enter email" required="true">
                                </div>
                                <!-- Password -->
                                <div class="form-group">
                                    <p class="form-field-title">Password:</p>
                                    <input type="password" class="form-control" name="adminPassword" placeholder="Enter password" id="adminPassword" required="true">
                                    <input type="checkbox" onclick="showAdminPassword()">&nbsp<small>Show Password</small>
                                </div>
                                <!-- Login Button -->
                                <div class="form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-submit" name="submit" value="submit"><b>LOGIN</b></button>
                                    <br><br><br>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>

	<!-- Footer -->
	<?php
        include_once('includes/footer.php');
    ?>

    <!-- JavaScript -->
    <script type="text/javascript">
        /*---------------------------------
          Function to show admin password
        ---------------------------------*/
        function showAdminPassword() {
            var x = document.getElementById("adminPassword"); //stores the id of input field for admin password

            if(x.type === "password") {
                x.type = "text"; //sets the input type as text
            }
            else {
                x.type = "password"; //sets the input type as password
            }
        }
    </script>
</body>
<!-- end of body -->

</html>
<!-- end of html -->
