<!DOCTYPE html>
<html lang="en">

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
<!-- nav -->
<?php
require_once('includes/header.php');
?>

<!-- END nav -->
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
				<h1 class="mb-0 bread">Products</h1>
			</div>
		</div>
	</div>
</div>
<section class="ftco-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10 mb-5 text-center">
					<ul class="product-category">
					<?php

						$select = $bdd->query("SELECT * FROM category");
			
						while($s = $select->fetch(PDO::FETCH_OBJ)){

						?>

							<li><a href="?category=<?php echo $s->name;?>"><h5><?php echo $s->name ?>&emsp;</h5></a></li>

						<?php

						}
					?>	
				</ul>
			</div>
		</div>
		<?php
		
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
						<div class="col-md-6 col-lg-3 ftco-animate">
							<div class="product">
							<a href="?show=<?php echo $s->title;?>" class="img-prod text-center"><img class="img-fluid" src="admin/images/<?php echo $s->title; ?>.jpg"
										alt="Colorlib Template"/>
									<div class="overlay"></div>
								</a>
								<div class="text py-3 pb-4 px-3 text-center">
									<a href="?show=<?php echo $s->title;?>"><h2><?php echo $s->title; ?></h2></a>
									<div class="d-flex">
										<div class="pricing">
											<h6><?php echo $description_finale; ?></h6>
											<p class="price"><span><h4><?php echo $s->price; ?> €</h4></span></p>
										</div>
									</div>
									<div class="bottom-area d-flex px-3">
										<div class="m-auto d-flex">
											<a href="#"
												class="add-to-cart d-flex justify-content-center align-items-center text-center">
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
						<?php
					}	
					
				?>
				<br/>
				<?php
					
			}
		}
		?>

		<div class="row mt-5">
			<div class="col text-center">
				<div class="block-27">
					<ul>
						<li><a href="#">&lt;</a></li>
						<li class="active"><span>1</span></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">4</a></li>
						<li><a href="#">5</a></li>
						<li><a href="#">&gt;</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
	<div class="container py-4">
		<div class="row d-flex justify-content-center py-5">
			<div class="col-md-6">
				<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
				<span>Get e-mail updates about our latest shops and special offers</span>
			</div>
			<div class="col-md-6 d-flex align-items-center">
				<form action="#" class="subscribe-form">
					<div class="form-group d-flex">
						<input type="text" class="form-control" placeholder="Enter email address">
						<input type="submit" value="Subscribe" class="submit px-3">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<footer>
	<!-- footer -->
	<?php
	require_once('includes/footer.php');
	?>

	<!-- END footer -->
</footer>

<!-- loader -->
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