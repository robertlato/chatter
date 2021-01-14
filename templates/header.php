<?php
    if (isset($_COOKIE['theme'])) {
        $themeLink = $_COOKIE['theme'];
    } else {
        $themeLink = "/css/light-theme.css";
        $_COOKIE['theme'] = "light";
    }
?>

<head>
    <meta charset="UTF-8">
    <!-- <link type="text/css" href="/css/light-theme.css" rel="stylesheet" id="theme-link"> -->
    <link type="text/css" href="<?php echo $themeLink; ?>" rel="stylesheet" id="theme-link">
    <title>Chatter</title>
</head>
<body>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        session_start();
        if ((isset($_SESSION['email']))) {
            echo "Witaj, ".$_SESSION['email'];
        } else {
            header("Location: login.php");
            exit();
    }
    ?>
    <button class="btn-toggle">Przełącz tryb ciemny</button>
    <nav>
        <div>
                <a href="/templates/home.php">Strona domowa</a>
                <a href="/templates/profile.php">Mój profil</a>
                <a href="/includes/logout.inc.php">Wyloguj</a>
        </div>
    </nav>
    <script src="/js/myscript.js"></script>
