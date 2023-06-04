<?php
@session_start();
session_destroy();
echo "<script language='javascript'>window.location.href='giris_detay.php'</script>";
?>

