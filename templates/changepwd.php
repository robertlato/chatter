<?php

require_once 'header.php';

?>

<div class="container">
    <h2>Zmiana hasła</h2>
    <div class="daneUzytkownika">
        <form action="/includes/changepwd.inc.php" method="post">
            <label for="currentPwd">Aktualne hasło: </label>
            <input type="password" name="currentPwd" required>

            <label for="newPwd">Nowe hasło: </label>
            <input type="password" name="newPwd" required>

            <label for="repeatPwd">Powtórz nowe hasło: </label>
            <input type="password" name="repeatPwd" required>

            <button name="submit" type="submit">Zapisz</button>
        </form>

        <?php
        if (isset($_GET['success'])) {
            echo "Hasło zostało zmienione";
        } else if(isset($_GET['error'])) {
            if ($_GET['error'] === 'invalidpassword') {
                echo "Wprowadź poprawne hasła";
            } else if ($_GET['error'] === 'pwdmismatch') {
                echo "Powtórz poprawnie nowe hasło";
            } else if ($_GET['error'] === 'noinput') {
                echo "Wprowadź dane";
            } else if ($_GET['error'] === 'stmtfail') {
                echo "Błędne zapytanie do bazy danych";
            } else if($_GET['error'] === 'wrongpwd') {
                echo "Wprowadź poprawne hasło";
            }
        }
        ?>
    </div>

</div>

</body>
</html>
