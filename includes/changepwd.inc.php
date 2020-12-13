<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (filter_has_var(INPUT_POST, 'submit')) {

    // zapisz dane z zabezpieczeniem ich
    $currentPwd = htmlspecialchars($_POST['currentPwd']);
    $newPwd = htmlspecialchars($_POST['newPwd']);
    $repeatPwd = htmlspecialchars($_POST['repeatPwd']);

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if (invalidPassword($currentPwd) || invalidPassword($newPwd) || invalidPassword($repeatPwd)) {
        header("Location: /templates/changepwd.php?error=invalidpassword");
        exit();
    } else if (!passwordMatch($newPwd, $repeatPwd)) {
        header("Location: /templates/changepwd.php?error=pwdmismatch");
        exit();
    }

    changePassword($connection, $currentPwd, $newPwd, $_SESSION['email']);
    header("Location: /templates/changepwd.php?success");
    exit();

} else {
    header("Location: /templates/changepwd.php?error=noinput");
    exit();
}
