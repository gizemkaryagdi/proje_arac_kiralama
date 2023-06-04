<?php
session_start();
include('baglan.php');

$kod = $_REQUEST['dogrulama'];
$dkod = $_SESSION["dogrulamakodu"];
$kullanici = $_REQUEST['site_email'];
$sifre = $_REQUEST['site_sifre'];

$sorgu = mysqli_query($conn,"Select * from musteriler where musteri_email='$kullanici'");
$say_uye = mysqli_num_rows($sorgu);

if (  $say_uye > 0  ) {
    $satir = mysqli_fetch_array($sorgu);
    $dogru_sifre = $satir['musteri_sifre'];
}

if ( strtolower($kod) != strtolower($dkod)  ) {
    echo "<img src='img/hata.svg' width='48' height='48'><br>";
    echo "Doğrulama Kodu Hatalı";
} elseif (  $say_uye == 0 ) {
    echo "<img src='img/hata.svg' width='48' height='48'><br>";
    echo "Giriş yetkiniz yok.";
} elseif  (md5(sha1(md5($sifre))) != $dogru_sifre){
    echo "<img src='img/hata.svg' width='48' height='48'><br>";
    echo "Kullanıcı adı veya şifre yanlış <br> Giriş yetkiniz yok.";
}
else {

    $_SESSION["musteri_id"] = $satir['musteri_id'];
    ?>
    <script language="javascript">window.location="index.php";
     </script>

    <?php

}
?>