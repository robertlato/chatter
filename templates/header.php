<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if ((isset($_SESSION['email']))) {
    echo "Witaj, ".$_SESSION['email'];
} else {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Chatter</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <meta charset="UTF-8">
</head>
<body>
<nav>
    <div class="container">
        <ul>
            <li><a href="/templates/home.php">Strona domowa</a></li>
            <li><a href="/templates/profile.php">Mój profil</a></li>
            <li><a href="/includes/logout.inc.php">Wyloguj</a></li>
        </ul>
    </div>
</nav>