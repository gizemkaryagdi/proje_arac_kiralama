<!Doctype html>
<html lang="en" class="no-js"><?php
session_start();
include('includes/baglan.php');
if (strlen($_SESSION['oturum']) == 0) {
	header('location:index.php');
} else {
	if (isset($_GET['sil'])) {
		$id = @$_GET['sil'];
		$marka_sil = mysqli_query($conn,"delete from markalar WHERE marka_id='{$id}'");
		$msg = "Marka başarıyla silindi.";
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

							<h2 class="page-title">Markaları Yönet</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Markalar</div>
								<div class="panel-body">
									<?php if (@$error) { ?><div class="errorWrap"><strong>HATA</strong>:<?php echo(@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>BAŞARILI</strong>:<?php echo(@$msg); ?> </div><?php } ?>
									<table id="mrka" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Marka Adı</th>
												<th>Marka Hakkında</th>
												<th>Marka Resim</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$marka_sorgu = mysqli_query($conn,"SELECT * from markalar");
											$marka_getir= mysqli_fetch_array($marka_sorgu);
											$say = 1;
											if ($marka_sorgu->num_rows > 0) {
												foreach ($marka_sorgu as $sonuc) {	
													?>
													<tr>
														<td><?php echo ($say); ?></td>
														<td><?php echo str_replace('_', ' ',$sonuc['marka_adi']); ?></td>
														<td><?php echo ($sonuc['marka_hakkinda']); ?></td>
														<td><?php echo "<img width='50' height='50' src='../resimler/markalar/".$sonuc['marka_resim']."'>"; ?></td>
														<td><a href="marka_duzenle.php?id=<?php echo @$sonuc['marka_id']; ?>"><i class="fa fa-edit"></i></a>;
															<a href="marka_yonet.php?sil=<?php echo @$sonuc['marka_id']; ?>" onclick="return confirm('Silmek istediğinize emin misiniz?');"><i class="fa fa-close"></i></a>
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