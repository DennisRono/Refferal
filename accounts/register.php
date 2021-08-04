<?php
    $msgError = "";
    $msgSuccess = "";
    $newname = "";
    include "db/config.php";
    include "./sendmail/verification/mail_verification.php";
    include "includes/rand.php";
    use Utils\RandomStringGenerator;
    /*if(isset($_GET['ref'])){
        echo '<script>var refcode = document.querySelector(".reff").value = "<?php echo $_GET['.'ref'.']; ?>";</script>';
    }*/
    if (isset($_POST['submit'])){
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $cpassword = trim($_POST['cpassword']);
        $code = trim($_POST['refferal']);
        $balance = 0;

        //$msgSuccess = "$username => $email => $password => $cpassword => $code";
        if (empty($username) && empty($email) && empty($password) && empty($cpassword)){
            $msgError = "Please fill in the form!";
        }else if(empty($username)){
            $msgError = "Username cannot be empty!";
        } else if (empty($email)){
            $msgError = "Email cannot be empty!";
        } else if (empty($password)){
            $msgError = "Password is a required field!";
        } else if (empty($cpassword)){
            $msgError = "You have to confirm your password!";
        } else {
            $query = $conn->prepare( "SELECT `Email` FROM `users` WHERE `Email` = ?" );
            $query->bindValue( 1, $email );
            $query->execute();

            if( $query->rowCount() > 0 ) { # If rows are found for query
                $msgError = "The email entered is already in use!";
            } else {
                $query = $conn->prepare( "SELECT `Username` FROM `users` WHERE `Username` = ?" );
                $query->bindValue( 1, $username );
                $query->execute();

                if( $query->rowCount() > 0 ) { # If rows are found for query
                    //Make suggestion username for username
                    function suggestion($username,$conn){
                        $newname = $username.rand(0,10);
                        //precheck new name
                        $query = $conn->prepare( "SELECT `Username` FROM `users` WHERE `Username` = ?" );
                        $query->bindValue( 1, $newname );
                        $query->execute();

                        if( $query->rowCount() > 0 ) {
                            suggestion($newname, $conn);
                        }
                        return $newname;
                    }
                    $newname = suggestion($username, $conn);
                    $username = $newname;
                    $msgError = "The Username entered is already in use!";
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $generator = new RandomStringGenerator;
                    $token = $generator->generate(16);
                    $userId = $generator->generate(10);
                    $verified = 0;
                    //Credit refferer with Downline
                    if(!empty($code)){
                        $query = $conn->prepare( "SELECT `RefferalCode` FROM `users` WHERE `RefferalCode` = ?" );
                        $query->bindValue( 1, $code );
                        $query->execute();

                        if( $query->rowCount() > 1 ) {
                            $msgError = "Internal Error we're on it!";
                        } else if( $query->rowCount() > 0 ) {
                            //fetch all downlines
                            $query = $conn->prepare( "select Downlines,Balance from users where RefferalCode=?" );
                            $query->execute([$code]);
                            $row = $query->fetch(PDO::FETCH_OBJ);
                            $downlines = $row->Downlines;
                            $balance = $row->Balance;
                            if(!empty($downlines)){
                                $downlines = $downlines.";".$userId;
                            } else {
                                $downlines = $userId;
                            }
                            $balance = $balance + 300;
                            //Update Downlines in db
                            $sql = "UPDATE users SET Downlines=?, Balance=? WHERE RefferalCode=?";
                            $conn->prepare($sql)->execute([$downlines, $balance, $code]);
                        } else {
                            $msgError = "Invalid refferal code! <br> Please confirm and retry!";
                        }
                    } else {
                        $newuserCode = 0;
                    }

                    //Generate user refferal Code
                    $query = $conn->prepare( "select RefferalCode from users order by RefferalCode desc limit 0,1" );
                    $query->execute();
                    $row = $query->fetch(PDO::FETCH_OBJ);
                    $newuserCode = $row->RefferalCode + 1;
                    
                    
                    //Insert to database
                    $balanceZero = 0;
                    $stmt = $conn->prepare("INSERT INTO users (Username, Email, Password, RefferalCode, SessionID, Verified, UserId, Balance) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$username, $email, $password, $newuserCode, $token, $verified, $userId, $balanceZero]);
                    $stmt = null;
                    
                    sendmail($email, $userId,$token);
                    //set cookie
                    setcookie("refferal.com", $username . "," . $userId);

                    // retrieve cookie info
                    /*
                    if(isset($_COOKIE["acookie"])){
                        $pieces = explode(",", $_COOKIE["acookie"]);
                        $username = $pieces[0];
                        $userid = $pieces[1];
                    }
                    */
                    //echo '<script>window.location.href="../dashboard.php"</script>';
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
    <title>Refferal | Register</title>
        <!--Icon Kit-->
        <link rel="stylesheet" href="../static/fonts/iconkit/css/iconkit.min.css">
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../static/css/register.css">
    <style>
        .err{
            color: red;
            border: 1px solid #ffe1c1;
            border-left: 2px solid red;
            background-color: #ffe1c1;
            padding: 10px;
            padding-left: 20px;
            border-radius: 5px;
        }
        .success{
            color: green;
            border: 1px solid #bae597;
            border-left: 2px solid green;
            background-color: #bae597;
            padding: 10px;
            padding-left: 20px;
            border-radius: 5px;
        }
        .warn{
            color: green;
            border: 1px solid #ffe5ad;
            border-left: 2px solid yellow;
            background-color: #ffe5ad;
            padding: 10px;
            padding-left: 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .warn span{
            background-color: #fff;
            border: 1px solid gray;
            color: gray;
            font-size: 10px;
            border-radius: 3px;
            padding: 0px 3px;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="register-form card">
            <div class="encapsulation">
                <h1>Refferal</h1>
                <div class="row no-gutters line-on-side" style="margin: 20px 0">
                    <div class="col d-flex align-items-center">
                        <span class="line"></span>
                    </div>
                    <div class="col-auto px-2 d-flex align-items-center">
                        <p class="my-0 text-muted txt">Create account</p>
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
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control username" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username']?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Create Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="confirm password">Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <label for="refferal code">Refferal Code (<span style="color: #4457DC">optional</span>)</label>
                        <input type="number" name="refferal" class="form-control reff" placeholder="Refferal code" value="<?php if(isset($_POST['refferal']) && isset($_GET['ref'])){echo $_POST['refferal'];}else{if(isset($_POST['refferal'])) {echo $_POST['refferal'];} else { echo $_GET['ref'];}}?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-block btn2"><i class="ik ik-user"></i>Register</button>
                    </div>
                </form>
                    <div class="row no-gutters line-on-side" style="margin: 20px 0">
                        <div class="col d-flex align-items-center">
                            <span class="line"></span>
                        </div>
                        <div class="col-auto px-2 d-flex align-items-center">
                            <p class="my-0 text-muted txt">Have an account?</p>
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="line"></span>
                        </div>
                    </div>
                    <a href="./login.php" class="btn btn1 btn-block">
                        <i class="ik ik-unlock"></i> Login
                    </a>
                    <p class="agree text-center footer">
                        By signing up you agree to the
                        <a href="../terms-and-conditions.html">Terms & conditions</a>.<br>
                        &copy; 2021 Refferal
                    </p>
            </div>
        </div>
    </div>
    <script>
        function addnew(){
            var username = document.querySelector('.username');
            username.value = "<?php echo $newname; ?>";
        }
    </script>
</body>
</html>