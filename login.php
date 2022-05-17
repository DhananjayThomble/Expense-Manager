<?php
require("includes/common.php");
// Redirects the user to products page if logged in.
if (isset($_SESSION['user_id'])) {
    header('location: dashboard.php');
}
$pageName = "login";
?>
<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php include "includes/headTag.php"; ?>

<body>
    <!-- header -->
    <?php include 'includes/header.php'; ?>
    <!-- header -->

    <!-- main -->
    <!-- login page -->
    <div class="container-fluid" id="cont1">
        <div class="row row_style">
            <div class="col-lg-6">
                <div class="panel panel-info panel1">
                    <div class="panel-heading ">
                        <center>
                            <h3>Login</h3>
                        </center>
                    </div>

                    <div class="panel-body bg-info">

                        <form action="login_submit.php" method="POST">
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Email: </label>
                                <input type="email" class="form-control" placeholder="Email" name="email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" oninvalid="setCustomValidity('Please enter the valid email')" oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Password: </label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required="true" pattern=".{6,}" oninvalid="setCustomValidity('Please check your password')" oninput="setCustomValidity('')">
                            </div>
                            <button type="submit" name="submit" class="btn btn-info btn-block "> LOGIN </button><br><br>

                        </form><br />
                    </div>
                    <div class="panel-footer">
                        <p>Don't have an account? <a href="signup.php"> click here to Sign Up. </a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- main -->

    <!-- footer -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>