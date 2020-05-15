<?php

  $dsn = 'mysql:host=localhost; dbname=laplacedumarche; charset=UTF8;';
  $user = 'root';
  $password = 'root';
  // https://www.php.net/manual/en/pdo.setattribute.php
  $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING];