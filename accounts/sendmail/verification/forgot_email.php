<?php

use Snipworks\Smtp\Email;

function sendmail($email,$code){

require_once(dirname(__DIR__) . '/vendor/autoload.php');
$_POST['email'] = $Email;
$mail = new Email('smtp.gmail.com', 587);
$mail->setProtocol(Email::TLS)
    ->setLogin('YourEmailHere', 'YourPasswordHere')
    ->setFrom('support@refferal.com')
    ->setSubject('RESET YOUR PASSWORD')
    ->setTextMessage('Reset Code')
    ->setHtmlMessage('Use this one time reset code to reset your password! <br> <center><strong>'.$code.'</strong></center>')
    ->addTo($email);
    //->addAttachment(dirname(__DIR__) . '/LICENSE')
    //->addAttachment(dirname(__DIR__) . '/README.md');

if ($mail->send()) {
    echo 'SMTP Email has been sent' . PHP_EOL;
    session_start();
    $_SESSION['email'] = $email;
    echo '<script>window.location.href="./code_confirm.php"</script>';
    exit(0);
}

echo 'An error has occurred. Please check the logs below:' . PHP_EOL;
print_r($mail->getLogs());

}
