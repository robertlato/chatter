<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function invalidValue($value) {
    $len = strlen($value);
    if (!preg_match("/^[a-zA-Z0-9]*$/", $value) || $len > 40) {
        return true;
    }else {
        return false;
    }
}

function invalidEmail($email) {

    return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function invalidPassword($pwd) {
    $len = strlen($pwd);
    if ($len > 40 || $len < 6) {
        return true;
    } else {
        return false;
    }
}

function userExists($conn, $email) {

    // prepare and bind
    // todo: dodaj warunek - czy zapytanie jest prawidłowe
    $stmt = $conn->prepare("SELECT * FROM uzytkownicy WHERE email = ?;");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $wynik = $stmt->get_result();
    $stmt->close();

    if ($row = $wynik->fetch_assoc()) {
        return $row;
    } else {
        return false;
    }
}

function createUser($conn, $imie, $nazwisko, $email, $pwd) {
    $stmt = $conn->prepare("INSERT INTO uzytkownicy (imie, nazwisko, email, haslo, img, dataUtworzenia, jestDostepny) VALUES (?, ?, ?, ?, 'defaultpicture.jpg', now(), 0);");
    if ($stmt === false) {
        header("Location: /templates/signup.php?error=stmtfail");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt->bind_param("ssss", $imie, $nazwisko, $email, $hashedPwd);
    $stmt->execute();
    $stmt->close();
    header("Location: /templates/signup.php?error=none");
}

function loginUser($conn, $email, $password) {
    $userExists = userExists($conn, $email);

    if ($userExists === false) {
        header("Location: /templates/login.php?error=wronglogin");
        exit();
    }

    // weryfikuj haslo
    $hashedPwd = $userExists['haslo'];

    if (password_verify($password, $hashedPwd)) {
        session_start();
        $_SESSION['id'] = $userExists['id'];
        $_SESSION['email'] = $email;
        $_SESSION['imie'] = $userExists['imie'];
        $_SESSION['nazwisko'] = $userExists['nazwisko'];
        $_SESSION['img'] = $userExists['img'];

        // zaktualizuj status "jestDostepny" na 'prawda'

//        $query = "UPDATE uzytkownicy SET jestDostepny = 1 WHERE email = ?;".$email;
        $stmt = $conn->prepare("UPDATE uzytkownicy SET jestDostepny = 1 WHERE email = ?;");
        if ($stmt === false) {
            header("Location: /templates/login.php?error=stmtfail");
            exit();
        }
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->close();

        header("Location: /templates/home.php");
        exit();
    } else {
        header("Location: /templates/login.php?error=wronglogin");
        exit();
    }
}

function logoutUser($conn, $email) {
    $stmt = $conn->prepare("UPDATE uzytkownicy SET jestDostepny = 0 WHERE email = ?;");
    if ($stmt === false) {
        header("Location: /templates/home.php?error=logoutfail");
        exit();
    }
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt->close();
}

function updateImg($conn, $imgName, $email) {
    $stmt = $conn->prepare("UPDATE uzytkownicy SET img = ? WHERE email = ?;");
    if ($stmt === false) {
        header("Location: /templates/profile.php?error=stmtfail");
        exit();
    }
    $stmt->bind_param("ss", $imgName, $email);
    $stmt->execute();
    $stmt->close();
}

function updateValue($connection, $newValue, $toBeChanged, $userEmail) {
    if ($toBeChanged == 'email') {
        // sprawdz czy dany uzytkownik istnieje
        if (userExists($connection, $newValue)) {
            header("Location: /templates/editprofile.php?error=userexists");
            exit();
        }
    }

    $query = "UPDATE uzytkownicy SET ".$toBeChanged." = ? WHERE email = ?;";
    $stmt = $connection->prepare($query);
    if ($stmt === false) {
        header("Location: /templates/editprofile.php?error=stmtfail");
        exit();
    }

    $stmt->bind_param("ss", $newValue, $userEmail);
    $stmt->execute();
    $stmt->close();

}


function passwordMatch($pwd, $repeatPwd) {
    return $pwd === $repeatPwd;
}

function changePassword($conn, $currentPwd, $newPwd, $userEmail){
    // sprawdz czy currentPwd zgadza sie z hasłem użytkownika
    // możesz ściągnąć cały row przez userExists
    // jeżeli się zgadza to zmieniasz hasła

    $userExists = userExists($conn, $userEmail);

//    if ($userExists === false) {
//        header("Location: /templates/login.php?error=wronglogin");
//        exit();
//    }

    // weryfikuj haslo
    $hashedPwd = $userExists['haslo'];

    if (password_verify($currentPwd, $hashedPwd)) {
        // zmien haslo
        $hashedNewPwd = password_hash($newPwd, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE uzytkownicy SET haslo = ? WHERE email = ?;");
        if ($stmt === false) {
            header("Location: /templates/changepwd.php?error=stmtfail");
            exit();
        }
        $stmt->bind_param("ss", $hashedNewPwd, $userEmail);
        $stmt->execute();
        $stmt->close();
    } else {
        header("Location: /templates/changepwd.php?error=wrongpwd");
        exit();
    }
}
