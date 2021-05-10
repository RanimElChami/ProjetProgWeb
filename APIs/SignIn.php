<link rel="stylesheet" href="../main/css/bootstrap.min.css"/>

<?php
  include("include/dbConnection.php");
  if(isset($_POST['pseudo']) && isset($_POST['password'])){
    if($_POST['pseudo'] != '' && $_POST['password'] != ''){
      $pseudo = $conn->real_escape_string($_POST['pseudo']);
      $password = $conn->real_escape_string($_POST['password']);

      $stmt = $conn -> prepare('SELECT user.*, user_type.user_type_name FROM user
      INNER JOIN user_type on user_type.user_type_id=user.user_type_id
      WHERE user.pseudo=? AND user.password=?');
      $stmt -> bind_param('ss',$pseudo, $password);
      $stmt -> execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
          if ($row["user_type_name"]=='Administrateur'){
            // Start a session
            session_start();
            // Create two session variables and set their value equal to the operator id
            $_SESSION['user_id'] = $row["user_id"];
            $_SESSION['user_type_name'] = $row["user_type_name"];
            $_SESSION['first_name'] = $row["first_name"];
            $_SESSION['last_name'] = $row["last_name"];
            $_SESSION['civility_id'] = $row["civility_id"];
            $_SESSION['dob'] = $row["dob"];
            $_SESSION['mail'] = $row["mail"];
            $_SESSION['pseudo'] = $row["pseudo"];
            $_SESSION['password'] = $row["password"];
            $_SESSION['nb_orders'] = $row["nb_orders"];
            $_SESSION['ancien']=true;
          } else {
            echo "<div class='alert alert-danger' role='alert' style='text-align:center;'>
            <h4>Vous devez être administrateur pour se connecter!</h4>
            </div>";
            exit();
          }
        }
        // Redirect user to page "Recherche.php"
        header('Location: ../main/Recherche.php');
        exit();
      } else {
        echo "<div class='alert alert-danger' role='alert' style='text-align:center;'>
        <h4>Votre mot de passe et/ou votre identifiant incorrect(s)</h4>
        </div>";
      }
      $stmt -> close();
      $conn -> close();
    }
    else {
      echo "<div class='alert alert-danger' role='alert' style='text-align:center;'>
      <h4>Les champs de mot de passe et d'identifiant doivent être remplis</h4>
      </div>";
    }
  }
  else {
    echo "<div class='alert alert-danger' role='alert' style='text-align:center;'>
    <h4>Votre mot de passe et/ou votre identifiant ne peuvent pas être null</h4>
    </div>";
  }
?>