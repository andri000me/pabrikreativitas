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
		if (isset($_GET['event'])) {
			$row=mysql_num_rows(mysql_query("SELECT no_tiket FROM tb_transaksi_visit"))+1;
			$event=$_GET['event'];
			$tiket=mysql_fetch_array(mysql_query("SELECT * FROM tb_visit WHERE MD5(id_visit)='$event'"));
			$idVisit=$tiket['id_visit'];
			$idUser=$_SESSION['idUser'];
			$noTiket="TKT".date("dmY").$row.(date("s")+$row);
			$mdTiket=md5($noTiket);
			$sisaStok=$tiket['stok_tiket'];

			$tglTransaksi=date("Y-m-d");
			if ($sisaStok<=0) {
				?>
                    <script language="JavaScript">
                        alertify.alert("Maaf Tiket Habis", function(){ window.location.assign('../vaksin?page=1&k=all'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                    </script>
                <?php
			}else{				
				$transaksi=mysql_query("INSERT INTO tb_transaksi_visit(`no_tiket`,`id_user`,`id_visit`,`tgl_transaksi`,`tgl_bayar`,`bukti_bayar`,`id_bank`,`status`) VALUES ('$noTiket','$idUser','$idVisit','$tglTransaksi','','','','0')");


				$min=mysql_query("UPDATE tb_visit SET stok_tiket=stok_tiket-1 WHERE MD5(id_visit)='$event'");
				if ($transaksi) {
					?>
                    <script language="JavaScript">
                        window.location.assign('../checkout_ticket?tiket=<?=$mdTiket;?>');
                    </script>
                	<?php
				}
			}
		}

		if (isset($_POST['bayarTransaksi'])) {
			$bank=$_POST['bank'];
			$total=$_POST['total'];
			$noTiket=$_POST['noTiket'];
			$status='1';
			$mdTiket=md5($noTiket);
			$min=mysql_query("UPDATE tb_transaksi_visit SET id_bank='$bank', status='$status' WHERE no_tiket='$noTiket'");
			if ($min) {
				?>
                   <script language="JavaScript">
                        window.location.assign('../payment_ticket?tiket=<?=$mdTiket;?>');
                   </script>
                <?php
			}
		}

		if (isset($_POST['uploadTransaksi'])) {
			$noTiket=$_POST['noTiket'];
			$iv=md5($noTiket);
			$status='2';
			$tgl_pembayaran=date("Y-m-d");
			$format_file = array("jpg", "png", "jpeg", "bmp");
		    $max_file_size = 1024*1000; //maksimal 1mb
		    $path = "../../admin/assets/images/payment/";
		    $namaFile=$_FILES['buktiPembayaran']['name'];
			
		        $ekstensi=explode('.', $namaFile);
		        $size=$_FILES['buktiPembayaran']['size'];
		        $namaBaru=str_replace('/', '-', $noTiket).".".$ekstensi[1];
			    
		            if ($size < $max_file_size || $size!=0) {
		                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
		                    if(move_uploaded_file($_FILES["buktiPembayaran"]["tmp_name"], $path.$namaBaru)){
		                        $update=mysql_query("UPDATE tb_transaksi_visit SET tgl_bayar='$tgl_pembayaran', bukti_bayar='$namaBaru', status='$status' WHERE no_tiket='$noTiket'");
		                        if ($update) {
		                            echo "<script>window.location.assign('../list_event');</script>";
		                        }else{
		                            echo "<script>window.location.assign('payment_ticket?tiket='".$iv.");</script>";
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
		                        alertify.alert("Format File Tidak Sesuai", function(){ window.location.assign('payment_ticket?tiket=<?=$iv;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php  
		                }
		            }else{
		                ?>
		                    <script type="text/javascript">
		                        alertify.alert("Ukuran File Terlalu Besar", function(){ window.location.assign('payment_ticket?tiket=<?=$iv;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php    
		            }
		        
		}

	?>
</body>
</html>