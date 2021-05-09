<?php session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img class="d-inline-block align-top" src="./images/library-logo.png" alt="Logo" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="./Home.php">Page d'accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Produits.php">Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Livres.php">Livres</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./Achat.php">Achat</a>
            </li>
            <?php
                if(isset($_SESSION['user_type_name'])){
                    if($_SESSION['user_type_name']=='Administrateur'){
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="./UpdateProduits.php">Update Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./UpdateLivres.php">Update Livres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../APIs/Deconnexion.php">Déconnexion</a>
                </li>
            <?php
                    }
                } else {
            ?>
                <li class="nav-item">
                    <a class="nav-link" href="./Connexion.php">Connexion</a>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>
</nav>

<?php session_destroy(); ?>