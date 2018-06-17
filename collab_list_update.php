<?php
include_once('connect.php');
include_once('functions.php');
session_start();


date_default_timezone_set('Asia/Kolkata');


if(isset($_POST['collab_update_list'])){

  $table = $_SESSION['collab_u_id'].$_SESSION['collab_l_id']."tasks";


  foreach($_POST as $id=>$checked){
    if($checked == 'on'){$checked = 1;}
    else {$checked = 0;}
    $query = "UPDATE {$table} ";
    $query .= "SET checked = {$checked} ";
    $query .= "WHERE id = {$id}";
    $result = $connection->query($query);
  }

  $table = $_SESSION['collab_u_id']."task_lists";
  $newTime = date("l jS \of F Y h:i:s A");
  $newId = $_SESSION['collab_l_id'];

  $query = "UPDATE {$table} ";
  $query .= "SET editTime = '{$newTime}' ";
  $query .= "WHERE id = {$newId}";
  $create_note_query = $connection->query($query);
  confirmQuery($create_note_query);

  redirect("collab_task_view.php?collab_u_id={$_SESSION['collab_u_id']}&collab_l_id={$_SESSION['collab_l_id']}");

}

?>
