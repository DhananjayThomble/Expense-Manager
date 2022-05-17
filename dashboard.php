<?php
require("includes/common.php");

// Redirects the user to Login page if he/she is NOT logged in.
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/headTag.php"; ?>
</head>

<body>

    <?php include "includes/header.php"; ?>


    <div id="afterHeader">
        <?php if (isPlanCreated($con)) { 
            // if plan is already created 
            header("location:showPlans.php");
        ?>
        <?php } else { ?>
            <!-- If plan is not made yet -->
            <h3>You don't have any active plans</h3>
            <?php noActivePlan(); ?>

        <?php } ?>
    </div>


    <?php include "includes/footer.php"; ?>

</body>

</html>



<?php
function noActivePlan()
{
?>
    <div id="cont1">
        <div class="panel panel-default" style="padding: 50px;">
            <div class="panel-body">
                <center>
                    <a href="new_plan.php" class="noUnderline" >
                        <h4 id="titlePlan"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Create a New Plan</h4>
                    </a </center>
            </div>
        </div>
    </div>

<?php }
?>

<?php
function isPlanCreated($connection)
{
    $con = $connection;
    $query = "select id from plan where user_id = '{$_SESSION['user_id']}' ";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    $num = mysqli_num_rows($result);
    if ($num > 0) {
        return true;
    }
    return false;
}

?>