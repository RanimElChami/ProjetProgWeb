<?php
    // Destroy all session variables
    session_start();
    session_destroy();
    // Redirect user to Homepage
    header('Location: ../main/Home.php');
    exit();
?>