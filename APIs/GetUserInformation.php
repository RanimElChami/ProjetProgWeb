<?php
    // Check if received values are not null nor empty
    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['civility_id'])
    && isset($_POST['user_type_id']) && isset($_POST['dob']) && isset($_POST['mail'])
    && isset($_POST['pseudo']) && isset($_POST['password'])){
        if($_POST['first_name'] != '' && $_POST['last_name'] != '' && $_POST['civility_id'] != ''
        && $_POST['user_type_id'] != '' && $_POST['dob'] != '' && $_POST['mail'] != ''
        && $_POST['pseudo'] != '' && $_POST['password'] != ''){
            // Start session
            session_start();

            // Create multiple session variables
            // Store received values in session variables to use them when the user validates his order
            // Instead of creating a new user in the database and the user changes his mind and doesn't want to
            // place an order anymore, we make sure that when he places an order, a new user is created with stored values

            $_SESSION['first_name'] = $_POST["first_name"];
            $_SESSION['last_name'] = $_POST["last_name"];
            $_SESSION['civility_id'] = $_POST["civility_id"];
            $_SESSION['user_type_id'] = $_POST["user_type_id"];
            $_SESSION['dob'] = $_POST["dob"];
            $_SESSION['mail'] = $_POST["mail"];
            $_SESSION['pseudo'] = $_POST["pseudo"];
            $_SESSION['password'] = $_POST["password"];

            // Redirect user to page "Recherche.php"
            header('Location: ../main/Recherche.php');
            exit();
        } else {
            $status["status"]="404";
            $status["error"]="Fields cannot be empty";
            echo json_encode($status);
        }
    } else {
        $status["status"]="404";
        $status["error"]="Fields cannot be null";
        echo json_encode($status);
    }
?>