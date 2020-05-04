<?php

    session_start();

    $user='RodolpheH';
    $password_definit='1234';

    if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username&&$password){

    if($username==$user&&$password==$password_definit){

    $_SESSION['username']=$username;
    header('Location: admin.php');   

    }else{

    echo'Identifiants eronnes !';
    }

    }else {

    echo'Veuillez remplir tous les champs !';
    }

    }

?>

<link rel="stylesheet" href="../style/bootstrap.css" type="text/css">
<h1>administration - connextion</h1>
<form method="POST" action="">
    <h3>Pseudo :</h3><input type="text" name="username" /><br /><br />
    <h3>Mot-de-passe :</h3></label><input type="password" name="password" /><br /><br />
    <input type="submit" name="submit" /><br /><br />
</form>