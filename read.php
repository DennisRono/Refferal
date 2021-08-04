<?php
    session_start();
    include "./accounts/db/config.php";
    //$sessionid = $_SESSION['sessionID'];
    if(isset($_GET['id'])){
        $query = $conn->prepare( "SELECT `Article_ID` FROM `blogs` WHERE `Article_ID` = ?" );
        $query->bindValue( 1, $_GET['id'] );
        $query->execute();

        if( $query->rowCount() > 0 ) { # If rows are found for query
            $query = $conn->prepare( "select Author,Title,Brief_desc,ImagePath,Article,DATE_FORMAT(Date_published, '%M %d, %Y') AS RegDat,Popularity from blogs where Article_ID=?" );
            $query->execute([$_GET['id']]);
            $row = $query->fetch(PDO::FETCH_OBJ);
            $author = $row->Author;
            $title = $row->Title;
            $path = $row->ImagePath;
            $article = $row->Article;
            $date = $row->RegDat;
            $popularity = $row->Popularity;
            
        } else {
            echo 'Invalid ID';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refferal | <?php echo $title; ?></title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="./static/bootstrap/css/bootstrap.min.css">
    <!-- fonts -->
    <link rel="stylesheet" href="./static/fonts/iconkit/css/iconkit.min.css">
    <link rel="stylesheet" href="./static/fonts/fontawesome-free-5.15.3-web/css/all.min.css">
    <link rel="stylesheet" href="./static/fonts/fontawesome-free-5.15.3-web/css/fontawesome.min.css">
    <!-- custom -->
    <link rel="stylesheet" href="./static/css/dashboard.css">
    <link rel="stylesheet" href="./static/css/homepage.css">
    <link rel="stylesheet" href="./static/css/read.css">
    <link rel="stylesheet" href="./static/css/footer.css">
    <link rel="stylesheet" href="./static/css/dataTables.bootstrap.min.css">
    <script src="./static/js/jquery.min.js"></script>
</head>
<body>
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
                        <?php if(isset($_SESSION['sessionID'])){?>
                            <li><a href="">Write Articles</a></li>
                            <li><a href="">Invest</a></li>
                            <li><a href="">Sponsor us</a></li>
                        <?php } else { ?>
                        <li><a href="./index.php#how_it_works">How it works</a></li>
                        <li><a href="accounts/register.html">Register</a></li>
                        <li><a href="accounts/login.html">Login</a></li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <!-- read body -->
    <div class="read">
        <div class="articles-read">
            <?php if (!isset($_GET['id'])){?>
                <style>
                    .footer{
                        position: absolute;
                        bottom: 0;
                        left: 38%;
                    }
                </style>
                <div class="error_id">
                    <img src="./static/images/not-found.png" alt="Err"><br>
                    <p><i class="fa fa-ban"></i>Broken Link!</p>
                </div>
            <?php } else { ?>
                <div class="breadcrumb">
                    <div class="container">
                        <p>Home<span class="separator item">&nbsp;»&nbsp;</span><?php echo $title; ?></p>
                    </div>
                </div>
                <div class="read-main-content">
                    <div class="container">
                        <div class="read-flex">
                            <div class="read-main">
                                <h1><?php echo $title; ?></h1>
                                <div class="article-img">
                                    <img src="<?php echo $path; ?>" alt="">
                                </div>
                                <div class="article-details">
                                    <div class="author-det">
                                        <div class="author-avatar">
                                            <img src="./static/images/uploads/avatar.png" alt="">
                                        </div>
                                        <span><?php echo $author; ?></span>
                                    </div>
                                    <div class="article-date">
                                        <p>Posted on <?php echo $date; ?></p>
                                    </div>
                                </div>
                                <div class="read-content">
                                    <p><?php echo $article; ?></p>
                                </div>
                                <div class="comment-sys">
                                    <div class="article-read-comments">

                                    </div>
                                    <div class="comment-sys-form">
                                        <div class="form-container">
                                            <form action="read.php" method="post">
                                                <div class="form-group">
                                                    <input type="hidden" name="articleid" value="<?php echo $_GET['id'];?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="username" value="<?php if(isset($_SESSION['sessionID'])){echo $_SESSION['sessionID'];}else{echo "User";} ?>">
                                                </div>
                                                <div class="form-group">
                                                    input
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="read-sidebar">
                                <div class="sidebar-one">
                                    <h2>Popular</h2>
                                    <?php
                                        $query = $conn->prepare( "select * from blogs ORDER BY Popularity DESC LIMIT 0, 3" );
                                        $query->execute();
                                        $row = $query->fetchAll();
                                        if($row) {
                                        foreach($row as $pk){ 
                                    ?>
                                    <a href="<?php echo 'read.php?id='.$pk['Article_ID']; ?>">
                                        <div class="article-bg-image">
                                            <img src="<?php echo $pk['ImagePath'] ?>" alt="">
                                            <div class="popular-article ">
                                                <div class="popular-texts">
                                                    <h5><?php if($pk["Tag"]==" "){echo $pk["Tag"];}else{echo $pk["Author"];} ?></h5>
                                                    <p><?php echo $pk["Title"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php }} else {
                                        echo '<p class="err">'.'No blogs currently'.'</p>';
                                    } ?>
                                </div>
                                <div class="sidebar-two">
                                    <h2>Latest</h2>
                                    <?php
                                        $query = $conn->prepare( "select * from blogs ORDER BY Date_published DESC LIMIT 0, 3" );
                                        $query->execute();
                                        $row = $query->fetchAll();
                                        if($row) {
                                        foreach($row as $pk){ 
                                    ?>
                                    <a href="<?php echo 'read.php?id='.$pk['Article_ID']; ?>">
                                        <div class="article-bg-image">
                                            <img src="<?php echo $pk['ImagePath'] ?>" alt="">
                                            <div class="popular-article">
                                                <div class="popular-texts">
                                                    <h5><?php if($pk["Tag"]==" "){echo $pk["Tag"];}else{echo $pk["Author"];} ?></h5>
                                                    <p><?php echo $pk["Title"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php }} else {
                                        echo '<p class="err">'.'No blogs currently'.'</p>';
                                    } ?>
                                </div>
                                <div class="sidebar-advert-tr">
                                    <div class="sidebar-ad-tr">
                                        <img src="./static/images/jumbotron.png" alt="">
                                    </div>
                                </div>
                                <!-- <div class="sidebar-advert">
                                    <div class="sidebar-ad">
                                        <img src="./static/images/jumbotron.png" alt="ad">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- footer -->
    <?php include "./includes/footer.php"; ?>
    <!-- <footer class="footer">
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
    </footer> -->
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