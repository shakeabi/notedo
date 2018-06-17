<?php
  include_once('connect.php');
  include_once('functions.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

    if(isset($_GET['t_id'])&&isset($_GET['u_id'])){
        $t_id = $_GET['t_id'];
        $u_id = $_GET['u_id'];
    }else{
      echo "Deletion failed";
      redirect('usertasks.php');
    }


    $table = $u_id.'task_lists';
    $list_table = $u_id.$t_id.'tasks';

    $query = "DELETE FROM $list_table";
    $connection->query($query);

    $query = "DROP TABLE $list_table";
    $connection->query($query);

    $query = "DELETE FROM $table where id = $t_id";
    $connection->query($query);

//Be careful here! for collaborated deletes only!

  if($u_id != $_SESSION['curr_id']){
    $table = $_SESSION['curr_id']."list_collabs";
    $query = "DELETE FROM $table WHERE (collabId = {$u_id} AND listId = {$t_id})";
    $connection->query($query);
  }


    redirect('usertasks.php');


 ?>
