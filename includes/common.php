<?php
   global $con;
   global $pageName;
   $con = mysqli_connect("localhost", "root", "", "ctrl_budget_db") or die(mysqli_error($con));
    session_start();
?>