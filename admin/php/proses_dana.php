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
    
    if (isset($_GET['kd'])) {
    	$user=$_GET['wl'];
        $status=$_GET['st'];
        $wallet=str_replace('US','W',$user);
        $carikan=mysql_query("UPDATE tb_buku_besar SET status='$status'") or die(mysql_error());
        $carikan1=mysql_query("UPDATE tb_detail_wallet SET status='$status' WHERE id_wallet='$wallet'") or die(mysql_error());
        if ($carikan&&$carikan1) {
            ?>
            <script type="text/javascript">
                alertify.alert("Pencairan Dana Selesai", function(){ window.location.assign('../cair_dana'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
            <?php
        }else{
            ?>
            <script type="text/javascript">
                alertify.alert("Pencairan Dana Gagal", function(){ window.location.assign('../cair_dana'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
            <?php
        }
    }
?>