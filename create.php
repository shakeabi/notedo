<?php

  include_once("connect.php");

  $query = "CREATE TABLE IF NOT EXISTS users(
              id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
              username VARCHAR(255) NOT NULL,
              password VARCHAR(255) NOT NULL,
              email VARCHAR(255) NOT NULL
              )";

  $connection->query($query);



 ?>
