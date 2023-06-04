<?php
session_start();
/* Olusturulan kodu diger sayfalara tasiyabilmemiz icin oturum baslatiyoruz.
0-999 araliginda bir sayi olusturup bunu md5 ile sifreliyoruz.
*/
$md5yap=md5(rand(0,9999));

//md5 ile sifrelenen sayimizin uzunlugu 32 karakter olacaktir. Biz 6 karakterli alacagiz.
$dogrulamakodu = strtoupper(substr($md5yap, 8, 6));

//Dogrulama icin kullanicak kodumuzu acilan oturuma kaydediyoruz.
$_SESSION["dogrulamakodu"] = $dogrulamakodu;

//Resim boyutlari belirleniyor
$en = 400;
$boy = 100;
header("Content-Type: image/png");
//Uzerinde calisacagimiz resim olusturuluyor.
$image = ImageCreate($en, $boy);

//Beyaz,Siyah ve Kirmizi renkler olusturuyoruz. Rakamlar renkleri ifade etmektedir.
$beyaz = ImageColorAllocate($image, 255, 255, 255);
$siyah = ImageColorAllocate($image, 0, 0, 0);
$kirmizi = ImageColorAllocate($image, 242, 0, 0);

// Yazý fontu belirliyoruz
//$font = "Font1.ttf";   // php 5.6
$font = __DIR__.'/css/Font1.ttf'; // php 7

//Arka plani beyaz yapiyoruz
ImageFill($image, 0, 0, $beyaz);

//Olusturulan dogrulama kodunu resime yaziyoruz.
ImageTtftext($image, 80, 0, 25, 90, $siyah, $font ,$dogrulamakodu);


//Gorunumu biraz karistirmak icin cizgilerle gorunumu zorlastiriyoruz.
//Dilerseniz imageline() satirlarini kaldirarak cizgileri yok edebilirsiniz.
imageline($image, 0, 2, $en, 2, $kirmizi);
imageline($image, 0, 125, $boy, 0, $kirmizi);
imageline($image, $en, $boy, 40, 0, $kirmizi);
imageline($image, 0, 23, $en, 23, $kirmizi);



//Resmimizi Jpg formatinda basiyoruz.
ImagePng($image);

//Bir kereye mahsus kullanacagimiz icin siliyoruz.
ImageDestroy($image);
exit();

?>