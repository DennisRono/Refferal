<?php

use Snipworks\Smtp\Email;

function sendmail($email, $articleID, $title, $author){

require_once(dirname(__DIR__) . '/vendor/autoload.php');
$inner = '<div><p>Hooray '.$author.'!</p><p>Your article '.$title.' was successfully posted!<br>Show your friends so that they can read it</p><br><p>Use this link to share your article <br><a>https://refferal.com/read.php?id='.$articleID.'</a></p></div>';
$mail = new Email('smtp.gmail.com', 587);
$mail->setProtocol(Email::TLS)
    ->setLogin('YourEmailHere', 'YourPasswordHere')
    ->setFrom('support@refferal.com')
    ->setSubject('Welcome to Refferal')
    //->setTextMessage('Plain text message')
    ->setHtmlMessage('<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>NullExpo</title><style>body{background-color:rgb(225,225,225);margin:0px;padding:0px;height:auto}.container{background-color:rgb(118,26,170);height:50vh;color:#fff;text-align:center}.container>h2{padding-top:40px;margin-bottom:30px}.button{background-color:rgb(26, 179, 176);padding:10px;border-radius:5px;margin-top:50px;color:#fff;text-decoration:none}</style></head><body><div class="container"><h2>Welcome to Refferal</h2><p>Welcome to the evergrowing marketing giant where you will make extra cash!</p> <br><br>'.$inner.'</div></body></html>')
    ->addTo($email);
    //->addAttachment(dirname(__DIR__) . '/LICENSE')
    //->addAttachment(dirname(__DIR__) . '/README.md');

if ($mail->send()) {
    echo 'SMTP Email has been sent' . PHP_EOL;
    echo '<script>window.location.href="http://localhost/refferal/read.php?id='.$articleID.'";</script>';
    exit(0);
}

//echo 'An error has occurred. Please check the logs below:' . PHP_EOL;
//print_r($mail->getLogs());

}
