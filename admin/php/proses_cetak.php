'<!DOCTYPE html>
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
    if (isset($_POST['simpanCetak'])) {
    	$date=date("dmY");
		$time=date('s');
		$urut=mysql_num_rows(mysql_query("SELECT id_desain FROM tb_desain"))+1;
		$idCetak="CT".$date."".$time."".$urut;
    	$jenisCetak=$_POST['jenisCetak'];
		$hargaUnit=str_replace('.','',str_replace(',00','',$_POST['hargaUnit']));
		$hargaJual=$hargaUnit+($hargaUnit*$persen);
		$ketHarga=$_POST['ketHarga'];
		$dekripsi=$_POST['dekripsi'];
		$format=$_POST['format'];
		$min=$_POST['min'];
		$max=$_POST['max'];
		$idAdmin=$_SESSION['idAdmin'];
	    $format_file = array("png");
	    $max_file_size = 1024*1000; //maksimal 1mb
	    $path = "../assets/images/urc/"; // Lokasi folder untuk menampung file
	    $count = 0;

	    foreach ($_FILES['icon']['name'] as $i => $namaFile) {
	        $j=$i+1;
	        $ekstensi=explode('.', $namaFile);
	        $size=$_FILES['icon']['size'][$i];
	        $namaBaru=$idCetak."-".$j.".".$ekstensi[1];
		    if ($i<=5) {
	            if ($size < $max_file_size || $size!=0) {
	                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
	                    if(move_uploaded_file($_FILES["icon"]["tmp_name"][$i], $path.$namaBaru)){
	                        $inputUnit=mysql_query("INSERT INTO `tb_cetak` (`id_cetak`, `jenis_cetak`, `format`, `min_pesan`, `max_pesan`, `harga`, `ket_harga`, `deskripsi`, `icon`. `pemilik`) VALUES ('$idCetak', '$jenisCetak', '$format', '$min', '$max', '$hargaJual', '$ketHarga', '$dekripsi', '$namaBaru', '$idAdmin');");
	                        if ($inputUnit) {
	                            $count++;
	                        }else{
	                            $count=0;
	                        }
	                   }else{
	                    ?>
	                        <script type="text/javascript">
	                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('../tambah_ceteak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                        </script>
	                    <?php  
	                   }                
	                }else{
	                    ?>
	                    <script type="text/javascript">
	                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('../tambah_ceteak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php  
	                }
	            }else{
	                ?>
	                    <script type="text/javascript">
	                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('../tambah_ceteak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php    
	            }
	        }else{
	            break;
	        }
	    }
	    if ($count>0) {
	        ?>
	        <script type="text/javascript">
	            alertify.alert("Unit Cetak Telah Ditambahkan", function(){ window.location.assign('../list_cetak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
	    }else{
	        ?>
	        <script type="text/javascript">
	            alertify.alert("Unit Cetak Gagal Ditambahkan", function(){ window.location.assign('tambah_cetak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
	    }
    }

    if (isset($_GET['hps'])) {
    	$idCetak=$_GET['hps'];
    	$path='../assets/images/urc/';
    	$gambar=mysql_fetch_array(mysql_query("SELECT icon FROM tb_cetak WHERE id_cetak='$idCetak'"));
    	$namaGambar=$gambar['icon'];
    	unlink($path.$namaGambar); 
    	$delete=mysql_query("DELETE FROM tb_cetak WHERE id_cetak='$idCetak'");
    	if ($delete) {
    		?>
	        <script type="text/javascript">
	            alertify.alert("Unit Cetak Telah Dihapus", function(){ window.location.assign('../list_cetak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}else{
    		?>
	        <script type="text/javascript">
	            alertify.alert("Unit Cetak Gagal Dihapus", function(){ window.location.assign('../list_cetak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}
    }

    if (isset($_POST['prosesCetak'])) {
    	$noInvoice=$_POST['noInvoice'];
    	$update=mysql_query("UPDATE tb_transaksi SET status='7' WHERE no_invoice='$noInvoice'");
    	if ($update) {
    		?>
	        <script type="text/javascript">
	            alertify.alert("<?=$noInvoice;?> Diproses", function(){ window.location.assign('../list_proses_cetak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}else{
    		?>
	        <script type="text/javascript">
	            alertify.alert("<?=$noInvoice;?> Gagal Diproses", function(){ window.location.assign('../proses_cetak?id=<?=$noInvoice;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}
    }
    if (isset($_POST['kirim'])) {
    	$noInvoice=$_POST['noInvoice'];
    	$status='5';
		$noResi=$_POST['noResi'];
		$update=mysql_query("UPDATE tb_transaksi SET status='$status', no_resi='$noResi' WHERE no_invoice='$noInvoice'");
    	if ($update) {
    		?>
	        <script type="text/javascript">
	            alertify.alert("<?=$noInvoice;?> Dikirim", function(){ window.location.assign('../list_proses_cetak'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}else{
    		?>
	        <script type="text/javascript">
	            alertify.alert("<?=$noInvoice;?> Gagal Diproses", function(){ window.location.assign('../proses_cetak?id=<?=$noInvoice;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}
    }
?>