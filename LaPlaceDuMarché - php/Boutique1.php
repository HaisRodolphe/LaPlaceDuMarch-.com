<?php
    require_once('includes/header.php');
	require_once('includes/sidebar.php');
	
	if(isset($_GET['category'])){

		$category=$_GET['category'];	
		$select = $bdd->prepare("SELECT * FROM products WHERE category='$category'");
		$select->execute();
			
		while($s=$select->fetch(PDO::FETCH_OBJ)){
		
			?>

			<img src="admin/images/<?php echo $s->title; ?>.jpg"/>
			<h2><?php echo $s->title; ?></h2>
			<h5><?php echo $s->description; ?></h5>
			<h4><?php echo $s->price; ?> €</h4>
			<br/><br/>

			<?php
		}	
		
    ?>

    <br/><br/><br/><br/>

    <?php

	}else{

	$select = $bdd->query("SELECT * FROM category");
				
	while($s = $select->fetch(PDO::FETCH_OBJ)){

		?>

		<a href="?category=<?php echo $s->name;?>"><h3><?php echo $s->name ?></h3></a>

		<?php

	}
        

    require_once('includes/footer.php');

        
    }
?>