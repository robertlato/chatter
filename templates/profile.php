<?php
require_once 'header.php';
?>

    <div class="container">
        <?php
            echo "<img src='/img/".$_SESSION['img']."' width='200px'>";
        ?>
        <form action="/includes/upload.inc.php" method="post" enctype="multipart/form-data">
            <input type="file" accept="image/*" name="profilowe">
            <button type="submit" name="submit">
                Zmień zdjęcie
            </button>
        </form>
        <?php
            if(isset($_GET['upload'])) {
                if ($_GET['upload'] === 'success') {
                    echo "Zdjęcie zaktualizowane";
                }
            } else if (isset($_GET['error'])) {
                if ($_GET['error'] === 'stmtfail') {
                    echo "Błędne zapytanie do bazy danych";
                }
            }
        ?>
        <h2>Dane użytkownika</h2>
        <div class="daneUzytkownika">
            <?php echo "<p>Adres email: ".$_SESSION['email']."</p>"; ?>
            <?php echo "<p>Imię: ".$_SESSION['imie']."</p>"; ?>
            <?php echo "<p>Nazwisko: ".$_SESSION['nazwisko']."</p>"; ?>
        </div>
        <div class="modyfikacje">
            <a href="editprofile.php">Edytuj dane</a>
            <a href="changepwd.php">Zmień hasło</a>
            <a href="deleteuser.php">Usuń konto</a>
        </div>
    </div>
</body>
</html>
