<?php
    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    session_start();
    logoutUser($connection, $_SESSION['email']);
    session_unset();
    session_destroy();
    header("Location: /templates/login.php?logout=true");
    exit();

?>