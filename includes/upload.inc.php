<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (isset($_POST['submit'])) {
    $profilowe = $_FILES['profilowe'];

    $name = $profilowe['name'];
    $tmpName = $profilowe['tmp_name'];
    $size = $profilowe['size'];
    $error = $profilowe['error'];
    $type = $profilowe['type'];
    $extension = explode('.', $name);
    $realExt = strtolower(end($extension));
    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($realExt, $allowed)) {
        if ($error === 0) {
            if ($size < 500000) {
                $name = "profil".$_SESSION['id'].".".$realExt;
                $destination = "../img/".$name;

                if (move_uploaded_file($tmpName, $destination)) {
                    $_SESSION['img'] = $name;
                    require_once 'functions.inc.php';
                    require_once 'db.inc.php';
                    updateImg($connection, $name, $_SESSION['email']);
                    header("Location: /templates/profile.php?upload=success");
                    exit();

                } else {
                    echo "<br>Wystąpił błąd przy transferze pliku.";
                }

            } else {
                echo "Za duży plik! Maksymalny rozmiar to 500kB";
            }
        } else {
            echo "Wystąpił błąd podczas przesyłania pliku";
        }

    } else {
        echo "Zły format pliku!";
    }
}

?>