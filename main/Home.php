<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
    <?php include('layout/Header.php')?>
	<link rel="stylesheet" href="css/produit.css"/>
	<link rel="stylesheet" href="css/swiper-bundle.min.css"/>
</head>

<body>
	<?php include('layout/Menu.php'); ?>

	<!-- Swiper -->
  	<div class="swiper-container" >
	    <div class="swiper-wrapper" style="margin-top: 50px;height: 400px">
	      <div class="swiper-slide"><img src='./images/backpack1.jpg' alt='Product image' /></div>
	      <div class="swiper-slide"><img src='./images/backpack2.jpg' alt='Product image' /></div>
	      <div class="swiper-slide"><img src='./images/backpack3.jpg' alt='Product image' /></div>
	      <div class="swiper-slide"><img src='./images/sac_dos-fjallraven-438378.jpg' alt='Product image' /></div>
	    </div>
    	<!-- Add Pagination -->
    	<div class="swiper-pagination"></div>
  	</div>

  	<section>
      <div class="container">
  		<div class="about-us-titre">
  			<h1>About us</h1>
  		</div>
  		<div class="about-us-cont">
  		<div class="about-us-img">
  			<img src="./images/Shakespeare_and_Company_bookstore.png" alt="Bookstore image"/>
  		</div>
  		<div class="about-us-txt">
  			<i>I created this bookstore like a man would write a novel, building each room like a chapter, and I like people to open the door the way they open a book, a book that leads into a magic world in their imaginations. —George Whitman</i>
  		</div>
  		</div>
  	</div>

  </section>

  	<section>
      <div class="container">
  		<div class="nos-livres-titre">
  			<h1>Nos livres</h1>
  		</div>
  		<!--Livres  -->
  		<div class="nos-livres-prod">
  			<div class="product-div">
                <div class="product-image">
                    <img src='./images/cien-anos-soledad.png' alt='Cien anos soledad' />
                </div>
                <div class="product-details">
                    <h5>Cien Años De Soledad</h5>
                    <p>Gabriel García márquez</p>
                    <p>Ref. 001<b> 150€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/the_alchemist_.png' alt='The Alchemist' />
                </div>
                <div class="product-details">
                    <h5>The Alchemist</h5>
                    <p>Paulo Cohelo</p>
                    <p>Ref. 002<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/le_parfum.png' alt='Le Parfum' />
                </div>
                <div class="product-details">
                    <h5>Le Parfum</h5>
                    <p>Patrick Süskind</p>
                    <p>Ref. 003<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
  		</div>
  		<div class="nos-livres-lien">
  				<a href="./Livres.php">Découvrir plus</a>
  		</div>
  	</div>
  </section>

  	<section>
      <div class="container">
  		<div class="nos-livres-titre">
  			<h1>Nos produits</h1>
  		</div>
  		<div class="nos-livres-prod">
		  <div class="product-div">
                <div class="product-image">
                    <img src="./images/chaise1.jpg" alt="Product Image" />
                </div>
                <div class="product-details">
                    <h5>BOSS Office Products 25 in. Width Big and Tall Brown Fabric</h5>
                    <p>Ref. 640<b> 250€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src="./images/chaise2.jpg" alt="Product Image" />
                </div>
                <div class="product-details">
                    <h5>Secretlab OMEGA, Black desk chair, Prime Leather</h5>
                    <p>Ref. 780<b> 180€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src="./images/chaise3.jpg" alt="Product Image" />
                </div>
                <div class="product-details">
                    <h5>DEER HUNTER Gaming Style Computer Office Desk Chair (Red)</h5>
                    <p>Ref. 95<b> 300€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
          </div>
	        <div class="nos-livres-lien">
  				<a href="./Produits.php">Découvrir plus</a>
  			</div>
		</div>
  </section>

	<?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>

	<!-- Initialize Swiper -->
	<script src="./js/swiper-bundle.min.js"></script>
	<script>
        var swiper = new Swiper('.swiper-container', {
            pagination: {el: '.swiper-pagination',},
        });
  	</script>
</body>
</html>