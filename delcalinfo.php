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

   $calendardel = "DELETE FROM calendar WHERE uid='$id'";
   mysqli_query($link, $calendardel);

   header("Location: settings.php?calendarinfodeleted");
