<!DOCTYPE html>

<head>
    <title>Recherche</title>
	<link rel="stylesheet" href="css/recherche.css"/>
    <?php
		include('layout/Header.php');
		include ('../APIs/include/dbConnection.php');

    	session_start();
    	if(!isset($_SESSION['total'])){
    		$_SESSION['total'] = 0;
    	}
    	else{
    		$_SESSION['total']=$_SESSION['total']/2;
    	}
    	if(!isset($_SESSION['commande'])){
    		$_SESSION['commande'] = array();
    	  	$_SESSION['qte'] = array();
    	  	$_SESSION['prices'] = array();
    	  	$_SESSION['quant_ava'] = array();
    	}

    	$i=0;

    	if(isset($_POST['vider'])){
			$_SESSION['commande'] = array();
    	  	$_SESSION['qte'] = array();
    	  	$_SESSION['prices'] = array();
    	  	$_SESSION['quant_ava'] = array();
			$_SESSION['total'] = 0;
			unset($_POST['vider']);
		}

		$f=0;

		foreach($_SESSION['commande'] as $select){
			if(isset($_POST[$f])){
				unset($_SESSION['commande'][$f]);
				$_SESSION['commande']=array_merge($_SESSION['commande']);
				unset($_SESSION['prices'][$f]);
				$_SESSION['prices']=array_merge($_SESSION['prices']);
				unset($_SESSION['qte'][$f]);
				$_SESSION['qte']=array_merge($_SESSION['qte']);
				unset($_SESSION['quant_ava'][$f]);
				$_SESSION['quant_ava']=array_merge($_SESSION['quant_ava']);
				unset($_POST[$f]);
			}
			$f+=1;
		}
		function location($where){
			echo '<script>window.location.href="'.$where.'"</script>';
		}
		function alert(){
			echo "<script type='text/javascript'>alert('Vous avez pas dépassé la quantité disponible de ce produit');</script>";
		}
		if(isset($_POST['valider'])){
			if(count($_SESSION['commande'])!=0){
				unset($_POST['valider']);
				location("Recapitulatif.php");
			}
		}

    	$g=0;

    	foreach($_SESSION['commande'] as $select){
    	  	if(isset($_POST[$g."quantmas"])){
    	  		if($_SESSION['quant_ava'][$g]>$_SESSION['qte'][$g]){
	    	  		unset($_POST[$g.'quantmas']);
					$_SESSION['qte'][$g]+=1;
				}
				else{ alert();};
			}
			if(isset($_POST[$g.'quantminus'])){
				if($_SESSION['qte'][$g]!=1){
					unset($_POST[$g.'quantminus']);
					$_SESSION['qte'][$g]-=1;
				}
				else{
					unset($_POST[$g.'quantminus']);
					unset($_SESSION['commande'][$g]);
				 	$_SESSION['commande']=array_merge($_SESSION['commande']);
				 	unset($_SESSION['prices'][$g]);
				 	$_SESSION['prices']=array_merge($_SESSION['prices']);
				 	unset($_SESSION['qte'][$g]);
				 	$_SESSION['qte']=array_merge($_SESSION['qte']);
				 	$g+=1;
				}
			}
			$g+=1;
    	  }
	?>
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

	<section>
		<div class="container">
			<div class="infos-pers">
				<div class="infos-titre">
					<h4>Vos Informations Personnelles</h4>
				</div>
				<div class="infos-content">
					<table class="table table-striped">
						<thead>
							<tr>
							<th scope="col">Nom</th>
							<th scope="col">Prénom</th>
							<th scope="col">Date de naissance</th>
							<th scope="col">Adresse Mail</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">
									<?php
										if (isset($_SESSION['last_name'])) {
											echo $_SESSION['last_name'];
										} else {
											echo "<p>-</p>";
										}
									?>
								</th>
								<td>
									<?php
										if (isset($_SESSION['first_name'])) {
											echo $_SESSION['first_name'];
										} else {
											echo "<p>-</p>";
										}
									?>
								</td>
								<td>
									<?php
										if (isset($_SESSION['dob'])) {
											echo $_SESSION['dob'];
										} else {
											echo "<p>-</p>";
										}
									?>
								</td>
								<td>
									<?php
										if (isset($_SESSION['mail'])) {
											echo $_SESSION['mail'];
										} else {
											echo "<p>-</p>";
										}
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="infos-pers">
				<div class="infos-titre">
					<h4>Passez Votre commande</h4>
				</div>
				<div class="recherche">
					<form method="GET">
						<div class="row">
							<div class="col">
								<input type="search" class="form-control" name="q" placeholder="Recherche..." />
							</div>
							<div class="col">
								<input type="submit" class="btn btn-dark" value="Valider" />
							</div>
						</div>
					</form>
				</div>
				<div class="form-order">
						<form method="post" class="commandes">
							<?php
								$articles = $conn->query('SELECT book_name FROM books UNION SELECT product_name FROM products');
								if(isset($_GET['q']) && !empty($_GET['q'])) {
									$q = htmlspecialchars($_GET['q']);
									$articles = $conn->query('SELECT book_name FROM books WHERE book_name LIKE "%'.$q.'%" UNION SELECT product_name FROM products WHERE product_name LIKE "%'.$q.'%" ');
								}
							?>
							<div class="row">
								<div class="col">
									<select name="search" class="custom-select">
										<option>Résultat(s) de votre recherche</option>
										<?php
											while($show=mysqli_fetch_array($articles)){
												echo "<option>".$show['book_name']."</option>";
											}
										?>
									</select>
								</div>
								<div class="col">
									<select name='livre' class="custom-select" id='livre'>
										<option>Selectionner un livre</option>
										<?php include('../APIs/GetAllBooks.php');
											foreach ($booksArray as $book){
												echo "<option>".$book['book_name']."</option>";
											}
										?>
									</select>
								</div>
								<div class="col">
									<select name='prod' class="custom-select">
										<option>Selectionner un produit</option>
										<?php
											include('../APIs/GetAllProducts.php');
											foreach ($productsArray as $product){
												echo "<option>".$product['product_name']."</option>";
											}
										?>
									</select>
								</div>
								<div class="col">
									<input type="submit" name='submit' class="btn btn-danger" onclick="calctotal()" />
								</div>
							</div>
						</form>
				</div>
			</div>
		</div>
	</section>

	<section>
		<?php
			include ('../APIs/include/dbConnection.php');
			if (isset($_POST['submit'])){
				$t=0;
				foreach($_SESSION['commande'] as $select){
					unset($_GET[$t.'quantmas']);
			    	unset($_GET[$t.'quantminus']);
			    	$t+=1;
				}
				if($_POST['search']!='Résultat(s) de votre recherche'){
					if(!in_array($_POST['search'], $_SESSION['commande'])){
						array_push($_SESSION['commande'], $_POST['search']);
						array_push($_SESSION['qte'], 1);
						$sql3='SELECT books.price, books.book_id, books.quant_available FROM books WHERE books.book_name="'.$_POST['search'].'" UNION SELECT products.price, products.product_id, products.quant_available FROM products WHERE products.product_name="'.$_POST['search'].'" ';
						$result3=mysqli_query($conn, $sql3);
						while($show3=mysqli_fetch_array($result3)){
							array_push($_SESSION['prices'],$show3['price']);
							array_push($_SESSION['quant_ava'], $show3['quant_available']);
						}
					}
				}
				if($_POST['livre']!='Selectionner un livre'){
					if(!in_array($_POST['livre'], $_SESSION['commande'])){
						array_push($_SESSION['commande'], $_POST['livre']);
						array_push($_SESSION['qte'], 1);
						$sql3='SELECT books.price, books.book_id, books.quant_available FROM books WHERE books.book_name="'.$_POST['livre'].'" UNION SELECT products.price, products.product_id, products.quant_available FROM products WHERE products.product_name="'.$_POST['livre'].'" ';
						$result3=mysqli_query($conn, $sql3);
						while($show3=mysqli_fetch_array($result3)){
							array_push($_SESSION['prices'],$show3['price']);
							array_push($_SESSION['quant_ava'], $show3['quant_available']);
						}
					}
				}
				if($_POST['prod']!='Selectionner un produit'){
					if(!in_array($_POST['prod'], $_SESSION['commande'])){
						array_push($_SESSION['commande'], $_POST['prod']);
						array_push($_SESSION['qte'], 1);
						$sql3='SELECT books.price, books.book_id, books.quant_available FROM books WHERE books.book_name="'.$_POST['prod'].'" UNION SELECT products.price, products.product_id, products.quant_available FROM products WHERE products.product_name="'.$_POST['prod'].'" ';
						$result3=mysqli_query($conn, $sql3);
						while($show3=mysqli_fetch_array($result3)){
							array_push($_SESSION['prices'],$show3['price']);
							array_push($_SESSION['quant_ava'], $show3['quant_available']);
						}
					}
				}
			}
		?>
		<div class="container">
			<div class="infos-pers">
				<div class="infos-titre">
					<h4>Votre Commande</h4>
				</div>
				<div class="prod-sel-content">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Nom du produit/livre</th>
								<th scope="col">Prix</th>
								<th scope="col">Quantité</th>
								<th scope="col">Actions</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">
									<?php
										if (count($_SESSION['commande'])!=0) {
											foreach ($_SESSION['commande'] as $select) { ?>
												<span>
													<?php echo $select;?>
												</span>
									<?php
											}
										} else {
											echo "<p>-</p>";
										}
									?>
								</th>
								<td>
									<?php
									if (count($_SESSION['prices'])!=0) {
										foreach ($_SESSION['prices'] as $prix) {?>
										<span>
											<?php echo $prix;?>
										</span>
									<?php }
										$_SESSION['total']=0;
										$c=0;
										foreach ($_SESSION['prices'] as $prix) {
											$_SESSION['total']=$_SESSION['total']+$prix*$_SESSION['qte'][$c];
											$c+=1;
										}
									} else {
										echo "<p>-</p>";
									}
									?>
								</td>
								<td>
									<?php
									$h=0;
									foreach ($_SESSION["qte"] as $quant){ ?>
										<form class="recap-form" method="POST">
											<span>
												<button class="btn btn-light" name='<?php echo $h."quantmas" ?>'><i class="fas fa-chevron-up"></i></button>
												<?php echo $quant;?>
												<button class="btn btn-light" name='<?php echo $h."quantminus" ?>'><i class="fas fa-chevron-down"></i></button>
											</span>
										</form>
									<?php $h+=1; } ?>
								</td>
								<td>
									<?php
										if (count($_SESSION['qte'])!=0) {
											$s=0;
											foreach ($_SESSION['qte'] as $qte) {?>
												<form class="recap-form" method="POST">
													<span>
														<button class="btn btn-danger delete-item" name='<?php echo $s; ?>'><i class="fas fa-trash"></i></button>
													</span>
												</form>
									<?php $s+=1;
											}
										}
										else {
											echo "<p>-</p>";
										} ?>
								</td>
								<td>
									<?php echo $_SESSION['total']; ?>
								</td>
							</tr>
						</tbody>
					</table>
					<form method="POST">
						<div class="row">
							<div class="col">
								<input type="submit" name="valider" class="btn btn-success" value="Valider votre panier">
							</div>
							<div class="col">
								<input type="submit" name="vider" class="btn btn-danger" value="Vider votre panier" >
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php include('layout/Footer.php'); ?>

	<script src="./js/jquery.min2.js"></script>

    <?php include('layout/BodyLinks.php'); ?>
</body>
</html>