<!Doctype html>
<html lang="en" class="no-js">
<?php
session_start();
include('includes/baglan.php');
if (strlen($_SESSION['oturum']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['kaydet'])) {
		$arac_model = $conn->real_escape_string($_POST['arac_model']);
		$arac_model_yili = $_POST['arac_model_yili'];
		$arac_resim = @$_FILES["resim"]["name"];
		$arac_yakit = $_POST['arac_yakit'];
		$arac_kira_ucreti = $_POST['arac_kira_ucreti'];
		
		$marka = $conn->real_escape_string($_POST['marka_adi']);
		move_uploaded_file(@$_FILES["resim"]["tmp_name"], "../resimler/arabalar/" . @$_FILES["resim"]["name"]);

		$marka_id_sorgu = mysqli_query($conn,"SELECT marka_id from markalar where marka_adi='$marka'");
		$arac_sorgu= mysqli_query($conn,"INSERT INTO araclar(arac_model,arac_model_yili,arac_resim,arac_yakit,arac_kira_ucreti,arac_durum,marka_id) VALUES('{$arac_model}','{$arac_model_yili}','{$arac_resim}','{$arac_yakit}','{$arac_kira_ucreti}',0,'{$marka}')");

		$lastInsertId = mysqli_query($conn,"SELECT LAST_INSERT_ID() FROM araclar");
		if ($lastInsertId) {
			$msg = "Araba başarıyla eklendi.";
		} else {
			$error = "Bir şeyler ters gitti.Lütfen tekrar deneyin.";
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
							<h2 class="page-title">Araç Ekle</h2>
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Bilgi</div>
										<?php if (@$error) { ?><div class="errorWrap"><strong>HATA</strong>:<?php echo(@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>BAŞARILI</strong>:<?php echo(@$msg); ?> </div><?php } ?>
										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-sm-2 control-label">Araba Modeli<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="arac_model" class="form-control" maxlength="50" required>
													</div>
													<label class="col-sm-2 control-label">Marka Seç<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="marka_adi" required>
															<option value=""> </option>
															<?php 
															$marka_sorgu = mysqli_query($conn,"select marka_id,marka_adi from markalar");
															if ($marka_sorgu->num_rows > 0) {
																foreach ($marka_sorgu as $sonuc) {
															?>
																	<option value="<?php echo($sonuc['marka_id']); ?>"><?php echo(str_replace('_', ' ', $sonuc['marka_adi'])); ?></option>
															<?php }
															} ?>
														</select>
													</div>
												</div>
												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Araç Kira Ücreti<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="arac_kira_ucreti" class="form-control myInput" maxlength="11" required>
													</div>
													<label class="col-sm-2 control-label">Araç Yakıt Türü<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select class="selectpicker" name="arac_yakit" required>
															<option value=""> </option>
															<option value="Benzin">Benzin</option>
															<option value="Dizel">Dizel</option>
															<option value="Elektrikli">Elektrikli</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Araç Model Yılı<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="arac_model_yili" class="form-control myInput" required>
													</div>
												</div>
												<div class="hr-dashed"></div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Resim Seç<span style="color:red">*</span></label>
													<div class="col-sm-1">
														<span style="color:red"></span><input type="file" name="resim" accept="image/*" required>
													</div>
												</div>

												<div class="hr-dashed"></div>
												<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">İptal Et</button>
													<button class="btn btn-primary" name="kaydet" type="submit">Kaydet</button>
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
		<script>
			$(document).ready(function() {
				$('.myInput').on('keydown keyup', function(event) {
					var input = $(this);
					var value = input.val();

					value = value.replace(/[^0-9\.]/g, '');

					var decimalCount = (value.match(/\./g) || []).length;
					if (decimalCount > 1) {
						value = value.replace(/\.+$/, '');
					}

					input.val(value);
				});
			})
		</script>
	</body>
	</html>
<?php } ?>