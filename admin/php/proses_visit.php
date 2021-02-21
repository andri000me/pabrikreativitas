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
    $keuntungan=mysql_fetch_array(mysql_query("SELECT keuntungan_visit FROM tb_settings"));
    $persen=$keuntungan['keuntungan_visit'];
    if (isset($_POST['daftar'])) {
    	$date=date("dmY");
		$time=date('s');
		$urut=mysql_num_rows(mysql_query("SELECT id_visit FROM tb_visit"))+1;
		$idVisit="V".$date."".$time."".$urut;
		$namaAcara=$_POST['namaAcara'];
		$pemilikAcara=$_POST['pemilikAcara'];		
		$lokasi=$_POST['lokasi'];
		$tanggalUpload=date('Y-m-d');
		$tglVisit=$_POST['tahun']."-".$_POST['bulan']."-".$_POST['hari'];
		$include=$_POST['include'];
	    $format_file = array("jpg", "png", "jpeg", "bmp");
	    $max_file_size = 1024*1500; //maksimal 1mb
	    $path = "../assets/images/poster/"; // Lokasi folder untuk menampung file
	    $count = 0;

	    $biaya=str_replace('.','',str_replace(',00','',$_POST['biaya']));
		$tiket=$_POST['tiket'];
		if ($tiket='1') {
			$adm=$biaya*$persen;
			$harga=$biaya+$adm;
		}else{
			$harga=$biaya;
		}

		$jmlTiket=$_POST['jmlTiket'];
		if ($jmlTiket==null) {
			$jml='0';
		}else{
			$jml=$jmlTiket;
		}
		
	    foreach ($_FILES['desain']['name'] as $i => $namaFile) {
	        $j=$i+1;
	        $ekstensi=explode('.', $namaFile);
	        $size=$_FILES['desain']['size'][$i];
	        $namaBaru=$idVisit."-".$j.".".$ekstensi[1];
		    if ($i<=5) {
	            if ($size < $max_file_size || $size!=0) {
	                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
	                    if(move_uploaded_file($_FILES["desain"]["tmp_name"][$i], $path.$namaBaru)){

	                    	$simpanVisit=mysql_query("INSERT INTO `tb_visit` (`id_visit`, `pemilik_acara`, `nama_visit`, `tgl_visit`, `lokasi`, `biaya`, `include`, `tgl_upload`, `tiket`, `stok_tiket`) VALUES ('$idVisit', '$pemilikAcara', '$namaAcara', '$tglVisit', '$lokasi', '$harga', '$include', '$tanggalUpload', '$tiket','jml');");
	                        $inputGambar=mysql_query("INSERT INTO `tb_gambar_visit`(`id_visit`,`gambar_visit`) VALUES ('$idVisit','$namaBaru')");

	                        if ($inputGambar&&$simpanVisit) {
	                            ?>
						        <script type="text/javascript">
						            alertify.alert("Acara Telah Ditambahkan", function(){ window.location.assign('../list_visit'); }).setHeader(' ').set({closable:false,transition:'pulse'});
						        </script>
						        <?php
	                        }else{
	                            ?>
						        <script type="text/javascript">
						            alertify.alert("Acara Gagal Ditambahkan", function(){ window.location.assign('../tambah_visit'); }).setHeader(' ').set({closable:false,transition:'pulse'});
						        </script>
						        <?php
	                        }
	                   }else{
	                    ?>
	                        <script type="text/javascript">
	                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('../tambah_visit'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                        </script>
	                    <?php  
	                   }                
	                }else{
	                    ?>
	                    <script type="text/javascript">
	                        alertify.alert("Format File Tidak Sesuai", function(){ window.location.assign('../tambah_visit'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php  
	                }
	            }else{
	                ?>
	                    <script type="text/javascript">
	                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('../tambah_visit'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php    
	            }
	        }else{
	            break;
	        }
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
?>