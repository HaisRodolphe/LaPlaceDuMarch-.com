<?php 

  require 'configConnect.php'; 

  // echo '<p>je me connecte à la BDD. </p> ';

  try {

    $dbConnect = new PDO($dsn, $user, $password, $options);

    // https://www.php.net/manual/en/pdo.setattribute.php -> Configure un attribut PDO
    $dbConnect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);    

  } catch(PDOException $e) {

    // https://www.php.net/manual/fr/exception.getmessage -> Récupère le message de l'exception
    die("Database connection failed : " . $e->getMessage());

  }

