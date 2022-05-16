<?php
// It will not allow direct access to this file by any user.
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.php');
    exit;
  }
require 'includes/common.php';

$initialBudget = $_POST['initialBudget'];
$initialBudget = mysqli_real_escape_string($con, $initialBudget);
$peoples = $_POST['peoples'];
$peoples = mysqli_real_escape_string($con, $peoples);

// check whether given input is greater than zero or not.
if($initialBudget <= 0){
    echo "<script>alert('Budget must be greater than 0')</script>";
    echo "<script>location.href='new_plan.php'</script>";
}

if($peoples <= 0 ){
    echo "<script>alert('Minimum 1 user must be require')</script>";
    echo "<script>location.href='new_plan.php'</script>";
}

if($initialBudget > 0 && $peoples > 0) {
    header("location:plan_details.php?initialBudget=$initialBudget&&peoples=$peoples");
}

?>