<?php
    // Start session
    session_start();

    // Boolean variables to check if received values are valid or not
    $_SESSION['validFN'] = false;
    $_SESSION['validLN'] = false;
    $_SESSION['validAge'] = false;
    $_SESSION['validCivility'] = false;
    $_SESSION['validMail'] = false;
    $_SESSION['validUserName'] = false;
    $_SESSION['validPassword'] = false;

    // Function to check if a string ends with a specific character
    function endsWith($stringToVerify, $char) {
        // Get the length of the char we are looking for at the end of the string
        $length = strlen($char);
        // If the length is equal to 0 or the character is empty, return true
        if(!$length) {
            return true;
        }
        // Otherwise, return the portion of string specified by the offset (stringToVerify)
        // and length parameters, and compare the returned result to the received char as an argument
        return substr($stringToVerify, -$length) === $char;
    }

    // Check if received values are not null nor empty
    if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['civility_id'])
    && isset($_POST['dob']) && isset($_POST['mail'])
    && isset($_POST['pseudo']) && isset($_POST['password'])){
        if($_POST['first_name'] != '' && $_POST['last_name'] != '' && $_POST['civility_id'] != ''
        && $_POST['dob'] != '' && $_POST['mail'] != ''
         && $_POST['pseudo'] != '' && $_POST['password'] != ''){
            // Check if the email contains the character "@"
            if(strpos($_POST['mail'], '@')){
                $_SESSION['validMail'] = true;
            }
            // Check if the email contains ends with ".fr" or ".com"
            if (endsWith($_POST['mail'], '.fr') || endsWith($_POST['mail'], '.com')) {
                $_SESSION['validMail'] = true;
            }
            // Check if the first and last name contain only letters

            if(ctype_alpha($_POST['first_name'])){
                $_SESSION['validFN'] = true;
            }
            if(ctype_alpha($_POST['last_name'])){
                $_SESSION['validLN'] = true;
            }

            // Calculate age of the user
            $dateOfBirth = new DateTime($_POST['dob']);
            $today = new DateTime('today');
            $age = $dateOfBirth->diff($today)->y;
            // Check if the user's age is greater than 10 and smaller than 90, if not valid is false
            if ($age>=10 || $age <= 90){
                $_SESSION['validAge'] = true;
            }
            // Check if civilité and user type are different than "Civilité" and "Type d'utilisateur"
            if($_POST['civility_id'] == 'select'){
                $_SESSION['validCivility'] = false;
            } else {
                $_SESSION['validCivility'] = true;
            }
            // Check if username is longer than 6 characters
            if(strlen($_POST['pseudo'])>=6){
                $_SESSION['validUserName'] = true;
            }
            // Check if password is longer than 6 characters
            if(strlen($_POST['password'])>=6){
                $_SESSION['validPassword'] = true;
            }

            // Create multiple session variables
            // Store received values in session variables to use them when the user validates his order
            // Instead of creating a new user in the database and the user changes his mind and doesn't want to
            // place an order anymore, we make sure that when he places an order, a new user is created with stored values
            $_SESSION['first_name'] = $_POST["first_name"];
            $_SESSION['last_name'] = $_POST["last_name"];
            $_SESSION['civility_id'] = $_POST["civility_id"];
            $_SESSION['dob'] = $_POST["dob"];
            $_SESSION['mail'] = $_POST["mail"];
            $_SESSION['pseudo'] = $_POST["pseudo"];
            $_SESSION['password'] = $_POST["password"];

            // Finally, if all conditions are respected, valid is true, therefore, redirect user to page "Recherche.php"
            // else, redirect the user again to the page "Achat.php" by displaying submitted values
            if ($_SESSION['validPassword'] && $_SESSION['pseudo'] && $_SESSION['validCivility'] &&
            $_SESSION['validAge'] && $_SESSION['validLN'] && $_SESSION['validFN'] && $_SESSION['validMail']){
                header('Location: ../main/Recherche.php');
                exit();
            } else {
                header('Location: ../main/Achat.php');
                exit();
            }
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