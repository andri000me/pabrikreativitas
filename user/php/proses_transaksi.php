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
		session_start();
		ob_start();
		if (isset($_POST['updateResi'])) {
			$noInvoice=$_POST['noInvoice'];
			$status='5';
			$noResi=$_POST['noResi'];
			$mdIv=md5($noInvoice);
			$ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status', no_resi='$noResi' WHERE no_invoice='$noInvoice'");

			if ($ubahStatus) {
				echo "<script>window.history.go(-2);</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Ubah Status", function(){ window.location.assign('../transaksi_detail?iv=<?=$mdIv;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}			
		}

		if (isset($_POST['proses'])) {
			$noInvoice=$_POST['noInvoice'];
			$status='7';
			$ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'");

			if ($ubahStatus) {
				echo "<script>window.history.go(-2);</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Ubah Status", function(){ window.location.assign('../transaksi_detail?iv=<?=$noInvoice;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}
		}

		if (isset($_POST['selesai'])) {
			$keuntungan=mysql_fetch_array(mysql_query("SELECT keuntungan FROM tb_settings"));
        	$persen=$keuntungan['keuntungan'];
			$noInvoice=$_POST['noInvoice'];
			$status='6';
        	$row='B';
        	$biaya=$persen;
			$ket='1';
			$transaksi=$noInvoice;
        	$code=substr($noInvoice,4,1);
        	$tgl_transaksi=date("Y-m-d");
			switch ($code) {
				case 'D':
					$data=mysql_query("SELECT pemilik, sub_total FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain WHERE tb_transaksi.no_invoice='$noInvoice'");
					$dataTransaksi=mysql_fetch_array($data);
					$nominal=$dataTransaksi['sub_total'];					
					$pemilik=$dataTransaksi['pemilik'];
					$cek=substr($pemilik,0,3);
					if ($cek!='ADM') {
						$qwallet=mysql_fetch_array(mysql_query("SELECT id_wallet FROM tb_wallet WHERE id_user='$pemilik'"));
						$idWallet=$qwallet['id_wallet'];						
						$admin=$nominal*$persen;
						$hasil=$nominal-$admin;
						$wallet=mysql_query("INSERT INTO `tb_detail_wallet` (`id_wallet`, `tgl_transaksi`, `nominal`, `biaya`, `ket`, `transaksi`, `status`) VALUES ('$idWallet', '$tgl_transaksi', '$hasil', '$biaya', '$ket', '$transaksi', '1');") or die(mysql_error());
					}else{
						break;
					}
					$ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'") or die(mysql_error());
					break;
				case 'J':
					$data=mysql_query("SELECT tb_jobs.id_user, sub_total FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs WHERE tb_transaksi.no_invoice='$noInvoice'" )or die(mysql_error());
					$dataTransaksi=mysql_fetch_array($data);
					$nominal=$dataTransaksi['sub_total'];
					$pemilik=$dataTransaksi['id_user'];
					$qwallet=mysql_fetch_array(mysql_query("SELECT id_wallet FROM tb_wallet WHERE id_user='$pemilik'"));
					$idWallet=$qwallet['id_wallet'];						
					$admin=$nominal*$persen;
					$hasil=$nominal-$admin;
					$wallet=mysql_query("INSERT INTO `tb_detail_wallet` (`id_wallet`, `tgl_transaksi`, `nominal`, `biaya`, `ket`, `transaksi`, `status`) VALUES ('$idWallet', '$tgl_transaksi', '$hasil', '$biaya', '$ket', '$transaksi', '1');") or die(mysql_error());
					$ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'") or die(mysql_error());
					break;
				case 'C':
					$data=mysql_query("SELECT sub_total FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_cetak ON tb_detail_transaksi.id_item=tb_cetak.id_cetak WHERE tb_transaksi.no_invoice='$noInvoice'" )or die(mysql_error());
					$dataTransaksi=mysql_fetch_array($data);
					$nominal=$dataTransaksi['sub_total'];
					$ubahStatus=mysql_query("UPDATE tb_transaksi SET status='$status' WHERE no_invoice='$noInvoice'") or die(mysql_error());
					break;
				default:
					$data=mysql_query("SELECT biaya FROM tb_transaksi_visit JOIN tb_visit ON tb_transaksi_visit.id_visit=tb_visit.id_visit WHERE no_tiket='$noInvoice'" )or die(mysql_error());
					$dataTransaksi=mysql_fetch_array($data);
					$nominal=$dataTransaksi['biaya'];					
					$ubahStatus=mysql_query("UPDATE tb_transaksi_visit SET status='$status' WHERE no_tiket='$noInvoice'") or die(mysql_error());
					break;
			}


			

			$catat=mysql_query("INSERT INTO `tb_buku_besar` (`id`, `tgl_transaksi`, `nominal`, `biaya`, `ket`, `transaksi`, `status`) VALUES ('$row', '$tgl_transaksi', '$nominal', '$biaya', '$ket', '$transaksi', '1');") or die(mysql_error());
			if ($ubahStatus&&$catat) {
				echo "<script>window.history.go(-2);</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Ubah Status", function(){ window.location.assign('../list_transaksi'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}
		}
	?>
</body>
</html>