<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

    // sprawdz czy przeslano dane
    if(filter_has_var(INPUT_POST, 'submit')) {
        // todo: sprawdz czy mail jest poprawny

        // zapisz dane
        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['password']);

        // polacz z baza danych i sprawdz czy uzytkownik istnieje

        require_once 'db.inc.php';
        require_once 'functions.inc.php';

        loginUser($connection, $email, $pwd);

    } else {
        header("Location: /templates/login.php");
        exit();
    }

?>