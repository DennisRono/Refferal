<?php
    include "../accounts/db/config.php";
    include "../accounts/sendmail/verification/sub_email.php";
    if(isset($_POST['subscribe'])){
        $email = trim($_POST['subscriber_email']);
        if(empty($email)){
            $subError = "You did not enter your email";
            echo "err1";
        } else {
            $username = "";
            //check if user is registered
            $query = $conn->prepare( "SELECT `Email` FROM `users` WHERE `Email` = ?" );
            $query->bindValue( 1, $email );
            $query->execute();

            if( $query->rowCount() > 0 ) { # If rows are found for query
                //User is registered so fetch his/her username
                $query = $conn->prepare( "select Username from users where Email=?" );
                $query->execute([$email]);
                $row = $query->fetch(PDO::FETCH_OBJ);
                $username = $row->Username;
            } else {
                //user is not registered
                $username = "Refferal Subscriber";
            }
            $username;
            //if everything is set save user to db
            $stmt = $conn->prepare("INSERT INTO subscribers (Email, Username) VALUES (?, ?)");
            $stmt->execute([$email, $username]);
            $stmt = null;

            //send confirming email to user
            sendmail($email);
        }
    }
?>