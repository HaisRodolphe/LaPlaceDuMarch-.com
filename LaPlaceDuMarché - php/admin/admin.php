
<?php

    session_start();
?>

<link rel="stylesheet" href="../style/bootstrap.css" type="text/css">

<h1>bienvenue, <?php echo $_SESSION['username']; ?></h1>
<br />
<!--Test action=add-->
<a href="?action=add">Ajouter un produit</a>
<a href="?action=modifyanddelete">Modifier / supprimer un produit</a><br/><br/>

<a href="?action=add_category">Ajouter une categorie</a><br/><br/>
<a href="?action=modifyanddelete_category">Modifier / supprimer une categorie </a><br/><br/>


<?php
    // Connection à la base de donnée
    try{

        $bdd = new PDO('mysql:host=localhost;dbname=laplacedumarche', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));// les erreurs lanceront des exceptions
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
                    //variables
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];

                    // gestion insertion image
                    $img = $_FILES['img']['name'];

                    $img_tmp = $_FILES['img']['tmp_name'];

                    if(!empty($img_tmp)){

                        $image = explode('.' ,$img);

                        $image_ext = end($image);

                        //print_r($image_ext);

                        if(in_array(strtolower($image_ext),array('png','jpg','jpeg'))===false){
                            
                            echo'Veuillez rentrer une image ayant pour extention : png, jpg ou jpeg';


                        }else{
                            // gestion Format image
                            $image_size = getimagesize($img_tmp); 

                            //print_r($image_size);

                            if($image_size['mime']=='image/jpeg'){

                                $image_src = imagecreatefromjpeg($img_tmp);

                            }else if($image_size['mime']=='image/png'){

                                $image_src = imagecreatefrompng($img_tmp);

                            }else{

                                $image_src = false;
                                echo'Veuillez rentrer une image valide';
                            }
                            // gestion dimentionnement image
                            if($image_src!==false){ 

                                $image_width=200;

                                if($image_size[0] == $image_width){

                                    $image_finale = $image_src;

                                }else{

                                    $new_width[0] = $image_width;

                                    $new_height[1] = 200;

                                    $image_finale = imagecreatetruecolor($new_width[0],$new_height[1]);

                                    imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width[0],$new_height[1],$image_size[0],$image_size[1]);

                                }
                                //Gestion d'injection image
                                imagejpeg($image_finale, 'images/' .$title. '.jpg'); 
                            }
                        }


                    }else{

                        echo'Veuillez rentrer une image';

                    }

                    if($title && $description && $price){

                        $category=$_POST['category'];
                        
                        //insertion des données
                        //execute requette preparer
                        $insert = $bdd->prepare("INSERT INTO products (title, description, price, category) VALUES(?, ?, ?, ?)");
                        $insert->execute(array($title, $description, $price, $category));

                    }else{

                    echo'Veuillez remplir tous les champs';

                    }

                }    

            ?>
                <!-- Formulaire -->
                <form action="" method="post" enctype="multipart/form-data">
                <h3>Titre du produit :</h3><input type="text" name="title" />
                <h3>Description du produit :</h3><textarea name="description"></textarea>
                <h3>Prix :</h3><input type="text" name="price" /><br /><br />
                <h3>Image :</h3>
                <input type="file" name="img" /><br /><br /> <!-- insert une image -->
                <!-- Selection category dans la base de donnée--> 
                <h3>Categorie :</h3><select name="category">

                <?php $select=$bdd->query("SELECT * FROM category");

                    while($s = $select->fetch(PDO::FETCH_OBJ)){

                        ?>

                        <option><?php echo $s->name; ?></option>

                        <?php


                    }

                ?>
                
                </select><br /><br />
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
                <h3>Prix :</h3><input value="<?php echo $data->price; ?>" type="text" name="price" /><br/><br/>
                <input type="submit" name="submit" value="modifier"/>
                <?php
                // Action de modification
                if(isset($_POST['submit'])){ //Quand j'appuie sur submit
                    // variable
                    $id=$_GET['id'];//appel id
                    $title=$_POST['title'];// poste dans le formulaire
                    $description=$_POST['description'];// poste dans le formulaire
                    $price=$_POST['price'];// poste dans le formulaire

                    //execute requette preparer
                    $update=$bdd->prepare("UPDATE products SET title=?, description=?, price=? WHERE id=?"); // je prépare ma requéte et je la met à jours
                    $update->execute(array($title, $description, $price, $id)); // j'excute avec les nouvelles données
                    
                    header('Location: admin.php?action=mofyanddelete');
                
                }

            }else if ($_GET['action']=='delete'){ // action=delete 
                
                $id=$_GET['id'];
                $delete = $bdd->prepare("DELETE FROM products WHERE id=?");
                $delete->execute(array($id));
            // Gestion des category    
            //Ajout d'une category    
            }else if($_GET['action']=='add_category'){

                if(isset($_POST['submit'])){

                    $name = $_POST['name']; //variable

                    if($name){

                        $insert = $bdd->prepare("INSERT INTO category (name) VALUES(?)");
                        $insert->execute(array($name));

                    }else{

                        echo'Veuillez remplir tous les champs';

                    }
                }
                
                ?>

                <form action="" method="post">
                <h3>Titre de la categorie :</h3><input type="texte" name="name"/><br/><br/>
                <input type="submit" name="submit" value="Ajouter"/>
                </form>

                <?php
            //Suprimer ou modifier une category
            }else if($_GET['action']=='modifyanddelete_category'){

                $select = $bdd->prepare("SELECT * FROM category");
                $select->execute();

                while($s=$select->fetch(PDO::FETCH_OBJ)){//tant que tu as des données à m afficher

                    echo $s->name;//afficher les articles et les liens pour supprimer ou modifier un article
                    ?>
                    <a href="?action=modify_category&amp;id=<?php echo $s->id; ?>">Modifier</a>
                    <a href="?action=delete_category&amp;id=<?php echo $s->id; ?>">Supprimer</a><br/><br/>
                    <?php

                }

            //Modifier une category
            }else if($_GET['action']=='modify_category'){
            
                $id=$_GET['id']; // id = id selectionner

                $select = $bdd->prepare("SELECT * FROM category WHERE id=$id"); // Aller chercher l'information dans products
                $select->execute();

                $data = $select->fetch(PDO::FETCH_OBJ);// Recuperation des données
                ?>
                <!-- Formulaire -->
                <form action="" method="post">
                <h3>Categorie produis :</h3><input value="<?php echo $data->name; ?>" type="text" name="name" />
                <input type="submit" name="submit" value="modifier"/>
                <?php
                // Action de modification
                if(isset($_POST['submit'])){ //Quand j'appuie sur submit
                    // variable
                    $id=$_GET['id']; // id = id selectionner
                    $name=$_POST['name']; //variable


                    //execute requette preparer
                    $update=$bdd->prepare("UPDATE category SET name=? WHERE id=?"); // je prépare ma requéte et je la met à jours
                    $update->execute(array($name, $id)); // j'excute avec les nouvelles données
                    
                    header('Location: admin.php?action=modifyanddelete_category');
                
                }
            //Suprimer une category
            }else if($_GET['action']=='delete_category'){    

                $id=$_GET['id'];
                $delete = $bdd->prepare("DELETE FROM category WHERE id=?");
                $delete->execute(array($id));

                header('Location: admin.php?action=modifyanddelete_category');

            }else{

                die('Une erreur s\'est ptoduite.');
        
            }

        }else{

            
        }

    }else{
            header('Location: ../index.php');
    }
       
?>

