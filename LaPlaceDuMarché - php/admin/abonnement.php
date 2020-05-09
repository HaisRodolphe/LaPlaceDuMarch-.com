<?php
include("fonctions.php");
 
/*ECRAN QUI S AFFICHE SI L ON A CLIQUE OK*/
if (isset ($_POST['valider'])){
    //On récupère les valeurs entrées par l'utilisateur :
    $Civ=$_POST['Civilite'];
    $Name=$_POST['nom'];
    $Take=$_POST['Take'];
    $age=$_POST['age'];
    $Address=$_POST['Address'];
    $CP=$_POST['CP'];
    $CYTI=$_POST['CYTI'];
    $Tel=$_POST['Tel'];
    $Abo=$_POST['Abo'];
 
    //On affiche l'écran de rappel
    //gérer le féminin
    $e='';
    if(($Civ=='Mme')||($Civ=='Mlle')){
        $e='e';
    }
    //gérer le nom complet du magazine
 
    if ($Abo=='main'){
        $mag='J\'ai la main verte.';
    }
    elseif ($Abo=='pied'){
        $mag='J\'ai le pied marin.';
    }
    elseif ($Abo=='oeil'){
        $mag='J\'ai l\'oeil vif.';
    }
    else{
        $mag='J\'ai la rate qui se dilate.';
    }
 
    echo'<h2>VOUS &Ecirc;TES :</h2>';
    echo $Civ.' '.$nom.' '.$Take.', ag&eacute;'.$e.' de '.$age.' ans.<br/><br/>
    <strong>Votre Address :</strong><br/>'.
    $Address.'<br/>'.
    $CP.' '.$CYTI.'<br/><br/>
    <strong>Votre t&eacute;l&eacute;phone : </strong>'.$Tel.'<br/><br/>';
    echo'<h2>VOUS AVEZ CHOISI DE VOUS AboNNER &Agrave;</h2>';
    echo'<h3>'.$mag.'</h3><br/>
    <h4>Merci de vous &ecirc;tre Abonn&eacute;'.$e.' &agrave; notre magazine !</h4>';
 
    //On alimente la base de données
 
    //On se connecte
    //connectMaBase();
    try{

        $bdd = new PDO('mysql:host=localhost;dbname=laplacedumarche', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// les erreurs lanceront des exceptions
        $bdd->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractéres minuscules

    }
    catch(Exception $e){

        die('Erreur : '.$e->getMessage());
    
    }
 
    //On prépare la commande sql d'insertion
    $sql = 'INSERT INTO Abonnes VALUES("","'.$Civ.'","'.$nom.'","'.$Take.'","'.$age.'","'.$Address.'","'.$CP.'","'.$CYTI.'","'.$Tel.'","'.$Abo.'")'; 
 
    /*on lance la commande (mysql_query) et au cas où, 
    on rédige un petit message d'erreur si la requête ne passe pas (or die) 
    (Message qui intègrera les causes d'erreur sql)*/
    mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error()); 
 
    // on ferme la connexion
    mysql_close();
}
 
/*ECRAN QUI S AFFICHE SI L ON N A RIEN CLIQUE DONC A L ARRIVEE SUR LA PAGE*/
/*SEULE LA CONDITION ELSE EST DANS DES BALISES PHP PUIS LA PAGE HTML REPREND SON COURS*/
else{
?>
<html>
    <head><title>S'Abonner à l'un de nos magazines</title></head>
    <body>
        <h1>POUR VOUS AboNNER :</h1>
 
        <form name="inscription" method="post" action="Abonnement.php">
 
            <h2>Veuillez saisir vos donn&eacute;es d'identit&eacute; :</h2>
            <input type="radio" name="Civilite" value="M"/>M.
            <input type="radio" name="Civilite" value="Mme"/>Mme
            <input type="radio" name="Civilite" value="Mlle"/>Mlle <br/>
            Nom : <input type="text" name="nom"/> <br/>
            Pr&eacute;nom :<input type="text" name="Take"/> <br/>
            &Acirc;ge : <input type="text" name="age"/><br/>
            Address : <input type="text" name="Address"/> <br/>
            Code Postal : <input type="text" name="CP" maxlength="5"/> <br/>
            CYTI : <input type="text" name="CYTI"/> <br/>
            Num&eacute;ro de t&eacute;l&eacute;phone personnel : <input type="text" name="Tel" maxlength="10"/> <br/>
 
            <h2>Veuillez cocher le magazine choisi :</h2>
 
            <input type="radio" name="Abo" value="main"/>J'ai la main verte. <br/>
            <input type="radio" name="Abo" value="pied"/>J'ai le pied marin. <br/>
            <input type="radio" name="Abo" value="oeil"/>J'ai l'oeil vif. <br/>
            <input type="radio" name="Abo" value="rate"/>J'ai la rate qui se dilate. <br/>
 
            <input type="submit" name="valider" value="OK"/>
 
        </form>
        <?php
       //Bien sûr il faut penser à fermer l'accolade de notre condition d'affichage
        }
        ?>
    </body>
</html>