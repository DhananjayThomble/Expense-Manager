<?php
require("includes/common.php");

if (!isset($_SESSION['user_id'])) {
  header('location: login.php');
}
global $pageName;
$pageName = "change_password";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/headTag.php"; ?>

<body>

    <?php include "includes/header.php"; ?>

    <!-- Change Password -->


    <div class="container-fluid" id="cont1">
        <div class="row row_style">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <center>
                            <h3>Change Password</h3>
                        </center>

                        <form action="change_password_script.php" method="post">
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Old Password:</label>
                                <input type="password" class="form-control" placeholder="Old Password" name="oldPassword" required="true" pattern=".{6,}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> New Password: </label>
                                <input type="password" class="form-control" placeholder="New Password (Min. 6 charecters)" name="newPassword" required="true" pattern=".{6,}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Confirm New Password : </label>
                                <input type="password" class="form-control" placeholder="Re-type New password" name="confirmNewPassword" required="true" pattern=".{6,}">
                            </div>

                            <button type="submit" class=" btn btn-primary btn-lg btn-block "> Change </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Change Password -->


    <?php include "includes/footer.php"; ?>
</body>

</html>