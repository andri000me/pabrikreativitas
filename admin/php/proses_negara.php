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

	if (isset($_POST['daftarNegara'])) {
		$kodeNegara=$_POST['kodeNegara'];
		$namaNegara=$_POST['namaNegara'];
		
		$insert=mysql_query("INSERT INTO `tb_negara` (`kode_negara`, `nama_negara`) VALUES ('$kodeNegara', '$namaNegara')") or die(mysql_error());
			
			if ($insert) { ?>
				<script type="text/javascript">
					alertify.alert("Negara Telah Ditambahkan", function(){window.location.assign('../list_negara')}).setHeader(' ').set({closable:false,transition:'fade'});
				</script>
			<?php
			}else{ ?>
				<script type="text/javascript">
					alertify.alert("Negara Gagal Ditambahkan", function(){window.location.assign('../list_negara')}).setHeader(' ').set({closable:false,transition:'fade'});
				</script>
			<?php
			}	
	}

	if (isset($_GET['hps'])) {
    	$idNegara=$_GET['hps'];
    	$delete=mysql_query("DELETE FROM tb_negara WHERE kode_negara='$idNegara'");
    	if ($delete) {
    		?>
	        <script type="text/javascript">
	            alertify.alert("Data Negara Telah Dihapus", function(){ window.location.assign('../list_negara'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}else{
    		?>
	        <script type="text/javascript">
	            alertify.alert("Data Negarak Gagal Dihapus", function(){ window.location.assign('../list_negara'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}
    }
?>