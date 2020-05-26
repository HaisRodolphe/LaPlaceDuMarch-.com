
<?php
    require_once('includes/header.php');
    require_once('includes/sidebar.php');

?>    
	<?PHP
    if(isset($_GET['show'])){

        $product = $_GET['show'];

        $select = $bdd->prepare("SELECT * FROM products WHERE title='$product'");
        $select->execute();
        
        $s = $select->fetch(PDO::FETCH_OBJ);

        $description = $s->description;

        $description_finale=wordwrap($description,120,'<br />', false);//Saut de ligne tout les 120 caractéres

        ?>
        <!-- Isolation produit pour présentation-->
        <br/>
        <img src="admin/images/<?php echo $s->title; ?>.jpg"/>
        <h1><?php echo $s->title; ?></h1>
        <h6><?php echo $description_finale; ?></h6>
        <h4><?php echo $s->price; ?> €</h4>
        <h4>Stock :<?php echo $s->stock; ?> Qt ou Kg</h4>
        <?php if ($s->stock!=0){ ?><a href="panier.php?action=ajout&amp;l=<?php echo $s->title; ?>&amp;q=1<?php echo $s->stock; ?>&amp;p=<?php echo $s->price; ?>">Ajouter au pannier</a><?php }else{echo'<h5 Stock style="color:red;">Stock épuisé !</h5>';} ?>
        <br/>

        <?php



    }else{


    if(isset($_GET['category'])){

		$category=$_GET['category'];	
		$select = $bdd->prepare("SELECT * FROM products WHERE category='$category'");
        $select->execute();
        
			
		while($s=$select->fetch(PDO::FETCH_OBJ)){

            
            $lenght=75;//reduction de la description

            $description = $s->description;

            $new_description = substr($description,0,$lenght)."...";//reduction de 00 à 75 caractéres
            
            $description_finale=wordwrap($new_description,50,'<br/>', false);//Saut de ligne tout les 50 caractéres
		
			?>
            <!-- Fiche article des produit à vendre -->
            <br/>
			<a href="?show=<?php echo $s->title;?>"><img src="admin/images/<?php echo $s->title; ?>.jpg"/></a><!--selection-->
			<a href="?show=<?php echo $s->title;?>"><h2><?php echo $s->title; ?></h2></a><!--selection-->
			<h6><?php echo $description_finale; ?></h6>
			<h4><?php echo $s->price; ?> €</h4>
            <h4>Stock :<?php echo $s->stock; ?> Qt ou Kg</h4>
            <?php if ($s->stock!=0){ ?><a href="panier.php?action=ajout&amp;l=<?php echo $s->title; ?>&amp;q=1<?php echo $s->stock; ?>&amp;p=<?php echo $s->price; ?>">Ajouter au pannier</a><?php }else{echo'<h5 Stock style="color:red;">Stock épuisé !</h5>';} ?>
			<br/>
			<?php
		}	
		
    ?>

    <br/><br/><br/><br/>

    <?php

    //Choix des cathegories
	}else{

	$select = $bdd->query("SELECT * FROM category");
				
	while($s = $select->fetch(PDO::FETCH_OBJ)){

		?>

		<a href="?category=<?php echo $s->name;?>"><h3><?php echo $s->name ?></h3></a>

		<?php

	}
        

    require_once('includes/footer.php');

        
    }
    }
?>