<!DOCTYPE html>
<html lang="en">

<?php
    require_once('includes/header.php');
	require_once('includes/sidebar.php');
	
    if(isset($_GET['show'])){

        $product = $_GET['show'];

        $select = $bdd->prepare("SELECT * FROM products WHERE title='$product'");
        $select->execute();
        
        $s = $select->fetch(PDO::FETCH_OBJ);

        $description = $s->description;

        $description_finale=wordwrap($description,120,'<br />', false);//Saut de ligne tout les 120 caractéres

        ?>
        <!-- Isolation produit pour présentation-->
        <br/><div style="text-align:center;">
        <img src="admin/images/<?php echo $s->title; ?>.jpg"/>
        <h1><?php echo $s->title; ?></h1>
        <h6><?php echo $description_finale; ?></h6>
        <h4><?php echo $s->price; ?> €</h4>
        <h4>Stock :<?php echo $s->stock; ?> Qt ou Kg</h4>
        </div><br/>

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
            
            $description_finale=wordwrap($new_description,50,'<br />', false);//Saut de ligne tout les 50 caractéres
		
			?>
            <head>
                <title>La Place Du Marché<img class="img-fluid" src="images/france.jpg" alt="Colorlib Template"></title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
                    rel="stylesheet">
                <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

                <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
                <link rel="stylesheet" href="css/animate.css">

                <link rel="stylesheet" href="css/owl.carousel.min.css">
                <link rel="stylesheet" href="css/owl.theme.default.min.css">
                <link rel="stylesheet" href="css/magnific-popup.css">

                <link rel="stylesheet" href="css/aos.css">

                <link rel="stylesheet" href="css/ionicons.min.css">

                <link rel="stylesheet" href="css/bootstrap-datepicker.css">
                <link rel="stylesheet" href="css/jquery.timepicker.css">

                <link rel="stylesheet" href="css/flaticon.css">
                <link rel="stylesheet" href="css/icomoon.css">
                <link rel="stylesheet" href="css/style.css">
            </head>
            <!-- Fiche article des produit à vendre -->
            <br/>
			<a href="?show=<?php echo $s->title;?>"><img src="admin/images/<?php echo $s->title; ?>.jpg"/></a><!--selection-->
			<a href="?show=<?php echo $s->title;?>"><h2><?php echo $s->title; ?></h2></a><!--selection-->
			<h6><?php echo $description_finale; ?></h6>
			<h4><?php echo $s->price; ?> €</h4>
            <h4>Stock :<?php echo $s->stock; ?> Qt ou Kg</h4>
            <?php if ($s->stock!=0){?><a href="panier.php?action=ajout&amp;1=<?php echo $s->titel; ?>$amp;q=1&amp;p=<?php echo $s->price; ?>">Ajouter au pannier</a><?php }else{echo'<h5 Stock style="color:red;">Stock épuisé !</h5>';} ?>
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
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
		<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
		<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
			stroke="#F96D00" /></svg></div>

<script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

</body>

</html>