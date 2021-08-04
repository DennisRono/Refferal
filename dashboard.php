<?php
session_start();
include "./accounts/db/config.php";

$sessionid = $_SESSION['sessionID'];
if (empty($sessionid)){
    echo '<script>window.location.href="./accounts/login.php";</script>';
} else {
    $query = $conn->prepare( "SELECT `SessionID` FROM `users` WHERE `SessionID` = ?" );
    $query->bindValue( 1, $sessionid );
    $query->execute();

    if( $query->rowCount() > 0 ) { # If rows are found for query
        $query = $conn->prepare( "select Username,Email,UserId,Verified,RefferalCode,Downlines,Balance,DescInvestments from users where SessionID=?" );
        $query->execute([$sessionid]);
        $row = $query->fetch(PDO::FETCH_OBJ);
        $isVerified = $row->Verified;
        $userid = $row->UserId;
        $refferalCode = $row->RefferalCode;
        $username = $row->Username;
        $email = $row->Email;
        $downlines = $row->Downlines;
        $investments = $row->DescInvestments;
    } else {
        echo '<script>window.location.href="./accounts/login.php";</script>';
    }
}

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Refferal</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="./static/bootstrap/css/bootstrap.min.css">
    <!-- fonts -->
    <link rel="stylesheet" href="./static/fonts/iconkit/css/iconkit.min.css">
    <link rel="stylesheet" href="./static/fonts/fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel="stylesheet" href="./static/fonts/fontawesome-free-5.15.3-web/css/fontawesome.min.css">
    <!-- custom -->
    <link rel="stylesheet" href="./static/css/dashboard.css">
    <link rel="stylesheet" href="./static/css/homepage.css">
    <link rel="stylesheet" href="./static/css/dataTables.bootstrap.min.css">
    <script src="./static/js/jquery.min.js"></script>
    <style>
        .ulink{
            text-align: center;
            color: #fff;
            font-size: 14px;
        }
        a:hover {
            color: #fff;
        }
        .downtable{
            margin: 0 auto;
            width: 100%;
            padding-right: 10px !important;
        }
        .downtable,tr,td{
            border: 1px solid #fff;
            color: #fff;
            border-collapse: collapse;
        }
        td{
            padding-left: 5px;
            padding-right: 10px;
        }
        .write-button{
            width: 85%;
            margin-left:50px;
            padding:10px;
        }
        .invest-form{
            display: none;
        }
        :root { --particular-ad: 600px; }

        @media (max-width: 600px) {
            :root { --particular-ad: 100% !important; }
            .invest{
                overflow-x: scroll;
            }
            .write-button{
                margin: 0px 10px;
                width: 94%;
            }
        }
    </style>
</head>
<body class="dash-body">
    <div class="pre-header">
        <div class="container">
            <div class="supprot-email">
                <a href="mailto:support@refferal.com"><i class="fa fa-envelope">&nbsp;support@refferal.com</i></a>
            </div>
            <div class="pre-socials">
                <a href="https://wa.me/254798116710"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                <a href=""><i class="fab fa-telegram" aria-hidden="true"></i></a>
                <a href="" class="instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                <a href=""><i class="fab fa-twitter" aria-hidden="true"></i></a>
                <a href=""><i class="fab fa-facebook" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
    <header class="header" id="Header" style="">
        <!-- mobile -->
        <div class="mobile">
            <div class="mobile-flex">
                <div class="bars">
                    <i class="fa fa-bars" onclick="opennav()"></i>
                </div>
                <div class="user-icon">
                    <i class="ik ik-user icon"></i>
                </div>
            </div>
            <!-- mobile navigation -->
            <div class="navigation" id="navigation">
                <nav class="nav">
                    <ul class="unordered">
                        <div class="mobi-brand">
                            <h2>Refferal</h2>
                        </div>
                        <i class="fa fa-times" onclick="closenav()"></i>
                        <li class="top"><a href="index.php">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-home"></i>&nbsp;Home</a></li>
                        <li><a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;Invest</a></li>
                        <li><a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;Balance</a></li>
                        <li><a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;Withdraw</a></li>
                        <li><a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;Deposit</a></li>
                        <li><a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;Downlines</a></li>
                        <li><a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;Bitcoin classes</a></li>
                        <li><a href="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-home"></i>&nbsp;Etherium classes</a></li>
                        <div class="mobi-copy">
                            <p>Copyright &copy; <br>Refferal <br> 2021</p>
                        </div>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- pc -->
        <div class="header-container" id="pc">
            <div class="left">
                <div class="logo">
                    <h1 id="logo-text">Refferal</h1>
                </div>
            </div>
            <div class="right">
                <div class="bars">
                    <i class="fa fa-bars" id="bars"></i>
                    <i class="fa fa-times" id="times"></i>
                </div>
                <nav class="nav" id="nav">
                    <ul class="unordered">
                        <li><a href="#how_it_works">How it works</a></li>
                        <li><a href="accounts/register.html">Register</a></li>
                        <li><a href="accounts/login.html">Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <div class="content-d">
        <div class="dash-links">
            
        </div>
        <div class="dash-blog-reads">
            <h1 class="blog-reads-title">Blog Articles</h1>
            <?php
                $query = $conn->prepare( "select * from blogs where Approved=?" );
                $query->execute([1]);
                $row = $query->fetchAll();
                if($row) {
                foreach($row as $pk){ 
            ?>
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="<?php echo $pk['ImagePath'] ?>" alt="Card image cap">
                <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo 'read.php?id='.$pk['Article_ID'] ?>"><?php echo $pk["Title"]; ?></a></h5>
                        <p><a href="<?php echo 'accounts/profile.php?id='.$pk['Author'] ?>" class="author-blog"><?php echo $pk["Author"]; ?></a></p>
                        <p class="card-text"><a href="<?php echo 'read.php?id='.$pk['Article_ID'] ?>"><?php echo $pk["Brief_desc"]; ?></a></p>
                </div>
            </div>
            <?php }} else {
                echo '<p class="err">'.'No blogs currently'.'</p>';
            } ?>
        </div>
        <div class="dash-jumb">
            <div class="jumbotron">
                <div class="jumb-container">
                    <div class="earnings" style="text-align: center; color: #fff;">
                        <h3>Welcome <?php echo $username;?></h3>
                        <a class="btn btn-primary" href="">Edit Profile</a>
                        <a class="btn btn-primary" href="">Settings</a>
                        <h4 style="font-size: 16px;margin-bottom:0px;font-weight:500;">Your Refferal Code <i></i></h4>
                        <div><a title="refferal link" href="./accounts/register.php?ref=<?php echo $refferalCode; ?>" target="blank" class="ulink">https://localhost/accounts/register.php?ref=<?php echo "$refferalCode"; ?></a></div>
                    </div>
                    <div class="earnings invest" style="width: var(--particular-ad);">
                        <h3>Active investments</h3>
                        <?php if(empty($investments)){ ?>
                            <p class="err"><i class="fa fa-exclamation-circle"></i>You have no active investments</p>
                        <?php
                            } else {
                                $pieces = explode(";", $investments);
                                echo '<table class="downtable"><thead><tr><td>FirstName</td><td>SecondName</td><td>ThirdName</td><td>Ammount</td><td>Type</td></tr></thead><tbody>';
                                for ($i=0; $i < count($pieces)-1; $i++) { 
                                    $ps = explode(":", $pieces[$i]);
                                    echo "<tr>";
                                    for ($j=0; $j < count($ps); $j++) { 
                                        echo '<td>'.$ps[$j].'</td>';
                                    }
                                    echo "</tr>";
                                }
                                echo '</tbody></table>';
                            }
                        ?>
                    </div>
                    <div class="earnings">
                        <h3>Account Balance</h3>
                        <h1 class="text-center" style="color: #fff;">ksh <?php
                                $query = $conn->prepare( "select Balance from users where SessionID=?" );
                                $query->execute([$sessionid]);
                                $row = $query->fetch(PDO::FETCH_OBJ);
                                echo $row->Balance;
                            ?>.00
                        </h1>
                    </div>
                    <div class="earnings">
                        <h3>Deposit</h3>
                        <form action="deposit.php" method="post">
                            <div class="form-group">
                                <input class="form-control dep" type="number" placeholder="make a deposit" name="deposit">
                                <input class="btn btn-primary dep-b" type="submit" name="submit" value="Deposit">
                            </div>                        
                        </form>
                    </div>
                    <!--invest-->
                    <div class="earnings">
                        <script>
                            function invest(){
                                var theform = document.querySelector('.invest-form');
                                var thexre = document.querySelector('.thexre');
                                thexre.style.display="none";
                                theform.style.display="block";
                            }
                        </script>
                        <h3>Invest</h3>
                        <button class="thexre btn btn-primary" onclick="invest()">Make an investment</button>
                        <form class="invest-form" action="./includes/invest.php" method="post">
                            <div class="form-group">
                                <p>
                                    <label for="location" class="label"><b>Type:</b></label><br>
                                    <select name="type" id="">
                                        <option value="">-select-</option>
                                        <option value="gold">Gold</option>
                                        <option value="platinum">Platinum</option>
                                        <option value="silver">Silver</option>
                                        <option value="bronze">Bronze</option>
                                    </select><br>
                                </p>
                                <input type="hidden" name="sessionid" value="<?php echo $sessionid; ?>">
                                <input class="form-control dep" type="number" placeholder="Ammount" name="ammount">
                                <input class="btn btn-primary dep-b" type="submit" name="invest" value="Invest">
                            </div>                        
                        </form>
                    </div>
                    <div class="earnings">
                        <h3>Downlines</h3>
                        <?php if(empty($downlines)){ ?>
                        <p class="err"><i class="fa fa-exclamation-circle"></i>&nbsp;You currently don't have Downlines</p>
                        <?php } else {
                            $pieces = explode(";", $downlines);
                            echo '<table class="downtable"><thead><tr><td>Name</td><td>RefferalCode</td></tr></thead><tbody>';
                            for ($i=0; $i < count($pieces); $i++) { 
                                //echo $pieces[$i];
                                $query = $conn->prepare( "select Username,RefferalCode from users where UserId=?" );
                                $query->execute([$pieces[$i]]);
                                $row = $query->fetch(PDO::FETCH_OBJ);
                                $userName = $row->Username;
                                $refferalC = $row->RefferalCode;
                                echo '
                                        <tr>
                                            <td>'.$userName.'</td>
                                            <td style="padding-left: 10px;">'.$refferalC.'</td>
                                        </tr>';
                            }
                            echo '</tbody></table>';
                        }
                        ?>
                    </div>
                </div>
                <div class="write-form">
                    <div class="show-write-form">
                        <?php include "write.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="footer">
        <div class="footer-container container">
            <div class="footer-flex">
                <div class="footer-socials">
                    <div class="footer-social-icons">
                        <a href=""><i class="fab fa-whatsapp"></i></a>
                        <a href=""><i class="fab fa-facebook"></i></a>
                        <a href=""><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fab fa-twitter"></i></a>
                        <a href=""><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>Copyright &copy; Refferal 2021 | All rights reserved</p>
        </div>
    </footer>
    <!-- scripts -->
    
    
    <script src="./static/js/main.js"></script>
    <script type="text/javascript" src="./static/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./static/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
            $(".table").DataTable({
                "ordering": true,
                "searching": true,
                "paging": true,
                "columnDefs": [
                    {
                        "targets": 0,
                        "searchable": false,
                        "visible": true
                    }
                ],
                "order": [[2, "desc"]]
            });
        });
    </script>
</body>
</html>
