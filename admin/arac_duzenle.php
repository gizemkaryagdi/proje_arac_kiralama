<!Doctype html>
<html lang="en" class="no-js">
<?php
session_start();
include('includes/baglan.php');
if (strlen($_SESSION['oturum']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['kaydet'])) {
		$arac_model = $_POST['arac_model'];
		$arac_model_yili = $_POST['arac_model_yili'];
		$arac_resim = @$_FILES["arac_resim"]["name"];
		move_uploaded_file(@$_FILES["arac_resim"]["tmp_name"], "../resimler/arabalar/" . @$_FILES["arac_resim"]["name"]);
		$arac_yakit = $_POST['arac_yakit'];
		$arac_kira_ucreti = $_POST['arac_kira_ucreti'];
		$arac_id = $_GET['id'];

		if ($arac_resim != null) {
			$arac_guncelle = mysqli_query($conn,"update araclar set arac_model='{$arac_model}',arac_model_yili='{$arac_model_yili}',arac_resim='{$arac_resim}',arac_yakit='{$arac_yakit}',arac_kira_ucreti='{$arac_kira_ucreti}' where arac_id='{$arac_id}'");
		} else {
			$arac_guncelle = mysqli_query($conn,"update araclar set arac_model='{$arac_model}',arac_model_yili='{$arac_model_yili}',arac_yakit='{$arac_yakit}',arac_kira_ucreti='{$arac_kira_ucreti}' where arac_id='{$arac_id}'");
		}
		$lastInsertId = mysqli_query($conn,"SELECT LAST_INSERT_ID() from araclar");
		$msg = "Araç başarıyla düzenlendi.";

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

							<h2 class="page-title">Araç Düzenle</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Detaylar</div>
										<div class="panel-body">
										<?php if (@$error) { ?><div class="errorWrap"><strong>HATA</strong>:<?php echo(@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>BAŞARILI</strong>:<?php echo(@$msg); ?> </div><?php } ?>
											<?php
											$id = $_GET['id'];
											$araclar_sorgu = mysqli_query($conn,"SELECT araclar.*,markalar.marka_adi,markalar.marka_id from araclar join markalar on markalar.marka_id=araclar.marka_id where araclar.arac_id='{$id}'");
											$sonuc=mysqli_fetch_array($araclar_sorgu);
												?>
													<form method="post" class="form-horizontal" enctype="multipart/form-data">
														<div class="form-group">
															<label class="col-sm-2 control-label">Araç Modeli<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="arac_model" class="form-control" value="<?php echo ($sonuc['arac_model']) ?>">
															</div>
															<label class="col-sm-2 control-label">Marka Seç<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<select class="selectpicker" name="marka_adi">
																	<option value="<?php echo ($sonuc['marka_id']); ?>"><?php echo ($marka_adi2 = str_replace('_', ' ', $sonuc['marka_adi'])); ?> </option>
																	<?php $markalar_sorgu= mysqli_query($conn,"select marka_id,marka_adi from markalar");
																	if ($markalar_sorgu->num_rows > 0) {
																		foreach ($markalar_sorgu as $sonuc2) {
																			if ($sonuc2['marka_adi'] == $marka_adi2) {
																				continue;
																			} else {
																	?>
																				<option value="<?php echo ($sonuc2['marka_id']); ?>"><?php echo str_replace('_', ' ', $sonuc2['marka_adi']); ?></option>
																	<?php }
																		}
																	} ?>
																</select>
															</div>
														</div>

														<div class="hr-dashed"></div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Araç Kiralama Ücreti<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="arac_kira_ucreti" class="form-control" value="<?php echo ($sonuc['arac_kira_ucreti']); ?>">
															</div>
															<label class="col-sm-2 control-label">Araç Yakıt Türü<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<select class="selectpicker" name="arac_yakit">
																	<option value="<?php echo ($sonuc['arac_yakit']); ?>"> <?php echo ($sonuc['arac_yakit']); ?> </option>																	
																	<option value="Benzin">Benzin</option>
																	<option value="Dizel">Dizel</option>
																	<option value="Elektrikli">Elektrikli</option>
																</select>
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-2 control-label">Araç Model Yılı<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="arac_model_yili" class="form-control" value="<?php echo ($sonuc['arac_model_yili']); ?>">
															</div>															
														</div>

														<div class="form-group">
															<div class="col-sm-2 control-label">
																<b>Araç Fotoğrafı</b>
																
															</div>
															<div class="col-sm-1">
																	<span style="color:red"></span><input type="file" name="arac_resim" accept="image/*" value="<?php echo($sonuc['arac_resim']);?>">
															</div>
														</div>

														<div class="form-group">
															<div class="col-sm-6 control-label">
																<img src="../resimler/arabalar/<?php echo ($sonuc['arac_resim']); ?>" width="300" height="200" style="border:solid 1px #000">
															</div>
														</div>
														<div class="hr-dashed"></div>
														
														<div class="form-group">
																<div class="col-sm-8 col-sm-offset-2">
																	<button class="btn btn-primary" name="kaydet" type="submit" style="margin-top:4%">Değişiklikleri Kaydet</button>
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
	</body>

	</html>
<?php } ?>