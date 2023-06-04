<!Doctype html>
<html lang="en" class="no-js">
<?php
session_start();
include('includes/baglan.php');
if (strlen($_SESSION['oturum']) == 0) {
	header('location:index.php');
} else {
	if (isset($_POST['kaydet'])) {
		$marka_resim = @$_FILES["resim"]["name"];
		$marka_adi = $_POST['marka_adi'];
		$marka_hakkinda= $_POST['marka_hakkinda'];
		
		move_uploaded_file(@$_FILES['resim']['tmp_name'], "../resimler/markalar/" . @$_FILES['resim']['name']);

		$marka_ekle= mysqli_query($conn,"INSERT INTO  markalar(marka_adi,marka_hakkinda,marka_resim) VALUES('$marka_adi','$marka_hakkinda','$marka_resim')");
		$lastInsertId = mysqli_query($conn,"SELECT LAST_INSERT_ID() FROM markalar");

		if ($lastInsertId) {
			$msg = "Marka Başarıyla Oluşturuldu.";
		} else {
			$error = "Bir şeyler ters gitti lütfen tekrar deneyin.";
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

							<h2 class="page-title">Marka Oluştur</h2>

							<div class="row">
								<div class="col-md-10">
									<div class="panel panel-default">
										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<?php if (@$error) { ?><div class="errorWrap"><strong>HATA</strong>:<?php echo (@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>BAŞARILI</strong>:<?php echo (@$msg); ?> </div><?php } ?>
												<div class="form-group">
													<label class="col-sm-4 control-label">Marka Adı</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="marka_adi" id="marka_adi" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-4 control-label">Marka Hakkında</label>
													<div class="col-sm-8">
														<input type="text" class="form-control" name="marka_hakkinda" id="marka_hakkinda" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-4 control-label">Resim Seç<span style="color:red">*</span></label>
													<div class="col-sm-1">
														<span style="color:red"></span><input type="file" name="resim" accept="image/*" required>
													</div>
												</div>

												<div class="hr-dashed"></div>

												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-4">
														<button class="btn btn-primary" name="kaydet" type="submit">Kaydet</button>
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