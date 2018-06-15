<?php
  include_once('connect.php');
  include_once('functions.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

    if(isset($_GET['p_id'])){
        $n_id = $_GET['p_id'];
    }else{
      echo "Deletion failed";
      redirect('usernotes.php');
    }


    $table = $_SESSION['curr_id'].'notes';

    $query = "SELECT id,imgPath FROM $table WHERE id = $n_id";
    $result = $connection->query($query);
    confirmQuery($result);
    $row = $result->fetch_assoc();
    $imgPath = $row['imgPath'];

    unlink("uploads/".$imgPath);
    $query = "DELETE FROM $table where id = $n_id";
    $connection->query($query);

    redirect('usernotes.php');


 ?>
