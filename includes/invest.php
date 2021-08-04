<?php
include "../accounts/db/config.php";
//wait for form submission trigger
if(isset($_POST['invest'])){
    $type = trim($_POST['type']);
    $sessionid = trim($_POST['sessionid']);
    $ammount = trim($_POST['ammount']);

    if(empty($type) && empty($ammount)){
        $invErr = "Please fill the form!";
    } else if(empty($type)){
        $invErr = "Please select the type of investment!";
    } else if(empty($ammount)){
        $invErr = "Please enter the ammount (min Ksh 500 )";
    } else if ($ammount < 100){
        $invErr = "The minimum investment ammount is Ksh 500";
    } else {
        //Check Balance
        $query = $conn->prepare( "select Username, UserId, Balance from users where SessionID=?" );
        $query->execute([$sessionid]);
        $row = $query->fetch(PDO::FETCH_OBJ);
        $balance= $row->Balance;
        $username = $row->Username;
        $userid = $row->UserId;
        if($type=="gold"){$days=14;}elseif($type=="silver"){$days=10;}elseif($type=="bronze"){$days=7;}elseif($type=="platinum"){$days=4;}
        if ($balance < $ammount){
            $requiredAmm = $ammount - $balance;
            $invErr = "Account insufficient you need an Additional Ammount of $requiredAmm";
            echo $invErr;
        } else {
            //Set investment & Subtract account balance
            // invoke mpesa api & await confirm response
            //Update user balance
            echo $username.'       '.$userid.'       '.$type.'       '.$ammount.'       '.$days;
            $stmt = $conn->prepare("INSERT INTO investments(Username,User_ID,Type,Ammount,Days_no)VALUES(?,?,?,?,?)");
            $stmt->execute([$username,$userid,$type,$ammount,$days]);
            $stmt = NULL;
            
        }
    }
}
?>