<?php
// It will not allow direct access to this file by any user.
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.php');
    exit;
  }
session_start();
if (!isset($_SESSION['email'])) {
    header('location: login.php');
}
session_destroy();
header('location: index.php');
?>