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
            echo "Dane zaktualizowane";
        } else if(isset($_GET['error'])) {
            if ($_GET['error'] === 'userexists') {
                echo "Użytkownik o podanym adresie e-mail już istnieje";
            } else if ($_GET['error'] === 'invalidemail') {
                echo "Wprowadź poprawny adres e-mail";
            } else if ($_GET['error'] === 'invalidvalue') {
                echo "Wprowadź poprawne dane";
            } else if ($_GET['error'] === 'stmtfail') {
                echo "Błędne zapytanie do bazy danych";
            }
        }
        ?>
    </div>

</div>

</body>
</html>
