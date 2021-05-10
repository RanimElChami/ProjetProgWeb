<?php
    session_start();
?>
<!DOCTYPE html>

<head>
    <title>Recapitulatif Commande</title>
	<link rel="stylesheet" href="css/recherche.css"/>
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
			<div class="infos-pers">
				<div class="prod-sel-content">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Nom du produit/livre</th>
								<th scope="col">Prix</th>
								<th scope="col">Quantité</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">
									<?php
										if (isset($_SESSION['commande'])) {
											if (count($_SESSION['commande'])!=0) {
												foreach ($_SESSION['commande'] as $select) { ?>
													<span><?php echo $select;?></span>
										<?php
												}
											}
										} else {
											echo "<p>-</p>";
										}
									?>
								</th>
								<td>
									<?php
									if (isset($_SESSION['commande'])) {
										if (count($_SESSION['commande'])!=0) {
											foreach ($_SESSION['commande'] as $select) {
												$sql3='SELECT books.price FROM books WHERE books.book_name="'.$select.
												'" UNION SELECT products.price FROM products WHERE products.product_name="'.$select.'" ';
												$result3=mysqli_query($conn, $sql3);
												while($show3=mysqli_fetch_array($result3)){
													echo $show3['price']."<br/>";
												}
											}
										}
									}  else {
										echo "<p>-</p>";
									}
									?>
								</td>
								<td>
									<?php
									if (isset($_SESSION['qte'])) {
										if (count($_SESSION['qte'])!=0) {
											foreach ($_SESSION['qte'] as $quant){ ?>
												<span><?php echo $quant;?></span>
										<?php
											}
										}
									}   else {
										echo "<p>-</p>";
									} ?>
								</td>
								<td>
									<p>Total sans remise : <?php echo $total; ?></p>
									<?php
									if(isset($_SESSION['ancien'])){
										if($_SESSION['ancien']){
											if($_SESSION['user_type_id']==1){
												$total=($total)-($total*0.15); ?>
												<p>Total avec remise (-15%) : <?php echo $total; ?></p>
									<?php 	}
											else{
												$total=($total)-($total*0.1); ?>
												<p>Total avec remise (-10%) : <?php echo $total; ?></p>
									<?php 	}
										}
									} ?>
								</td>
							</tr>
							</tbody>
					</table>
					<form method="POST">
						<div class="row">
							<div class="col">
								<input type="submit" name="confirmer" class="btn btn-success" value="Confirmer votre panier">
							</div>
							<div class="col">
								<input type="submit" name="modifier" class="btn btn-danger" value="Modifier votre panier">
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