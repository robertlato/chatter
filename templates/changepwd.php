<!DOCTYPE html>
<html lang="pl">

    <?php include 'header.php'; ?>

    <div class="container">
        <h2>Zmiana hasła</h2>
        <div class="daneUzytkownika">
            <form action="/includes/changepwd.inc.php" method="post">
                <label for="currentPwd">Aktualne hasło: </label>
                <input type="password" name="currentPwd" id="currentPwd" required>

                <label for="newPwd">Nowe hasło: </label>
                <input type="password" name="newPwd" id="newPwd" required>

                <label for="repeatPwd">Powtórz nowe hasło: </label>
                <input type="password" name="repeatPwd" id="repeatPwd" required>

                <button name="submit" type="submit">Zapisz</button>
            </form>
        </div>

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
    </body>
</html>

