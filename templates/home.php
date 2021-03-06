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
    <div class="message-container">
        <div id="messages"></div>
        <div id="sendMessage">
            <form>
                <input type="text" id="send-message" name="send-message" placeholder="Wpisz wiadomość...">
                <button name="submit" type="submit">Wyślij</button>
            </form>
        </div>
    </div>
</div>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script>
    var myID = <?php echo json_encode($_SESSION['id'], JSON_HEX_TAG); ?>;
    loadUsers();
    sendMessage();
    var currentRecipientId;
    var myVar = setInterval(loadUsers, 10000);
    var myInterval = setInterval(loadNewMessages, 10000000000000);
    var currentConversationLastMessage;

    function loadNewMessagesIntervalSetter() {
        if (currentRecipientId != null) {
            clearInterval(myInterval);
            myInterval = setInterval(loadNewMessages, 1000);
        }
    }

    function loadUsers() {
        // $.get("/includes/loadusers.inc.php", function (result) {
        $.get("/includes/loadfriendslist.inc.php", function (result) {
            if (result.users) {
                $('#users').html(showUsers(result));
            } else {
                $('#users').html("<p>Brak użytkowników do wyświetlenia</p>");
            }
        });
    }

    function showUsers(result) {
        var myResult = ``;
        let mySpan = ``;
        result.users.forEach(user => {
            let mySpan = ``;
            if (user.jestDostepny == 1) {
                mySpan = `<span class="status green"></span>`;
            } else {
                mySpan = `<span class="status red"></span>`;
            }
            myResult += `
<div id="user" onclick="setCurrentRecipientId(${user.id});loadConversation()">
    <img src="/img/${user.img}" alt="user img">
    <p>${user.imie} ${user.nazwisko}</p>
    ${mySpan}
</div>`;
        })
        return myResult;
    }

    // ustaw id oraz imie i nazwisko osoby, z ktora chcesz prowadzic konwersacje
    function setCurrentRecipientId(id) {

        currentRecipientId = id;
        document.getElementById('currentRecipientId').value = currentRecipientId;

        $.get("/includes/loaduserbyid.inc.php", {
            userID: id
        }, function (result) {
            result = JSON.parse(result);
            $('#currentRecipientId').html(`Rozmawiasz z: ${result.imie} ${result.nazwisko}`);

            // ustaw odswiezanie wiadomosci, jezeli zostal wybrany odbiorca
            loadNewMessagesIntervalSetter();
        });
    }

    function sendMessage() {
        $('form').submit(function () {
            $.post("/includes/sendmessage.inc.php", {
                message: $('#send-message').val(),
                recipientID: currentRecipientId,
                senderID: myID
            });
            $('#send-message').val('');
            return false;
        })
    }

    // odbieraj nowe wiadomosci i dopisuj je do istniejącej konwersacji
    function loadNewMessages() {
        $.get("/includes/loadnewmessages.inc.php", {
            recipientID: currentRecipientId,
            senderID: myID,
            lastMessageDate: currentConversationLastMessage
        }, function (result) {
            if (result.messages) {
                $('#messages').append(showMessages(result));
                $('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
            }
        });
    }

    // zaladuj 20 ostatnich wiadomosci miedzy myId a currentRecipientId
    function loadConversation() {
        $('#messages').html('');
        $.get("/includes/loadconversation.inc.php", {
            recipientID: currentRecipientId,
            senderID: myID
        }, function (result) {
            if (result.messages) {
                $('#messages').html(showMessages(result));

            } else {
                $('#messages').html("<p>Rozpocznij konwersacje</p>");
            }
            $('#messages').animate({scrollTop: $('#messages')[0].scrollHeight});
        });
    }

    function showMessages(result) {
        var myResult = ``;
        result.messages.forEach(message => {
            if (message.id == myID) {
            myResult += `<div id="message-myself"><p>${message.imie} ${message.nazwisko}<span>${message.dataUtworzenia}</span></p> ${message.wiadomosc}</div>`;

            } else {
                myResult += `<div id="message-recipient"><p>${message.imie} ${message.nazwisko}<span>${message.dataUtworzenia}</span></p> ${message.wiadomosc}</div>`;
            }
            currentConversationLastMessage = message.dataUtworzenia;
        });
        return myResult;
    }


</script>
</body>
</html>
