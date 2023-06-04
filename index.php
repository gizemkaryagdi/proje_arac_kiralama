<!DOCTYPE html>
<html lang="en">
<?php
session_start();

include('baglan.php');
$sorgu = mysqli_query($conn,"select * from site_bilgileri");
$site_bilgileri = mysqli_fetch_array($sorgu);
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
</head>  
<body>

    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-6" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="#" class="navbar-brand">
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
                    $sorgu = mysqli_query($conn,"Select * from musteriler where musteri_id='{$_SESSION['musteri_id']}'");
                    $satir = mysqli_fetch_array($sorgu);
                    echo "<div class='nav-item dropdown'>";
                    echo "<a href='profil.php' onclick='window.location.href='profil.php';' class='nav-link dropdown-toggle' data-toggle='dropdown' >".$satir['musteri_ad']." ".$satir['musteri_soyad']."</a>";
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

    <!-- Carousel Start -->
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 100000px;">
                            <h2 class="text-white text-uppercase mb-md-3">
                            <?php echo $site_bilgileri['site_kisa_bilgi'];  ?> 
                            </h2>
                            <a href="arac.php" class="btn btn-primary py-md-3 px-md-5 mt-2">Araçları İnceleyin</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <h2 class="text-white text-uppercase mb-md-3">
                            <?php echo $site_bilgileri['site_slogan'];  ?> 
                            </h2>
                            <a href="marka.php" class="btn btn-primary py-md-3 px-md-5 mt-2">Markaları Keşfedin</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    <!-- Carousel End -->

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

    <!-- Footer Start -->

    <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">İletişim</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i> <?php echo $site_bilgileri['site_adres'];  ?></p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i> <?php echo $site_bilgileri['site_tel']; ?></p>
                <p><i class="fa fa-envelope text-primary mr-3"></i><?php echo $site_bilgileri['site_email']; ?></p>
            </div>
            
            
<!--Galeri-->
    <?php
            echo"<div class='col-lg-19 col-md-1 mb-10'>";
                echo"<h4 class='text-uppercase text-light mb-4'>Galeri</h4>";
                echo"<div class='row mx-n1'>";
                    echo"<div class='a'>";
                        $sorgu1 = mysqli_query($conn,"select * from site_bilgileri where site_id=1");                   
                        $say1 = mysqli_num_rows($sorgu1);
                        $satir1 = mysqli_fetch_array($sorgu1);                   
                         echo "<g align='center'><img width='200' height='140' src='resimler/galeri/".$satir1['site_resim']."'></g>";
                    echo"</div>";
                    echo"<div class='c'>";
                        $sorgu3 = mysqli_query($conn,"select * from site_bilgileri where site_id=3");                   
                        $say3 = mysqli_num_rows($sorgu3);
                        $satir3 = mysqli_fetch_array($sorgu3);                   
                         echo "<g align='center'><img width='200' height='140' src='resimler/galeri/".$satir3['site_resim']."'></g>";
                    echo"</div>";
                    echo"<div class='d'>";
                        $sorgu4 = mysqli_query($conn,"select * from site_bilgileri where site_id=4");                   
                        $say4 = mysqli_num_rows($sorgu4);
                        $satir4 = mysqli_fetch_array($sorgu4);                   
                         echo "<g align='center'><img width='200' height='140' src='resimler/galeri/".$satir4['site_resim']."'></g>";
                    echo"</div>";
                    echo"<div class='e'>";
                        $sorgu5 = mysqli_query($conn,"select * from site_bilgileri where site_id=5");                   
                        $say5 = mysqli_num_rows($sorgu5);
                        $satir5 = mysqli_fetch_array($sorgu5);                   
                         echo "<g align='center'><img width='200' height='140' src='resimler/galeri/".$satir5['site_resim']."'></g>";
                    echo"</div>";
                    echo"<div class='g'>";
                    $sorgu7 = mysqli_query($conn,"select * from site_bilgileri where site_id=7");                   
                    $say7 = mysqli_num_rows($sorgu7);
                    $satir7 = mysqli_fetch_array($sorgu7);                   
                    echo "<g ><img width='200' height='140' src='resimler/galeri/".$satir7['site_resim']."'></g>";
                    echo"</div>";
                    echo"<div class='h'>";
                        $sorgu8 = mysqli_query($conn,"select * from site_bilgileri where site_id=8");                   
                        $say8 = mysqli_num_rows($sorgu8);
                        $satir8 = mysqli_fetch_array($sorgu8);                   
                        echo "<g ><img width='200' height='140' src='resimler/galeri/".$satir8['site_resim']."'></g>";
                    echo"</div>";
                echo"</div>";
            echo"</div>";
        echo"</div>";
    echo"</div>";
    ?>
    <!--Galeri-->
    <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
        <p class="m-0 text-center text-body"><a href="rapor.pdf ">Proje Raporu</a></p>		
		<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->					
        <p class="m-0 text-center text-body"><a href="https://htmlcodex.com/demo/?item=1585 ">Şablon Orijinal Versiyonu</a></p>
    </div>
    <!-- Footer End -->

</body>
    
</html>
