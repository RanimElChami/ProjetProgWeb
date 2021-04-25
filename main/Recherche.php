<!DOCTYPE html>

<head>
    <title>Recherche</title>
    <?php include('layout/Header.php')?>
    <?php include ('../APIs/include/dbConnection.php'); 
    	  session_start();
    	  if(!isset($_SESSION['total'])){
    	  	$_SESSION['total']=0;
    	  }
    	  else{
    	  	$_SESSION['total']=$_SESSION['total']/2;
    	  }
    	  if(!isset($_SESSION['commande'])){
    	  	$_SESSION['commande']=array();	
    	  };
    	  	$_SESSION['prices']=array();

    	   if(isset($_POST['vider'])){

							$_SESSION['commande']=array();
							$_SESSION['prices']=array();
							$_SESSION['total']=0;	
							unset($_POST['vider']);
			};
			function location($where){
				echo '<script>window.location.href="'.$where.'"</script>';
			}
			if(isset($_POST['valider'])){
				unset($_POST['valider']);
				location("recap.php"); 
			}
	 ?>  
    <link rel="stylesheet" href="css/recherche.css"/>
    <script language="javascript" src="js/recherche.js"></script>
</head>

<body>
	<?php include('layout/Menu.php'); ?>

	<div class="banner">
        <h2>Recherche</h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="10vw" viewBox="0 0 1280 140" preserveAspectRatio="none">
            <g fill="#ffffff">
                <path d="M1280 3.4C1050.59 18 1019.4 84.89 734.42 84.89c-320 0-320-84.3-640-84.3C59.4.59 28.2 1.6 0 3.4V140h1280z" fill-opacity=".3"/>
                <path d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V140H0z" fill-opacity=".5"/>
                <path d="M1280 51.76c-201 12.49-242.43 53.4-513.58 53.4-320 0-320-57-640-57-48.85.01-90.21 1.35-126.42 3.6V140h1280z"/>
            </g>
        </svg>
    </div>

	<section class='infos-pers'>
		<div class='container'>
			<div class='infos-titre'>
				<h4>Vos Informations Personnelles</h4>
			</div>
				<div class='infos-content'>
					<div><span><i>Nom</i></span>
						<span><?php echo $_SESSION['last_name']; ?></span>
					</div>
					<div><span><i>Prénom</i></span>
						<span><?php echo $_SESSION['first_name']; ?></span>
					</div>
					<div><span><i>Adresse Mail</i></span>
						<span><?php echo $_SESSION['mail']; ?></span>
					</div>
					<div><span><i>Date de naissance</i></span>
						<span><?php echo $_SESSION['dob']; ?></span>
					</div>
				</div>
		</div>
	</section>
	<section class="con">
		<h4>Faites Votre commande</h4>
	<section class='recherche' >
		<form method="get" >
				<input type="search" name="q" placeholder="Recherche..." />
				<input type="submit" value="Valider" />
			</form>
	</section>
		<section class='form-order'>
		<div class="container">
			<form method="post" class='commandes'>
		
				<?php
			$articles = $conn->query('SELECT book_name FROM books UNION SELECT product_name FROM products');
			if(isset($_GET['q']) AND !empty($_GET['q'])) {            
				 $q = htmlspecialchars($_GET['q']);
				 $articles = $conn->query('SELECT book_name FROM books WHERE book_name LIKE "%'.$q.'%" UNION SELECT product_name FROM products WHERE product_name LIKE "%'.$q.'%" ');
			}?>
			<select name='search'  style="width: 35%">
				<option>Résultat de votre recherche</option>
				<?php 
				while($show=mysqli_fetch_array($articles)){
						echo "<option>".$show['book_name']."</option><br/>";
				}

				?>
			</select>
				
				
				<select name='livre' id='livre'>
					<option>Selectionner un livre</option>
					<?php 
						$sql="SELECT book_name FROM books";
						$result= mysqli_query($conn,$sql);
						while($show=mysqli_fetch_array($result)){
							echo "<option>".$show['book_name']."</option><br/>";
						}
					?>
				</select>
			
				<select name='prod' style="width: 34.2%">
					<option>Selectionner un produit</option>
					<?php 
						$sql2="SELECT product_name FROM products";
						$result2= mysqli_query($conn,$sql2);
						while($show2=mysqli_fetch_array($result2)){
							echo "<option>".$show2['product_name']."</option><br/>";
						}
					
					?>
					
				</select>
				<input type="submit" name='submit' class="btn btn-success" onclick="calctotal()" />
		</form>
		
	</div>
	</section>
</section>
	<section class='prod-sel'>
		<?php 
			
			if (isset($_POST['submit'])){
				$_SESSION['prices']=array();
				if($_POST['search']!='Résultat de votre recherche'){
					if(!in_array($_POST['search'], $_SESSION['commande'])){
						array_push($_SESSION['commande'], $_POST['search']);
					}
				}
				if($_POST['livre']!='Selectionner un livre'){
					if(!in_array($_POST['livre'], $_SESSION['commande'])){
						array_push($_SESSION['commande'], $_POST['livre']);
					}
				}
				if($_POST['prod']!='Selectionner un produit'){
					if(!in_array($_POST['prod'], $_SESSION['commande'])){
						array_push($_SESSION['commande'], $_POST['prod']);
					}
				};
			};
					?>
		<div class='container'>
			<div class='infos-titre'>
				<h4>Votre Commande</h4>
			</div>
				<div class='prod-sel-content'>
					<div><span style='margin-bottom: 25px;'><i>Nom du produit</i></span>
						<span><?php foreach ($_SESSION['commande'] as $select) { 
										echo $select."<br/>";
									}?>
							</span>
					</div>
					<div><span style='margin-bottom: 25px;'><i>Prix</i></span>
						<span><?php foreach ($_SESSION['commande'] as $select) {
									$sql3='SELECT books.price FROM books WHERE books.book_name="'.$select.'" UNION SELECT products.price FROM products WHERE products.product_name="'.$select.'" ';
									$result3=mysqli_query($conn, $sql3);
									while($show3=mysqli_fetch_array($result3)){
										echo $show3['price']."<br/>";
										array_push($_SESSION['prices'],$show3['price']);
									}
								}
								$_SESSION['total']=0;
								foreach ($_SESSION['prices'] as $prix) {
									$_SESSION['total']=$_SESSION['total']+$prix;
								}
							
								

						?>
						</span>
					</div>
					<div><span style='margin-bottom: 25px;'><i>Quantité</i></span>
						<?php foreach ($_SESSION['commande'] as $select){ ?><span> 0 </span><?php };  ?>
					</div>
					<div><span><i>TOTAL</i></span>
						 <span ><?php echo $_SESSION['total']; ?></span>
					</div>
					</div>
					<form method="post">
					<div><input type="submit" name='valider' class="btn btn-success" value="Valider votre panier"></div>
					<div><input type="submit" name='vider' class="btn btn-success" value="Vider votre panier" style="background-color: red;border-color: red;" ></div>
				</form>
				</div>
	</section>
	<?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>
</body>
</html>

