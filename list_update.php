<?php
include_once('connect.php');
include_once('functions.php');
session_start();


date_default_timezone_set('Asia/Kolkata');


if(isset($_POST['update_list'])){

  $table = $_SESSION['curr_id'].$_SESSION['list_id']."tasks";


  foreach($_POST as $id=>$checked){
    if($checked == 'on'){$checked = 1;}
    else {$checked = 0;}
    $query = "UPDATE {$table} ";
    $query .= "SET checked = {$checked} ";
    $query .= "WHERE id = {$id}";
    $result = $connection->query($query);
  }

  $table = $_SESSION['curr_id']."task_lists";
  $newTime = date("l jS \of F Y h:i:s A");
  $newId = $_SESSION['list_id'];

  $query = "UPDATE {$table} ";
  $query .= "SET editTime = '{$newTime}' ";
  $query .= "WHERE id = {$newId}";
  $create_note_query = $connection->query($query);
  confirmQuery($create_note_query);

  redirect("task_view.php?t_id={$_SESSION['list_id']}");

}

?>
