<?php
include "../accounts/db/config.php";
include "../accounts/includes/rand.php";
use Utils\RandomStringGenerator;

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $authid = trim($_POST['auth']);
    $pass = trim($_POST['pass']);

    $stmt = $conn->prepare("SELECT * from core");
    $stmt->execute();

    if($stmt->rowCount() > 0){
        //There is someone in the db
        //check if auth id is valid
        $stmt = $conn->prepare("SELECT * from core");
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $query = $conn->prepare( "select Password from core where AuthID=?" );
            $query->execute([$authid]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            if(password_verify($pass, $row->Password)){
                $generator = new RandomStringGenerator;
                $adminsession = $generator->generate(10);
                $stmt = $conn->prepare("UPDATE core SET Admin_Session=? WHERE AuthID=?");
                $stmt->execute([$adminsession, $authid]);
                $stmt = NULL;
                session_start();
                $_SESSION['admin'] = $adminsession;
                echo "<script>window.location.href='./admin-panel.php';</script>";
            } else {
                $coreErr = "Wrong pass";
            }
        } else {
            $coreErr = "Invalid Auth ID";
        }
    } else {
        //No one is in the DB
        echo "<script>window.location.href='./reg.php';</script>";
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
        <div class="inform">
            <span class="informclose" onclick="closeInform()">&times;</span>
            <p>you have three trials to login</p>
            <a href="mailto:finnneron1@gmail.com"><i class="fas fa-envelope">Contact Admin for Pass</i></a>
            <br>
        </div>
    <div class="coreauth">
        <h3>Auth</h3>
        <div class="message">
            <?php
                if(isset($coreErr)){
                    echo '<p class="err">'.$coreErr.'</p>';
                }
            ?>
        </div>
        <form class="form" method="POST" action="index.php">
            <input name="username" type="text" placeholder="Username" id="user" autocomplete="new-password">
            <input name="auth" type="text" placeholder="Auth_ID" id="id" autocomplete="new-password">
            <input name="pass" type="password" placeholder="passcode" id="pass" autocomplete="new-password">
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