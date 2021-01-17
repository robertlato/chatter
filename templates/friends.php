<!DOCTYPE html>
<html lang="pl">

<?php include 'header.php'; ?>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'logoutfail') {
        echo "Nie udało się wylogować";
    }
}
?>

</body>
</html>
