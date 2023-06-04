<?php
session_start();
include('baglan.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail_adres = 'gizemkarydi@gmail.com';
$mail_gonderici_adi = 'RENTGO';

$alici_mail = $_SESSION['musteri_mail'];

$token = md5($alici_mail.rand(10,9999));
$url = "https://localhost/proje_arac_kiralama/sifre_sifirla.php?id=$token";

$token_yazdir=mysqli_query($conn,"update musteriler set musteri_token='{$token}' where musteri_email='{$alici_mail}'");

$mail = new PHPMailer(true);
try {
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;                                 
    $mail->isSMTP();                                     
    $mail->Host = 'mail.smtp2go.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'gkarydi';                 
    $mail->Password = 'zV4AjwHrUeizTLjJ';                           
    $mail->SMTPSecure = 'ssl';                            
    $mail->Port = 465;                                    
 
    $mail->setFrom($mail_adres, $mail_gonderici_adi);
    $mail->addAddress($alici_mail);

    $mail->isHTML(true);                                 
    $mail->Subject = 'Şifre Sıfırlama';
    $mail->Body    = nl2br("Şifrenizi sıfırlamak için tıklayınız\n {$url}");


    $mail->send();
    echo "Mesajınız <b>$alici_mail</b> adresine gönderildi";
} catch (Exception $e) {
    echo "Mail gönderilemedi. HATA: . '$mail->ErrorInfo";
}

?>