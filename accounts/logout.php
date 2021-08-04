<?php
    session_start();

    if (!isset($_SESSION['sessionID'])){
        header("location: index.php");
        exit();
    } else {
        $_SESSION = array();
        session_destroy();
        setcookie('refferal', ", time()-3600,'/',", 0, 0);

        header("location: index.php");

        exit();
    }
?>