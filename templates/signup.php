<?php
session_start();

// sprawdz czy uzytkownik jest zalogowany
if ((isset($_SESSION['email']))) {
    header('Location: /templates/home.php');
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
<form action="/includes/signup.inc.php" method="post">
    <div class="imgcontainer">
        <img src="/img/defaultpicture.jpg" alt="Avatar" class="avatar">
    </div>
    <h2>Zarejestruj się za pomocą adresu e-mail</h2>

    <div class="container">
        <label for="imie"><b>Imie</b></label>
        <input id="imie" type="text" placeholder="Wprowadź imie" name="imie" required>

        <label for="nazwisko"><b>Nazwisko</b></label>
        <input id="nazwisko" type="text" placeholder="Wprowadź nazwisko" name="nazwisko" required>


        <label for="email"><b>Adres e-mail</b></label>
        <input id="email" type="text" placeholder="Wprowadź e-mail" name="email" required>

        <label for="password"><b>Stwórz hasło</b></label>
        <input id="password" type="password" placeholder="Wprowadź hasło" name="password" required>

        <button name="submit" type="submit">Zarejestruj się</button>
    </div>

</form>

<?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'none') {
            echo "<p>Rejestracja zakończona pomyślnie</p>";
        } else if ($_GET['error'] == 'invalidvalue') {
            echo "<p>Wprowadzono błędne dane!</p>";
        } else if ($_GET['error'] == 'invalidpassword') {
            echo "<p>Wprowadź krótsze hasło!</p>";
        } else if ($_GET['error'] == 'invalidemail') {
            echo "<p>Wprowadzono błędny adres e-mail!</p>";
        } else if ($_GET['error'] == 'stmtfail') {
            echo "<p>Ups! Mamy problem z bazą danych</p>";
        } else if ($_GET['error'] == 'userexists') {
            echo "<p>Konto o podanym adresie e-mail już istnieje</p>";
        }

    }
?>


<div class="container">
    <p>Masz już konto?</p>
    <button onclick="window.location.href='login.php';">
        Zaloguj się
    </button>
</div>

<div class="container" style="background-color:#f1f1f1">
    <span class="password">Nie pamiętasz <a href="#">hasła?</a></span>
</div>

<p id="mojid">To jest znacznik p</p>

</body>
</html>