<?php
include_once('connect.php');
include_once('functions.php');
session_start();


date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['add_note_collab'])){

    $userId = $_SESSION['curr_id'];
    $noteId = $_SESSION['note_id'];
    $createTime = date("l jS \of F Y h:i:s A");

    $targetId = $_POST['target_collab_id'];

    $table = $targetId."note_collabs";

    $query = "INSERT INTO {$table}(collabId,noteId,createTime)";
    $query .= "VALUES('{$userId}','{$noteId}','{$createTime}')";
    $result = $connection->query($query);
    confirmQuery($result);

    $table = $userId."notes";

    $query = "SELECT collabs FROM {$table} WHERE id = $noteId";
    $result = $connection->query($query);
    confirmQuery($result);
    $row = $result->fetch_assoc();

    $result_array = explode(" ",$row['collabs']);

    array_push($result_array,$targetId);
    $collab_update_string = implode(" ",$result_array);
    echo $collab_update_string;

    $query = "UPDATE {$table} SET collabs = '{$collab_update_string}' WHERE id = $noteId";
    $result = $connection->query($query);
    confirmQuery($result);


    redirect("notes_view.php?p_id={$_SESSION['note_id']}");

}


 ?>
