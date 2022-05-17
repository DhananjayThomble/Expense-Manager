<?php
// set the connection object and start the session;
require("includes/common.php");

// Redirects the user to Dashboard page if he/she is logged in.
if (isset($_SESSION['user_id'])) {
  header('location: dashboard.php');
}
// Using the global variable for storing the page name, to use in the navbar.
$pageName = "index";
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/headTag.php"; ?>

<body style="padding-top: 50px;">
    <!-- Header -->
    <?php
    include 'includes/header.php';
    ?>
    <!--Header end-->

    <div id="content">
        <!--Main banner image-->
        <div id="banner_image">
            <div class="container">
                <center>
                    <div id="banner_content">
                       
                        <h1>We help you control your budget</h1>
                        <br />
                        <a href="login.php" class="btn btn-success btn-lg btnNewPlan">Start Today</a>
                    </div>
                </center>
            </div>
        </div>
        <!--Main banner image end-->

    </div>

    <!--Footer-->
    <?php
    include 'includes/footer.php';
    ?>
    <!--Footer end-->

</body>

</html>