<!DOCTYPE html>
<html>

<head>
    <title>Achat</title>
    <?php include('layout/Header.php')?>
    <link rel="stylesheet" href="css/achat.css"/>
</head>

<body>
    <?php
        include ("transfert.php");
        if (isset($_FILES['fic'])){
            transfert();
        }
      ?>
    <?php include('layout/Menu.php'); ?>

    <section class="achat-formulaire">
        <div class="container">
            <h4>Informations Personelles</h4>
            <p>Pour placer une commande, veuillez remplir le formulaire suivant pour renseigner vos informations personelles</p>
            <form>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" placeholder="Nom">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="prenom" placeholder="Prénom">
                </div>
                <div class="form-group">
                    <label for="email">Adresse Mail</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Adresse Mail">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="dob">Date de naissance</label>
                    <input type="date" class="form-control" id="dob" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </section>

    <?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>
</body>

</html>