<?php
    session_start();
    include('../APIs/include/dbConnection.php');
?>

<!DOCTYPE html>

<head>
    <title>Achat</title>
    <?php include('layout/Header.php')?>
    <link rel="stylesheet" href="css/achat.css"/>
</head>

<body>
    <?php include('layout/Menu.php'); ?>

    <div class="banner">
        <h2>Informations Personelles</h2>
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
            <h5>Pour placer une commande, veuillez remplir le formulaire suivant pour renseigner vos informations personelles</h5>
            <form class="needs-validation" novalidate action="../APIs/GetUserInformation.php" method="POST">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="last_name">Nom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nom"
                        required value=<?php if (isset($_SESSION['last_name'])) {echo $_SESSION['last_name'];}?>>
                        <div class="valid-feedback">Nom valide!</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="first_name">Prénom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Prénom"
                        required value=<?php if (isset($_SESSION['first_name'])) {echo $_SESSION['first_name'];}?>>
                        <div class="valid-feedback">Prénom valide!</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="civility_id">Civilité</label>
                        <select id="civility_id" class="form-control" required name="civility_id">
                            <option>Civilité</option>
                                <?php
                                    $query = "SELECT * FROM civility";
                                    $result = mysqli_query($conn, $query);

                                    while($row = mysqli_fetch_array($result)){
                                        echo '<option value="'.$row["civility_id"].'"';

                                        if($row['civility_id'] == $_SESSION['civility_id']) {
                                            echo ' selected';
                                        }

                                        echo '>'.$row["civility_name"].'</option>';
                                    }
                                ?>
                        </select>
                        <div class="invalid-feedback">Please provide a valid zip.</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="user_type_id">Type Utilisateur</label>
                        <select id="user_type_id" class="form-control" required name="user_type_id">
                            <option>Type Utilisateur</option>
                                <?php
                                    $query = "SELECT * FROM user_type";
                                    $result = mysqli_query($conn, $query);

                                    while($row = mysqli_fetch_array($result)){
                                        echo '<option value="'.$row["user_type_id"].'"';

                                        if($row['user_type_id'] == $_SESSION['user_type_id']) {
                                            echo ' selected';
                                        }

                                        echo '>'.$row["user_type_name"].'</option>';
                                    }
                                ?>
                        </select>
                        <div class="invalid-feedback">Veuillez choisir un type d'utilisateur</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="dob">Date de naissance</label>
                        <input type="date" class="form-control" id="dob" placeholder="Date de naissance" name="dob" required
                        value=<?php if (isset($_SESSION['dob'])) {echo $_SESSION['dob'];}?>>
                        <div class="invalid-feedback">Veuillez choisir une date de naissance</div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="mail">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                            </div>
                            <input type="email" class="form-control" id="mail" name="mail" placeholder="Email" aria-describedby="inputGroupPrepend" required
                            value=<?php if (isset($_SESSION['mail'])) {echo $_SESSION['mail'];}?>>
                            <div class="invalid-feedback">Adresse e-mail invalide!</div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="pseudo">Pseudo</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                            </div>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" aria-describedby="inputGroupPrepend" required
                            value=<?php if (isset($_SESSION['pseudo'])) {echo $_SESSION['pseudo'];}?>>
                            <div class="invalid-feedback">Pseudo invalide!</div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required
                        value=<?php if (isset($_SESSION['password'])) {echo $_SESSION['password'];}?>>
                        <div class="invalid-feedback">Mot de passe invalide!</div>
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Submit form</button>
            </form>
        </div>
    </section>

    <?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>

    <script>
        (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
        })();
    </script>

    <?php
        function verifyInformation(int $argument) {
            if($argument>=18){
                return true;
            }
            return false;
            if(preg_match('/[^a-zA-Z\d]/', $argument) && preg_match('/\d/', $argument) && strlen($argument)>=8){
                echo "Password Valid";
            } else {
                echo "Password invalid - Enter a new password that contains at least one digit, one capital letter and is at least 8 characters long";
            }
        }
    ?>
</body>

</html>