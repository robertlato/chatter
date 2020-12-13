<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // sprawdz czy przeslano dane
    if(filter_has_var(INPUT_POST, 'submit')) {
        // todo: sprawdz czy mail jest poprawny

        // zapisz dane
        $imie = htmlspecialchars($_POST['imie']);
        $nazwisko = htmlspecialchars($_POST['nazwisko']);
        $email = htmlspecialchars($_POST['email']);
        $pwd = htmlspecialchars($_POST['password']);

        // sprawdz poprawnosc wprowadzonych danych

        require_once 'functions.inc.php';

        if (invalidValue($imie) !== false || invalidValue($nazwisko) !== false) {
            header('Location: /templates/signup.php?error=invalidvalue');
            exit();
        }

        if (invalidPassword($pwd) !== false) {
            header('Location: /templates/signup.php?error=invalidpassword');
            exit();
        }

        if (invalidEmail($email) !== false) {
            header('Location: /templates/signup.php?error=invalidemail');
            exit();
        }

        // polacz z baza danych i sprawdz czy uzytkownik istnieje

        require_once 'db.inc.php';


        if (userExists($connection, $email)) {
            header('Location: /templates/signup.php?error=userexists');
            exit();
        }

        createUser($connection, $imie, $nazwisko, $email, $pwd);


    } else {
        header("Location: /templates/signup.php");
        exit();
    }


?>