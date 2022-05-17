<?php
// It will not allow direct access to this file by any user.
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.php');
    exit;
  }
require "includes/common.php";

$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];
$confirmNewPassword = $_POST['confirmNewPassword'];

$oldPassword = mysqli_real_escape_string($con, $oldPassword);
$newPassword = mysqli_real_escape_string($con, $newPassword);
$confirmNewPassword = mysqli_real_escape_string($con, $confirmNewPassword);

// Check whether a 2 password matches or not?
if ($newPassword == $confirmNewPassword) {
    // Check whether oldPassword is correct or not.
    if (checkPassword($oldPassword, $con)) {
        changePassword($newPassword, $con);
    } else {
        // User does not exist or has wrong password.
        echo "<script>alert('Please enter correct Password')</script>";
        echo "<script>location.href='change_password.php'</script>";
    }
} else {
    // new pass and confirm pass must be same
    echo "<script>alert('New Password and Confirm password must be same')</script>";
    echo "<script>location.href='change_password.php'</script>";
}


function checkPassword($oldPassword, $con)
{
    $oldPassword = md5($oldPassword);
    $query = "select * from users where id = {$_SESSION['user_id']} and password = '$oldPassword' ";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    $num = mysqli_num_rows($result);
    echo "check" . mysqli_affected_rows($con);
    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}

function changePassword($pass, $con)
{
    $pass = md5($pass);
    $query = "update users set password = '$pass' where id = {$_SESSION['user_id']}";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    if (mysqli_affected_rows($con) > 0) {
        echo "<script>alert('Password Changed Successfully')</script>";
        session_destroy();
        echo "<script>location.href='index.php'</script>";
    }
}
