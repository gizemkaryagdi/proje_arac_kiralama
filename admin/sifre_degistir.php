<!Doctype html>
<html lang="en" class="no-js">
	
<?php
session_start();
include('includes/baglan.php');
$admin_sorgu = mysqli_query($conn,"SELECT * FROM admin WHERE admin_kullanici='{$_SESSION['oturum']}'");

if (strlen($_SESSION['oturum']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['kaydet'])) {
		$admin_email = $_POST['admin_email'];
		$admin_sifre = md5(sha1(md5(($_POST['admin_sifre']))));
		$admin_yeni_sifre = md5(sha1(md5(($_POST['admin_yeni_sifre']))));
		$admin_kullanici = $_SESSION['oturum'];
		$admin_sifre_sorgu = mysqli_query($conn,"SELECT admin_sifre FROM admin WHERE admin_kullanici='{$admin_kullanici}' and admin_sifre='{$admin_sifre}'");
		if ($admin_sifre_sorgu->num_rows > 0) {
			$admin_sifre_guncelle = mysqli_query($conn,"update admin set admin_email='{$admin_email}',admin_sifre='{$admin_yeni_sifre}' where admin_kullanici='{$admin_kullanici}'");
			$msg = "Şifre başarıyla değiştirildi.";
		} else {
			$error = "Mevcut şifre geçerli değil.";
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
		<script type="text/javascript">

			function valid() {
				if (document.sifre_degistir.admin_yeni_sifre.value != document.sifre_degistir.admin_sifre_kontrol.value) {
					alert("Şifreler eşleşmiyor!");
					document.sifre_degistir.admin_sifre_kontrol.focus();
					return false;
				}
				return true;
			}
		</script>
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

							<h2 class="page-title">Şifre Değiştir</h2>

							<div class="row">
								<div class="col-md-10">
									<div class="panel panel-default">
										<div class="panel-heading">Form</div>
										<div class="panel-body">
											<form method="post" name="sifre_degistir" class="form-horizontal" onSubmit="return valid();">
												<?php if (@$error) { ?><div class="errorWrap"><strong>HATA</strong>:<?php echo(@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>BAŞARILI</strong>:<?php echo(@$msg); ?> </div><?php } ?>

												<div class="form-group">
													<label class="col-sm-4 control-label">Kullanıcı E-mail</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="admin_email" id="email" value="<?= mysqli_fetch_array($admin_sorgu)['admin_email'] ?>" required>
													</div>
												</div>				
												
												<div class="form-group">
													<label class="col-sm-4 control-label">Mevcut Şifre</label>
													<div class="col-sm-8">
														<input type="password" class="form-control" name="admin_sifre" id="password" required>
													</div>
												</div>
												<div class="hr-dashed"></div>

												<div class="form-group">
													<label class="col-sm-4 control-label">Yeni Şifre</label>
													<div class="col-sm-8">
														<input type="password" class="form-control" name="admin_yeni_sifre" id="newpassword" required>
													</div>
												</div>
												<div class="hr-dashed"></div>

												<div class="form-group">
													<label class="col-sm-4 control-label">Yeni Şifre Tekrar</label>
													<div class="col-sm-8">
														<input type="password" class="form-control" name="admin_sifre_kontrol" id="confirmpassword" required>
													</div>
												</div>
												<div class="hr-dashed"></div>



												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-4">

														<button class="btn btn-primary" name="kaydet" type="submit">KAYDET</button>
													</div>
												</div>

											</form>

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
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>

	</body>

	</html>
<?php } ?>