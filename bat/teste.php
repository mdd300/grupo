<?php

require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'cookiedigital.com.br';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->SMTP_PORT = 465;
$mail->Username = 'filipi@cookiedigital.com.br';                            // SMTP username
$mail->Password = 'majora64';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'contato@cookiedigital.com.br';
$mail->FromName = 'Mailer';
$mail->addAddress('filipi@cookiedigital.com.br', 'Josh Adams');  // Add a recipient

/*$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');
*/

$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
/*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
*/$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';
