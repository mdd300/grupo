<?php

$recipients = 'web@gruporedes.global';

try {
    require './phpmailer/PHPMailerAutoload.php';

    preg_match_all("/([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)/", $recipients, $addresses, PREG_OFFSET_CAPTURE);

    if (!count($addresses[0])) {
        die('MF001');
    }

    if (preg_match('/^(127\.|192\.168\.)/', $_SERVER['REMOTE_ADDR'])) {
        die('MF002');
    }

    $template = "<html><head></head><body><div>Nome: " . $_POST['nome'] . "</div><div>Email: " . $_POST['email'] . "</div></body></html>";

    $subject = "Contato Black Friday";



    /*  preg_match("/(<!-- #{BeginInfo} -->)(.|\n)+(<!-- #{EndInfo} -->)/", $template, $tmp, PREG_OFFSET_CAPTURE);

      foreach ($_POST as $key => $value) {
      if ($key != "email" && $key != "message" && $key != "form-type" && $key != "g-recaptcha-response" && !empty($value)){

      $info = str_replace(
      array("<!-- #{BeginInfo} -->", "<!-- #{InfoState} -->", "<!-- #{InfoDescription} -->"),
      array("", ucfirst($key) . ':', $value),
      $tmp[0][0]);

      $template = str_replace("<!-- #{EndInfo} -->", $info, $template);
      }
      } */

    $template = str_replace(
            array("<!-- #{Subject} -->", "<!-- #{SiteName} -->"), array($subject, $_SERVER['SERVER_NAME']), $template);

    $mail = new PHPMailer();
    $mail->From = $_POST['email'];



    if (isset($_POST['name'])) {
        $mail->FromName = $_POST['nome'];
    } else {
        $mail->FromName = "Contato Black Friday";
    }
    /*
      foreach ($addresses[0] as $key => $value) {
      $mail->addAddress($value[0]);
      }
     */


    $mail->addAddress('victor.za.oshiro5@gmail.com');


    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->SMTPAuth = true;

    $mail->Host = 'mail.gruporedes.global';
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Username = 'web@gruporedes.global';
    $mail->Password = 'yVPdPbVK';

    $mail->CharSet = 'utf-8';
    $mail->Subject = $subject;
    $mail->MsgHTML($template);
    $mail->send();



    header("Location: http://gruporedes.global"); /* Redirect browser */
exit();
} catch (phpmailerException $e) {
    die('MF254');
} catch (Exception $e) {
    die('MF255');
}
