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

   $testsdel = "DELETE FROM tests WHERE uid='$id'";
   mysqli_query($link, $testsdel);

   header("Location: settings.php?testinfodeleted");
