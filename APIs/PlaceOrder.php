<?php
    include('include/dbConnection.php');

    // Start session
    session_start();

    // Check if received values are not null nor empty
    if(isset($_SESSION['first_name']) && isset($_SESSION['last_name']) && isset($_SESSION['civility_id'])
    && isset($_SESSION['user_type_id']) && isset($_SESSION['dob']) && isset($_SESSION['mail'])
    && isset($_SESSION['pseudo']) && isset($_SESSION['password'])){
        if($_SESSION['first_name'] != '' && $_SESSION['last_name'] != '' && $_SESSION['civility_id'] != ''
        && $_SESSION['user_type_id'] != '' && $_SESSION['dob'] != '' && $_SESSION['mail'] != ''
        && $_SESSION['pseudo'] != '' && $_SESSION['password'] != ''){
            $first_name = $conn->real_escape_string($_SESSION["first_name"]);
            $last_name = $conn->real_escape_string($_SESSION["last_name"]);
            $civility_id = $conn->real_escape_string($_SESSION["civility_id"]);
            $user_type_id = $conn->real_escape_string($_SESSION["user_type_id"]);
            $dob = $conn->real_escape_string($_SESSION["dob"]);
            $mail = $conn->real_escape_string($_SESSION["mail"]);
            $pseudo = $conn->real_escape_string($_SESSION["pseudo"]);
            $password = $conn->real_escape_string($_SESSION["password"]);
            $coma = "' , '";

            $query = "INSERT INTO user(first_name, last_name, civility_id, dob, mail, password, pseudo, user_type_id)
            VALUES ('".$first_name.$coma.$last_name.$coma.$civility_id.$coma.$dob.$coma.$mail.$coma.$password.$coma.$pseudo.$coma.$user_type_id."')";

            if(mysqli_query($conn, $query)){
                echo 'User Added';
            }

            // After succesfully placing an order, redirect user to page "Home.php"
            header('Location: ../main/Home.php');
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