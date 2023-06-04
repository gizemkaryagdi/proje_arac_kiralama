<!Doctype html>
<html lang="en" class="no-js">
<?php
session_start();
include('includes/baglan.php');
if (isset($_POST['giris'])) {
	$admin_kullanici = $_POST['admin_kullanici'];
	$admin_sifre = md5(sha1(md5(($_POST['admin_sifre']))));
	$giris_sorgu = mysqli_query($conn,"SELECT admin_kullanici,admin_sifre FROM admin WHERE admin_kullanici='{$admin_kullanici}' and admin_sifre='{$admin_sifre}'");
	if ($giris_sorgu->num_rows > 0) {
		$_SESSION['oturum'] = $_POST['admin_kullanici'];
		echo "<script type='text/javascript'> document.location = 'kontrol_paneli.php'; </script>";
	} else {
		echo "<script>alert('Girilen bilgiler uyuşmuyor');</script>";
	}
}

?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>RENTGO YÖNETİM PANELİ</title>
	<link rel="shortcut icon" href="../assets/images/favicon-icon/favicon.png">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="login-page bk-img" style="background-image: url(img/adminlogin.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">Giriş Yap</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">

									<label for="" class="text-uppercase text-sm">Kullanıcı Adı </label>
									<input type="text" placeholder="Kullanıcı Adı" name="admin_kullanici" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Şifre</label>
									<input type="password" placeholder="Şifre" name="admin_sifre" class="form-control mb">


									<button class="btn btn-primary btn-block" name="giris" type="submit">Giriş Yap</button>

									<div style="margin-top: 25px">
										<a href="sifre_hatirlat.php">Şifremi Unuttum?</a>
									</div>
								</form>
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