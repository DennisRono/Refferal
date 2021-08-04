<?php
include "../db/config.php";
include "../sendmail/verification/mail_verification.php";
    $Verifi = "1";
    $userid = $_GET['token'];
    $verid = 'VER'.$userid;
    $sql = "UPDATE users SET Verified = $Verifi, UserId = '$verid' WHERE UserId=?";
    $conn->prepare($sql)->execute([$userid]);
    echo "<br>";
        echo "Verified successfylly!";
        echo "<script> window.location.href='../../dashboard.php?ver=$verid' </script>";
        $_SESSION['logged_in'] = true;
        exit();
?>