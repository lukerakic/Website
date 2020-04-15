<?php
// Initialize the session
session_start();
require_once 'config.php';
$id = $_SESSION['id'];
 
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
    display: table;
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

    tasks{
    float: left;
    width: 33%;
    height: 100%;
    }

    tests{
    float: left;
    width: 33%;
    height: 100%;
    }

    schedule{
    float: right;
    width: 34%;
    height: 100%;
    }
    </style>
</head>
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
        <header>
            <h1>Welcome,  </h1><h2><?php echo htmlspecialchars($_SESSION["username"]); ?></h2><h1>    to your study planner!</h1>
        </header>
        <tasks>
        <h1>Tasks</h1>
        <?php
        $tasktitlerequest = "SELECT title FROM tasks WHERE uid='$id' AND status=1";
        $tasktitle = mysqli_query($link, $tasktitlerequest);
        $taskrequest = "SELECT task FROM tasks WHERE uid='$id' AND status=1";
        $task = mysqli_query($link, $taskrequest);

        while($tasktitlerow = mysqli_fetch_assoc($tasktitle)){
            while($taskrow = mysqli_fetch_assoc($task)){
                echo '
                <table class="table table-condensed table-bordered neutralize">     
                <tbody>
                    <tr>
                        <td>Title</td>
                        <td>Task</td>
                    </tr>
                ';
        
                echo '
                    <tr>
                        <td>'.$tasktitlerow['title'].'</td>
                        <td>'.$taskrow['task'].'</td>
                    </tr>
                ';
        
                echo '
                </tbody>
                </table>
                ';
            }
        }
        ?>
        </tasks>
        <tests>
        <h1>Tests</h1>
        <?php
        $testtitlerequest = "SELECT testsubject FROM tests WHERE uid='$id' AND status=1";
        $testtitle = mysqli_query($link, $testtitlerequest);
        $testrequest = "SELECT testdesc FROM tests WHERE uid='$id' AND status=1";
        $test = mysqli_query($link, $testrequest);

        while($testtitlerow = mysqli_fetch_assoc($testtitle)){
            while($testrow = mysqli_fetch_assoc($test)){
                echo '
                <table class="table table-condensed table-bordered neutralize">     
                <tbody>
                    <tr>
                        <td>Subject</td>
                        <td>test</td>
                    </tr>
                ';
        
                echo '
                    <tr>
                        <td>'.$testtitlerow['testsubject'].'</td>
                        <td>'.$testrow['testdesc'].'</td>
                    </tr>
                ';
        
                echo '
                </tbody>
                </table>
                ';
            }
        }
        ?>
        </tests>
        <schedule>
        <h1>Schedule</h1>
        <br>
        <?php
        $sqlSchIns = "INSERT INTO schedule (uid) VALUE ($id)";
        mysqli_query($link, $sqlSchIns);
        $sql = "SELECT * FROM schedule WHERE uid = '$id'";
        $result = mysqli_query($link, $sql);
        $status = mysqli_fetch_assoc($result);
        if ($status['status'] == 1) {
            $schedulename = "SELECT schedule FROM schedule WHERE uid = '$id'";
            $resultschedule = mysqli_query($link, $schedulename);
            while($scheduleRow = mysqli_fetch_assoc($resultschedule)){
                    echo "<img class='scheduleimg' src='schedules/" . $scheduleRow['schedule'] . "' style='width:80%;height:50%;'>";
                }
            } else{
                echo "No schedule found!";
            }

        ?>
        </schedule>
    </content>
    </section>
</body>
</html>