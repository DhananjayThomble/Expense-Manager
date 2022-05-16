<?php
require("includes/common.php");

if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}

// get plan id
$planId = $_GET['planId'];
// Get this data from database - title,peoples,budget,fromDate,toDate
$query = "select title,peoples_in_grp,initial_budget,date_from,date_to from plan where id = $planId";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$num = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
$remainingAmount = 0;
$allTheExpenses = 0;
// get remaining amount -
$qExpense = "select SUM(amount_spent) as total from expense where plan_id = $planId";
$rExpense = mysqli_query($con, $qExpense) or die(mysqli_error($con));
$nExpense = mysqli_num_rows($rExpense);

$temp = mysqli_fetch_array($rExpense);
// echo "money - " . $temp['total'];
if (mysqli_num_rows($rExpense) > 0) {
    // $temp = mysqli_fetch_array($rExpense);
    $allTheExpenses = $temp['total'];
} else {
    $allTheExpenses = $row['initial_budget'];
}

// fetch value for expense box
$query2 = "SELECT e.title,e.eDate,e.amount_spent,e.bill_path,p.name from expense e 
            INNER JOIN persons p on p.id = e.person_id
                WHERE plan_id = $planId";
$result2 = mysqli_query($con, $query2) or die(mysqli_error($con));
$num2 = mysqli_num_rows($result2);


if ($allTheExpenses == NULL) {
    $remainingAmount = $row['initial_budget'];
} else {
    $remainingAmount = $row['initial_budget'] - $allTheExpenses;
}
// $allTheExpenses = $rExpense['total'];
// // $remainingAmount = budget - allTheExpenses
// $remainingAmount = $row['initial_budget'] - $rExpense['total'];

?>

<!DOCTYPE html>
<html lang="">

<?php include "includes/headTag.php"; ?>

<body>

    <?php include "includes/header.php"; ?>

    <div class="container">

        <!-- ---------------- Budget Overview ------------------------------ -->
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-default panelViewPlan">

                    <div class="panel-heading" id="panelNewPlan">
                        <center>
                            <h3 class="panel-title">
                                <?php echo $row['title']; ?> <span class="text-right"><?php echo $row['peoples_in_grp']; ?></span>
                                <span class="glyphicon glyphicon-user text-right"></span>
                            </h3>
                        </center>

                    </div>

                    <!-- ------------------------------------------------------------- -->
                    <div class="panel-body">
                        <div>
                            <h5><b>Budget</b> <span class="text-right">₹ <?php echo $row['initial_budget']; ?></span> </h5>
                        </div>

                        <div>
                            <h5><b>Remaining Amount</b>
                                <span class="text-right" <?php
                                                            $msg = "₹ ". round($remainingAmount,2);
                                                            if ($remainingAmount > 0) {
                                                                echo "style='color:green'";
                                                                
                                                            } else if ($remainingAmount < 0) {
                                                                echo "style='color:red'";
                                                                $msg = "Overspent by ₹ ". abs(round($remainingAmount,2) );                                                            } else if ($remainingAmount == 0) {
                                                                echo "style='color:black'";
                                                            }
                                                            ?>><?php echo $msg; ?></span>
                            </h5>
                        </div>

                        <div>
                            <h5><b>Date</b> <span class="text-right">
                                    <?php echo date("jS F", strtotime($row['date_from'])) . " - "; ?>
                                    <?php echo date("jS F Y", strtotime($row['date_to'])); ?></span> </h5>
                        </div>


                    </div>

                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <a href="expense_distribution.php?planId=<?php echo $planId; ?>">
                    <button type="button" class="btn btn-outline-success btn-lg btn1" id="myButton">Expense
                        Distribution</button>
                </a>
            </div>

        </div>
        <!-- ---------------- End Budget Overview ------------------------------ -->


        <div class="row">

            <!-- Added Expenses -->
            <div class="col-md-6 col-lg-6">

                <?php
                if ($num2 > 0) {
                    while ($row2 = mysqli_fetch_array($result2)) { ?>
                        <div class="col-lg-6">
                            <div class="panel panel-default panelViewPlan">
                                <div class="panel-heading" id="panelNewPlan">
                                    <center>
                                        <h1 class="panel-title">
                                            <?php echo $row2['title']; ?>
                                        </h1>
                                    </center>

                                </div>
                                <div class="panel-body">

                                    <div>
                                        <h5><b>Amount</b> <span class="text-right">
                                        ₹ <?php echo $row2['amount_spent']; ?>
                                            </span> </h5>
                                    </div>

                                    <div>
                                        <h5><b>Paid by</b> <span class="text-right">
                                                <?php echo $row2['name']; ?>
                                            </span> </h5>
                                    </div>
                                    <div>
                                        <h5><b>Paid On</b> <span class="text-right">
                                                <?php echo date("jS F-Y", strtotime($row2['eDate'])); ?>
                                            </span> </h5>
                                    </div>

                                    <?php
                                    // check whether the bill is available or not. 
                                    if ($row2['bill_path'] != NULL) {
                                        echo "<a class='noUnderline' href='{$row2['bill_path']}' id='cont1' target='_blank' rel='noopener noreferrer'> Show Bill </a>";
                                    } else {
                                        echo "<a class='noUnderline' href='#' id='cont1'>You Don't Have bill</a>";
                                    }
                                    ?>



                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
                <!-- <div class="col-lg-6">
                    <div class="panel panel-default panelViewPlan">
                        <div class="panel-heading" id="panelNewPlan">
                            <h3 class="panel-title">fdskj
                                <span class="text-right">34</span>
                                <span class="glyphicon glyphicon-user text-right"></span>
                            </h3>
                        </div>
                        <div class="panel-body">

                            <div>
                                <h5><b>Budget</b> <span class="text-right">455</span> </h5>
                            </div>

                            <div>
                                <h5><b>Date</b> <span class="text-right">
                                        3443ser
                                        - 454sdf </span> </h5>
                            </div>
                            <a class="noUnderline" href="viewPlan.php?planId=">
                                <button id="btnNewPlan" type="button" class="btn btn-block">View Plan</button>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel panel-default panelViewPlan">
                        <div class="panel-heading" id="panelNewPlan">
                            <h3 class="panel-title">fdskj
                                <span class="text-right">34</span>
                                <span class="glyphicon glyphicon-user text-right"></span>
                            </h3>
                        </div>
                        <div class="panel-body">

                            <div>
                                <h5><b>Budget</b> <span class="text-right">455</span> </h5>
                            </div>

                            <div>
                                <h5><b>Date</b> <span class="text-right">
                                        3443ser
                                        - 454sdf </span> </h5>
                            </div>
                            <a class="noUnderline" href="viewPlan.php?planId=">
                                <button id="btnNewPlan" type="button" class="btn btn-block">View Plan</button>
                            </a>

                        </div>
                    </div>
                </div> -->
                <!-- End Added Expenses -->
            </div>
            <!-- --------------------Add New Expense---------------------------- -->
            <div class="col-md-6 col-lg-6" id="stickToRight">

                <div class="panel panel-default">
                    <div class="panel-heading" id="panelNewPlan">
                        <center>
                            <h4>Add New Expense</h4>
                        </center>
                    </div>
                    <div class="panel-body">

                        <form action="viewPlan_script.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputPassword1"> Title </label>
                                <input type="text" class="form-control" placeholder="Expense Name" required="true" name="title">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1"> Date </label>
                                <input type="date" class="form-control" placeholder="date" name="eDate" required="true" min="<?php echo $row['date_from']; ?>" max="<?php echo $row['date_to']; ?>">
                            </div>
                            <?php

                            $person = getPersonName($con, $planId);
                            ?>
                            <select id="inputState" class="form-control" name='selectedName'>
                                <?php
                                while ($rowOfPerson = mysqli_fetch_array($person)) {

                                    echo "<option value='{$rowOfPerson['id']}' selected>{$rowOfPerson['name']}</option>";
                                }
                                ?>
                            </select>

                            <div class="form-group">
                                <label for="exampleInputPassword1"> Amount Spent </label>
                                <input type="text" class="form-control" placeholder="Amount Spent" required="true" pattern="^[1-9]\d*(?:\.\d+)?$" name="amountSpent">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlFile1"> Upload Bill </label>
                                <input type="file" name="uploadedimage" id="uploadedimage">
                            </div>

                            <input type="text" name="planId" value="<?php echo $planId; ?>" hidden>
                            <button type="submit" class="btn  btn-block btnNewPlan">Add</button>


                        </form>
                    </div>
                </div>
            </div>
            <!-- --------------------End Add New Expense---------------------------- -->

        </div>




    </div>



    <?php

    include "includes/footer.php"; ?>

</body>

</html>
<?php
function getPersonName($con, $planId)
{
    // get people name from peoples_in_grp
    $query = "SELECT p.name,p.id FROM peoples_in_grp pg
            INNER JOIN persons p ON
            p.id = pg.person_id
            INNER JOIN plan pn ON
            pn.id = pg.plan_id
            WHERE pg.plan_id = $planId";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    return $result;
}

?>