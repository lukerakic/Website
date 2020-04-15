<?php

session_start();
include_once 'config.php';
$id = $_SESSION["id"];

if(isset($_POST['createtask'])){
    $title = $_POST['tasktitle'];
    $task = $_POST['task'];

    $sql = "INSERT INTO tasks (uid, title, task) VALUES ('$id', '$title', '$task')";
    mysqli_query($link, $sql);
    header("Location: taskcreate.php?taskcreated");
}
