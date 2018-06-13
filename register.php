<?php
  include_once('connect.php');
  session_start();

  $flag = 0;
  $db_username = null;
  $db_password = null;
  $db_id = null;

  if(isset($_POST['register'])){
    if($_POST['passwordsignup'] == $_POST['passwordsignup_confirm']){
      $username = $_POST['usernamesignup'];
      $username = $connection->real_escape_string($username);
      $password = $_POST['passwordsignup'];
      $password_confirm = $_POST['passwordsignup_confirm'];
      $email = $_POST['emailsignup'];
      $email = $connection->real_escape_string($_POST['emailsignup']);


      $hashFormat = "$2y$10$";
      $salt = "notedoisawesomeuseitnow";
      $hashAndSalt = $hashFormat . $salt;
      $password = crypt($password, $hashAndSalt);

      $query = "INSERT INTO users(username,password,email) "; // be careful with the quotations!
      $query .= "VALUES ('$username', '$password', '$email')";
      $connection->query($query);

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

      //creating personal tables..
      $tableName_notes = $db_id."notes";
      $query = "CREATE TABLE IF NOT EXISTS $tableName_notes(
      		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      		title VARCHAR(200) NOT NULL,
      		noteContent TEXT NOT NULL,
      		priority INT(11) NOT NULL,
      		labels VARCHAR(1000) NOT NULL,
      		imgPath VARCHAR(1000) NOT NULL,
      		editTime VARCHAR(1000) NOT NULL,
      		createTime VARCHAR(1000) NOT NULL
      		)";
      $connection->query($query);


      $tableName_tasks = $db_id."tasks";
      $query = "CREATE TABLE IF NOT EXISTS $tableName_tasks(
      		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
      		checked VARCHAR(200) NOT NULL,
      		taskContent VARCHAR(8000) NOT NULL,
      		priority INT(11) NOT NULL,
      		editTime VARCHAR(1000) NOT NULL,
      		createTime VARCHAR(1000) NOT NULL
      		)";
      $connection->query($query);
      
      if($flag == 1){
        $flag = 0;
        $_SESSION['curr_id'] = $db_id;
        $_SESSION['curr_username'] = $db_username;
        header("Location: usernotes.php");
      }
      else{
          $_SESSION['info'] = 'User could not be added to the database!';
          header("Location: start.php#toregister");
      }


    }
    else{
      $_SESSION['info'] = 'Passwords do not Match!';
      header("Location: index.php#toregister");
    }
  }

 ?>
