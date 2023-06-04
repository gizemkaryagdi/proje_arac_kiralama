<!Doctype html>
<html lang="en" class="no-js">
<?php
session_start();

include('includes/baglan.php');
if (isset($_POST['kaydet'])) {
    $admin_email=$_POST['admin_email'];
    $dogrulama_kod=$_SESSION["dogrulamakodu"];
    $kullanici_kod=$_POST["dogrulama"];
    $admin_sorgu=mysqli_query($conn,"select admin_email from admin");
    $admin_sorgu_getir=mysqli_fetch_array($admin_sorgu);
    if ($dogrulama_kod != $kullanici_kod){
        $error="Doğrulama kodu hatalı";
    } 
    else if ($admin_email!=$admin_sorgu_getir['admin_email']){
        $error="E-mail hatalı";       
    } else{
        $_SESSION['admin_email']=$admin_email;
        header('location:mail.php');
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

    <div class="login-page bk-img" style="background-image: url(img/adminlogin.jpg);">
        <div class="form-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <h1 class="text-center text-bold text-light mt-4x">Şifremi Unuttum?</h1>

                        <div class="well row pt-2x pb-3x bk-light">
                            <div class="col-md-8 col-md-offset-2">
                                <form method='post' id='giris_form'>
                                    <?php if (@$error) { ?><div class="errorWrap"><strong>HATA</strong>:<?php echo (@$error); ?> </div><?php } else if (@$msg) { ?><div class="succWrap"><strong>BAŞARILI</strong>:<?php echo (@$msg); ?> </div><?php } ?>
                                    <div>
                                        <label for="" class="control mb">E-mail</label>
                                        <input type="email" name="admin_email" class="form-control mb" required>
                                    </div>

                                    <div>
                                        <label for="" class="control mb">Doğrulama Kodu</label>
                                        <td align='right'><img src="img.php" height="37" width="180" /></td>
                                        <input type="text" name="dogrulama" class="form-control mb" required>          
                                    </div>

                                    <button class="btn btn-primary btn-block" name="kaydet" type="submit">Kaydet</button>

                                    <div style="margin-top: 25px">
                                        <a href="index.php">Şifremi Hatırladım</a>
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