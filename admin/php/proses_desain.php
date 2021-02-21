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

</body>
</html>
<?php
	include '../../database/koneksi.php';
	session_start();
	ob_start();
	function str_to_tanggal($a){
		$date=explode(" ", $a);
        $bulan = array(
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        );
        $tgl=$date[2]."-".$bulan[$date[1]]."-".$date[0];
        return $tgl;
    }
    $keuntungan=mysql_fetch_array(mysql_query("SELECT keuntungan FROM tb_settings"));
    $persen=$keuntungan['keuntungan'];
    if (isset($_POST['daftar'])) {
    	$date=date("dmY");
		$time=date('s');
		$urut=mysql_num_rows(mysql_query("SELECT id_desain FROM tb_desain"))+1;
		$idDesain="D".$date."".$time."".$urut;
    	$namaDesain=$_POST['namaDesain'];
		$hargaDesain=str_replace('.','',str_replace(',00','',$_POST['hargaDesain']));
		$hargaJual=$hargaDesain+($hargaDesain*$persen);
		$tanggalUpload=date('Y-m-d');
		$kategori=$_POST['kategori'];
		$berat=$_POST['berat'];
		$dekripsi=$_POST['dekripsi'];
		$idAdmin=$_SESSION['idAdmin'];
	    $format_file = array("jpg", "png", "jpeg", "bmp");
	    $max_file_size = 1024*1000; //maksimal 1mb
	    $path = "../assets/images/ugd/"; // Lokasi folder untuk menampung file
	    $count = 0;

	    $cw=$_POST['cw'];
	    if ($cw=='1') {
	    	$warna=$cw.'.'.$_POST['warna'];
	    }else{
	    	$warna=$cw.',-';
	    }
		
		$simpanDesain=mysql_query("INSERT INTO `tb_desain` (`id_desain`, `nama_desain`, `tgl_upload`, `harga`, `berat`, `color_background`, `favorit`, `deskripsi`, `id_kategori`, `pemilik`, `status`) VALUES ('$idDesain', '$namaDesain', '$tanggalUpload', '$hargaJual', '$berat', '$warna', '0', '$dekripsi', '$kategori', '$idAdmin', '1');");
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
	                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('tambah_Desain'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                        </script>
	                    <?php  
	                   }                
	                }else{
	                    ?>
	                    <script type="text/javascript">
	                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('tambah_Desain'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php  
	                }
	            }else{
	                ?>
	                    <script type="text/javascript">
	                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('tambah_Desain'); }).setHeader(' ').set({closable:false,transition:'pulse'});
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
	            alertify.alert("Desain Telah Ditambahkan", function(){ window.location.assign('../list_Desain'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
	    }else{
	        ?>
	        <script type="text/javascript">
	            alertify.alert("Desain Gagal Ditambahkan", function(){ window.location.assign('tambah_Desain'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
	    }
    }

    if (isset($_GET['hps'])) {
    	$idDesain=$_GET['hps'];
    	$path='../assets/images/ugd/';
    	$gambar=mysql_query("SELECT gambar_desain FROM tb_gambar_desain WHERE id_desain='$idDesain'");
    	$no=0;
    	while ($dataGambar=mysql_fetch_array($gambar)) {
    		$namaGambar=$dataGambar['gambar_desain'];
    		$deleteGambar=mysql_query("DELETE FROM tb_gambar_desain WHERE id_desain='$idDesain' AND gambar_desain='$namaGambar'");
    		unlink($path.$namaGambar);    		
    		$no++;
    	}

    	$deleteDesain=mysql_query("DELETE FROM tb_desain WHERE id_desain='$idDesain'");
    	if ($no>0&&$deleteDesain) {
    		?>
	        <script type="text/javascript">
	            alertify.alert("Desain Telah Dihapus", function(){ window.location.assign('../list_desain'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}else{
    		?>
	        <script type="text/javascript">
	            alertify.alert("Desain Gagal Dihapus", function(){ window.location.assign('../list_desain'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}
    }

    if (isset($_POST['ubahData'])) {
    	$idDesain=$_POST['idDesain'];

    	$desk=mysql_query("SELECT deskripsi FROM tb_desain WHERE id_desain='$idDesain'");
    	$r=mysql_fetch_array($desk);
    	$dekripsi=$_POST['dekripsi'];
    	if ($dekripsi=='') {
    		$dk=$r['deskripsi'];
    	}else{
    		$dk=$_POST['dekripsi'];
    	}
    	$namaDesain=$_POST['namaDesain'];
		$hargaDesain=$_POST['hargaDesain'];
		$berat=$_POST['berat'];
		$tanggalUpload=$_POST['tanggalUpload'];
		$kategori=$_POST['kategori'];
		$format_file = array("jpg", "png", "jpeg", "bmp");
	    $max_file_size = 1024*1000;
	    $path = "../assets/images/ugd/"; // Lokasi folder untuk menampung file
	    $count = 0;
	    $cek = 0;
		$hargaJual=$hargaDesain+($hargaDesain*$persen);
		$ubahDesain = mysql_query("UPDATE tb_desain SET `nama_desain`='$namaDesain', `tgl_upload`='$tanggalUpload', `harga`='$hargaJual', `berat`='$berat', `deskripsi`='$dk', `id_kategori`='$kategori' WHERE `id_desain`='$idDesain'") or die(mysql_error());

		if ($_FILES['desain']['name']!=null) {
			foreach ($_FILES['desain']['name'] as $i => $namaFile) {
		        $j=$i+1;
		        $ekstensi=explode('.', $namaFile);
		        $size=$_FILES['desain']['size'][$i];
		        $ex=pathinfo($_FILES['desain']['name'][$i], PATHINFO_EXTENSION);
		        $namaBaru=$idDesain."-".$j.".".$ex;
			    if ($i<=5) {
		            if ($size < $max_file_size || $size!=0) {
		                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
		                    if(move_uploaded_file($_FILES["desain"]["tmp_name"][$i], $path.$namaBaru)){
		                        $inputGambar=mysql_query("UPDATE `tb_gambar_desain` SET `gambar_desain`='$namaBaru')");
		                        if ($inputGambar) {
		                            $count++;
		                        }else{
		                            $count=0;
		                        }
		                   }else{
		                    ?>
		                        <script type="text/javascript">
		                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('../edit_desain?=<?=$idDesain;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                        </script>
		                    <?php  
		                   }                
		                }else{
		                    ?>
		                    <script type="text/javascript">
		                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('../edit_desain?=<?=$idDesain;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php  
		                }
		            }else{
		                ?>
		                    <script type="text/javascript">
		                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('../edit_desain?=<?=$idDesain;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php    
		            }
		        }else{
		            break;
		        }
		    }
		    $cek=1;
		}
		if ($ubahDesain && $count>0 || $ubahDesain && $cek>=0) {
	        ?>
	        <script type="text/javascript">
	            alertify.alert("Desain Telah Diubah", function(){ window.location.assign('../edit_desain?=<?=$idDesain;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
	    }else{
	        ?>
	        <script type="text/javascript">
	            alertify.alert("Desain Gagal Diubah", function(){ window.location.assign('edit_desain?=<?=$idDesain;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
	    }
    }
?>