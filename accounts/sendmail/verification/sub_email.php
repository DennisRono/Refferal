<?php

use Snipworks\Smtp\Email;

function sendmail($email){

require_once(dirname(__DIR__) . '/vendor/autoload.php');
$mail = new Email('smtp.gmail.com', 587);
$mail->setProtocol(Email::TLS)
    ->setLogin('YourEmailAddressHere', 'YourPasswordHere')
    ->setFrom('support@refferal.com')
    ->setSubject('Your subscription to Refferal was Successful!')
    //->setTextMessage('Plain text message')
    ->setHtmlMessage('')
    ->addTo($email);
    //->addAttachment(dirname(__DIR__) . '/LICENSE')
    //->addAttachment(dirname(__DIR__) . '/README.md');

if ($mail->send()) {
    echo 'SMTP Email has been sent' . PHP_EOL;
    exit(0);
}

echo 'An error has occurred. Please check the logs below:' . PHP_EOL;
print_r($mail->getLogs());

}
