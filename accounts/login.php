<?php
    $msgError = "";
    $msgSuccess = "";
    $newname = "";
    include "db/config.php";
    if(isset($_POST['submit'])){
        $identity = trim($_POST['username']);
        $password = trim($_POST['password']);

        if(empty($identity) && empty($password)){
            $msgError = "Please fill in the form!";
        } else if(empty($identity)){
            $msgError = "Please enter Username or Email address!";
        } else if(empty($password)){
            $msgError = "Please enter the password!";
        } else {
            //$msgSuccess = "$identity <br> $password";
            //Check if user entered email or username
            if(strpos($identity, "@") !== false){
                $email = $identity;
                $query = $conn->prepare( "SELECT `Email` FROM `users` WHERE `Email` = ?" );
                $query->execute([$email]);

                if( $query->rowCount() > 0 ) { # If rows are found for query
                    $query = $conn->prepare( "select SessionID,Password from users where Email=?" );
                    $query->execute([$email]);
                    $row = $query->fetch(PDO::FETCH_OBJ);
                    $pass = $row->Password;
                    $sessionid = $row->SessionID;
                    //Check password!
                    if (password_verify($password, $pass)) {
                        // start session
                        session_start();
                        $_SESSION['sessionID'] = $sessionid;
                        echo '<script>window.location.href="../dashboard.php?sessionID='.$sessionid.'"</script>';
                    } else {
                        $msgError = "Wrong Password!";
                    }
                } else {
                    $msgError = "The email entered does not match out credentials!";
                }
            } else {
                $username = $identity;
                $query = $conn->prepare( "SELECT `Username` FROM `users` WHERE `Username` = ?" );
                $query->execute([$username]);

                if( $query->rowCount() > 0 ) { # If rows are found for query
                    $query = $conn->prepare( "select SessionID,Password from users where Username=?" );
                    $query->execute([$username]);
                    $row = $query->fetch(PDO::FETCH_OBJ);
                    $pass = $row->Password;
                    $sessionid = $row->SessionID;
                    //Check password!
                    if (password_verify($password, $pass)) {
                        //redirect user to homepage
                        // start session
                        session_start();
                        $_SESSION['sessionID'] = $sessionid;
                        echo '<script>window.location.href="../dashboard.php?sessionID='.$sessionid.'"</script>';
                    } else {
                        $msgError = "Wrong Password!";
                    }
                } else {
                    $msgError = "The Username entered does not match out credentials!";
                }
            }
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Refferal</title>
    <!--Icon Kit-->
    <link rel="stylesheet" href="../static/fonts/iconkit/css/iconkit.min.css">
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-form card">
            <div class="encapsulation">
                <h1>Refferal</h1>
                <div class="row no-gutters line-on-side" style="margin: 20px 0">
                    <div class="col d-flex align-items-center">
                        <span class="line"></span>
                    </div>
                    <div class="col-auto px-2 d-flex align-items-center">
                        <p class="my-0 text-muted txt">Account Login</p>
                    </div>
                    <div class="col d-flex align-items-center">
                        <span class="line"></span>
                    </div>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <?php
                        if ($msgError != ""){
                        echo '<p class="err">'.$msgError.'</p>';
                        }
                        if ($msgSuccess != ""){
                        echo '<p class="success">'.$msgSuccess.'</p>';
                        }
                        if ($newname != ""){
                            echo '<p class="warn" onclick="addnew()" title="Click to use">'.'Suggestion <br>'.$newname.'&nbsp;&nbsp;&nbsp;<span>Use</span>'.'</p>';
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="username">Username, Email or Phone number</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter your username, email or phone number">
                    </div>
                    <div class="form-group">
                        <label for="password">Create Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <p><a href="forgot.php" style="text-decoration: none; color: #4457DC;">Forgot password ?</a></p>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-block btn2">
                            <i class="ik ik-unlock"></i>Login</button>
                    </div>
                </form>
                    <div class="row no-gutters line-on-side" style="margin: 20px 0">
                        <div class="col d-flex align-items-center">
                            <span class="line"></span>
                        </div>
                        <div class="col-auto px-2 d-flex align-items-center">
                            <p class="my-0 text-muted txt">New here?</p>
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="line"></span>
                        </div>
                    </div>
                    <a href="./register.php" class="btn btn1 btn-block">
                        <i class="ik ik-user"></i> Register
                    </a>
                    <p class="agree text-center footer">
                        &copy; 2021 Refferal
                    </p>
            </div>
        </div>
    </div>
</body>
</html>