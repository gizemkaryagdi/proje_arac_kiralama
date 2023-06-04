<!DOCTYPE html>
<html lang="en">
<?php
@session_start();
include('baglan.php');
$sorgu = mysqli_query($conn,"select * from araclar where arac_durum=0");
$say = mysqli_num_rows($sorgu);
?>
<html>

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
                            <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Araç</a>
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
                    $sorgu1 = mysqli_query($conn,"Select * from musteriler where musteri_id='{$_SESSION['musteri_id']}'");
                    $satir1 = mysqli_fetch_array($sorgu1);
                    echo "<div class='nav-item dropdown'>";
                    echo "<a href='profil.php' class='nav-link dropdown-toggle' data-toggle='dropdown' >".$satir1['musteri_ad']." ".$satir1['musteri_soyad']."</a>";
                   
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
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Araçlar</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Anasayfa</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Araçlar</h6>
        </div>
    </div>
    <div class="nav-item dropdown">
        <div class="dropdown-menu rounded-0 m-0">
            <a href="arac_listele.php" class="dropdown-item">Araç Listele</a>
            <a href="arac.php" class="dropdown-item">Araçlar</a>
            <a href="marka.php" class="dropdown-item">Markalar</a>
        </div>
    </div>
    
<!-- sorgu baslangic -->

    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="row">
<?php
function alert($message) { echo "<script>alert('$message')</script>"; }
if ( $say > 0 ) {
    while ( $satir = mysqli_fetch_array($sorgu)) {
        ?>
        <div class="col-lg-4 col-md-6 mb-2" style="flex: 0 0 33.333%;display: flex;" >
            <div class="rent-item mb-4" style="flex: 0 0 100%;">
                <img class="img-fluid mb-4" style="object-fit: contain; height: 250px; align-items: center; justify-content: center;" src="resimler/arabalar/<?php echo "".$satir['arac_resim'].""; ?>" alt="">
                <h4 class="text-uppercase mb-4"><?php $marka_adi = str_replace('_', ' ', implode(($conn->query("select marka_adi from markalar where marka_id = (".$satir['marka_id'].")")->fetch_row()))); echo "".$marka_adi." ".$satir['arac_model'].""; ?></h4>
                <div class="d-flex justify-content-center mb-4">
                    <div class="px-2">
                        <i class="fa fa-car text-primary mr-1"></i>
                        <span><?php echo "".$satir['arac_model_yili'].""; ?></span>
                    </div>
                    <div class="px-2 border-left border-right">
                        <i class="fa fa-cogs text-primary mr-1"></i>
                        <span><?php echo "".$satir['arac_yakit'].""; ?></span>
                    </div>
                
                    </div>
                <a href= "rezervasyon.php?arac_id=<?php echo @$satir['arac_id']?>" class="btn btn-primary px-3" ><?php echo "Günlük ".$satir['arac_kira_ucreti']."₺"; ?></a>
            </div>
        </div>
        <?php
    }}
?>
</div>
</div>
</div>

<!-- sorgu bitis -->

<?php
    echo "<div class='container-fluid py-5'>";
    echo "<div class='container pt-5 pb-3'>";           
    echo "<div 'class='row'>";
    
    if ( $say > 0 ) {
        while ( $satir = mysqli_fetch_array($sorgu)) {
        echo "<div class='col-lg-4 col-md-6 mb-2'>";
                    echo "<div class='rent-item mb-4'>";  
                        echo "<img class='img-fluid mb-4' src='resimler/arabalar/".$satir['arac_resim']."' width=350' height='200'>";                                                   
                                echo "<h4 class='text-uppercase mb-4'>".$satir['arac_model']."</h4>"; 
                        echo "<div class='d-flex justify-content-center mb-4'>";
                            echo "<div class='px-2'>";
                                echo "<i class='fa fa-car text-primary mr-1'></i>";
                                echo "<span>".$satir['arac_model_yili']."</span>";
                            echo "</div>";
                            echo "<div class='px-2 border-left'>";
                                echo "<i class='fa fa-cogs text-primary mr-1'></i>";
                                echo "<span>".$satir['arac_yakit']."</span>";
                            echo "</div>";
                        echo "</div>";
                        echo"<p class='btn btn-primary px-3' href=''>".$satir['arac_kira_ucreti']."</p>";
                    echo "</div>";
                    echo "</div>";
                }
            echo "</div>";           
            echo "</div>";
            echo "</div>"; 
}
?>
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