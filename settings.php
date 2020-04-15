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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<style>
@import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500&display=swap');

body{ 
    font: 14px Montserrat; 
    font-weight: 300;
    text-align: center; 
    margin: 0px;
    padding: 0px;
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
    background: #f7ce3e;
    height: 50px;
}

.areamain{
    margin-top:7%;
}

.areamain button{
    margin: 1%;
}

button{
    font-family: Montserrat;
    font-size: 46px;
    width: 20%;
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
    left: 15%;
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
    <div class="areamain">
    <form name="deltask" method="POST" action="deltaskinfo.php">
    <button type="submit" class="btn btn-default">DELETE TASK INFO</button>
    </form>
    <br>
    <form name="deltest" method="POST" action="deltestinfo.php">
    <button type="submit" class="btn btn-default">DELETE TEST INFO</button>
    </form>
    <br>
    <form name="delsch" method="POST" action="delschinfo.php">
    <button type="submit" class="btn btn-default">DELETE SCHEDULE INFO</button>
    </form>
    <br>
    <form name="delcal" method="POST" action="delcalinfo.php">
    <button type="submit" class="btn btn-default">DELETE CALENDAR INFO</button>
    </form>
    <br>
    <form name="resacc" method="POST" action="resetacc.php">
    <button type="submit" class="btn btn-warning">RESET ACCOUNT</button>
    </form>
    <br>
    <form name="delacc" method="POST" action="deleteacc.php">
    <button type="submit" class="btn btn-danger">DELETE ACCOUNT</button>
    </form> 
    </div>
    </content>
    </section>