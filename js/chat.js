

function loadUsers() {
    $.get("/includes/loadusers.inc.php", function (result) {
        if (result.users) {
            $('#searchResults').html(showUsers(result));
        } else {
            $('#searchResults').html("<p>Brak użytkowników do wyświetlenia</p>");
        }
    });
}

function showUsers(result) {
    var myResult = ``;
    result.users.forEach(user => {
        myResult += `<div id="searchResult"><img src="/img/${user.img}" alt="user img" width="100" height="100"><p>${user.imie} ${user.nazwisko}</p><form><input type="button" value="Dodaj do znajomych" onclick="addFriend(${user.id});loadUsers()"></form></div>`;
    })
    return myResult;
}

function addFriend(id) {
    $.get("/includes/addfriend.inc.php", {
        recipientID: id
    });
}

function loadInvites() {
    $.get("/includes/loadinvites.inc.php", function (result) {
        if (result.users) {
            $('#invites').html(showInvites(result));
        } else {
            $('#invites').html("<p>Brak oczekujących zaproszeń</p>");
        }
    });
}

function showInvites(result) {
    var myResult = ``;
    result.users.forEach(user => {
        myResult += `<div id="invitation">
<img src="/img/${user.img}" alt="user img" width="100" height="100">
<p>${user.imie} ${user.nazwisko}</p>
<form>
<input type="button" value="Akceptuj" onclick="setInvitationResponse(${user.id}, 1);loadInvites();loadUsers()">
<input type="button" value="Odrzuć" onclick="setInvitationResponse(${user.id}, 2);loadInvites()">
</form>
</div>`;
    })
    return myResult;
}

function setInvitationResponse(id, status) {
    $.post("/includes/setinvitationresponse.inc.php", {
        recipientID: id,
        status: status
    });
    loadFriendsList();
}

function loadFriendsList() {
    $.get("/includes/loadfriendslist.inc.php", function (result) {
        if (result.users) {
            $('#friends').html(showFriends(result));
        } else {
            $('#friends').html("<p>Brak znajomych</p>");
        }
    });
}

function showFriends(result) {
    var myResult = ``;
    result.users.forEach(user => {
        myResult += `
<div id="friend">
<img src="/img/${user.img}" alt="user img" width="100" height="100">
<p>${user.imie} ${user.nazwisko}</p>
<form>
<input type="button" value="Usuń znajomego" onclick="deleteFriend(${user.id})">
</form>
</div>`;
    })
    return myResult;
}

function deleteFriend(id) {
    $.get("/includes/deletefriend.inc.php", {
        friendID: id
    });
    loadFriendsList();
}




