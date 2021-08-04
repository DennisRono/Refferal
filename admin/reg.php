<?php
include "../accounts/db/config.php";
include "../accounts/includes/rand.php";
use Utils\RandomStringGenerator;

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $authid = $_POST['auth'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if(empty($username) && empty($authid) && empty($pass) && empty($cpass)){
        $coreErr = "You have to fill the form!";
    } else if(empty($username)){
        $coreErr = "Username is a required field!";
    } else if (empty($authid)){
        $coreErr = "Auth ID is required!";
    } else if(empty($pass)){
        $coreErr = "Password is required!";
    } else if (empty($cpass)){
        $coreErr = "you have to confirm your password!";
    } else if($pass != $cpass){
        $coreErr = "Passwords must match!";
    } else {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $generator = new RandomStringGenerator;
        $sessionid = $generator->generate(10);
        $trial = 3;
        $stmt = $conn->prepare("INSERT INTO core(Username,AuthID,Password,Admin_Session,Trial)VALUES(?,?,?,?,?)");
        $stmt->execute([$username, $authid, $pass, $sessionid, $trial]);
        $stmt = NULL;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Core</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        .err{
            color: #fff;
            padding: 10px;
            padding-left: 20px;
            background-color: rgba(255, 93, 93, 0.774);
            border: 1px solid rgba(255, 93, 93, 0.774);
            border-left: 4px solid red;
            margin: 0px 30px 0px 20px;
        }
    </style>
</head>
<body>
    <div class="corecontainer">
    <div class="coreauth">
        <h3>Auth</h3>
        <div class="message">
            <?php
                if(isset($coreErr)){
                    echo '<p class="err">'.$coreErr.'</p>';
                }
            ?>
        </div>
        <form class="form" method="POST" action="reg.php">
            <input name="username" type="text" placeholder="Username" id="user" autocomplete="new-password">
            <input name="auth" type="text" placeholder="Auth_ID" id="id" autocomplete="new-password">
            <input name="pass" type="password" placeholder="passcode" id="pass" autocomplete="new-password">
            <input name="cpass" type="password" placeholder="confirm passcode" id="pass" autocomplete="new-password">
            <!-- <div class="recaptcha"></div> -->
            <!-- <div class="checkbox">
                <input type="checkbox">
                <p>agree to terms of service</p>
            </div> -->
            <input class="subb" type="submit" name="submit" value="Submit" onclick="core()">
        </form>
    </div>
    <div class="warn">
        <!-- <button class="manualentry"><a href="#">Click Here</a></button> -->
        <p class="warnp"></p>
    </div>
    </div>
    <script src="./js/main.js"></script>
</body>
</html>