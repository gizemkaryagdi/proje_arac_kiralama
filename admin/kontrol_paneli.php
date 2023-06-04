<!Doctype html>
<html lang="en" class="no-js">
<?php
session_start();
include('includes/baglan.php');

if (strlen($_SESSION['oturum']) == 0) {
	header('location:index.php');
}
?>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>RENTGO YÖNETİM PANELİ</title>
		<link rel="shortcut icon" href="../assets/images/favicon-icon/favicon.png">
		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<?php include('includes/baslik.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/menu.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-title">Kontrol Paneli</h2>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-primary text-light">
													<div class="stat-panel text-center">
														<?php
														$musteri = mysqli_query($conn,"SELECT COUNT(*) as sum FROM musteriler");
														$musteri_say = mysqli_fetch_array($musteri);														
														?>
														<div class="stat-panel-number h1 "><?php echo ($musteri_say['sum']); ?></div>
														<div class="stat-panel-title text-uppercase">MÜŞTERİLER</div>
													</div>
												</div>
												<a href="musteriler.php" class="block-anchor panel-footer text-center">Detaylar<i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-success text-light">
													<div class="stat-panel text-center">
														<?php
														$arac = mysqli_query($conn,"SELECT COUNT(*) as sum FROM araclar");
														$arac_say = mysqli_fetch_array($arac);
														?>
														<div class="stat-panel-number h1 "><?php echo($arac_say['sum']); ?></div>
														<div class="stat-panel-title text-uppercase">ARAÇLAR</div>
													</div>
												</div>
												<a href="arac_yonet.php" class="block-anchor panel-footer text-center">Detaylar<i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-info text-light">
													<div class="stat-panel text-center">
														<?php
														$kira= mysqli_query($conn,"SELECT COUNT(*) as sum FROM kiralama");
														$kira_say = mysqli_fetch_array($kira);
														?>
														<div class="stat-panel-number h1 "><?php echo($kira_say['sum']); ?></div>
														<div class="stat-panel-title text-uppercase">REZERVASYONLAR</div>
													</div>
												</div>
												<a href="rezervasyon.php" class="block-anchor panel-footer text-center">Detaylar<i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-warning text-light">
													<div class="stat-panel text-center">
														<?php
														$marka= mysqli_query($conn,"SELECT COUNT(*) as sum FROM markalar");
														$marka_say = mysqli_fetch_array($marka);
														?>
														<div class="stat-panel-number h1 "><?php echo ($marka_say['sum']); ?></div>
														<div class="stat-panel-title text-uppercase">MARKALAR</div>
													</div>
												</div>
												<a href="marka_yonet.php" class="block-anchor panel-footer text-center">Detaylar<i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/main.js"></script>
    </body>
</html>