<?php
require("includes/common.php");

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/headTag.php'; ?>

<body>

    <?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <div class="container" id="cont1">
        <div class="row row_style">
            <div class="col-lg-12">
                <div class="panel panel-default" id="">

                    <div class="panel-body">
                        <form action="plan_details_script.php" method="post">

                            <div class="form-group col-md-12 ">
                                <label for="exampleInputPassword1">Title</label>
                                <input class="form-control" placeholder="Enter Title (Ex. trip to Goa)" name="title" required="true">
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1"> Form </label>
                                    <input type="date" class="form-control" placeholder="date" name="dateFrom" required="true" min="2021-01-01" max="2100-01-01">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1"> To </label>
                                    <input type="date" class="form-control" placeholder="date" name="dateTo" required="true" min="2021-01-01" max="2100-01-01">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1"> Initial Budget </label>

                                    <input class="form-control" placeholder="10000 " name="initialBudget" readonly value="<?php echo $_GET['initialBudget']; ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputPassword1"> No Of People </label>
                                    <input readonly type="text" class="form-control" placeholder="2" name="peoples" value="<?php echo $_GET['peoples']; ?>">
                                </div>
                            </div>

                            <!-- Generate input for personName dynamically -->
                            <?php
                            for ($i = 0; $i < $_GET['peoples']; $i++) {
                                echo "<div class='form-group col-md-12 '>
                                    <label for='exampleInputPassword1'> Person " . ($i + 1) . "  </label>
                                    <input type='text' class='form-control' placeholder='Person " . ($i + 1) . " Name' name='person" . ($i + 1) . "' required='true'>
                                </div>";
                            }
                            ?>
                            <!-- End -->
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <button type="submit" class=" btn btn-outline-light btn-lg btn-block btnNewPlan"> Submit </button>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- end details page -->

    <!-- End Main Content -->
    <?php include 'includes/footer.php'; ?>

</body>

</html>