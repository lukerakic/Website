<?php
session_start();
include 'config.php';
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Study Planner</title>
    <link rel="icon" href="default_images/icon.png">
</head>
<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500&display=swap');

body{ 
    font-family: Montserrat; 
    text-align: center; 
    margin: 0px;
    padding: 0px;
}

h1{
    font-family: Montserrat;
    font-weight:300;
    font-size:40px;
}

section{
    display: table;
}

nav{
    position: fixed;
    top: 0%;
    float: left;
    height: 100%;
    width: 5%;
    background: #1a2930;
}

nav ul{
    padding: 10px;
    position: absolute;
    top: 20%;
    left: 30%;
}

nav img{
    position: absolute;
    bottom: 10%;
    left: 35%;
}

content {
    position: fixed;
    left: 5%;
    float: left;
    width: 95%;
    height: 100%;
    background: #c5c1c0;
}

.dashboard{
    position: relative;
    top: 10%;
    left: auto;
}

.calendar{
    position: relative;
    top: 15%;
    left: auto;
    background: #f7ce3e;
    height: 35px;
}

.taskcreate{
    position: relative;
    top: 20%;
    left: auto;
}

.settings{
    position: relative;
    top: 25%;
    left: auto;
}

.forms{
    display: inline;
}

.calendarimg{
    margin-top: 5%;
    margin-bottom: 5%;
}

.icon{
    width: 100%;
    position: relative;
    top: 5%;
    left: -0%;
    border-bottom-style: solid;
    border-width: 10%;
    border-color: black;
    margin: 5px;
}

.icon img{
    margin: 10%;
    left: 11%;
}


</style>

<body>
    <section>
    <nav>
        <ul class=icon style="list-style-type:none;">
            <li><img src="default_images/icon.png" width="60" height="60"></li>
        </ul>
        <ul class=dashboard style="list-style-type:none;">
            <li><a href="welcome.php"><img src="default_images/dashboard.png" width="40" height="40"></a></li>
        </ul>
        <br>
        <ul class="calendar" style="list-style-type:none;">
            <li><a href="calendar.php"><img src="default_images/calendar.png" width="40" height="40"></a></li>
        </ul>
        <br>
        <ul class="taskcreate" style="list-style-type:none;">
            <li><a href="taskcreate.php"><img src="default_images/taskcreate.png" width="40" height="40"></a></li>
        </ul>
        <br>
        <ul class="settings" style="list-style-type:none;">
            <li><a href="settings.php"><img src="default_images/settings.png" width="40" height="40"></a></li>
        </ul>
        <a href="logout.php">
        <img src="default_images/logout.png" width="40" height="40">
        </a>
    </nav>
    <content>
    <?php
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM schedule WHERE uid = $id";
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) == 0) {
        $sqlSchIns = "INSERT INTO schedule (uid) VALUE ($id)";
        mysqli_query($link, $sqlSchIns);}
    $sql = "SELECT * FROM calendar WHERE uid = $id";
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) == 0) {
        $sqlCalIns = "INSERT INTO calendar (uid) VALUE ($id)";
        mysqli_query($link, $sqlCalIns);
    }  else{
            $status = mysqli_fetch_assoc($result);
            if ($status['status'] == 1) {
            $calendarname = "SELECT calendar FROM calendar WHERE uid = '$id'";
            $resultcalendar = mysqli_query($link, $calendarname);
            while($calendarRow = mysqli_fetch_assoc($resultcalendar)){
                echo "<img class='calendarimg' src='calendars/" . $calendarRow['calendar'] . "' style='width:50%;height:50%;'>";
            }
        }

    }
    ?>
        <h1>Upload calendar here!</h1>
        <form action="calendar_upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="calendar">
        <button type="submit" name="uploadcalendar">Upload Calendar</button>
        </form>
        <h1>Upload schedule here!</h1>
        <form action="schedule_upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="schedule">
        <button type="submit" name="uploadschedule">Upload Schedule</button>
        </form>
    </content>
    </section>