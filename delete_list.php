<?php
  include_once('connect.php');
  include_once('functions.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

    if(isset($_GET['t_id'])){
        $t_id = $_GET['t_id'];
    }else{
      echo "Deletion failed";
      redirect('usertasks.php');
    }


    $table = $_SESSION['curr_id'].'task_lists';
    $list_table = $_SESSION['curr_id'].$t_id.'tasks';

    $query = "DELETE FROM $list_table";
    $connection->query($query);

    $query = "DROP TABLE $list_table";
    $connection->query($query);

    $query = "DELETE FROM $table where id = $t_id";
    $connection->query($query);

    redirect('usertasks.php');


 ?>
