<?php

session_start();
include 'config.php';
$id = $_SESSION["id"];

if (isset($_POST['uploadcalendar'])) {
    $calendar = $_FILES['calendar'];

    $calendarname = $calendar['name'];
    $calendarTmpName = $calendar['tmp_name'];
    $calendarSize = $calendar['size'];
    $calendarError = $calendar['error'];
    $calendarType = $calendar['type'];

    $calendarExt = explode('.', $calendarname);
    $calendarActualExt = strtolower(end($calendarExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($calendarActualExt, $allowed)){
        if ($calendarError === 0){
            if ($calendarSize < 10000000){
                $calendarnameNew = "calendar".$id.".".$calendarActualExt;
                $calendarDestination = 'calendars/'.$calendarnameNew;
                move_uploaded_file($calendarTmpName, $calendarDestination);
                $sql = "UPDATE calendar SET status=1 WHERE uid='$id'";
                $result = mysqli_query($link, $sql);
                $sqlcal = "UPDATE calendar SET calendar='$calendarnameNew' WHERE uid='$id'";
                $resultcal = mysqli_query($link, $sqlcal);
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