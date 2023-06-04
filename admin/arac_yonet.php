<!Doctype html>
<html lang="en" class="no-js">
<?php
session_start();
include('includes/baglan.php');
if (strlen($_SESSION['oturum']) == 0) {
	header('location:index.php');
} else {

	if (isset($_REQUEST['sil'])) {

		$arac_id_sil = $_GET['sil'];
		$arac_sil_sorgu= mysqli_query($conn,"delete from araclar WHERE arac_id='{$arac_id_sil}'");
		$msg = "Araç başarıyla silindi.";
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

							<h2 class="page-title">ARAÇLAR</h2>

							<div class="panel panel-default">
								<div class="panel-heading">LİSTE</div>
								<div class="panel-body">
									<?php if (@$error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo(@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo(@$msg); ?> </div><?php } ?>
									<table id="arac_tbl" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Araç Markası</th>
												<th>Araç Modeli</th>
												<th>Araç Model Yılı </th>
												<th>Araç Resim</th>
												<th>Araç Yakıt Türü</th>
												<th>Araç Kira Ücreti</th>
												<th>Araç Durumu</th>
												<th>İşlemler</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$arac_sorgu = mysqli_query($conn,"SELECT markalar.marka_adi,araclar.arac_model,araclar.arac_model_yili,araclar.arac_resim,araclar.arac_yakit,araclar.arac_kira_ucreti,araclar.arac_durum,araclar.arac_id from araclar join markalar on markalar.marka_id=araclar.marka_id");
											$say = 1;
											if ($arac_sorgu->num_rows > 0) {
												foreach ($arac_sorgu as $sonuc) {?>
													<tr>

														<td><?php echo ($say); ?></td>
														<td><?php echo (str_replace('_', ' ',$sonuc['marka_adi'])); ?></td>
														<td><?php echo ($sonuc['arac_model']); ?></td>
														<td><?php echo ($sonuc['arac_model_yili']); ?></td>
														<td><?php echo "<img width='100' height='50' src='../resimler/arabalar/".$sonuc['arac_resim']."'>"; ?></td>
														<td><?php echo ($sonuc['arac_yakit']); ?></td>
														<td><?php echo ($sonuc['arac_kira_ucreti']); ?></td>
														<td><?php echo ($sonuc['arac_durum']); ?></td>
														<td><a href="arac_duzenle.php?id=<?php echo $sonuc['arac_id']; ?>"><i class="fa fa-edit"></i></a>;
															<a href="arac_yonet.php?sil=<?php echo $sonuc['arac_id']; ?>" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-close"></i></a>
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
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>