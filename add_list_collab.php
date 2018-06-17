<?php
include_once('connect.php');
include_once('functions.php');
session_start();


date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['add_list_collab'])){

    $userId = $_SESSION['curr_id'];
    $listId = $_SESSION['list_id'];
    $createTime = date("l jS \of F Y h:i:s A");

    $targetId = $_POST['target_collab_id'];

    $table = $targetId."list_collabs";

    $query = "INSERT INTO {$table}(collabId,listId,createTime)";
    $query .= "VALUES('{$userId}','{$listId}','{$createTime}')";
    $result = $connection->query($query);
    confirmQuery($result);

    $table = $userId."task_lists";

    $query = "SELECT collabs FROM {$table} WHERE id = $listId";
    $result = $connection->query($query);
    confirmQuery($result);
    $row = $result->fetch_assoc();

    $result_array = explode(" ",$row['collabs']);

    array_push($result_array,$targetId);
    $collab_update_string = implode(" ",$result_array);
    echo $collab_update_string;

    $query = "UPDATE {$table} SET collabs = '{$collab_update_string}' WHERE id = $listId";
    $result = $connection->query($query);
    confirmQuery($result);


    redirect("task_view.php?t_id={$_SESSION['list_id']}");

}


 ?>
