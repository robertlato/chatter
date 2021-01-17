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

<div class="container">
    <div id="users">
    </div>
</div>

<script src="/js/chat.js"></script>

<script>
    loadUsers();
</script>


</body>
</html>
