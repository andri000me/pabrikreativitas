<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" type="image/ico" href="../../admin/assets/images/icon/favicon.ico" />
	<link href="../../assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">
	<link href="../../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="../../assets/user_admin/js/alertify.min.js"></script>
</head>
<body>
	<?php
		session_start();
		include '../../database/koneksi.php';
		if (isset($_POST['favorit'])) {
			$idDesain=$_POST['idDesain'];
			$favorit=mysql_query("UPDATE tb_desain SET favorit=favorit+1 WHERE id_desain='$idDesain'");
			if ($favorit) {
				echo "<script>window.history.go(-1);</script>";
			}
		}

		if (isset($_GET['id'],$_GET['q'],$_GET['i'],$_GET['t'])) {
			$qty=$_GET['q'];
			$idUser=$_GET['id'];
			$item=$_GET['i'];
			$total=$_GET['t'];

			$qKeranjang=mysql_query("SELECT id_keranjang FROM tb_keranjang WHERE id_user='$idUser'");
			$keranjang=mysql_fetch_array($qKeranjang);
			$idKeranjang=$keranjang['id_keranjang'];

			//cari item sama
			$qItem=mysql_query("SELECT id_keranjang FROM tb_detail_keranjang WHERE id_item='$item' AND id_keranjang='$idKeranjang'");
			$rItem=mysql_num_rows($qItem);
			if ($rItem<1) {
				$insertKeranjang=mysql_query("INSERT INTO tb_detail_keranjang (id_keranjang, id_item, qty, total) VALUES ('$idKeranjang','$item','$qty','$total')");
				if ($insertKeranjang) {
					?>
			            <script type="text/javascript">
							window.location.assign('../../user/keranjang');
						</script>
			        <?php
				}else{
					?>
			            <script type="text/javascript">
							alertify.alert("Gagal", function(){window.history.go(-1)}).setHeader(' ').set({closable:false,transition:'fade'});
						</script>
			        <?php
				}
			}else{
				$updateKeranjang=mysql_query("UPDATE tb_detail_keranjang SET qty=qty+'$qty', total=total+'$total' WHERE id_item='$item' AND id_keranjang='$idKeranjang'");
				if ($updateKeranjang) {
					?>
			            <script type="text/javascript">
							window.location.assign('../../user/keranjang');
						</script>
			        <?php
				}else{
					?>
			            <script type="text/javascript">
							alertify.alert("Gagal", function(){window.history.go(-1)}).setHeader(' ').set({closable:false,transition:'fade'});
						</script>
			        <?php
				}
			}

		}
	?>
</body>
</html>