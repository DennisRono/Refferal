<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot | Refferal</title>
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
                        <p class="my-0 text-muted txt">Forgot Password?</p>
                    </div>
                    <div class="col d-flex align-items-center">
                        <span class="line"></span>
                    </div>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="username">Email address*</label>
                        <input type="email" name="username" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-block btn2">
                            <i class="ik ik-mail" style="margin-right: 10px;"></i>Request reset</button>
                    </div>
                </form>
                    <div class="row no-gutters line-on-side" style="margin: 20px 0">
                        <div class="col d-flex align-items-center">
                            <span class="line"></span>
                        </div>
                        <div class="col-auto px-2 d-flex align-items-center">
                            <p class="my-0 text-muted txt">back to login</p>
                        </div>
                        <div class="col d-flex align-items-center">
                            <span class="line"></span>
                        </div>
                    </div>
                    <a href="./login.php" class="btn btn1 btn-block">
                        <i class="ik ik-unlock"></i> Login
                    </a>
                    <p class="agree text-center footer">
                        &copy; 2021 Refferal
                    </p>
            </div>
        </div>
    </div>
</body>
</html>