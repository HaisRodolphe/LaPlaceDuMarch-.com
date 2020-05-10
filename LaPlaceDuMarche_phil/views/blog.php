<?php 
	require_once '../templates/doctype.php'; 
	require_once '../templates/header.php';
	require_once '../templates/navbar.php'; 
	require_once '../templates/titleSlide_page.php';
?>
 
    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
						<div class="row">
						
							<!--
								 TODO Partie à dynamiser en PHP pour éviter la répétition en html et taper du code html à l'infinie ... 
							-->

							<?php

								// 1° Se connecter à la Bdd
								require_once '../inc/dbConnect.php';
								
								// 2° Accèder aux données en Bdd via une requête SQL de Selection
								// DATE_FORMAT(champ en datetime, format de conversion) avec heure DATE_FORMAT(created_at, "%d/%m/%Y à %Hh%imin%ss")
								function datasPostSelect($dbConnect){

									/**
									 * 	$reqPrepare = $dbConnect->prepare('SELECT title, content, DATE_FORMAT(created_at, "%d/%m/%Y") AS date_creat_fr, blog_pictures.picture
									 *																 		 FROM blog_post
									 *																     INNER JOIN blog_pictures 
									 *																     ON blog_post.blog_picture_ID = blog_pictures.ID');
									 *	$reqPrepare->execute();
									 */
					
									$req = 'SELECT title, content, DATE_FORMAT(created_at, "%d/%m/%Y à %Hh%imin%ss") AS date_creat_fr, blog_pictures.name, blog_pictures.ext, blog_pictures.path
													FROM blog_post
													INNER JOIN blog_pictures 
													ON blog_post.blog_picture_ID = blog_pictures.ID';								
									$reqPrepare = $dbConnect->prepare($req);
									$reqPrepare->execute();
									return $reqPrepare->fetchAll(PDO::FETCH_ASSOC);

								}

								// 3° Traiter les données								
								
								$datasPost = datasPostSelect($dbConnect);									
								
								// if(isset($datasPost)){
								// 	$postTitle = trim(htmlspecialchars($datasPost['title']));
								// 	echo 'afficher le post';
								// } else {
								// 	echo 'ERROR 404';
								// }									
							?>

							<?php foreach($datasPost AS $datasOnePost) : ?>

							<?php
								// https://www.php.net/manual/fr/control-structures.if.php
								$postDatetimeCreatFr = (isset($datasOnePost)) ? trim(htmlspecialchars($datasOnePost['date_creat_fr'])) : 'ERROR_404';
								$postContent = (isset($datasOnePost)) ? trim(htmlspecialchars($datasOnePost['content'])) : 'ERROR_404';
								$postTitle = (isset($datasOnePost)) ? trim(htmlspecialchars($datasOnePost['title'])) : 'ERROR_404';
								// image voir le CSS - url('../public/images/image_1.jpg')
								$postPicture = (isset($datasOnePost)) ? trim(htmlspecialchars($datasOnePost['path'] . $datasOnePost['name'] . $datasOnePost['ext'])) : 'ERROR_404';									
							?>

								<div class="col-md-12 d-flex ftco-animate">
									<div class="blog-entry align-self-stretch d-md-flex">

										<a href="blog-single.php" class="block-20"><img src="<?= $postPicture ?>" alt=""/></a>
										<div class="text d-block pl-md-4">
											<div class="meta mb-3">
												<!-- https://www.php.net/manual/fr/function.date.php  -  https://www.php.net/manual/fr/datetime.format.php -->
												<time><a href="#"><?= 'Le ' . $postDatetimeCreatFr ?></a></time>
												<div><a href="#">Admin</a></div>
												<!-- TODO Ajouter un compteur de commentaire : 
														 			Pour ce post incrémenter chaque commentaire le concernant
												-->
												<div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
											</div>
											<h3 class="heading"><a href="#"><?= $postTitle ?></a></h3>
											<p><?= mb_substr($postContent, 0, 100); ?> [. . .]</p>
											<p><a href="blog-single.php" class="btn btn-primary py-2 px-3">Read more</a></p>
										</div>
									</div>
								</div>									

							<?php endforeach ; ?>								
							<!-- Fin de partie à dynamiser -->		          

          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon ion-ios-search"></span>
                  <input type="text" class="form-control" placeholder="Search...">
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate">
            	<h3 class="heading">Categories</h3>
              <ul class="categories">
                <li><a href="#">Vegetables <span>(12)</span></a></li>
                <li><a href="#">Fruits <span>(22)</span></a></li>
                <li><a href="#">Juice <span>(37)</span></a></li>
                <li><a href="#">Dries <span>(42)</span></a></li>
              </ul>
            </div>

            <div class="sidebar-box ftco-animate">
							<h3 class="heading">Recent Blog</h3>
							
							<!-- 
								TODO Partie à dynamiser en PHP pour éviter la répition en html et taper du code html à l'infinie ... 
							-->
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(../public/images/image_1.jpg);"></a>
                <div class="text">
                  <h3 class="heading-1"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> April 09, 2019</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
								</div>								
							</div>
							<!-- Fin de partie à dynamiser -->
							
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(../public/images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading-1"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> April 09, 2019</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
								</div>
								
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(../public/images/image_3.jpg);"></a>
                <div class="text">
                  <h3 class="heading-1"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> April 09, 2019</a></div>
                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
							</div>
							
            </div>

            <div class="sidebar-box ftco-animate">
              <h3 class="heading">Tag Cloud</h3>
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">fruits</a>
                <a href="#" class="tag-cloud-link">tomatoe</a>
                <a href="#" class="tag-cloud-link">mango</a>
                <a href="#" class="tag-cloud-link">apple</a>
                <a href="#" class="tag-cloud-link">carrots</a>
                <a href="#" class="tag-cloud-link">orange</a>
                <a href="#" class="tag-cloud-link">pepper</a>
                <a href="#" class="tag-cloud-link">eggplant</a>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3 class="heading">Paragraph</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
            </div>
          </div>

        </div>
      </div>
		</section> <!-- .section -->

<?php 
	require_once '../templates/footer_page.php'; 
	require_once '../templates/footer_script.php';
	require_once '../templates/footerTagClosed.php';
?>
		



   