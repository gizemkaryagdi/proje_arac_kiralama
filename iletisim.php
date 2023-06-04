<!DOCTYPE html>
<html lang="en">
<?php
@session_start();
include('baglan.php');
$sorgu = mysqli_query($conn,"select * from site_bilgileri");
$site_bilgileri = mysqli_fetch_array($sorgu);

if (isset($_POST['kaydet'])){
    $iletisim_ad=$_POST['isim'];
    $iletisim_email=$_POST['email'];
    $iletisim_konu=$_POST['konu'];
    $iletisim_mesaj=$_POST['mesaj'];
    $iletisim_sorgu=mysqli_query($conn,"insert into iletisim(iletisim_ad,iletisim_email,iletisim_konu,iletisim_mesaj) values('{$iletisim_ad}','{$iletisim_email}','{$iletisim_konu}','{$iletisim_mesaj}')");
    echo "<script>alert('Mesajınız başarıyla iletildi.')</script>";
}
?>

<head>
<link rel="stylesheet" href="style.css"></link>
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
</head> 

<body>
  <!-- Navbar Start -->
   <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-6" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="index.php" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1">RentGo</h1>
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
                        <a href="iletisim.php" class="nav-item nav-link active">İletişim</a>
                    </div>
                </div>
                <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
              <?php
               if ( !isset($_SESSION["musteri_id"]) ) {
                echo"<a href='giris_detay.php'><img src='img/giris.svg' width='28'></a>";
            } else {
                echo"<div class='navbar-nav ml-auto py-0'>";
                    $sorgu = mysqli_query($conn,"Select * from musteriler where musteri_id='{$_SESSION['musteri_id']}'");
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
            </nav>
        </div>
    </div>
  <!-- Navbar End -->
  <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Bize Ulaşın</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Anasayfa</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Bize Ulaşın</h6>
        </div>
    </div>
    <!-- Page Header Start -->
   <!-- Contact Start -->
   <div class="container-fluid py-2">
        <div class="container pt-9 pb-6">
            <h1 style="text-align:center;">İletişim</h1>
            <span style="font-size:17px;">Gerekli alanları doldurup gönderiniz en kısa zamanda sizinle iletişime geçeceğiz.</span>
            <div class="row">
                <div class="col-lg-7 mb-2">
                    <div class="contact-form bg-light mb-4" style="padding: 30px;">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6 form-group">
                                    <input name="isim" type="text" class="form-control p-4" placeholder="İsim" required="required">
                                </div>
                                <div class="col-6 form-group">
                                    <input name="email" type="email" class="form-control p-4" placeholder="Email" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="konu" type="text" class="form-control p-4" placeholder="Konu" required="required">
                            </div>
                            <div class="form-group">
                                <textarea name="mesaj" class="form-control py-3 px-4" rows="5" placeholder="Mesaj" required="required"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary py-3 px-5" name="kaydet" type="submit">Mesaj Gönder</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 mb-2">
                    <div class="bg-secondary d-flex flex-column justify-content-center px-5 mb-4" style="height: 435px;">
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">1.Şube</h5>
                                <p>Odunpazarı, Eskişehir, Türkiye</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-map-marker-alt text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">2.Şube</h5>
                                <p>Lüleburgaz, Kırklareli, Türkiye</p>
                            </div>
                        </div>
                        <div class="d-flex mb-3">
                            <i class="fa fa-2x fa-envelope-open text-primary flex-shrink-0 mr-3"></i>
                            <div class="mt-n1">
                                <h5 class="text-light">Müşteri Hizmetleri</h5>
                                <p>rentacar_musteri@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <!-- Footer Start -->
    <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="d-flex flex-column justify-content-start">
            <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1jd6SFbX5YmbFEXI7quDV3gqojp3wtGc&ehbc=2E312F" width="100%" height="380"></iframe>
        </div>
    </div>
    <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
        <p class="m-0 text-center text-body"><a href="rapor.pdf ">Proje Raporu</a></p>		
		<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->					
        <p class="m-0 text-center text-body"><a href="https://htmlcodex.com/demo/?item=1585 ">Şablon Orijinal Versiyonu</a></p>
    </div>
    <!-- Footer End -->


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
    </body>
</html>