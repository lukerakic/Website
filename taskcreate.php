<?php
// Initialize the session
session_start();
require 'config.php';
 
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
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Montserrat:300,400,500&display=swap');

body{ 
    font: 14px Montserrat; 
    font-weight: 300;
    text-align: center; 
    margin: 0px;
    padding: 0px;
}

h1{
    font-family: Montserrat;
    font-weight: 400;
    font-size: 46px;
}

h2{
    font-family: Montserrat;
    font-weight: 300;
    font-size: 36px;
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
    display:table;
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
    background: #f7ce3e;
    height: 50px;
}

.settings{
    position: relative;
    top: 25%;
    left: auto;
}

.taskcreation{
    float: left;
    width:30%;
    height: 100%;
    margin-top: 17%;
    margin-left: 10%;
    margin-right: 10%;
}

.testcreation{
    float: right;
    width:30%;
    height: 100%;
    margin-top: 17%;
    margin-left: 10%;
    margin-right: 10%;
}


</style>

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
    <div class="taskcreation">
    <div class="form-group">
    <h1>Create a Task</h1>
        <form name="createtask" action="task_upload.php" method="POST">
            <h2>Title</h2>
            <input type="text" name="tasktitle" class="form-control">
            <br>
            <h2>Task</h2>
            <textarea type="text" name="task" class="form-control" rows="4"></textarea>
            <br>
            <button type="submit" name="createtask">Create Task</button>
        </form>
    </div>
    </div>
    <div class="testcreation">
    <div class="form-group">
    <h1>Add a test</h1>
        <form name="createtask" action="test_add.php" method="POST">
            <h2>Subject</h2>
            <input type="text" name="testsubject" class="form-control">
            <br>
            <h2>Description</h2>
            <textarea type="text" name="testdesc" class="form-control" rows="4"></textarea>
            <br>
            <button type="submit" name="addtest" class="btn btn-default">Add Test</button>
        </form>
    </div>
    </div>
    </content>
    </section>