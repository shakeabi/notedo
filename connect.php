<?php

  define ('DB_HOST','localhost');
  define ('DB_USER','root');
  define ('DB_PASSWORD','');

  $connection = new mysqli(DB_HOST,DB_USER,DB_PASSWORD);

  $query = "CREATE DATABASE IF NOT EXISTS notedo";
  $connection->query($query);

  $query = "USE notedo";
  $connection->query($query);

?>
