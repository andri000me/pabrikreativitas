<!DOCTYPE html>
<html>
<head>
	<title>Desain</title>
	<link rel="icon" type="image/ico" href="../../admin/assets/images/icon/favicon.ico" />
	<link href="../../assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">
	<link href="../../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="../../assets/user_admin/js/alertify.min.js"></script>
</head>
<body>
	<?php
		session_start();
		include '../../database/koneksi.php';
		if (isset($_POST['beli'])) {
			$catatan=$_POST['keterangan'];
			$qty=$_POST['qty'];
			$total=str_replace('.', '', $_POST['total']);
			$item=$_POST['idItem'];
			$format=$_POST['format'];
			$idUser=$_SESSION['idUser'];
			$tgl_transaksi=date("Y-m-d");
			$date=date("dmY");
			$urut=mysql_num_rows(mysql_query("SELECT no_invoice FROM tb_transaksi WHERE SUBSTR(no_invoice,5,1)='C'"))+1;
			$noInvoice="INV-C/".$date."/".date("Y")."/".$urut;
			$format_file = array("jpg", "png", "jpeg", "bmp", "psd", "cdr");
		    $max_file_size = 1024*8000; //maksimal 1mb
		    $path = "../../admin/assets/file/"; // Lokasi folder untuk menampung file

			foreach ($_FILES['desain']['name'] as $i => $namaFile) {
		        $j=$i+1;
		        $ekstensi=explode('.', $namaFile);
		        $size=$_FILES['desain']['size'][$i];
		        $namaBaru=str_replace('/', '-', $noInvoice).".".$ekstensi[1];
			    
		            if ($size < $max_file_size || $size!=0) {
		                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
		                    if(move_uploaded_file($_FILES["desain"]["tmp_name"][$i], $path.$namaBaru)){

		                    	$masukTransaksi=mysql_query("INSERT INTO `tb_transaksi` (`no_invoice`, `id_user`, `tgl_transaksi`, `sub_total`, `bukti_transfer`, `tgl_pembayaran`, `kurir`, `ongkir`,`id_bank`, `no_resi`, `status`, `keterangan`) VALUES ('$noInvoice', '$idUser', '$tgl_transaksi', '$total', '', '', '', '', '', '', '0', '')") or die(mysql_error());

		                    	$masukItem=mysql_query("INSERT INTO `tb_detail_transaksi` (`no_invoice`, `id_item`, `qty`, `catatan`, `file`, `format`) VALUES ('$noInvoice', '$item', '$qty', '$catatan', '$namaBaru', '$format')") or die(mysql_error());
		                        
		                        if ($masukTransaksi&&$masukItem) {
									$mdInvoice=md5($noInvoice);
									echo "<script>window.location.assign('../checkout?iv=".$mdInvoice."')</script>";
								}

		                   }else{
		                    ?>
		                        <script type="text/javascript">
		                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('../detail_cetak?id=<?=$item;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                        </script>
		                    <?php  
		                   }                
		                }else{
		                    ?>
		                    <script type="text/javascript">
		                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('../detail_cetak?id=<?=$item;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php  
		                }
		            }else{
		                ?>
		                    <script type="text/javascript">
		                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('../detail_cetak?id=<?=$item;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php    
		            }
		        
		    }

			
		}

		if (isset($_GET['hps'])) {
			$idKeranjang=$_GET['ik'];
			$idItem=$_GET['it'];

			$hapusItem=mysql_query("DELETE FROM tb_detail_keranjang WHERE id_keranjang='$idKeranjang' AND id_item='$idItem'");
			if ($hapusItem) {
				echo "<script>window.location.assign('../keranjang');</script>";
			}else{
				?>
			        <script type="text/javascript">
						alertify.alert("Gagal", function(){window.history.go(-1)}).setHeader(' ').set({closable:false,transition:'fade'});
					</script>
			    <?php
			}
		}
	?>
</body>
</html>