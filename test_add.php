<?php

session_start();
include_once 'config.php';
$id = $_SESSION["id"];

if(isset($_POST['addtest'])){
    $testsubject = $_POST['testsubject'];
    $testdesc = $_POST['testdesc'];

    $sql = "INSERT INTO tests (uid, testsubject, testdesc) VALUES ('$id', '$testsubject', '$testdesc')";
    mysqli_query($link, $sql);
    header("Location: taskcreate.php?testadded");
}
