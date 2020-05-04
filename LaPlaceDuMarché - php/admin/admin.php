
<?php

    session_start();
?>

<link rel="stylesheet" href="../style/bootstrap.css" type="text/css">

<h1>bienvenue, <?php echo $_SESSION['username']; ?></h1>
<br />
<!--Test action=add-->
<a href="?action=add">Ajouter un produit</a>
<a href="?action=modifyanddelete">Modifier / supprimer un produit</a><br/><br/>


<?php
    // Connection à la base de donnée
    try{

        $bdd = new PDO('mysql:host=localhost;dbname=laplacedumarche;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// les erreurs lanceront des exceptions
        $bdd->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractéres minuscules

    }
    catch(Exception $e){

        die('Erreur : '.$e->getMessage());
    
    }

    if(isset($_SESSION['username'])){

        if(isset($_GET['action'])){    
        
            // Test action=add
            if($_GET['action']=='add'){

                // Test submit
                if(isset($_POST['submit'])){

                    $title=$_POST['title'];
                    $description=$_POST['description'];
                    $price=$_POST['price'];

                    if($title && $description && $price){

    
                        //insertion des données
                        //$insert = $bdd->prepare("INSERT INTO products VALUES('$title','$description','$price')");
                        //$insert->execute();
                        $req = $bdd->prepare('INSERT INTO products1 (title, description, price ) VALUES(?, ?, ?)');
                        $req->execute(array($_POST['title'], $_POST['description'], $_POST['price']));

                    }else{

                    echo'Veuillez remplir tous les champs';

                    }

                }    

            ?>
                <!-- Formulaire -->
                <form action="" method="post">
                <h3>Titre du produit :</h3><input type="text" name="title" />
                <h3>Description du produit :</h3><textarea name="description"></textarea>
                <h3>Prix :</h3><input type="text" name="price" /><br /><br />
                <input type="submit" name="submit" />

                </form>

            <?php

            }else if ($_GET['action']=='modifyanddelete'){ // Action de modification où de suppression

                $select = $bdd->prepare("SELECT * FROM products");
                $select->execute();

                while($s=$select->fetch(PDO::FETCH_OBJ)){//tant que tu as des données à m afficher

                    echo $s->title;//afficher les articles et les liens pour supprimer ou modifier un article
                    ?>
                    <a href="?action=modify&amp;id=<?php echo $s->id; ?>">Modifier</a>
                    <a href="?action=delete&amp;id=<?php echo $s->id; ?>">Supprimer</a><br/><br/>
                    <?php

                }

            }else if ($_GET['action']=='modify'){ // action=modify

                $id=$_GET['id']; // id = id selectionner

                $select = $bdd->prepare("SELECT * FROM products WHERE id=$id"); // Aller chercher l'information dans products
                $select->execute();

                $data = $select->fetch(PDO::FETCH_OBJ);// Recuperation des données
                ?>
                <!-- Formulaire -->
                <form action="" method="post">
                <h3>Titre du produit :</h3><input value="<?php echo $data->title; ?>" type="text" name="title" />
                <h3>Description du produit :</h3><textarea name="description"><?php echo $data->description; ?></textarea>
                <h3>Prix :</h3><input value="<?php echo $data->price; ?>" type="text" name="price" /><br /><br />
                <input type="submit" name="submit" value="modifier"/>
                <?php
                // Action de modification
                if(isset($post['submit'])){ //Quand j'appuie sur submit

                    // $data = [
                    //     'title' => $title,
                    //     'description' => $description,
                    //     'price' => $price,
                    // ];                    

                    //$udapte = "UPDATE products1 SET title=$title, description=$description, price=$price, WHERE id=$id";
                    //$stmt= $pdo->prepare($sql);
                    //$stmt->execute($data);                    

                    $title=$_POST['title']; // Je modifie le titre
                    $description=$_POST['description']; // Je modifie la description
                    $price=$_POST['price']; // Je modifie le prix.

                    // Je mets à jour la base de donnée sélectionner.
                    $sql = "UPDATE products SET title=?, description=?, price=? WHERE id=$id";
                    $stmt= $pdo->prepare($sql);
                    $stmt->execute([$title, $description, $price]);
                    //$req = $bdd->prepare("UPDATE products1 SET `title`='salade1',`description`='super',`price`='10' WHERE `id`=$id");
                    //if ($req->execute()) { 
                        //echo 'working';
                    //} else {
                        //echo 'not working';
                    //}

                    //$update = $bdd->exec("UPDATE products SET title=$title, description=$description, price=$price WHERE id=$id");
                    //$udapte->execute();

                    //$requete = "UPDATE products ($title, $description, $price ) VALUES(?, ?, ?)";
                    //$mysqli->query($requete) or die ('Erreur '.$requete.' '.$mysqli->error());
                    
                    //$req = $bdd->prepare("UPDATE products SET title = $nvtitle, description = $nvdescription, price = $nvprice WHERE id = $id");
                    //$req->execute();

                    //'nvtitle' => $nvtitle,'nvdescription' => $nvdescription,'nvprice' => $nvprice
                    
                    //test phpmyadmin
                    //UPDATE `products` SET `title`=[value-2],`description`=[value-3],`price`=[value-4] WHERE `id`=[$id]

                    //'UPDATE products1 SET title="salad1", description="super", price=20 WHERE id=1' ok

                    //header('location: admin.php action=modifyanddelete');

                    //$update = "UPDATE products SET title = ?, description = ?, price = ? WHERE id = ?";
                    //$pdostmt = $bdd->prepare($update);
                    //$pdostmt->bindParam(1, $title, PDO::PARAM_STR);
                    //$pdostmt->bindParam(2, $description, PDO::PARAM_STR);
                    //$pdostmt->bindParam(3, $price, PDO::PARAM_INT);
                    //$pdostmt->bindParam(4, $id, PDO::PARAM_INT);
                    //$pdostmt->execute();
                }


            }else if ($_GET['action']=='delete'){ // action=delete 
                
                $id=$_GET['id'];
                $delete = $bdd->prepare("DELETE FROM products1 WHERE id=$id");
                $delete->execute();

            }else{

                die('Une erreur s\'est ptoduite.');
        
            }

        }else{
            
        }

    }else {

    header('Location: ../index.php');
    }

?>

