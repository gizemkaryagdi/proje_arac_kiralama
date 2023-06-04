<?php
@session_start();
if ( !isset($_SESSION["musteri_id"]) ) {
    echo "<p align='center'><img src='img/hata.svg' width='48' height='48'><br>";
    echo "Bu sayfayı görüntüleme izniniz yok. </p>";
    die();
} else {
  $oturum_sahibi =  $_SESSION["musteri_id"];
}
?>

