<?php
// It will not allow direct access to this file by any user.
if(!isset($_SERVER['HTTP_REFERER'])){
  // redirect them to your desired location
  header('location:index.php');
  exit;
}
require("includes/common.php");

// Getting the values from the signup page using $_POST[] and cleaning the data submitted by the user.
$name = $_POST['name'];
$name = mysqli_real_escape_string($con, $name);

$email = $_POST['email'];
$email = mysqli_real_escape_string($con, $email);

$password = $_POST['password'];
// To check, whether the password length is minimum 6 or not.
if (strlen($password) > 5) {
  $password = mysqli_real_escape_string($con, $password);
  // It will encrypt the string using MD5 hash
  $password = MD5($password);
} else {
  // invalid password
  echo "<script>alert('Invalid Password! Enter Min 6 characters')</script>";
  echo "<script>location.href='signup.php'</script>";
}

$contact = $_POST['phoneNo'];
$contact = mysqli_real_escape_string($con, $contact);

$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$regex_num = "/[0-9]{10}$/";

// Check whether the email address already exist or not.
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($con, $query) or die($mysqli_error($con));

// get, number of rows affected by the query. 
$num = mysqli_num_rows($result);

// if above query returns one or more rows, it means $num has > 0 values. means email address already exits. 

// Check email,phone numbers are valid or not. 
if ($num != 0) {
  echo "<script>alert('Email is already registered!')</script>";
  echo "<script>location.href='signup.php'</script>";
} else if (!preg_match($regex_email, $email)) {
  // true, when email does not matched with pattern.
  echo "<script>alert('Invalid Email!')</script>";
  echo "<script>location.href='signup.php'</script>";
} else if (!preg_match($regex_num, $contact)) {
  echo "<script>alert('Invalid Phone Number!')</script>";
  echo "<script>location.href='signup.php'</script>";
} else {

  // True, when all the input is matched with pattern.

  $query = "INSERT INTO users(name, email, password, contact) VALUES('$name','$email','$password','$contact')";
  mysqli_query($con, $query) or die(mysqli_error($con));
  
  // It will return recently generated unique id and assign to $user_id.
  $user_id = mysqli_insert_id($con);
  // Now we store the email and user id in the Session variable for the future use.
  // $_SESSION['email'] = $email;
  $_SESSION['user_id'] = $user_id;

  // It will redirect to the Dashboard page.
  header('location: dashboard.php');
}
