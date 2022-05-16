<?php
// It will not allow direct access to this file by any user.
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:index.php');
    exit;
  }
require("includes/common.php");

$title = $_POST['title'];
$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];
$initialBudget = $_POST['initialBudget'];
$peoples = $_POST['peoples'];

// escape all special characters for use in an SQL query
$title = mysqli_real_escape_string($con, $title);
$initialBudget = mysqli_real_escape_string($con, $initialBudget);
$peoples = mysqli_real_escape_string($con, $peoples);

$arrPeople = array();
// store values of people in the array of arrPeople variable.
for ($i = 0; $i < $peoples; $i++) {
    $str = $_POST["person" . ($i + 1)];
    $str = mysqli_real_escape_string($con, $str);
    // if person name must not be empty
    if (strlen($str) <= 0) {
        echo "<script>alert('Person must not be empty')</script>";
        echo "<script>location.href='new_plan.php'</script>";
    }
    // storing people name in PERSONS table
    $query = "INSERT INTO persons(name) VALUES('$str')";
    mysqli_query($con, $query) or die(mysqli_error($con));

    // Storing id of person in the array.
    $idPerson = mysqli_insert_id($con);
    array_push($arrPeople, $idPerson);
}

// some basic validation of strings, strings must not be empty.
if (strlen($title) <= 0 || $initialBudget <= 0 || $peoples <= 0) {
    echo "<script>alert('Check Your Inputs')</script>";
    echo "<script>location.href='new_plan.php'</script>";
}

// chanage the date fomate for mysql database.
// $originalDate = "2010-03-21";
// $newDate = date("d-m-Y", strtotime($originalDate));
$newDateFrom = date("Y-m-d", strtotime($dateFrom));
$newDateTo  = date("Y-m-d", strtotime($dateTo));

// Store the data in the PLAN Table.
echo "<script>alert('$peoples')</script>";
$query = "INSERT INTO plan(initial_budget,peoples_in_grp,title,date_from,date_to,user_id)
               VALUES($initialBudget,$peoples,'$title','$newDateFrom','$newDateTo',{$_SESSION['user_id']} ) ";
mysqli_query($con, $query) or die(mysqli_error($con));
$idPlan = mysqli_insert_id($con);

// Store persons names in peoples_in_grp table
foreach ($arrPeople as $i){
    $query = "INSERT INTO peoples_in_grp(plan_id,person_id) VALUES($idPlan,$i)";
    mysqli_query($con, $query) or die(mysqli_error($con));
}

header('location:dashboard.php');





/* note
- first change the date format for mysql database.
- insert data of PERSONS
    collect id of PERSONS in array
- insert data of PLAN
    collect id of Plan in variable
- insert data of PEOPLES_IN_GRP

*/
