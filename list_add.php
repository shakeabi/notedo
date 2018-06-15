<?php
include_once('connect.php');
include_once('functions.php');
session_start();


date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['add_list'])){
  $list_name = $_POST['list_name'];
  $list_time = date("l jS \of F Y h:i:s A");

  $table = $_SESSION['curr_id']."task_lists";

  $query = "INSERT INTO {$table}(listName, editTime, createTime) ";

  $query .= "VALUES('{$list_name}','{$list_time}','{$list_time}')";

  $create_note_query = $connection->query($query);

  confirmQuery($create_note_query);

  $query = "SELECT listName,id FROM $table";
  $result = $connection->query($query);

  while($row = $result->fetch_assoc()){
    $db_listName = $row['listName'];
    $db_id = $row['id'];
    if($list_name == $db_listName){
      break;
    }
  }

  $tableName_tasks = $_SESSION['curr_id'].$db_id."tasks";
  $query = "CREATE TABLE IF NOT EXISTS $tableName_tasks(
      id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      taskName VARCHAR(1000) NOT NULL,
      taskPriority INT(11) NOT NULL,
      checked INT(11) DEFAULT '0',
      createTime VARCHAR(1000) NOT NULL
      )";
  $result = $connection->query($query);
  confirmQuery($result);
  redirect('usertasks.php');
}
?>
