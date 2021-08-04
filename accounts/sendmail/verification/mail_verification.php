<?php

use Snipworks\Smtp\Email;

function sendmail($Email,$token,$sessionid){

require_once(dirname(__DIR__) . '/vendor/autoload.php');
$_POST['email'] = $Email;
$link = 'href="localhost/refferal/accounts/includes/verify.php?token='.$token.'"';
$mail = new Email('smtp.gmail.com', 587);
$mail->setProtocol(Email::TLS)
    ->setLogin('YourEmailHere', 'YourPasswordHere')
    ->setFrom('support@refferal.com')
    ->setSubject('Welcome to Refferal')
    //->setTextMessage('Plain text message')
    ->setHtmlMessage('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>NullExpo</title><style>body{background-color:rgb(225,225,225);margin:0px;padding:0px;height:auto}.container{background-color:rgb(118,26,170);height:50vh;color:#fff;text-align:center}.container>h2{padding-top:40px;margin-bottom:30px}.button{background-color:rgb(26, 179, 176);padding:10px;border-radius:5px;margin-top:50px;color:#fff;text-decoration:none}</style></head><body><div class="container"><h2>Welcome to NullExpo</h2><p>Welcome to the evergrowing marketing giant where you will make extra cash!</p> <br><br> <a class="button" '.$link.'> verify your account </a></div></body></html>')
    ->addTo($Email);
    //->addAttachment(dirname(__DIR__) . '/LICENSE')
    //->addAttachment(dirname(__DIR__) . '/README.md');

if ($mail->send()) {
    echo 'SMTP Email has been sent' . PHP_EOL;
    // start session
    session_start();
    $_SESSION['sessionID'] = $sessionid;
    echo '<script>window.location.href="../dashboard.php?sessionID='.$sessionid.'"</script>';
    exit(0);
}

echo 'An error has occurred. Please check the logs below:' . PHP_EOL;
print_r($mail->getLogs());

}
