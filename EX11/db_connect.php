<?php
  $servername = "localhost";
  $username   = "root";
  $password   = 'mysql';
  $dbname     = "shopping_db";
 
  $conn = new mysqli('127.0.0.1', 'root', '', 'shopping_db', 3307);
 
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
?>
