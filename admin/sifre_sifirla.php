<!Doctype html>
<html lang="en" class="no-js">

<?php
session_start();
include('includes/baglan.php');

$token_sorgu = mysqli_query($conn,"select admin_token from admin");
$token_getir=mysqli_fetch_array($token_sorgu);
if ($_GET["id"] != $token_getir['admin_token']) {
	header("location: hata.php");
} 
if (isset($_POST['kaydet'])) {
	$sifre = md5(sha1(md5(($_POST['sifre']))));
	$tekrar_sifre = $_POST['sifre_tekrar'];
	$dkod=$_SESSION['dogrulamakodu'];
	$kod=$_POST['kod'];
	if ( strtolower($kod) != strtolower($dkod)) {
		$error="Doğrulama kodu hatalı.";
	} 
	else {
		mysqli_query($conn,"update admin set admin_sifre='{$sifre}', admin_token=NULL where admin_token='{$token_getir['admin_token']}'");
		$msg = "Şifre başarıyla değiştirildi.";
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
	<script type="text/javascript">

			function sifre_kontrol() {
				if (document.sifre_sifirla.sifre.value != document.sifre_sifirla.sifre_tekrar.value) {
					alert("Şifreler eşleşmiyor!");
					document.sifre_sifirla.sifre_tekrar.focus();
					return false;
				}
				return true;
			}
		</script>
</head>

<body>

	<div class="login-page bk-img" style="background-image: url(img/adminlogin.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">Şifreyi Değiştir</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form name="sifre_sifirla" method="post" onSubmit="return sifre_kontrol();">
								<?php if (@$error) { ?><div class="errorWrap"><strong>HATA</strong>:<?php echo (@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>BAŞARILI</strong>:<?php echo (@$msg); ?> </div><?php } ?>
								
									<label for="" class="text-uppercase text-sm">Yeni Şifre</label>
									<input type="password" maxlength="30" name="sifre" class="form-control mb" required>

									<label for="" class="text-uppercase text-sm">Tekrar Şifre</label>
									<input type="password" maxlength="30" name="sifre_tekrar" class="form-control mb" required>

									<tr>
										<td><label for="kod">Doğrulama Kodu :</label>	</td>
										<td><input type='text' name='kod' required  minlength="6" maxlength="6"> </td>
									</tr>

									<tr>
									<td></td>
									<td align='right'><img src="img.php" height="25" width="150" />	</td>
									</tr>
									<button class="btn btn-primary btn-block" name="kaydet" type="submit">Kaydet</button>
									<a href="index.php" class="btn btn-primary btn-block" name="giris_yap" type="text">Giriş Yap</a>
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