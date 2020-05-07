<div class="sidebar">
<h4>Derniers Articles</h4>
<head>
<title>La Place Du Marché</title>
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
    <link rel="stylesheet" href="../style/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="style/stylesidebar.css">
</head>
<?php

    $select = $bdd->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 0,2");//Nombre d'articles à afficher
    $select->execute();

    while($s=$select->fetch(PDO::FETCH_OBJ)){

        $lenght=35;//reduction de la description

        $description = $s->description;

        $new_description = substr($description,0,$lenght)."...";//reduction de 00 à 35 caractéres
            
        $description_finale=wordwrap($new_description,35,'<br />', true);//Saut de ligne tout les 50 caractéres

        ?>
        <div style="text-align:center;">
        <img height="50" width="50" src="admin/images/<?php echo $s->title; ?>.jpg"/><br/>
        <h8><?php echo $s->title; ?></h8><br/>
        <h8><?php echo $description_finale; ?></h8><br/>
        <h8><?php echo $s->price; ?> €</h8><br/>
        </div><br/>
        <?php
    }    

?>




</div>