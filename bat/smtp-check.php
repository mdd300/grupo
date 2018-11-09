<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    teste



<?php
require './phpmailer/PHPMailerAutoload.php';
//Create a new SMTP instance
$smtp = new SMTP;
//Enable connection-level debug output
$smtp->do_debug = SMTP::DEBUG_CONNECTION;
try {
    //Connect to an SMTP server
    if (!$smtp->connect('cookiedigital.com.br', 465)) {
        throw new Exception('Connect failed');
    }
    //Say hello
    if (!$smtp->hello(gethostname())) {
        throw new Exception('EHLO failed: ' . $smtp->getError()['error']);
    }
    //Get the list of ESMTP services the server offers
    $e = $smtp->getServerExtList();
    //If server can do TLS encryption, use it
    if (is_array($e) && array_key_exists('STARTTLS', $e)) {
        $tlsok = $smtp->startTLS();
        if (!$tlsok) {
            throw new Exception('Failed to start encryption: ' . $smtp->getError()['error']);
        }
        //Repeat EHLO after STARTTLS
        if (!$smtp->hello(gethostname())) {
            throw new Exception('EHLO (2) failed: ' . $smtp->getError()['error']);
        }
        //Get new capabilities list, which will usually now include AUTH if it didn't before
        $e = $smtp->getServerExtList();
    }
    //If server supports authentication, do it (even if no encryption)
    if (is_array($e) && array_key_exists('AUTH', $e)) {
        if ($smtp->authenticate('filipi@cookiedigital.com.br', 'majora64')) {
            echo "Connected ok!";
        } else {
            throw new Exception('Authentication failed: ' . $smtp->getError()['error']);
        }
    }
} catch (Exception $e) {
    echo 'SMTP error: ' . $e->getMessage(), "\n";
}

?>

</body>
</html>
