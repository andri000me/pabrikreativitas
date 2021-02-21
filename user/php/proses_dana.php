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
    
    if (isset($_POST['carikan'])) {
    	$idWallet=$_POST['idWallet'];
    	$user=mysql_fetch_array(mysql_query("SELECT id_user, biaya FROM tb_wallet JOIN tb_detail_wallet ON tb_wallet.id_wallet=tb_detail_wallet.id_wallet WHERE tb_wallet.id_wallet='$idWallet'"));
		$cairUang=$_POST['cairUang'];
		$biaya=$user['biaya'];
		$tglTransaksi=date("Y-m-d");
		$ket='Carikan Dana '.$user['id_user'];
    	$carikan=mysql_query("INSERT INTO tb_buku_besar(tgl_transaksi, nominal, biaya, ket, transaksi, status) VALUES ('$tglTransaksi', '$cairUang','$biaya','0','$ket','0')");
    	$carikan1=mysql_query("INSERT INTO tb_detail_wallet(id_wallet, tgl_transaksi, nominal, biaya, ket, transaksi, status) VALUES ('$idWallet', '$tglTransaksi', '$cairUang','$biaya','0','Cairkan Dana','0')");
    	if ($carikan&&$carikan1) {
    		?>
	        <script type="text/javascript">
	            alertify.alert("Tunggu Konfirmasi Pencairan Dana", function(){ window.location.assign('../my_wallet'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
            <?php
    	}else{
        ?>
	        <script type="text/javascript">
	            alertify.alert("Gagal Permohonan Pencairan Dana", function(){ window.location.assign('../my_wallet'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}
    }
?>