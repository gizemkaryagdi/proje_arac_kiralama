<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$sendEmailTo =  $_SESSION['adminEmail'];

$mail = new PHPMailer(true); // Ignore Erros

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'dclinic139@gmail.com';
$mail->Password = 'sxmokpcoqsgbkayu';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('dclinic139@gmail.com');

$mail->addAddress($sendEmailTo);

$mail->isHTML(true);

$mail->Subject = 'Admin Password Request in V.M.S.';
$mail->Body = 'Hello Admin! Here is your password in Visitor management!<br> Password : ' . $password['Password'];

$mail->send();