<!-- store value of expense form -->
<?php
require("includes/common.php");
// It will not allow direct access to this file by any user.
if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location
    header('location:index.php');
    exit;
  }

function GetImageExtension($imagetype)
{
    if (empty($imagetype)) return false;
    switch ($imagetype) {
        case 'image/bmp':
            return '.bmp';
        case 'image/gif':
            return '.gif';
        case 'image/jpeg':
            return '.jpg';
        case 'image/png':
            return '.png';
        default:
            return false;
    }
}

if (isset($_POST['title'])) {
    $planId = $_POST['planId'];
    $title = $_POST['title'];
    $eDate = $_POST['eDate'];
    $selectedPersonId = $_POST['selectedName'];
    $amountSpent = $_POST['amountSpent'];

    $planId = mysqli_real_escape_string($con, $planId);
    $title = mysqli_real_escape_string($con, $title);
    $selectedPersonId = mysqli_real_escape_string($con, $selectedPersonId);
    $amountSpent = mysqli_real_escape_string($con, $amountSpent);

    if (!empty($_FILES["uploadedimage"]["name"])) {
        $file_name = $_FILES["uploadedimage"]["name"];
        $temp_name = $_FILES["uploadedimage"]["tmp_name"];
        $imgtype = $_FILES["uploadedimage"]["type"];
        $ext = GetImageExtension($imgtype);
        $imagename = date("d-m-Y") . "-" . time() . $ext;
        $target_path = "img/" . $imagename;
        if (move_uploaded_file($temp_name, $target_path)) {
            // Make a query to save data to your database.
            $query = "INSERT INTO expense(plan_id,title,eDate,person_id,amount_spent,bill_path)
                            VALUES($planId,'$title','$eDate',$selectedPersonId,$amountSpent,'$target_path')";
            mysqli_query($con, $query) or die(mysqli_error($con));
            echo "<script>location.href='viewPlan.php?planId=$planId'</script>";
        }
    } else {
        // if user didn't upload a file'
        $query = "INSERT INTO expense(plan_id,title,eDate,person_id,amount_spent)
        VALUES($planId,'$title','$eDate',$selectedPersonId,$amountSpent)";
        mysqli_query($con, $query) or die(mysqli_error($con));
        echo "<script>location.href='viewPlan.php?planId=$planId'</script>";
    }
}


?>