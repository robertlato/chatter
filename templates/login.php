<?php

    if (isset($_COOKIE['theme'])) {
        $themeLink = $_COOKIE['theme'];
    } else {
        $themeLink = "/css/light-theme.css";
        $_COOKIE['theme'] = "light";
    }

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
        <link type="text/css" href="<?php echo $themeLink; ?>" rel="stylesheet" id="theme-link">
        <meta charset="UTF-8">
    </head>
    <body>
        <button class="btn-toggle">Przełącz tryb ciemny</button>
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
            </div>
        </form>
        <div class="container">
            <p>Nie masz jeszcze konta?</p>
            <button onclick="window.location.href='signup.php';">
                Zarejestruj się
            </button>
        </div>
        <div class="container">
            <span class="password">Nie pamiętasz <a href="#">hasła?</a></span>
        </div>
        <div class="container">
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
        </div>
        <script src="/js/themetoggle.js"></script>
    </body>
</html>
