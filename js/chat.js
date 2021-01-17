

function loadUsers() {
    $.get("/includes/loadusers.inc.php", function (result) {
        if (result.users) {
            $('#users').html(showUsers(result));
        } else {
            $('#users').html("<p>Brak użytkowników do wyświetlenia</p>");
        }
    });
}

function showUsers(result) {
    var myResult = ``;
    result.users.forEach(user => {
        myResult += `<div id="user"><img src="/img/${user.img}" alt="user img" width="100" height="100"><p>${user.imie} ${user.nazwisko}</p><form><input type="button" value="Dodaj do znajomych" onclick="addFriend(${user.id})"></form></div>`;
    })
    return myResult;
}

function addFriend(id) {
    $.get("/includes/addfriend.inc.php", {
        recipientID: id
    });
}

