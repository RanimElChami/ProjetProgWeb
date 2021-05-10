<?php
    session_start();
?>
<!DOCTYPE html>

<head>
    <title>Recapitulatif Commande</title>
	<link rel="stylesheet" href="css/recherche.css"/>
	<link rel="stylesheet" href="css/recap.css"/>
    <?php
		include('layout/Header.php');
		include ('../APIs/include/dbConnection.php');
		$total=$_SESSION['total'];
		function location($where){
			echo '<script>window.location.href="'.$where.'"</script>';
		}
    ?>
</head>

<body>
	<?php include('layout/Menu.php'); ?>

	<div class="banner">
        <h2>Recapitulatif de votre commande</h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="10vw" viewBox="0 0 1280 140" preserveAspectRatio="none">
            <g fill="#ffffff">
                <path d="M1280 3.4C1050.59 18 1019.4 84.89 734.42 84.89c-320 0-320-84.3-640-84.3C59.4.59 28.2 1.6 0 3.4V140h1280z" fill-opacity=".3"/>
                <path d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V140H0z" fill-opacity=".5"/>
                <path d="M1280 51.76c-201 12.49-242.43 53.4-513.58 53.4-320 0-320-57-640-57-48.85.01-90.21 1.35-126.42 3.6V140h1280z"/>
            </g>
        </svg>
    </div>

	<section class="recap">
		<div class="container">
			<div class="additional-info">
				<h4>Informations complémentaires</h4>
				<div class="left-info">
					<h5>Adresse de la boutique</h5>
					<p>37 Rue de la Bûcherie, 75005 Paris</p>
				</div>
				<div class="right-info">
					<h5>Horaire d'ouverture</h5>
					<ul>
						<li>Lundi à Vendredi, 2.00pm à 6.30pm</li>
						<li>Samedi et Dimanche, 11.30am à 6.30pm</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="recap">
		<div class="container">
			<div class="infos-pers">
				<div class="prod-sel-content">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Nom du produit/livre</th>
								<th scope="col">Prix</th>
								<th scope="col">Quantité</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$iterator = new MultipleIterator();
							$iterator->attachIterator(new ArrayIterator($_SESSION['commande']));
							$iterator->attachIterator(new ArrayIterator($_SESSION['prices']));
							$iterator->attachIterator(new ArrayIterator($_SESSION["qte"]));
							$h=0;
							$s=0;
							foreach ($iterator as $item){?>
								<tr>
									<th scope="row">
										<span><?php echo $item[0];?></span>
									</th>
									<td>
										<?php echo $item[1];?>
										<?php
											$_SESSION['total']=0;
											$c=0;
											foreach ($_SESSION['prices'] as $prix) {
												$_SESSION['total']=$_SESSION['total']+$prix*$_SESSION['qte'][$c];
												$c+=1;
											}
										?>
									</td>
									<td>
										<span><?php echo $item[2];?></span>
									</td>

								</tr>
							<?php } ?>
							<tr>
								<th>
									<?php echo "<h5>Total sans remise : ".$_SESSION['total']."€</h5>";?>
								</th>
								<th colspan="2">
									<?php
										if(isset($_SESSION['ancien'])){
											if($_SESSION['ancien']){
												if($_SESSION['user_type_id']==1){
													$total=($total)-($total*0.15); ?>
													<h5>Total avec remise (-15%) : <?php echo $total; ?>€</h5>
										<?php 	}
												else if($_SESSION['user_type_id']==2){
													$total=($total)-($total*0.1); ?>
													<h5>Total avec remise (-10%) : <?php echo $total; ?>€</h5>
										<?php }}}
										else {
											echo "<p>-</p>";
										} ?>
								</th>
							</tr>
						</tbody>
					</table>
					<form method="POST">
						<div class="row">
							<div class="col">
								<input type="submit" name="modifier" class="btn btn-danger" value="Modifier votre panier">
							</div>
							<div class="col">
								<input type="submit" name="confirmer" class="btn btn-success" value="Confirmer votre panier">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<?php
		if(isset($_POST['confirmer'])){
			$_SESSION['total']=$total;
			if (!(isset($_SESSION['ancien']))){
				$sql4="INSERT INTO user (first_name, last_name, civility_id, dob, mail, password, pseudo)
				VALUES ('".$_SESSION["first_name"]."', '".$_SESSION["last_name"]."', '".$_SESSION["civility_id"]."', '".
				$_SESSION["dob"]."', '".$_SESSION["mail"]."', '".$_SESSION["password"]."', '".$_SESSION["pseudo"]."') ";
				mysqli_query($conn,$sql4);
				$sql='SELECT user_type_id, nb_orders, user_id FROM user WHERE mail="'.$_SESSION['mail'].'"';
				$result=mysqli_query($conn, $sql);
				while($show=mysqli_fetch_array($result)){
					$_SESSION['user_type_id']=$show['user_type_id'];
					$_SESSION['user_id']=$show['user_id'];
					$_SESSION['nb_orders']=$show['nb_orders'];
				}
			}
			$sql5="INSERT INTO orders (user_id, order_date, total_amount) VALUES
			('".$_SESSION["user_id"]."', '".date("Y-m-d")."', '".$_SESSION["total"]."');";
			mysqli_query($conn,$sql5);
			foreach($_SESSION['commande'] as $select){
				$sql6="SELECT book_id, prodorbook FROM books WHERE book_name='".$select."' UNION SELECT product_id, prodorbook FROM products WHERE product_name='".$select."' ";
				$result6=mysqli_query($conn, $sql6);
				while($show6=mysqli_fetch_array($result6)){
					$prodorbook=$show6['prodorbook'];
					$id_prod=$show6['book_id'];
					$quant_prod=$_SESSION['qte'][array_search($select, $_SESSION['commande'])];
				}
				$sql7="SELECT order_id FROM orders WHERE user_id='".$_SESSION["user_id"]."' AND order_date='".date("Y-m-d")."' ";
				$result7=mysqli_query($conn, $sql7);
				while($show7=mysqli_fetch_array($result7)){
					$order_id=$show7['order_id'];
				}
				if($prodorbook==0){
					$sql8="INSERT INTO order_book (order_id, book_id, quantity) VALUES ('".$order_id."', $id_prod, $quant_prod )";
					mysqli_query($conn,$sql8);
				}
				if($prodorbook==1){
					$sql8="INSERT INTO order_product (order_id, product_id, quantity) VALUES ('".$order_id."', $id_prod, $quant_prod )";
					mysqli_query($conn,$sql8);
				}
			}
			$_SESSION['commande'] = array();
    	  	$_SESSION['qte'] = array();
    	  	$_SESSION['prices'] = array();
    	  	$_SESSION['quant_ava'] = array();
			$_SESSION['total'] = 0;
			location("Home.php");
		}
		if(isset($_POST['modifier'])){
			location('Recherche.php');
			unset($_POST['modifier']);
		}
	?>

  	<?php include('layout/Footer.php'); ?>

	<script src="./js/jquery.min2.js"></script>

    <?php include('layout/BodyLinks.php'); ?>
</body>
</html>