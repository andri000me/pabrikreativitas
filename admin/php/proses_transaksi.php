<!DOCTYPE html>
<html>
<head>
	<title>proses</title>
	<link rel="icon" type="image/ico" href="../../admin/assets/images/icon/favicon.ico" />
	<link href="../../assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">
	<link href="../../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="../../assets/user_admin/js/alertify.min.js"></script>
</head>
<body>
	<?php
		include '../../database/koneksi.php';
		if (isset($_POST['konfirmasi'])) {
			$noInvoice=$_POST['noInvoice'];
			$status='3';

			if (substr($noInvoice,0,2)=='IN') {
				$ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'");
			}else{
				$ubahStatus=mysql_query("UPDATE tb_transaksi_visit SET status='$status' WHERE no_tiket='$noInvoice'");
			}
			

			if ($ubahStatus) {
				echo "<script>window.history.go(-2);</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Ubah Status", function(){ window.location.assign('../detail_transaksi?iv=<?=$noInvoice;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}			
		}

		if (isset($_POST['batal'])) {
			$noInvoice=$_POST['noInvoice'];
			$status='4';
			$code=substr($noInvoice,4,1);
			echo $code;

			switch ($code) {
                case 'D':
                    $ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'");                             
                    break;
                case 'C':
                    $ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'");                             
                    break;
                case 'J':
                    $ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'");                             
                    break;
                default:
                    $ubahStatus=mysql_query("UPDATE tb_transaksi_visit SET status='$status' WHERE no_tiket='$noInvoice'");                
                    break;
            }

			if ($ubahStatus) {
				echo "<script>window.history.go(-2);</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Ubah Status", function(){ window.location.assign('../detail_transaksi?iv=<?=$noInvoice;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}		
		}

		if (isset($_POST['kirim'])) {
			$noInvoice=$_POST['noInvoice'];
			$status='5';
			$noResi=$_POST['noResi'];
			$ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status', no_resi='$noResi' WHERE no_invoice='$noInvoice'");

			if ($ubahStatus) {
				echo "<script>window.history.go(-2);</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Ubah Status", function(){ window.location.assign('../detail_transaksi?iv=<?=$noInvoice;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}			
		}

		if (isset($_POST['proses'])) {
			$noInvoice=$_POST['noInvoice'];
			$status='7';
			$ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'");

			if ($ubahStatus) {
				echo "<script>window.location.assign('../my_transaksi;?>');</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Ubah Status", function(){ window.location.assign('../transaksi_detail?iv=<?=$noInvoice;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}
		}
	?>
</body>
</html>