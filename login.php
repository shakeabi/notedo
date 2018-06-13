<?php

include_once('connect.php');
session_start();

$flag = 0;
$db_username = null;
$db_password = null;
$db_id = null;

if(isset($_POST['login'])){
  $username = $_POST['usernamelogin'];
  $username = $connection->real_escape_string($username);
  $password = $_POST['passwordlogin'];

  $hashFormat = "$2y$10$";
  $salt = "notedoisawesomeuseitnow";
  $hashAndSalt = $hashFormat . $salt;
  $password = crypt($password, $hashAndSalt);

  $query = "SELECT * FROM users ";
  $result = $connection->query($query);

  while($row = $result->fetch_assoc()){
    $db_username = $row['username'];
    $db_password = $row['password'];
    $db_id = $row['id'];

    if($username == $db_username && $password == $db_password){
      $flag = 1;
      break;
    }
  }
if($flag == 1){
  $flag = 0;
  $_SESSION['curr_id'] = $db_id;
  $_SESSION['curr_username'] = $db_username;
  header("Location: usernotes.php");
}
else{
    $_SESSION['info_l'] = 'Wrong Credentials';
    header("Location: index.php#tologin");
}




}

 ?>
