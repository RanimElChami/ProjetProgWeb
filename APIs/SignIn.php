<?php
  include("include/dbConnection.php");
  
  if(isset($_POST['pseudo']) && isset($_POST['password'])){
    if($_POST['pseudo'] != '' && $_POST['password'] != ''){
      $pseudo = $conn->real_escape_string($_POST['pseudo']);
      $password = $conn->real_escape_string($_POST['password']);

      $stmt = $conn -> prepare('SELECT * FROM user
      INNER JOIN user_type on user_type.user_type_id=user.user_type_id
      WHERE user.pseudo=? AND user.password=?');
      $stmt -> bind_param('ss',$pseudo, $password);
      $stmt -> execute();
      $result = $stmt->get_result();
     
      if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
            // Start a session
            session_start();
            // Create two session variables and set their value equal to the operator id
            $_SESSION['user_id'] = $row["client_id"];
            $_SESSION['user_type_id'] = $row["user_type_id"];
            $_SESSION['first_name'] = $row["first_name"];
            $_SESSION['last_name'] = $row["last_name"];
            $_SESSION['civility_id'] = $row["civility_id"];
            $_SESSION['dob'] = $row["dob"];
            $_SESSION['mail'] =$row["mail"];
            $_SESSION['pseudo'] = $row["pseudo"];
            $_SESSION['password'] = $row["password"];
        }
        // Redirect user to page "Recherche.php"
        header('Location: ../main/Recherche.php');
        exit();
      } else {
        echo "<h2>Wrong username/password combination</h2>";
      }
      $stmt -> close();
      $conn -> close();
    }
    else {
      echo "<h2>Username/password field must be filled</h2>";
    }
  }
  else {
    echo "<h2>Username/password cannot be null</h2>";
  }
?>