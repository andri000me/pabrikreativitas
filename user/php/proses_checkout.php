<!DOCTYPE html>
<html>
<head>
	<title>Pasen</title>
	<link rel="icon" type="image/ico" href="../../admin/assets/images/icon/favicon.ico" />
	<link href="../../assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">
	<link href="../../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="../../assets/user_admin/js/alertify.min.js"></script>
</head>
<body>
	<?php
		session_start();
		ob_start();
		include '../../database/koneksi.php';

		if (isset($_POST['bayarTransaksi'])) {
			$noInvoice=$_POST['noInvoice'];
			$iv=md5($noInvoice);
			$kurir=$_POST['kurir'];
			$bank=$_POST['bank'];
			$ongkir=$_POST['ongkir'];
			$update=mysql_query("UPDATE tb_transaksi SET `kurir`='$kurir', `ongkir`='$ongkir', `id_bank`='$bank', `status`='1' WHERE no_invoice='$noInvoice'");
			if ($update) { ?>
				<script type="text/javascript">
					window.location.assign('../payment_checkout?iv=<?=$iv;?>');
				</script>
			<?php
			}else{ ?>
				<script type="text/javascript">
					window.location.assign('../checkout?iv=<?=$iv;?>');
				</script>
			<?php
			}
		}

		if (isset($_POST['batalTransaksi'])) {
			$noInvoice=$_POST['noInvoice'];
			$iv=md5($noInvoice);
			$delete=mysql_query("DELETE FROM tb_transaksi WHERE md5(no_invoice)='$iv'");
			if ($delete) { ?>
				<script type="text/javascript">
					window.location.assign('../../home');
				</script>
			<?php
			}else{ ?>
				<script type="text/javascript">
					window.location.assign('../checkout?iv=<?=$iv;?>');
				</script>
			<?php
			}
		}

		if (isset($_POST['uploadTransaksi'])) {
			$noInvoice=$_POST['noInvoice'];
			$iv=md5($noInvoice);
			$tgl_pembayaran=date("Y-m-d");
			$format_file = array("jpg", "png", "jpeg", "bmp");
		    $max_file_size = 1024*1000; //maksimal 1mb
		    $path = "../../admin/assets/images/payment/";
		    $namaFile=$_FILES['buktiPembayaran']['name'];
			
		        $ekstensi=explode('.', $namaFile);
		        $size=$_FILES['buktiPembayaran']['size'];
		        $namaBaru=str_replace('/', '-', $noInvoice).".".$ekstensi[1];
			    
		            if ($size < $max_file_size || $size!=0) {
		                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
		                    if(move_uploaded_file($_FILES["buktiPembayaran"]["tmp_name"], $path.$namaBaru)){
		                        $update=mysql_query("UPDATE tb_transaksi SET `bukti_transfer`='$namaBaru', `tgl_pembayaran`='$tgl_pembayaran', `status`='2' WHERE no_invoice='$noInvoice'");
		                        if ($update) {
		                            echo "<script>window.location.assign('../list_transaksi');</script>";
		                        }else{
		                            echo "<script>window.location.assign('payment_checkout?iv='".$iv.");</script>";
		                        }
		                   }else{
		                    ?>
		                        <script type="text/javascript">
		                            alertify.alert("Gagal Upload Bukti Pembayaran", function(){ }).setHeader(' ').set({closable:false,transition:'pulse'});
		                        </script>
		                    <?php  
		                   }                
		                }else{
		                    ?>
		                    <script type="text/javascript">
		                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('payment_checkout?iv=<?=$iv;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php  
		                }
		            }else{
		                ?>
		                    <script type="text/javascript">
		                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('payment_checkout?iv=<?=$iv;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php    
		            }
		        
		}
	?>
</body>
</html>