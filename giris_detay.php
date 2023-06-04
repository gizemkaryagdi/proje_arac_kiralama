<!DOCTYPE html>
<html lang="en">
<?php
@session_start();
if ( isset($_SESSION["musteri_id"]) ) {
    echo "<script language='javascript'>window.location='profil.php'</script>";
} 
include('baglan.php');
$sorgu = mysqli_query($conn,"select * from site_bilgileri");
$site_bilgileri = mysqli_fetch_array($sorgu);
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
                        <a href="iletisim.php" class="nav-item nav-link">İLETİŞİM</a>
                    </div>
                </div>
                <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                <a href="giris_detay.php"><img src='img/giris.svg' width='28'></a>
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </nav>
        </div>
    </div>
  <!-- Navbar End -->
<div class="container-fluid py-5">
    <div class="container pt-5 pb-3"> 
      <h1 class="display-4 text-uppercase text-center mb-5">
      <?php echo $site_bilgileri['site_adi'];  ?> ÜYE GİRİŞİ
      </h1>
        <div class="row justify-content-center">
            <p class="col-lg-10 text-center">
               <form action='giris_isle.php' method='post' id='giris_form'>
                <table align='center'>
                    <tr>
                        <td><label for='site_email'>E-posta:<label></td>
                        <td><input type='email' name='site_email' required></td>
                    </tr>
                    <tr>
                        <td><label for='site_sifre'>Şifre:<label></td>
                        <td><input type='password' name='site_sifre' required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align='left'><img src="img.php" height="25" width="150" /></td>
                    </tr>
                    <tr>
                        <td><label for='kod'>Doğrulama Kodu:<label></td>
                        <td><input type='text' name='dogrulama' minlength='6' required></td>
                    </tr>
<tr>
  <td align='left'><input type="button" value="Kayıt Ol" onclick="window.location.href = 'giris_kayit.php'"></td>
  <td align='right'><input type="button" value="Şifremi Unuttum" onclick="window.location.href = 'sifre_hatirlat.php'">
    <input type="submit" value="Giriş Yap"></td>
</tr>
            </table>
</form>
            </p>
        </div>
    </div>
</div>
</p>
    </div>
    <div align='center' id="giris_sonuc">
       <h5></h5>
    </div>
  </section>


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

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="row pt-1">
            <div class="col-lg-1 col-md-1 mb-1">
                <h4 class="text-uppercase text-light mb-4"></h4>
            </div>
    <!--Galeri-->
    <?php
            echo"<div class='col-lg-19 col-md-1 mb-10'>";
                echo"<h4 class='text-uppercase text-light mb-4'></h4>";
                echo"<div class='row mx-n1'>";                   
                echo"</div>";
            echo"</div>";
        echo"</div>";
    echo"</div>";
    ?>
    <!--Galeri-->
    <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
    </div>
    <!-- Footer End -->
</body>
</html>