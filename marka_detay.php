<!DOCTYPE html>
<html lang="en">
<?php
include('baglan.php');
$marka_adi = $_GET['marka'];
$sorgu = mysqli_query($conn,"select * from markalar WHERE marka_adi REGEXP '$marka_adi'");
$markaid = mysqli_fetch_array($sorgu);
$sorgu = mysqli_query($conn,"select * from markalar WHERE marka_adi REGEXP '$marka_adi'");
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
    <!-- Page Header Start -->
<?php
     echo"<div class='container-fluid page-header'>";
     $sorgu3 = mysqli_query($conn,"select * from markalar where marka_adi='$marka_adi'");                   
     $say3 = mysqli_num_rows($sorgu3);
     $satir3 = mysqli_fetch_array($sorgu3); 
     $dogru_marka_adi = str_replace('_', ' ', $satir3['marka_adi']);
         echo"<h1 class='display-3 text-uppercase text-primary mb-3'>".$dogru_marka_adi."</h1>";
         echo"<div class='d-inline-flex text-white'>";
             echo"<h6 class='text-uppercase m-0'><a class='text-white' href='index.php'>Anasayfa</a></h6>";
             echo"<h6 class='text-body m-0 px-3'>/</h6>";
             echo"<h6 class='text-uppercase m-0'><a class='text-white' href='marka.php'>Markalar</a></h6>";
         echo"</div>";
     echo"</div>";
 echo"</div>"; 
?>
<!-- Page Header End -->
<?php
if ( $say > 0 ) {
   while ( $satir = mysqli_fetch_array($sorgu)) {
   echo "<div class='container-fluid py-5'>";
       echo "<div class='container pt-10 pb-15'>";           
           echo "<div 'class='row'>";
               echo "<div class='col-lg-15 col-md-15 mb-15'>";
               $sorgu1 = mysqli_query($conn,"select * from markalar where marka_adi='$marka_adi'");                   
               $say1 = mysqli_num_rows($sorgu1);
               $satir1 = mysqli_fetch_array($sorgu1);                   
               echo"<center><img class='mb-5' src='resimler/markalar/".$satir1['marka_resim']."' width=190' height='190'></center>";
            echo "</div>";
            echo "<div class='col-lg-15 col-md-15 mb-15'>";
            $sorgu2 = mysqli_query($conn,"select * from markalar where marka_adi='$marka_adi'");                   
            $say2 = mysqli_num_rows($sorgu2);
            $satir2 = mysqli_fetch_array($sorgu2);                   
            echo  "<div align:'center'>".$satir2['marka_hakkinda']."</div>";
       echo "</div>";
   echo "</div>";  
}
}
?>
<?php
    $sorgu = mysqli_query($conn,"select * from araclar where marka_id=$markaid[0]");
    $say = mysqli_num_rows($sorgu);
    if ( $say > 0 ) {
        while ( $satir = mysqli_fetch_array($sorgu)) {
        echo "<div class='container-fluid py-5'>";
            echo "<div class='container pt-10 pb-15'>";           
                echo "<div 'class='row'>";
                    echo "<div class='col-lg-15 col-md-15 mb-15'>";
                        echo "<div class='rent-item mb-4'>";  
                            echo "<img src='resimler/arabalar/".$satir['arac_resim']."' width=350' height='200'>";                                                   
                                    echo "<h4 class='text-uppercase mb-4'>".$satir['arac_model']."</h4>"; 
                            echo "<div class='d-flex justify-content-center mb-4'>";
                                echo "<div class='px-2'>";
                                    echo "<i class='fa fa-car text-primary mr-1'></i>";
                                    echo "<span>".$satir['arac_model_yili']."</span>";
                                echo "</div>";
                                echo "<div class='px-2 border-left border-right'>";
                                    echo "<i class='fa fa-cogs text-primary mr-1'></i>";
                                    echo "<span>".$satir['arac_yakit']."</span>";
                                echo "</div>";
                            echo"</div>";
                            echo"<p class='btn btn-primary px-3' href=".$satir['arac_kira_ucreti'].">".$satir['arac_kira_ucreti']."</p>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";           
         //<!-- Rent A Car End --> 
    }
    }
    ?>

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