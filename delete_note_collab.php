<?php
include_once('connect.php');
include_once('functions.php');
session_start();

if(isset($_GET['d_id'])){
  $d_id = $_GET['d_id'];
}else{
    echo "Deletion failed";
    redirect('usernotes.php');
  }

$table = $_SESSION['curr_id']."notes";

$query = "SELECT collabs FROM {$table} WHERE id = {$_SESSION['note_id']}";
$result = $connection->query($query);
confirmQuery($result);
$row = $result->fetch_assoc();

$result_array = explode(" ",$row['collabs']);

foreach ($result_array as $key => $value) {
  if($d_id == $value){
    unset($result_array[$key]);
    //break;
  }
}

$collab_update_string = implode(" ",$result_array);
echo $collab_update_string;

$query = "UPDATE {$table} SET collabs = '{$collab_update_string}' WHERE id = {$_SESSION['note_id']}";
$result = $connection->query($query);
confirmQuery($result);

$table = $d_id."note_collabs";
$query = "DELETE FROM {$table} WHERE (noteId = {$_SESSION['note_id']} AND collabId = {$_SESSION['curr_id']})";
$result = $connection->query($query);
confirmQuery($result);


redirect("notes_view.php?p_id={$_SESSION['note_id']}");


 ?>
