<!DOCTYPE html>
<html lang="en">
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
</head>
<?php

    require_once('includes/header.php');
    require_once('includes/sidebar.php');
    $select = $bdd->prepare("SELECT * FROM products");
    $select->execute();

    while($s=$select->fetch(PDO::FETCH_OBJ)){
    
        ?>
        <img src="admin/images<?php echo $s->title; ?>.jpg"/>
        <h2><?php echo $s->title; ?></h2>
        <h5><?php echo $s->description; ?></h5>
        <h4><?php echo $s->price; ?> €</h4>
        <br/><br/>
        <?php
    }    


    require_once('includes/footer.php');

    
?>

<br/><br/><br/><br/>
<div class="col-md-6 col-lg-3 ftco-animate">
    <div class="product">
        <a href="#" class="img-prod"><img class="img-fluid" src="images/product-5.jpg" alt="Colorlib Template">
            <span class="status">30%</span>
            <div class="overlay"></div>
        </a>
        <div class="text py-3 pb-4 px-3 text-center">
            <h3><a href="#"><?php echo $s->title; ?></a></h3>
            <div class="d-flex">
                <div class="pricing">
                    <p class="price"><span class="mr-2 price-dc">$120.00</span><span
                            class="price-sale"><?php echo $s->price; ?> €</span></p>
                </div>
            </div>
            <div class="bottom-area d-flex px-3">
                <div class="m-auto d-flex">
                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                        <span><i class="ion-ios-menu"></i></span>
                    </a>
                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                        <span><i class="ion-ios-cart"></i></span>
                    </a>
                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                        <span><i class="ion-ios-heart"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</html>