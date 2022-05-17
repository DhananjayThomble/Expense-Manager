<?php require "includes/common.php";
// Redirects the user to Login page if he/she is NOT logged in.
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
}
$planId = $_GET['planId'];
// echo $planId;

// check how many peoples are in the plan, and calculate 
// money spent by all the individuals person.
$initialBudget = 0;
$moneySpentByPerson = array();
$remainingPerson = array(array(null, null));
$totalAmountSpent = 0;
$remainingAmount = 0;
$noOfPeoples = 0;
$individualShares = 0;
$title = "";

// Fill person name in the array
$queryPersonName = "select persons.name from persons INNER JOIN peoples_in_grp On persons.id = peoples_in_grp.person_id where peoples_in_grp.plan_id = $planId";
$resultPersonName = mysqli_query($con, $queryPersonName) or die(mysqli_error($con));
while($r = mysqli_fetch_array($resultPersonName)){
    $moneySpentByPerson += array("{$r['name']}"=>0);
    // array_push($moneySpentByPerson, array($r['name'],0));
}

// check whether expense table has any VALUES
$query = "select * from expense where plan_id = $planId";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$num = mysqli_num_rows($result);
// echo "num of expense row = ". $num;
if ($num <= 0) {
    // if no expense is made yet.
    $query = "select initial_budget,peoples_in_grp,title from plan where id = $planId";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $initialBudget = $row['initial_budget'];
    $noOfPeoples = $row['peoples_in_grp'];
    $title = $row['title'];

} else {
    // If someone made any expense for the plan
    $queryExpense = "SELECT
    plan.title,plan.initial_budget,expense.person_id,
    SUM(expense.amount_spent) as person_spent,persons.name
    FROM
    plan
    INNER JOIN expense ON
    expense.plan_id = plan.id
    INNER JOIN persons ON
    persons.id = expense.person_id
    WHERE plan.id = $planId
    GROUP BY expense.person_id";
    $resultExpense = mysqli_query($con, $queryExpense) or die(mysqli_error($con));
    $numOfRows = mysqli_num_rows($resultExpense);

    // it will populate array with the persons those make expenses. 
    // echo " ex block";
    for ($i = 0; $i < $numOfRows; $i++) {
        $rowOfExpense = mysqli_fetch_array($resultExpense);
        $moneySpentByPerson["{$rowOfExpense['name']}"] = $rowOfExpense['person_spent'];
    }

    $initialBudget = $rowOfExpense['initial_budget'];
    $title = $rowOfExpense['title'];



    $query = "select peoples_in_grp from plan where id = $planId";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $row = mysqli_fetch_array($result);
        $noOfPeoples = $row[0];
        $resultPersonName = getPersonName($con, $planId);
    }
}

function getPersonName($con, $planId)
{
    // get people name from peoples_in_grp
    $query = "SELECT p.name as pName FROM peoples_in_grp pg
            INNER JOIN persons p ON
            p.id = pg.person_id
            INNER JOIN plan pn ON
            pn.id = pg.plan_id
            WHERE pg.plan_id = $planId";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    return $result;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/headTag.php"; ?>
</head>

<body>

    <?php  include "includes/header.php"; 
    ?>


    <div class="container">
        <div class="row">

            <div class="col-md-12 col-lg-12" id="cont1">
                <div class="panel panel-default">
                    <div class="panel-heading" id="panelNewPlan">

                        <center>
                            <h3 class="panel-title"> <?php echo $title; ?>
                                <span class="text-right"><?php echo $noOfPeoples; ?></span>
                                <span class="glyphicon glyphicon-user text-right"></span>
                            </h3>
                        </center>

                    </div>

                    <div class="panel-body">
                        <div>
                            <h5><b>Initial Budget</b> <span class="text-right">₹ <?php echo $initialBudget; ?></span> </h5>
                        </div>

                        <?php

                        $j = 1;
                            foreach ($moneySpentByPerson as $aName => $aAmount){
   
                            echo "<div>
                                <h5><b>$aName</b> <span class='text-right'>₹ ". round($aAmount,2)."</span> </h5>
                                </div>";
                            $totalAmountSpent += $aAmount;
                            $j++;
                        }
                        $remainingAmount = $initialBudget - $totalAmountSpent;
                        $individualShares = $totalAmountSpent / $noOfPeoples;

                        ?>


                        <div>
                            <h5><b>Total amount spent</b> <span class="text-right">₹ <?php echo round( $totalAmountSpent,2); ?></span> </h5>
                        </div>

                        <div>
                            <h5><b>Remaining Amount</b>
                                <span class="text-right" id="green" <?php
                                                                    $msg = "";
                                                                    if ($remainingAmount > 0) {
                                                                        echo "style='color:green'";
                                                                        $msg = "₹ ". abs( round( $remainingAmount,2) );
                                                                    } else if ($remainingAmount < 0) {
                                                                        $msg = "Overspent by ₹ ".abs( round( $remainingAmount,2) );
                                                                        echo "style='color:red'";
                                                                    } else if ($remainingAmount == 0) {
                                                                        echo "style='color:black'";
                                                                        $msg = "₹ ". abs( round( $remainingAmount,2) );
                                                                    }
                                                                    ?>>
                                    <?php echo $msg ?>
                                </span>
                            </h5>
                        </div>

                        <div>
                            <h5><b>Individual shares</b> <span class="text-right">₹ <?php echo round($individualShares,2); ?></span> </h5>
                        </div>


                        <?php

                        ?>
                        <?php
                        $j = 1;
                        foreach ($moneySpentByPerson as $aName => $aAmount){
                            $temp =  $aAmount - $individualShares;
                            $msg = "";
                        ?>
                            <div>
                                <h5>
                                    <b> <?php echo $aName; ?> </b>
                                    <span class="text-right" <?php

                                                                if ($temp > 0) {
                                                                    echo "style='color:green'";
                                                                    $msg = "Gets back ₹ ". round($temp,2);
                                                                } else if ($temp < 0) {
                                                                    echo "style='color:red'";
                                                                    $msg = "Owes ₹ ".abs( round($temp,2));
                                                                } else if ($temp == 0) {
                                                                    echo "style='color:black'";
                                                                    $msg = "All Settled up";
                                                                }
                                                                ?>>
                                        <?php echo $msg; ?> </span>
                                </h5>
                            </div>
                        <?php $j++;
                        } ?>
                        <a href="viewPlan.php?planId=<?php echo $planId; ?>" id="cont1" class="noUnderline">
                            <button type="button" class="btn btnNewPlan">
                                <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
                                Go Back</button>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <?php include "includes/footer.php"; ?>
</body>

</html>