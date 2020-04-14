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
    <style>
    @import url('https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500&display=swap');

    body{ 
    font-family: Montserrat;
    text-align: center; 
    margin: 0px;
    padding: 0px;
    }

    header{
    margin: auto; 
    background: white;
    height: 5%;
    text-align
    }


    h1{
    font-family: Montserrat;
    font-weight:300;
    font-size:40px;
    display: inline;   
    }

    h2{
    font-family: Montserrat;
    font-weight:400;
    font-size:40px;
    display: inline;   
    }
   
    section{
        display: table;
    }

    p{
    position: relative;
    left: 20% !important;
    top: 10% !important;
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
    background: #f7ce3e;
    height: 40px;
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
    }


    </style>
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
        <header>
            <h1>Welcome,  </h1><h2><?php echo htmlspecialchars($_SESSION["username"]); ?></h2><h1>    to your study planner!</h1>
        </header>
        <tasks>
        </tasks>
        <tests>
        </tests>
        <schedule>
        </schedule>
    </content>
    </section>
</body>
</html>