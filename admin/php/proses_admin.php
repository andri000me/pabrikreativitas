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

	if (isset($_POST['daftarAdmin'])) {
		$date=date("dmY");
		$time=date('s');
		$nama=$_POST['nama'];
		$jenisKelamin=$_POST['jenisKelamin'];
		$tglLahir=$_POST['tahun']."-".$_POST['bulan']."-".$_POST['hari'];
		$noHp=$_POST['kodeNegara']."".$_POST['noHp'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$alamat=$_POST['alamat'];
		$password=$_POST['password'];
		$kPassword=$_POST['kPassword'];
		$pertanyaan=$_POST['pertanyaan']."-".strtolower($_POST['jawaban']);		
		$id=$date."".$_POST['hari']."".$time;
		$idUser="ADM".$id;
		$posisi=$_POST['posisi'];
		$fotoSampul='img_sampul.png';
		if ($jenisKelamin=='1') {
			$fotoProfil='img_man.png';
		}else{
			$fotoProfil='img_woman.png';
		}

		if ($password==$kPassword) {
			$insert=mysql_query("INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `email`, `username`, `alamat`, `password`, `pertanyaan`, `posisi`, `foto_profil`, `foto_sampul`) VALUES ('$idUser', '$nama', '$tglLahir', '$jenisKelamin', '$noHp', '$email', '$username', '$alamat', '$password', '$pertanyaan', '$posisi', '$fotoProfil', '$fotoSampul');") or die(mysql_error());
			if ($insert) { ?>
				<script type="text/javascript">
					alertify.alert("Admin Telah Ditambahkan", function(){window.location.assign('../list_admin')}).setHeader(' ').set({closable:false,transition:'fade'});
				</script>
			<?php
			}else{ ?>
				<script type="text/javascript">
					alertify.alert("Admin Gagal Ditambahkan", function(){window.location.assign('../list_admin')}).setHeader(' ').set({closable:false,transition:'fade'});
				</script>
			<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alertify.alert("Password Tidak Sesuai", function(){window.location.assign('../profil')}).setHeader(' ').set({closable:false,transition:'fade'});
			</script>
			<?php
		}		
	}
?>