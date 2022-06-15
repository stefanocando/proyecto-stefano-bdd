<?php
  $user = 'grupo121';
  $password = 'maninydani';
  $databaseName = 'grupo121e3';
  $db = new PDO("pgsql:dbname=$databaseName;host=localhost;port=5432;user=$user;password=$password");
  $user2 = 'grupo94';
  $password2 = 'Gr94ES';
  $databaseName2 = 'grupo94e3';
  $db2 = new PDO("pgsql:dbname=$databaseName2;host=localhost;port=5432;user=$user2;password=$password2");
?>
