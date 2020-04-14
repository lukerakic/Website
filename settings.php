<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
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
    <link rel="stylesheet" type="text/css" href="settings.css">
</head>

<body>
    <section>
    <nav>
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
    </content>
    </section>