<?php
session_start();    
require_once('includes/head.php');
require_once('includes/header.php');
require_once('includes/sidebar.php');
include_once('includes/functions_panier.php');

$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']: (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{

    if(!in_array($action, array('ajout','suppression','refresh')))
    $erreur = true;
    //récupération des variables en POST ou GET
    $l = (isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
    $q = (isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
    $p = (isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));
    //Suppression des espaces verticaux
    $l = preg_replace('#\v#', '', $l);
    //On vérifie que $p est un float
    $p = floatval($p);

    //On traite $q qui peut être un entier simple ou un tableau d'entiers
    if(is_array($q)){
        
    $QteArticle = array();  
    $i = 0;
    foreach($q as $contenu){
        $QteArticle[$i++] = intval($contenu);  
        }

    }
    else{
    $q = intval($q);

} 

    
if(!$erreur){
    switch($action){
        Case "ajout":
            ajouterArticle($l, $q, $p);
            break;
                
        Case "suppression":
            suprimerArticle($l);
            break;

        Case "refresh":
            for($i = 0;$i<count($QteArticle);$i++)
            {
                modifierQteArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
            }
            break;

        Default:
            break;
    }
}

echo '<?xml version="1.0" encoding="utf-8"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<form method="post" action="">
    <table width="400">
        <tr>
            <td colspan="4">Votre panier</td>
        </tr>
        <tr>
            <td>Libellé produit</td>
            <td>Prix unitaire</td>
            <td>Quantité</td>
            <td>TVA</td>
            <td>Action</td>
        </tr>

        <?php
        if(isset($_GET['deletpanier']) && $_GET['deletpanier'] == true)
        {
          supprimerPanier();
        }

        if(creationPanier())
        {
            $nbProduits = count($_SESSION['panier']['libelleProduit']);
            if($nbProduits <= 0){
            echo '<br/><p style="font-size:20px; color:red;">Oops, panier vide !</p>';
            }else{
                for($i = 0; $i<$nbProduits; $i++)
            
                ?>    
                <tr>

                    <td><br/><?php echo $_SESSION['panier']['libelleProduit'][$i];?></td>
                    <td><br/><?php echo $_SESSION['panier']['prixProduit'][$i];?></td>
                    <td><br/><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i];?> " size="5" /></td>
                    <td><br/><?php echo $_SESSION['panier']['tva'][$i]." %"; ?></td>
                    <td><br/><a herf="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]);?>">X</a></td>

                </tr>
                <?php } ?>
                <tr>

                <td colspan="2"><br />
                    <p>Total : <?php echo MontantGlobal()."€"; ?></p><br />
                    <p>Total avec TVA : <?php echo MontantGlobalTVA()."€"; ?></p>
                    <p>Calcule des frais de port : <?php echo CalulFraisPort()."€"; ?></p>
                </td>

                </tr>
                <tr>

                <td colspan="4">
                    <input type="submit" value="rafraichir" />
                    <input type="hidden" name="action" value="refresh" />
                    <a href="?deletepanier=true">Suprime le panier</a>
                </td>

                </tr>

                <?php
                }  
                
            }
            
        ?>
    </table>
</form>

<?php

require_once('includes/partner.php');
require_once('includes/abonnement.php');
require_once('includes/footer.php');
require_once('includes/script.php');
?>
</html>