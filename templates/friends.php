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
    <h2>Zaproszenia do znajomych</h2>
    <div id="invites">
    </div>

    <h2>Twoi znajomi</h2>
    <div id="friends">
    </div>
</div>

<script>
    var myID = <?php echo json_encode($_SESSION['id'], JSON_HEX_TAG); ?>;
</script>
<script src="/js/chat.js"></script>

<script>
    loadInvites();
    loadFriendsList();
    setInterval(loadInvites, 10000);
    setInterval(loadFriendsList, 10000);
</script>


</body>
</html>
