<?php
require_once 'header.php';
?>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'logoutfail') {
        echo "Nie udało się wylogować";
    }
}
?>

</body>
</html>