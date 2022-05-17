<?php
require("includes/common.php");
if (isset($_SESSION['user_id'])) {
    header('location: dashboard.php');
}
$pageName = "signup";
?>
<!DOCTYPE html>
<html lang="en">

<!-- Head Tag -->
<?php include "includes/headTag.php"; ?>

<body>
    <!-- Header start -->
    <?php include 'includes/header.php'; ?>
    <!-- Header end -->

    <!--sign up -->

    <div class="container-fluid" id="cont1">
        <div class="row row_style">
            <div class="col-lg-6">
                <div class="panel panel-info panel1">
                    <div class="panel-heading" id="">
                        <center>
                            <h3 class="fancyHeading">Sign up</h3>
                        </center>
                    </div>
                    <div class="panel-body bg-info" id="">
                        <form class="form" action="signup_script.php" method="POST">

                            <div class="form-group">
                                <label for="name"> Name:</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="name" required="true" pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" oninvalid="setCustomValidity('Please enter the name')" oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label for="email"> Email: </label>
                                <input type="email" class="form-control" placeholder="Enter valid email" name="email" required="true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" oninvalid="setCustomValidity('Please enter the valid email')" oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Password: </label>
                                <input type="password" class="form-control" placeholder="Enter Password (min. 6 characters)" name="password" required="true" pattern=".{6,}" oninvalid="setCustomValidity('Please enter the minimum 6 characters')" oninput="setCustomValidity('')">

                            </div>

                            <div class="form-group">
                                <label for="phoneNumber"> Phone Number: </label>

                                <input class="form-control" placeholder="Enter valid Phone Number(Ex: 8448444853)" name="phoneNo" required=" true" maxlength="10" size="10" pattern="[0-9]{10}$" oninvalid="setCustomValidity('Please enter the valid 10 digits number')" oninput="setCustomValidity('')">
                            </div>

                            <button type="submit" class=" btn btn-info btn-lg btn-block">SIGN UP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end sign up-->

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>
</body>

</html>