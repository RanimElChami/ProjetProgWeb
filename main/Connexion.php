<!DOCTYPE html>

<head>
    <title>Achat</title>
    <?php include('layout/Header.php')?>
    <link rel="stylesheet" href="css/achat.css"/>
</head>

<body>
    <?php include('layout/Menu.php'); ?>

    <div class="banner">
        <h2>Connexion - Administrateur</h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="10vw" viewBox="0 0 1280 140" preserveAspectRatio="none">
            <g fill="#ffffff">
                <path d="M1280 3.4C1050.59 18 1019.4 84.89 734.42 84.89c-320 0-320-84.3-640-84.3C59.4.59 28.2 1.6 0 3.4V140h1280z" fill-opacity=".3"/>
                <path d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V140H0z" fill-opacity=".5"/>
                <path d="M1280 51.76c-201 12.49-242.43 53.4-513.58 53.4-320 0-320-57-640-57-48.85.01-90.21 1.35-126.42 3.6V140h1280z"/>
            </g>
        </svg>
    </div>

    <section class="achat-formulaire">
        <div class="container">
            <div class="ancien-client-form">
                <form class="needs-validation" novalidate action="../APIs/SignIn.php" method="POST">
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                            </div>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" aria-describedby="inputGroupPrepend" required>
                            <div class="invalid-feedback">Pseudo invalide!</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                        <div class="invalid-feedback">Mot de passe invalide!</div>
                    </div>
                    <button class="btn btn-success" type="submit">S'authentifier</button>
                </form>
            </div>
        </div>
    </section>

    <?php include('layout/Footer.php'); ?>

    <script src="./js/jquery.min2.js"></script>

    <?php include('layout/BodyLinks.php'); ?>
</body>

</html>