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
		$keuntungan=mysql_fetch_array(mysql_query("SELECT keuntungan FROM tb_settings"));
        $persen=$keuntungan['keuntungan'];
		if (isset($_POST['tambahPasen'])) {
	    	$date=date("dmY");
			$time=date('s');
			$urut=mysql_num_rows(mysql_query("SELECT id_desain FROM tb_desain"))+1;
			$idDesain="D".$date."".$time."02".$urut;
	    	$namaPasen=$_POST['namaPasen'];
			$hargaPasen=str_replace('.','',$_POST['hargaPasen']);
			$hargaJual=$hargaPasen+($hargaPasen*$persen);
			$tanggalUpload=date('Y-m-d');
			$kategori=$_POST['kategori'];
			$dekripsi=$_POST['dekripsi'];
			$berat=$_POST['berat'];
			$idUser=$_SESSION['idUser'];
		    $format_file = array("jpg", "png", "jpeg", "bmp");
		    $max_file_size = 1024*1000; //maksimal 1mb
		    $path = "../../admin/assets/images/ugd/"; // Lokasi folder untuk menampung file
		    $count = 0;

		    $cw=$_POST['cw'];
		    if ($cw=='1') {
		    	$warna=$_POST['warna'];
		    }else{
		    	$warna='';
		    }
						
			$simpanDesain=mysql_query("INSERT INTO `tb_desain` (`id_desain`, `nama_desain`, `tgl_upload`, `harga`, `berat`, `color_background`, `favorit`, `deskripsi`, `id_kategori`, `pemilik`, `status`) VALUES ('$idDesain', '$namaPasen', '$tanggalUpload', '$hargaJual', '$berat', '$warna', '0', '$dekripsi', '$kategori', '$idUser', '0');");
			foreach ($_FILES['desain']['name'] as $i => $namaFile) {
	        $j=$i+1;
	        $ekstensi=explode('.', $namaFile);
	        $size=$_FILES['desain']['size'][$i];
	        $namaBaru=$idDesain."-".$j.".".$ekstensi[1];
		    if ($i<=5) {
	            if ($size < $max_file_size || $size!=0) {
	                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
	                    if(move_uploaded_file($_FILES["desain"]["tmp_name"][$i], $path.$namaBaru)){
	                        $inputGambar=mysql_query("INSERT INTO `tb_gambar_desain`(`id_desain`,`gambar_desain`) VALUES ('$idDesain','$namaBaru')");
	                        if ($inputGambar) {
	                            $count++;
	                        }else{
	                            $count=0;
	                        }
	                   }else{
	                    ?>
	                        <script type="text/javascript">
	                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('tambah_artikel'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                        </script>
	                    <?php  
	                   }                
	                }else{
	                    ?>
	                    <script type="text/javascript">
	                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('tambah_artikel'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php  
	                }
	            }else{
	                ?>
	                    <script type="text/javascript">
	                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('tambah_artikel'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php    
	            }
	        }else{
	            break;
	        }
	    }
		    if ($simpanDesain && $count>0) {
		        ?>
		        <script type="text/javascript">
		            alertify.alert("Berhasil Silahkan Tunggu Persetujuan Admin", function(){ window.location.assign('../list_pasen'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		        </script>
		        <?php
		    }else{
		        ?>
		        <script type="text/javascript">
		            alertify.alert("Gagal Silahkan Coba Lagi", function(){ window.location.assign('../tambah_pasen'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		        </script>
		        <?php
		    }
    	}
	?>
</body>
</html>