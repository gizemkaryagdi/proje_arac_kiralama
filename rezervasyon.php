<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("ses_kontrol.php");
include('baglan.php');
$arac_id = $_GET['arac_id'];
$sorgu = mysqli_query($conn,"select * from site_bilgileri");
$site_bilgileri = mysqli_fetch_array($sorgu);
$sorgu2 = mysqli_query($conn,"select * from araclar join markalar on markalar.marka_id=araclar.marka_id where arac_id='{$arac_id}'");
$sorgu2_getir = mysqli_fetch_array($sorgu2);

if (isset($_POST['kaydet'])){
    $basla_tarih= date_create($_POST['basla_tarih']);
    $bitis_tarih= date_create($_POST['bitis_tarih']);
    $islem=date_diff($bitis_tarih,$basla_tarih);
    $gun = intval($islem->format('%d'));
    $hesapla=($sorgu2_getir['arac_kira_ucreti']) * $gun;
    $sorgu3=mysqli_query($conn,"insert into kiralama(kira_basla,kira_bitir,arac_id,musteri_id,fiyat) values('{$_POST['basla_tarih']}','{$_POST['bitis_tarih']}','{$arac_id}','{$_SESSION['musteri_id']}','{$hesapla}')");
    $sorgu4=mysqli_query($conn,"update araclar set arac_durum=1 where arac_id={$arac_id}");
    echo "<script>alert('Rezervasyon başarıyla tamamlandı.')</script>";
    echo "<script language='javascript'>window.location='profil.php';</script>";
}
?>

<html>

<head>
    <link rel="stylesheet" href="css/style.css"></link>
    <meta charset="utf-8">
    <title>RentGo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <title><?php echo $site_silgileri['site_adi'];  ?></title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
	</style>

    <script type="text/javascript">

    function hesapla() {
        var baslangic = new Date(document.getElementById("basla_tarih").value);
        var bitis = new Date(document.getElementById("bitis_tarih").value);
        var sonuc = (bitis - baslangic)/(1000*60*60*24);
        var kira= "<?php Print($sorgu2_getir['arac_kira_ucreti']); ?>";
        var islem=kira*sonuc;
        document.getElementById("fiyattest").innerHTML = islem + "₺";
    }
    </script>
</head>

<body>

<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-6" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1"><?php echo $site_bilgileri['site_adi']; ?></h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="hakkimizda.php" class="nav-item nav-link">Hakkımızda</a>                        
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Araç</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="arac.php" class="dropdown-item">Araçlar</a>
                                <a href="marka.php" class="dropdown-item">Markalar</a>
                            </div>
                        </div>
                        <a href="iletisim.php" class="nav-item nav-link">İletişim</a>
                    </div>
                </div>
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
              <?php
               if ( !isset($_SESSION["musteri_id"]) ) {
                echo"<a href='giris_detay.php'><img src='img/giris.svg' width='28'></a>";
            } else {
                echo"<div class='navbar-nav ml-auto py-0'>";
                    $sorgu = mysqli_query($conn,"Select * from musteriler where musteri_id='$oturum_sahibi'");
                    $satir = mysqli_fetch_array($sorgu);
                    echo "<div class='nav-item dropdown'>";
                    echo "<a href='profil.php' class='nav-link dropdown-toggle' data-toggle='dropdown' >".$satir['musteri_ad']." ".$satir['musteri_soyad']."</a>";
                   
                        echo "<div class='dropdown-menu rounded-0 m-0'>";
                            echo"<a href='cikis.php' class='dropdown-item'>Çıkış Yap</a>";
                    echo"</div>";
                    echo"</div> ";   
                  echo"</div>";
              }  
              ?>
              </form>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Rezervasyon</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Anasayfa</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Rezervasyon</h6>
        </div>
    </div>
    <!-- Page Header Start -->

    <!-- Detail Start -->
    
    <div class="container-fluid pt-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase mb-5"><?php echo (str_replace('_',' ',$sorgu2_getir['marka_adi']));?> <?php echo $sorgu2_getir['arac_model']?></h1>
            <div class="row align-items-center pb-2">
                <div class="col-lg-6 mb-4">
                    <img class="img-fluid" src="resimler/arabalar/<?php echo($sorgu2_getir['arac_resim']);?>">
                </div>
                <div class="col-lg-6 mb-4">
                    <h4 class="mb-2"><?php echo $sorgu2_getir['arac_kira_ucreti']."₺";?></h4>
                    <p><?php echo $sorgu2_getir['marka_hakkinda'];?></p>                
                </div>
            </div>
            <div class="row mt-n3 mt-lg-0 pb-4">
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-car text-primary mr-2"></i>
                    <span>MODEL: <?php echo $sorgu2_getir['arac_model_yili'];?></span>
                </div>
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-cogs text-primary mr-2"></i>
                    <span>YAKIT TÜRÜ: <?php echo $sorgu2_getir['arac_yakit'];?></span>
                </div>             
            </div>
        </div>
    </div>
    <!-- Detail End -->

    
     <!-- Car Booking Start -->
     <div class="container-fluid pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-4">Rezervasyon Bilgileri</h2>
                    <form name="rezervasyon" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="mb-5">
                        <div class="row">
                            <div class="col-6 form-group">
                                <div class="date" id="date1" data-target-input="nearest">
                                    <input name="basla_tarih" id="basla_tarih" type="datetime" class="form-control p-4 datetimepicker" placeholder="Başlangıç Tarihi"
                                        data-target="#date1" data-toggle="datetimepicker" />
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="date" id="date2" data-target-input="nearest">
                                    <input name="bitis_tarih" id="bitis_tarih" type="datetime" class="form-control p-4 datetimepicker" onblur="hesapla()" placeholder="Bitiş Tarihi"
                                        data-target="#date2" data-toggle="datetimepicker" />
                                </div>
                            </div>
                        </div>
                        <p>    </p>
                        <div id="kredi_kart" class="row">
                            <div class="col-6 form-group">
                                <input name="kart_sahibi" type="text" class="form-control p-4" placeholder="Kart Sahibi"required>
                            </div>
                            <div class="col-1 form-group">
                                
                            </div>
                            <div class="col-2 form-group">
                                <input name="aa" type="text" class="form-control p-4 myInput" placeholder="aa" maxlength='2'required>
                            </div>
                            <p style="font-size:1.8vw">/</p>
                            <div class="col-2 form-group">
                                <input name="yy" type="text" class="form-control p-4 myInput" placeholder="yy" maxlength='2'required>
                            </div>
                            <div class="col-6 form-group">
                                <input name="kart_no" type="text" class="form-control p-4 myInput" placeholder="Kart Numarası" maxlength='16'required>
                            </div>
                            <div class="col-2 form-group">
                       
                            </div>
                            <div class="col-2 form-group">
                                <input name="cvc" type="text" class="form-control p-4 myInput" placeholder="CVC" maxlength='3'required>
                            </div>
                        
                        </div>

                    </div>

        
                </div>
                <div class="col-lg-4">
                    <div class="bg-secondary p-5 mb-5">
                        <h2 class="text-primary mb-4">Toplam Tutar</h2>
                        <div class="form-group">
                            <label id="fiyattest"style="font-size:2vw" class="text-light mb-4"><?php echo (@$sorgu2_getir['arac_kira_ucreti'])."₺";?></label>
                        </div>
                        <button class="btn btn-block btn-primary py-3" name="kaydet" type="submit">Ödeme Yapın</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Car Booking End -->

<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script>
    $(document).ready(function() {
        $('.myInput').on('keydown keyup', function(event) {
            var input = $(this);
            var value = input.val();

            value = value.replace(/[^0-9\.]/g, '');

            var decimalCount = (value.match(/\./g) || []).length;
            if (decimalCount > 1) {
                value = value.replace(/\.+$/, '');
            }

            input.val(value);
        });
    })
</script>
    <!--Galeri-->
    <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
        <p class="m-0 text-center text-body"><a href="rapor.pdf ">Proje Raporu</a></p>		
        <p class="m-0 text-center text-body"><a href="https://htmlcodex.com/demo/?item=1585 ">Şablon Orijinal Versiyonu</a></p>
    </div>
    <!-- Footer End -->
</body>
</html>