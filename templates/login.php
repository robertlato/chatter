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
    <form action="/includes/login.inc.php" method="post">
        <div class="imgcontainer">
            <img src="/img/defaultpicture.jpg" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="email"><b>Adres e-mail</b></label>
            <input id="email" type="text" placeholder="Wprowadź e-mail" name="email" required>

            <label for="password"><b>Hasło</b></label>
            <input id="password" type="password" placeholder="Wprowadź hasło" name="password" required>

            <button name="submit" type="submit">Zaloguj się</button>
            <label>
                <input type="checkbox" name="remember"> Zapamiętaj mnie
            </label>
        </div>

    </form>

    <?php
    if (isset($_GET['logout'])) {
        if ($_GET['logout'] === 'true') {
            echo "<p>Udane wylogowanie</p>";
        }
    } else if (isset($_GET['error'])) {
        if ($_GET['error'] === 'wronglogin') {
            echo "<p>Niepoprawne dane!</p>";
        } else if ($_GET['error'] === 'stmtfail') {
            echo "Błędne zapytanie do bazy danych";
        } else if ($_GET['error'] === 'logoutfail') {
            echo "Nie udało się wylogować";
        }
    } else if (isset($_GET['userdeleted'])) {
        echo "Konto zostało pomyślnie usunięte! Pamiętaj, że zawsze możesz zarejestrować się ponownie. Do zobaczenia.";
    }
    ?>
    <div class="container">
        <p>Nie masz jeszcze konta?</p>
        <button onclick="window.location.href='signup.php';">
            Zarejestruj się
        </button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <span class="password">Nie pamiętasz <a href="#">hasła?</a></span>
    </div>

    <p id="mojid">To jest znacznik p</p>

</body>
</html>