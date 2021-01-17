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
    <div class="chat">
        <p id="currentRecipientId">Nie wybrano użytkownika</p>
        <div id="users">

        </div>
        <div id="messages">
            <div id="sendMessage">
                <form>
                    <input type="text" id="message" name="message" placeholder="Wpisz wiadomość...">
<!--                    <input type="hidden" id="recipientID" name="recipientID" value="">-->
<!--                    <input type="hidden" id="senderID" name="senderID" value="--><?php //$_SESSION['id'] ?><!--">-->
                    <button name="submit" type="submit">Wyślij</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var myID = <?php echo json_encode($_SESSION['id'], JSON_HEX_TAG); ?>;
        loadUsers();
        sendMessage();
        var currentRecipientId;
        var myVar = setInterval(loadUsers, 10000);

        function loadUsers() {
            $.get("/includes/loadusers.inc.php", function(result) {
                if(result.users) {
                    $('#users').html(showUsers(result));
                    // result.users.forEach(user => {
                    //     $('#users').html(showUser(user));
                    // })
                } else {
                    $('#users').html("<p>Brak użytkowników do wyświetlenia</p>");
                }
            });
        }

        function showUsers(result) {
            var myResult = ``;
            result.users.forEach(user => {
                    myResult += `<div id="user"><p onclick="setCurrentRecipientId(${user.id})">${user.imie} ${user.nazwisko}</p></div>`;
            })
            return myResult;
        }

        function setCurrentRecipientId(id) {
            currentRecipientId = id;
            $('#currentRecipientId').html(currentRecipientId);
            document.getElementById('currentRecipientId').value = currentRecipientId;
        }

        function sendMessage() {
            $('form').submit(function(e) {
                $.post("/includes/sendmessage.inc.php", {
                    message: $('#message').val(),
                    recipientID: currentRecipientId,
                    senderID: myID
                });
                $('#message').val('');
                return false;
            })
        }
    </script>
    </body>
</html>
