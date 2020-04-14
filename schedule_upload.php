<?php

session_start();
include_once 'config.php';
$id = $_SESSION["id"];

if(isset($_POST['uploadschedule'])){
    $schedule = $_FILES['schedule'];

    $schedulename = $schedule['name'];
    $scheduleTmpName = $schedule['tmp_name'];
    $scheduleSize = $schedule['size'];
    $scheduleError = $schedule['error'];
    $scheduleType = $schedule['type'];

    $scheduleExt = explode('.', $schedulename);
    $scheduleActualExt = strtolower(end($scheduleExt));

    $allowed = array('jpg', 'jpeg', 'png');

   if (in_array($scheduleActualExt, $allowed)){
        if ($scheduleError === 0){
            if ($scheduleSize < 10000000){
                $schedulenameNew = "schedule".$id.".".$scheduleActualExt;
                $scheduleDestination = 'schedules/'.$schedulenameNew;
                move_uploaded_file($scheduleTmpName, $scheduleDestination);
                $sql = "UPDATE schedule SET status=1 WHERE uid='$id'";
                $result = mysqli_query($link, $sql);
                $sqlsch = "UPDATE schedule SET schedule='$schedulenameNew' WHERE uid='$id'";
                $resultsch = mysqli_query($link, $sqlsch);
                header("Location: calendar.php?uploadsuccess");
            } else{
                echo "File is too big!";
            }
        } else{
            echo "There was an error!";
        }

    } else {
        echo "Invalid file type!";
    }
}