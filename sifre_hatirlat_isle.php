<?php
session_start();
include('baglan.php');

$kod = $_POST['dogrulama'];
$dkod = $_SESSION["dogrulamakodu"];
$kullanici = $_POST['site_email'];
$_SESSION['musteri_mail']=$kullanici;

$sorgu = mysqli_query($conn,"Select * from musteriler where musteri_email='$kullanici'");
$say_uye = mysqli_num_rows($sorgu);

if ( strtolower($kod) != strtolower($dkod)  ) {
    echo "<img src='img/hata.svg' width='48' height='48'><br>";
    echo "Doğrulama Kodu Hatalı";
} elseif (  $say_uye == 0 ) {
    echo "<img src='img/hata.svg' width='48' height='48'><br>";
    echo "Böyle bir üye bulunamadı.";
}

    ?>
    <script language="javascript">window.location="mail.php";
     </script>

    <?php
?>