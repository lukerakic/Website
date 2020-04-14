<?php

session_start();
include_once 'config.php';
$id = $_SESSION["id"];

if(isset($_POST['createtask'])){
    $title = $_POST['title'];
    $task = $_POST['task'];
    $task = $_POST['task'];

}
