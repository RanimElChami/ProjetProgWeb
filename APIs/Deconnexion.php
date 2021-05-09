<?php
    // Destroy all session variables
    session_destroy();
    unset($_SESSION['user_type_name']);
    // Redirect user to Homepage
    header('Location: ../main/Home.php');
    exit();
?>