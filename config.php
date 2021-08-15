<?php
  //Provides data to connect to database

  $host = "localhost";
  $username = "rculv7jbop3v";
  $password = "CAY21hND7e";
  $dbname = "ReadingTracker";
  $dsn = "mysql:host=$host;dbname=$dbname";
  $options = array(
               PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
?>