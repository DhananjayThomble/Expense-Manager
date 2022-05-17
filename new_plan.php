<?php
require("includes/common.php");

if (!isset($_SESSION['user_id'])) {
  header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Head Tag -->
<?php include "includes/headTag.php"; ?>

<body>

    <!-- navbar -->
    <?php include "includes/header.php"; ?>
    <!--end navbar  -->

    <!-- new plan form -->
    <div class="container-fluid" id="cont1">
        <div class="row row_style">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading" id="panelNewPlan">
                        <center>
                            <h4>CREATE NEW PLAN</h4>
                        </center>
                    </div>
                    <div class="panel-body">

                        <form action="newPlan_script.php" method="post">
                            <div class="form-group">
                                <label for="budget"> Initial Budget </label>
                                <input type="text" id="budget" class="form-control" placeholder=" Initial Budget(Ex.4000)" name="initialBudget" required="true" pattern="^[1-9]\d*(?:\.\d+)?$" >
                            </div>
                            <div class="form-group">
                                <label for="peoples">How many peoples you want to add in your groups? </label>
                                <input type="text" id="peopleCount" class="form-control" placeholder="No. of people" name="peoples" required="true" pattern="^[1-9]\d*$" oninvalid="setCustomValidity('Value must be greater than or equal to 1.')" oninput="setCustomValidity('')">
                            </div>
                            <button  type="submit" class="btn btn-block btnNewPlan"> Next </button>

                        </form><br />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end new plan-->

    <!-- footer -->
    <?php include "includes/footer.php"; ?>

</body>

<script>
    // Checks budget value is minimum 50 rs.
    var budget = document.getElementById("budget");
    var peopleCount = document.getElementById("peopleCount");
    budget.addEventListener("input",function(e){
        var num = budget.value;
        if( num < 50 ){
                e.target.setCustomValidity('Value must be greater than or equal to 50.'); 
        } else{
            e.target.setCustomValidity(''); 
        }
    });

    peopleCount.addEventListener("input",function(e1){
        var num = peopleCount.value;
        if( num < 0 ){
            e1.target.setCustomValidity('Value must be greater than or equal 1.');
        } else{
            e1.target.setCustomValidity(''); 
        }
    });

</script>

</html>