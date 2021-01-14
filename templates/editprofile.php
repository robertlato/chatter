<!DOCTYPE html>
<html lang="pl">

    <?php
        // todo: upewnij się czy użytkownika chce zmienić dane
        include 'header.php';
    ?>
    <div class="container">
        <h2>Dane użytkownika</h2>
        <div class="daneUzytkownika">
            <?php echo "
                        <form action='/includes/editprofile.inc.php' method='post'>
                            <label for='email'>Adres email: </label>
                            <input type='text' name='email'  id='email' value='".$_SESSION['email']."'>
                            
                            <label for='imie'>Imię: </label>
                            <input type='text' name='imie' id='imie' value='".$_SESSION['imie']."'>
                            
                            <label for='nazwisko'>Nazwisko: </label>
                            <input type='text' name='nazwisko' id='nazwisko'  value='".$_SESSION['nazwisko']."'>
                            
                            <button name='submit' type='submit'>Zapisz</button>
                        </form>";
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
                } ?>
        </div>
    </div>
    </body>
</html>
