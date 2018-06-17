<?php
  include_once('connect.php');
  include_once('functions.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

  if(isset($_GET['p_id'])&&isset($_GET['u_id'])){
      $n_id = $_GET['p_id'];
      $u_id = $_GET['u_id'];
  }else{
      echo "Deletion failed";
      redirect('usernotes.php');
    }


    $table = $u_id.'notes';

    $query = "SELECT id,imgPath FROM $table WHERE id = $n_id";
    $result = $connection->query($query);
    confirmQuery($result);
    $row = $result->fetch_assoc();
    $imgPath = $row['imgPath'];

    if($imgPath != 'DEFAULT.jpg'){
        unlink("uploads/".$imgPath);
    }

    $query = "DELETE FROM $table where id = $n_id";
    $connection->query($query);

    //Be careful here! for collaborated deletes only!

      if($u_id != $_SESSION['curr_id']){
        $table = $_SESSION['curr_id']."note_collabs";
        $query = "DELETE FROM $table WHERE (collabId = {$u_id} AND noteId = {$n_id})";
        $connection->query($query);
      }

    redirect('usernotes.php');


 ?>
