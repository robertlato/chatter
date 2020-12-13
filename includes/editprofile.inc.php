<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (filter_has_var(INPUT_POST, 'submit')) {

    // zapisz dane
    $noweImie = htmlspecialchars($_POST['imie']);
    $noweNazwisko = htmlspecialchars($_POST['nazwisko']);
    $nowyEmail = htmlspecialchars($_POST['email']);

    $toBeChanged = array();

    require_once 'functions.inc.php';
    require_once 'db.inc.php';

    // sprawdz czy dane sa poprawne - jezeli sa to zaktualizuj je w bazie danych
    // jezeli nie -> blad

    if ($nowyEmail !== $_SESSION['email']) {
        if (invalidEmail($nowyEmail) !== false) {
            header("Location: /templates/editprofile.php?error=invalidemail");
            exit();
        } else {
            // email dodajesz jako pierwsza wartosc asocjacyjna - wazne przy aktualizowaniu danych (kolejnosc ma znaczenie w tablicy asoc - sprawdzales)
            // w funkcji aktualizujacej dane najpierw sparwdzasz czy istnieje juz uzytkownik o takim mailu
            // jezeli istnieje to funckja przerywa wykonywanie skryptu i wysyla error + exit()
            // czyli zadna informacja nie zostaje zaktualizowana
            $toBeChanged['email'] = $nowyEmail;
        }
//    } else {
//        array_push($toBeChanged, 'email');
//        $toBeChanged = 'email';
//        updateValue($connection, $nowyEmail, $toBeChanged);
    }

    if ($noweImie !== $_SESSION['imie']) {
        if (invalidValue($noweImie) !== false) {
            header("Location: /templates/editprofile.php?error=invalidvalue");
            exit();
        } else {
            $toBeChanged['imie'] = $noweImie;
        }
//    } else {
//        array_push($toBeChanged, 'imie');
//        $toBeChanged = 'imie';
//        updateValue($connection, $noweImie, $toBeChanged);
    }

    if ($noweNazwisko !== $_SESSION['nazwisko']) {
        if (invalidValue($noweNazwisko) !== false) {
            header("Location: /templates/editprofile.php?error=invalidvalue");
            exit();
        } else {
            $toBeChanged['nazwisko'] = $noweNazwisko;
        }
//    } else {
//        array_push($toBeChanged, 'nazwisko');
//        $toBeChanged = 'email';
//        updateValue($connection, $noweNazwisko, $toBeChanged);
    }

    foreach ($toBeChanged as $key => $value) {
        updateValue($connection, $value, $key, $_SESSION['email']);
        $_SESSION[$key] = $value;
    }



    header("Location: /templates/editprofile.php?success");
    exit();
}
?>