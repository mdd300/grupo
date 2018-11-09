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

    $template = file_get_contents('rd-mailform.tpl');

    if (isset($_POST['form-type'])) {
        switch ($_POST['form-type']){
            case 'contact':
                $subject = 'Mensagem de visitante do site';
                break;
            case 'subscribe':
                $subject = 'Cadastro de newsletter';
                break;
            case 'representante':
                $subject = 'Representante';
                break;
            case 'seg-fire':
                $subject = 'Pedido de contrato - Firewall';
                break;
            case 'fire-load-ba':
                $subject = 'Pedido de contrato - Firewall com Load Balance';
                break;
            case 'anti-ddos':
                $subject = 'Pedido de contrato - Anti-DDOS';
                break;
            case 'dados':
                $subject = 'Pedido de contrato - Dados';
                break;
            case 'internet':
                $subject = 'Pedido de contrato - Internet';
                break;
            case 'voz-sip':
                $subject = 'Pedido de contrato - Voz SIP';
                break;
            case 'wifi-waas':
                $subject = 'Pedido de contrato - Redes WiFi como serviço - Waas';
                break;
            case 'cell-id':
                $subject = 'Pedido de contrato - WiFi CELL-ID Location';
                break;
            case 'ger-wifi':
                $subject = 'Pedido de contrato - Gerenciamento de redes WiFi';
                break;
            case 'back-stor':
                $subject = 'Pedido de contrato - Backup/Storage';
                break;
            case 'cloud-back':
                $subject = 'Pedido de contrato - Cloud Bakcup';
                break;
            case 'cloud':
                $subject = 'Pedido de contrato - Cloud';
                break;
            case 'colo':
                $subject = 'Pedido de contrato - Colocation';
                break;
            case 'dis-rec':
                $subject = 'Pedido de contrato - Disaster recovery';
                break;
            case 'host-ded':
                $subject = 'Pedido de contrato - Host dedicado';
                break;
            case 'outs':
                $subject = 'Pedido de contrato - Outsourcing';
                break;
            case 'data-vir':
                $subject = 'Pedido de contrato - Data center virtual';
                break;
            default:
                $subject = 'A message from your site visitor';
                break;
        }
    }else{
        die('MF004');
    }

    if (isset($_POST['email'])) {
        $template = str_replace(
            array("<!-- #{FromState} -->", "<!-- #{FromEmail} -->"),
            array("Email:", $_POST['email']),
            $template);
    }else{
        die('MF003');
    }

    if (isset($_POST['message'])) {
        $template = str_replace(
            array("<!-- #{MessageState} -->", "<!-- #{MessageDescription} -->"),
            array("Mensagem:", $_POST['message']),
            $template);
    }

    if (isset($_POST['telefone'])) {
        $template = str_replace(
            array("<!-- #{FromTel} -->", "<!-- #{FromPhone} -->"),
            array("Telefone:", $_POST['telefone']),
            $template);
    }

    if (isset($_POST['name'])) {
        $template = str_replace(
            array("<!-- #{FromNa} -->", "<!-- #{FromName} -->"),
            array("Nome:", $_POST['name']),
            $template);
    }

    if (isset($_POST['Razao'])) {
        $template = str_replace(
            array("<!-- #{FromRa} -->", "<!-- #{FromRaz} -->"),
            array("Razão Social:", $_POST['Razao']),
            $template);
    }


    if (isset($_POST['NomeFantasia'])) {
    $template = str_replace(
        array("<!-- #{FromNoF} -->", "<!-- #{FromNoFa} -->"),
        array("Nome fantasia:", $_POST['NomeFantasia']),
        $template);
    }

    if (isset($_POST['CNPJ'])) {
        $template = str_replace(
            array("<!-- #{FromCN} -->", "<!-- #{FromCNP} -->"),
            array("CNPJ:", $_POST['CNPJ']),
            $template);
    }

    if (isset($_POST['TelefoneDaEmpresa'])) {
        $template = str_replace(
            array("<!-- #{FromTelE} -->", "<!-- #{FromTelEmp} -->"),
            array("Telefone da empresa:", $_POST['TelefoneDaEmpresa']),
            $template);
    }

    if (isset($_POST['Responsavel'])) {
        $template = str_replace(
            array("<!-- #{FromResp} -->", "<!-- #{FromRespon} -->"),
            array("Responsavel:", $_POST['Responsavel']),
            $template);
    }

    if (isset($_POST['EmailDoResponsavel'])) {
        $template = str_replace(
            array("<!-- #{FromEmailR} -->", "<!-- #{FromEmailResp} -->"),
            array("Email responsável:", $_POST['EmailDoResponsavel']),
            $template);
    }

    if (isset($_POST['CEP'])) {
        $template = str_replace(
            array("<!-- #{FromCE} -->", "<!-- #{FromCEP} -->"),
            array("CEP:", $_POST['CEP']),
            $template);
    }

    if (isset($_POST['Endereco'])) {
        $template = str_replace(
            array("<!-- #{FromEnd} -->", "<!-- #{FromEnde} -->"),
            array("Endereço:", $_POST['Endereco']),
            $template);
    }

    if (isset($_POST['Numero'])) {
        $template = str_replace(
            array("<!-- #{FromNum} -->", "<!-- #{FromNumer} -->"),
            array("Número:", $_POST['Numero']),
            $template);
    }

    if (isset($_POST['bairro'])) {
        $template = str_replace(
            array("<!-- #{FromBair} -->", "<!-- #{FromBairro} -->"),
            array("Bairro:", $_POST['bairro']),
            $template);
    }

    if (isset($_POST['complemento'])) {
        $template = str_replace(
            array("<!-- #{FromComp} -->", "<!-- #{FromComple} -->"),
            array("Complemento:", $_POST['complemento']),
            $template);
    }

    if (isset($_POST['estado'])) {
        $template = str_replace(
            array("<!-- #{FromEst} -->", "<!-- #{FromEstad} -->"),
            array("Estado:", $_POST['estado']),
            $template);
    }

    if (isset($_POST['cidade'])) {
        $template = str_replace(
            array("<!-- #{FromCid} -->", "<!-- #{FromCidad} -->"),
            array("Cidade:", $_POST['cidade']),
            $template);
    }

    if (isset($_POST['LigarAgora'])) {
        $template = str_replace(
            array("<!-- #{FromLigA} -->", "<!-- #{FromLigAgo} -->"),
            array("Ligar agora:", $_POST['LigarAgora']),
            $template);
    }

  /*  preg_match("/(<!-- #{BeginInfo} -->)(.|\n)+(<!-- #{EndInfo} -->)/", $template, $tmp, PREG_OFFSET_CAPTURE);

    foreach ($_POST as $key => $value) {
        if ($key != "email" && $key != "message" && $key != "form-type" && $key != "g-recaptcha-response" && !empty($value)){

            $info = str_replace(
                array("<!-- #{BeginInfo} -->", "<!-- #{InfoState} -->", "<!-- #{InfoDescription} -->"),
                array("", ucfirst($key) . ':', $value),
                $tmp[0][0]);

            $template = str_replace("<!-- #{EndInfo} -->", $info, $template);
        }
    }*/

    $template = str_replace(
        array("<!-- #{Subject} -->", "<!-- #{SiteName} -->"),
        array($subject, $_SERVER['SERVER_NAME']),
        $template);

    $mail = new PHPMailer();
    $mail->From = $_POST['email'];

    # Attach file
    if (isset($_FILES['file']) &&
        $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $mail->AddAttachment($_FILES['file']['tmp_name'],
                             $_FILES['file']['name']);
    }

    if (isset($_POST['name'])){
        $mail->FromName = $_POST['name'];
    }else{
        $mail->FromName = "Visitante do site";
    }
/*
    foreach ($addresses[0] as $key => $value) {
        $mail->addAddress($value[0]);
    }
*/


    switch ($_POST['form-type']){
      case 'contact':
        $mail->addAddress('comercial@gruporedes.global');
        break;
      case 'representante':
        $mail->addAddress('representante@gruporedes.global');
        break;
      case 'subscribe':
        $mail->addAddress('newsletter@gruporedes.global');
        break;
      default:
        $mail->addAddress('contrate@gruporedes.global');
        break;
      }

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

    if ($_POST['form-type'] = 'subscribe') {
      $mail = new PHPMailer();

      $mail->isSMTP();
      $mail->SMTPDebug = 0;
      $mail->Debugoutput = 'html';
      $mail->SMTPAuth = true;

      $mail->Host = 'mail.gruporedes.global';
      $mail->SMTPSecure = "tls";
      $mail->Port = 587;
      $mail->Username = 'web@gruporedes.global';
      $mail->Password = 'yVPdPbVK';

      $mail->From = 'newsletter@gruporedes.global';
      $mail->FromName = "Grupo Redes";
      $mail->addAddress($_POST['email']);
      $mail->CharSet = 'utf-8';
      $messageBody = '<img src="http://gruporedes.global/images/resposta-newsletter.jpg">';
      $mail->Subject = 'Obrigado por se cadastrar';
      $mail->MsgHTML($messageBody);
      $mail->send();
    }

    die('MF000');
} catch (phpmailerException $e) {
    die('MF254');
} catch (Exception $e) {
    die('MF255');
}
