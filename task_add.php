<?php
include_once('connect.php');
include_once('functions.php');
session_start();


date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['add_task'])){

    $task_name = $_POST['task_name'];
    $task_priority = $_POST['task_priority'];
    $task_time = date("l jS \of F Y h:i:s A");

    $table = $_SESSION['curr_id'].$_SESSION['list_id']."tasks";

    $query = "INSERT INTO {$table}(taskName,taskPriority,createTime)";
    $query .= "VALUES('{$task_name}','{$task_priority}','{$task_time}')";
    $result = $connection->query($query);
    confirmQuery($result);

    redirect("task_view.php?t_id={$_SESSION['list_id']}");

}


 ?>
