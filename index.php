<?php
    session_start();

    // sprawdz czy uzytkownik jest zalogowany
    if ((isset($_SESSION['email']))) {
        header('Location: /templates/home.php');
        exit();
    } else {
        header('Location: templates/login.php');
    }


    //$zmienna = "Hello world!123";
    //echo htmlspecialchars($zmienna);

?>