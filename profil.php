<!DOCTYPE html>
<html lang="en">
<?php
@session_start();
include("ses_kontrol.php");
include('baglan.php');
$sorgu = mysqli_query($conn,"select * from site_bilgileri");
$site_bilgileri = mysqli_fetch_array($sorgu);
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
                        <a href="iletisim.php" class="nav-item nav-link">İletişim</a>
                    </div>
                </div>
                <?php 
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
                ?>
              </form>
            </nav>
        </div>
    </div>
    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3"> Üye Profil Sayfası </h1>
        <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a class="text-white" href="index.php">Anasayfa</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Üye Profil Sayfası</h6>
        </div>
    </div>
    
	<div class="ts-main-content">
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Rezervasyonlar</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-body">
								<?php if (@$error) { ?><div class="errorWrap"><strong>HATA</strong>:<?php echo (@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>BAŞARILI</strong>:<?php echo (@$msg); ?> </div><?php } ?>
								<table id="rezervasyon_tablo" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Kiralayan</th>
											<th>Araç Modeli</th>
											<th>Kira Başlangıç Tarihi</th>
											<th>Kira Bitiş Tarihi</th>
											<th>Fiyat</th>
										</tr>
									</thead>
									<tbody>

										<?php 
										$rezervasyon_kontrol_sorgu=mysqli_query($conn,"select kiralama.kira_id,musteriler.musteri_ad, musteriler.musteri_soyad, markalar.marka_adi, araclar.arac_model, kiralama.kira_basla, kiralama.kira_bitir,kiralama.fiyat from kiralama join musteriler on musteriler.musteri_id=kiralama.musteri_id join araclar on araclar.arac_id=kiralama.arac_id join markalar on markalar.marka_id=araclar.marka_id where kiralama.musteri_id='{$oturum_sahibi}'");
										$say = 1;
										if ($rezervasyon_kontrol_sorgu->num_rows > 0) {
											foreach ($rezervasyon_kontrol_sorgu as $sonuc) {				
										?>
												<tr>
													<td><?php echo ($say); ?></td>
													<td><?php echo ($sonuc['musteri_ad']);?> <?php echo ($sonuc['musteri_soyad']);?></td>
													<td><?php echo (str_replace('_',' ',$sonuc['marka_adi']));?> <?php echo ($sonuc['arac_model']); ?></td>
													<td><?php echo ($sonuc['kira_basla']); ?></td>
													<td><?php echo ($sonuc['kira_bitir']); ?></td>
													<td><?php echo ($sonuc['fiyat']); ?></td>
												</tr>
										<?php $say = $say + 1;
											}
										} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<!-- <script src="js/jquery.min.js"></script> -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
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