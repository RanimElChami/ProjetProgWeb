<?php
  include("include/dbConnection.php");
  if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['first_name']) && isset($_POST['last_name'])
  && isset($_POST['civility_id']) && isset($_POST['mail']) && isset($_POST['user_type_id']) && isset($_POST['dob'])){
    if($_POST['pseudo'] != '' && $_POST['password'] != '' && $_POST['first_name'] != '' && $_POST['last_name'] != ''
    && $_POST['civility_id'] != '' && $_POST['mail'] != '' && $_POST['user_type_id'] != '' && $_POST['dob'] != ''){
        $pseudo = $conn->real_escape_string($_POST['pseudo']);
        $password = $conn->real_escape_string($_POST['password']);
        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $civility_id = $conn->real_escape_string($_POST['civility_id']);
        $mail = $conn->real_escape_string($_POST['mail']);
        $user_type_id = $conn->real_escape_string($_POST['user_type_id']);
        $dob = $conn->real_escape_string($_POST['dob']);
        $nb_orders = 0;

        $stmt = $conn -> prepare('INSERT INTO user(first_name, last_name, civility_id, dob, mail, password,
        pseudo, nb_orders, user_type_id)
        VALUES (?,?,?,?,?,?,?,?,?)');
        $stmt -> bind_param('ssissssii', $first_name, $last_name, $civility_id, $dob, $mail, $password,
        $pseudo, $nb_orders, $user_type_id);
        $stmt -> execute();
        $stmt -> close();
        $conn -> close();
    }
    else {
      echo "<h2>All fields must be filled</h2>";
    }
  }
  else {
    echo "<h2>Fields cannot be null</h2>";
  }
?>