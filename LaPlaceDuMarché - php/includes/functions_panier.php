<?php

function creationPanier(){

    try{

        $db = new PDO('mysql:host=localhost;dbname=laplacedumarche', 'root', '');
        $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);// les noms des champs seront en caractère minuscules
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//les erreurs lanceront des exceptions
    }

    catch(Exception $e){

        die('Une erreur est survenue');
    }

    if(!isset($_SESSION['panier'])){
        
        $_SESSION['panier']=array();
        $_SESSION['panier']['libelleProduit'] = array();
        $_SESSION['panier']['qteProduit'] = array();
        $_SESSION['panier']['prixProduit'] = array();
        $_SESSION['panier']['verrou'] = false;
        $select = $db->query("SELECT tva FROM products");
        $data = $select->fetch(PDO::FETCH_OBJ);
        $_SESSION['panier']['tva'] = $data->tva;


    }

    return true;
}

function ajouterArticle($libelleProduit,$qteProduit,$prixProduit){


    if (creationPanier() && !isVerouille())
    {

        $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);
           
        if($positionProduit !== false){

            $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit;

        }
        else
        {

            array_push($_SESSION['panier']['libelleProduit'],$libelleProduit);
            array_push($_SESSION['panier']['qteProduit'],$qteProduit);
            array_push($_SESSION['panier']['prixProduit'],$prixProduit);
        }

    }
    else{
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }    
}    

function modifierQteArticle($libelleProduit,$qteProduit){
    // Si le panier éxiste
    if (creationPanier() && !isVerouille())
    {
        // Si la quantité est positive on modifie sinon on supprime l'article
        if($qteProduit > 0)
        {
            //Recherche du produit dans le panier
            $positionProduit = array_search($libelleProduit, $_SESSION['panier']['libelleProduit']);

            if($positionProduit !== false)
            {
                $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit;
            }    

        }
        else{
        suprimerArticle($libelleProduit);
        }

    }
    else{
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }
}

function suprimerArticle($libelleProduit){

    if(creationPanier() && !isVerouille())
    {

        $tmp = array();
        $tmp['libelleProduit'] = array();
        $tmp['qteProduit'] = array();
        $tmp['prixProduit'] = array();
        $tmp['verrou'] = $_SESSION['panier']['verrou'];
        $tmp['tva'] = $_SESSION['panier']['tva'];

        for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
        {

            if($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
            {
                array_push($tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
                array_push($tmp['qteProduit'], $_SESSION['panier']['qteProduit'][$i]);
                array_push($tmp['prixProduit'], $_SESSION['panier']['prixProduit'][$i]);
            }
        } 
        $_SESSION['panier'] = $tmp;

        unset($tmp);

    }
    else{
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }
} 
    
function MontantGlobal(){

    $total = 0;

    for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
    {
        $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
    }

    return $total;

}

function MontantGlobalTva(){

    $total = 0;

    for($i = 0; $i<count($_SESSION['panier']['libelleProduit']); $i++)
    {

        $total += $_SESSION['panier']['qteProduit'][$i]*$_SESSION['panier']['prixProduit'][$i];

    }

    return $total + $total*$_SESSION['panier']['tva']/100;


}
    
function suprimerPanier(){
    unset($_SESSION['panier']);
} 

function isVerouille(){
    if(isset($_SESSION['panier']) && $_SESSION['panier']['verrou']){
    return true;
    }else{
    return false;
    }
}
    
function compterArticle()
{
    if(isset($_SESSION['panier'])){
    return count($_SESSION['panier']['libelleProduit']);
    }else{
    return 0;       
    }

}

function CalulFraisPort()
{
    $erreur = false;
    $weight_product = "";
    $shipping = "";

    for($i = 0; $i < compterArticle(); $i++){

        for($j = 0; $j < ($_SESSION['panier']['qteProduit'][$i]); $j++){
            echo "";

        }
    }
    return $shipping;


}

?>