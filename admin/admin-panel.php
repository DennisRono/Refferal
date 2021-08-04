<?php
session_start();
$adminSession = $_SESSION['admin'];
include "../accounts/db/config.php";
//check if logged user is admin
$stmt = $conn->prepare("SELECT * from core");
$stmt->execute();

if($stmt->rowCount() > 0){
    //There is someone in the db
} else {
    //No one is in the DB
    echo "<script>window.location.href='./reg.php';</script>";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refferal | Admin panel</title>
    <link rel="stylesheet" href="./css/admin-style.css">
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.min.css">
    <style>
        .tbr{
            color: #fff !important;
            text-decoration: none;
            font-size: 18px;
        }
    </style>
</head>
<body>
   <header class="header">
       <div class="container">
           <div class="logo">
               <h1>Refferal Admin Panel</h1>
           </div>
           <div class="navigation">
               <nav class="nav">
                   <ul class="unordered">
                       <li><a href="admin-panel.php">Home</a></li>
                       <li><a href="admin-write.php">Write</a></li>
                       <li><a href=""></a></li>
                       <li><a href=""></a></li>
                   </ul>
               </nav>
           </div>
       </div>
   </header>
   <div class="admin-content" style="margin-top: 60px;">
       <div class="admin-flex-one">
           <div class="admin-links">
               <div class="bb">
                   <h1>Refferal</h1>
               </div>
               <div class="links">
                   <a href="">
                       <div class="ilink">Home</div>
                   </a>
                   <a href="">
                       <div class="ilink">users</div>
                   </a>
                   <a href="">
                       <div class="ilink">articles</div>
                   </a>
                   <a href="">
                       <div class="ilink">investments</div>
                   </a>
                   <a href="">
                       <div class="ilink">refferals</div>
                   </a>
                   <a href="">
                       <div class="ilink">Approvals</div>
                   </a>
                   <a href="">
                       <div class="ilink">write</div>
                   </a>
                   <a href="">
                       <div class="ilink">stats</div>
                   </a>
               </div>
               <div class="cc">
                   <p>&copy; Refferal 2021</p>
               </div>
           </div>
           <div class="admin-main-area">
               <div class="main-top">
                    <div class="users">
                        <h2>Members</h2>
                        <div class="users-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Username</td>
                                        <td>Userid</td>
                                        <td>Date Joined</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <?php
                                        $query = $conn->prepare( "select * from users" );
                                        $query->execute();
                                        $row = $query->fetchAll();
                                        if($row) {
                                        foreach($row as $pk){
                                        ?>
                                        <tr>
                                        <td><?php echo $pk['ID'] ?></td>
                                        <td><?php echo $pk['Username'] ?></td>
                                        <td><?php echo $pk['UserId'] ?></td>
                                        <td><?php echo $pk['DateJoined'] ?></td>
                                        </tr>
                                        <?php }} else {
                                            echo '<p class="err">'.'No Users currently'.'</p>';
                                        } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="articles">
                        <h2>Articles</h2>
                        <div class="users-table">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td></td>
                                        <td>Author</td>
                                        <td>Article ID</td>
                                        <td>Title</td>
                                        <td>Date Written</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = $conn->prepare( "select * from blogs" );
                                        $query->execute();
                                        $row = $query->fetchAll();
                                        if($row) {
                                        foreach($row as $pk){
                                        ?>
                                    <tr>
                                        <td><a class="tbr" href="<?php echo '../read.php?id='.$pk['Article_ID']; ?>"><?php echo $pk['ID'] ?></a></td>
                                        <td><a class="tbr" href="<?php echo '../read.php?id='.$pk['Article_ID']; ?>"><?php echo $pk['Author'] ?></a></td>
                                        <td><a class="tbr" href="<?php echo '../read.php?id='.$pk['Article_ID']; ?>"><?php echo $pk['Article_ID'] ?></a></td>
                                        <td><a class="tbr" href="<?php echo '../read.php?id='.$pk['Article_ID']; ?>"><?php echo $pk['Title'] ?></a></td>
                                        <td><a class="tbr" href="<?php echo '../read.php?id='.$pk['Article_ID']; ?>"><?php echo $pk['Date_published'] ?></a></td>
                                    </tr>
                                    <?php }} else {
                                        echo '<p class="err">'.'No Users currently'.'</p>';
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
               </div>
               <div class="main-bottom">
                    <div class="data-spread">
                        <div class="investments">
                            <h2>Investments</h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>Username</td>
                                        <td>User ID</td>
                                        <td>refferals number</td>
                                        <td>Earnings via Refferals</td>
                                        <td>active</td>
                                        <td>Date Joined</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kibet</td>
                                        <td>qwerty</td>
                                        <td>20</td>
                                        <td>30000</td>
                                        <td>300</td>
                                        <td>1st Aug 2021</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="refferals">
                            <h2>refferals</h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>Username</td>
                                        <td>User ID</td>
                                        <td>refferals number</td>
                                        <td>Earnings via Refferals</td>
                                        <td>active</td>
                                        <td>Date Joined</td>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $query = $conn->prepare( "select * from users" );
                                        $query->execute();
                                        $row = $query->fetchAll();
                                        if($row) {
                                        foreach($row as $pk){
                                            if($pk['Active'] == 0){
                                                $active = "NO";
                                            } else {
                                                $active = "YES";
                                            }
                                            if(!empty($pk['Downlines'])){
                                                if(strpos($pk['Downlines'], ";") !== false){
                                                    $ref_earnings = explode(';', $pk['Downlines']);
                                                    $ref_earnings = count($ref_earnings)*300;
                                                    $downlines = count(explode(';', $pk['Downlines']));
                                                }else{
                                                    //has one downline
                                                    $ref_earnings = 300;
                                                    $downlines = 1;
                                                }
                                            }else{//zero has not earned
                                                $ref_earnings = 0;
                                                $downlines = 0;
                                            }
                                        ?>
                                    <tr>
                                        <td><?php echo $pk['Username'] ?></td>
                                        <td><?php echo $pk['UserId'] ?></td>
                                        <td><?php echo $downlines; ?></td>
                                        <td><?php echo $ref_earnings; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td><?php echo $pk['DateJoined'] ?></td>
                                    </tr>
                                    <?php }} else {
                                        echo '<p class="err">'.'No Users currently'.'</p>';
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="approvals">
                            <h2>Approvals</h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Article ID</td>
                                        <td>Title</td>
                                        <td>Author</td>
                                        <td>Date Posted</td>
                                        <td>Approve</td>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                         $query = $conn->prepare( "select * from core" );
                                         $query->execute();
                                         $row = $query->fetchAll();
                                         if($row) {
                                         foreach($row as $pk){
                                             if($pk['Approval'] != ""){
                                                $pieces = explode(';', $pk['Approval']);
                                        ?>
                                    <tr>
                                        <td><?php echo $pieces[0]; ?></td>
                                        <td><?php echo $pieces[1]; ?></td>
                                        <td><?php echo $pieces[2]; ?></td>
                                        <td><?php echo $pieces[3]; ?></td>
                                        <td><?php echo $pieces[4]; ?></td>
                                        <td>
                                            <?php
                                                if(isset($_POST['approve'])){
                                                    $articleid = $_POST['articleid'];
                                                    $query = $conn->prepare( "UPDATE blogs SET Approved=? WHERE Article_ID=?" );
                                                    $query->execute([1, $articleid]);
                                                    $query = NULL;
                                                    $query = $conn->prepare( "DELETE FROM core WHERE Approval=?" );
                                                    $query->execute([$pk['Approval']]);
                                                    $query = NULL;
                                                }
                                            ?>
                                            <form action="admin-panel.php" method="post">
                                                <input type="hidden" name="articleid" value="<?php echo $pieces[1]; ?>">
                                                <input type="submit" name="approve" class="btn btn-primary" value="Approve" >
                                            </form>
                                        </td>
                                    </tr>
                                    <?php }}} else {
                                        echo '<p class="err">'.'No Users currently'.'</p>';
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="stats">
                            <h2>Statistics</h2>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td>Acc_Bal</td>
                                        <td>Money IN</td>
                                        <td>Money OUT</td>
                                        <td>Profit</td>
                                        <td>Total Clicks</td>
                                        <td>Wild Card</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ksh 500, 000</td>
                                        <td>Ksh 100, 000</td>
                                        <td>Ksh 50, 000</td>
                                        <td>Ksh 50, 000</td>
                                        <td>Ksh 400</td>
                                        <td>Ksh 30,000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
               </div>
           </div>
       </div>
   </div>
   <script src="./js/main.js"></script>
</body>
</html>