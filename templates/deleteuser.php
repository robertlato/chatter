<!DOCTYPE html>
<html lang="pl">

    <?php include 'header.php'; ?>

    <div class="container">
        <h2>Usuwanie konta</h2>
        <p><b>Czy na pewno chcesz usunąć konto?</b> </p>
        <p>Od tej decyzji nie będzie odwrotu! Wszelkie informacje dotyczące Twojego konta zostaną utracone.</p>
        <button onclick="window.location.href='/includes/deleteuser.inc.php';">
            Tak
        </button>
        <button onclick="window.location.href='profile.php';">
            Nie
        </button>
            <?php
            if(isset($_GET['error'])) {
                if ($_GET['error'] === 'deletionfail') {
                    echo "Nie udało się usunąć Twojego konta! Spróbuj ponownie lub skontaktuj się z administratorem.";
                } else if ($_GET['error'] === 'stmtfail') {
                    echo "Błędne zapytanie do bazy danych";
                }
            } ?>
    </div>
    </body>
</html>
