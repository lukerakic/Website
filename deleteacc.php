<?php
// Initialize the session
session_start();
require_once 'config.php';
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

   $id = $_SESSION['id'];
   $userdel = "DELETE FROM users WHERE id='$id'";
   mysqli_query($link, $userdel);

   $calendardel = "DELETE FROM calendar WHERE uid='$id'";
   mysqli_query($link, $calendardel);

   $scheduledel = "DELETE FROM schedule WHERE uid='$id'";
   mysqli_query($link, $scheduledel);

   $tasksdel = "DELETE FROM tasks WHERE uid='$id'";
   mysqli_query($link, $tasksdel);

   $testsdel = "DELETE FROM tests WHERE uid='$id'";
   mysqli_query($link, $testsdel);

   $_SESSION = array();
   session_destroy();

   header("Location: login.php?accountdeleted");
   exit;