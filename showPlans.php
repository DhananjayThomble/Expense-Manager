<?php
require("includes/common.php");

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ctrl Budget</title>
<link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="css/showPlan.css">

<body>

    <?php include "includes/header.php"; ?>

    <div class="container" id="afterHeader">
      
        <?php
        $userId = $_SESSION['user_id'];
        $query = "select * from plan where user_id = $userId";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        if (mysqli_num_rows($result) >= 1) {
            while ($row = mysqli_fetch_array($result)) {


        ?>
                <!-- 1st box -->
                <div class="col-md-4 col-lg-4">

                    <div class="panel panel-default">
                        <div class="panel-heading" id="panelNewPlan">
                            <h3 class="panel-title"><?php echo $row['title']; ?>
                                <span class="text-right"><?php echo $row['peoples_in_grp']; ?></span>
                                <span class="glyphicon glyphicon-user text-right"></span>
                            </h3>
                        </div>
                        <div class="panel-body">

                            <div>
                                <h5><b>Budget</b> <span class="text-right"><?php echo $row['initial_budget']; ?></span> </h5>
                            </div>

                            <div>
                                <h5><b>Date</b> <span class="text-right">
                                        <?php echo date("jS F", strtotime($row['date_from'])) . " - "; ?>
                                        <?php echo date("jS F Y", strtotime($row['date_to'])); ?> </span> </h5>
                            </div>
                            <a class="noUnderline" href="viewPlan.php?planId=<?php echo $row['id']; ?>">
                                <button  type="button" class="btn btn-block btnNewPlan">View Plan</button>
                            </a>

                        </div>
                    </div>

                </div>
                <!-- End 1st box -->
        <?php
            }
        }
        ?>


        <a href="new_plan.php">
            <h1 class="plusIcon">
                <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
            </h1>
        </a>


    </div>
    <!-- end of container -->

    <?php include "includes/footer.php"; ?>
</body>

</html>