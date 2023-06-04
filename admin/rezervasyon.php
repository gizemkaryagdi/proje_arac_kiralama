<!Doctype html>
<html lang="en" class="no-js">
<?php
session_start();
include('includes/baglan.php');
if (strlen($_SESSION['oturum']) == 0) {
	header('location:index.php');
}
if (isset($_GET['kiralama_id'])) {
	$kiralama_id = $_GET['kiralama_id'];
	$rezerve_sorgu = mysqli_query($conn,"delete from kiralama WHERE kira_id='{$kiralama_id}'");
	if ($rezerve_sorgu) {
		$msg = "Rezervasyon iptal edildi.";
	} else {
		$msg = "Lütfen tekrar deneyiniz.";
	}
}

?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<title>RENTGO YÖNETİM PANELİ </title>
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
	<?php include('includes/baslik.php'); ?>

	<div class="ts-main-content">
		<?php include('includes/menu.php'); ?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Rezervasyonlar</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Bilgi</div>
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
											<th>İşlem</th>
										</tr>
									</thead>
									<tbody>

										<?php 
										$rezervasyon_kontrol_sorgu=mysqli_query($conn,"select kiralama.kira_id,musteriler.musteri_ad, musteriler.musteri_soyad, markalar.marka_adi, araclar.arac_model, kiralama.kira_basla, kiralama.kira_bitir,kiralama.fiyat from kiralama join musteriler on musteriler.musteri_id=kiralama.musteri_id join araclar on araclar.arac_id=kiralama.arac_id join markalar on markalar.marka_id=araclar.marka_id");
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
													<td>
														<a href="rezervasyon.php?kiralama_id=<?php echo (@$sonuc['kira_id']); ?>" onclick="return confirm('Rezervasyonu iptal etmek istiyor musunuz?')">İptal Et</a>
													</td>
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

</html>