<!DOCTYPE html>
<html>
<head>
	<title>proses</title>
	<link rel="icon" type="image/ico" href="../../admin/assets/images/icon/favicon.ico" />
	<link href="../../assets/home/css/bootstrap.4.min.css" rel="stylesheet">
	<link href="../../assets/home/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="../../assets/home/js/alertify.min.js"></script>
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

	if (isset($_POST['register'])) {
		$date=date("dmY");
		$time=date('s');
		$nama=$_POST['nama'];
		$jenisKelamin=$_POST['jenisKelamin'];
		$tglLahir=$_POST['tahun']."-".$_POST['bulan']."-".$_POST['hari'];
		$noHp=$_POST['noHp'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$alamat=$_POST['alamat'];
		$password=$_POST['password'];
		$kPassword=$_POST['kPassword'];
		$pertanyaan=$_POST['pertanyaan']."-".strtolower($_POST['jawaban']);		
		$id=$date."".$_POST['hari']."".$time;
		$idUser="US".$id;
		$idKeranjang="K".$id;
		$fotoSampul='img_sampul.png';
		if ($jenisKelamin=='1') {
			$fotoProfil='img_man.png';
		}else{
			$fotoProfil='img_woman.png';
		}

		if ($_POST['bank']=='1') {
			$bank=$_POST['namaBank'].'-'.$_POST['noRek'].'-'.$_POST['namaPemilik'];
		}else{
			$bank=$_POST['bank'].'-'.$_POST['noRek'].'-'.$_POST['namaPemilik'];
		}

		if ($password==$kPassword) {
			$insert=mysql_query("INSERT INTO `tb_user` (`id_user`, `nama_user`, `tgl_lahir`, `jenis_kelamin`, `no_hp`, `email`, `username`, `alamat`, `password`, `pertanyaan`, `foto_profil`, `foto_sampul`, `akun_bank`) VALUES ('$idUser', '$nama', '$tglLahir', '$jenisKelamin', '$noHp', '$email', '$username', '$alamat', '$password', '$pertanyaan', '$fotoProfil', '$fotoSampul','$bank');") or die(mysql_error());
			$keranjang=mysql_query("INSERT INTO `tb_keranjang` (`id_keranjang`, `id_user`) VALUES ('$idKeranjang','$idUser');");
			if ($insert&&$keranjang) { ?>
				<script type="text/javascript">
					alertify.alert("Terima Kasih, Silahkan Login", function(){window.location.assign('../../login')}).setHeader(' ').set({closable:false,transition:'fade'});
				</script>
			<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alertify.alert("Password Tidak Sesuai", function(){window.location.assign('../../login')}).setHeader(' ').set({closable:false,transition:'fade'});
			</script>
			<?php
		}		
	}

	if (isset($_POST['updatePasword'])) {
		$idUser=$_POST['idUser'];
		$password=$_POST['password'];
		$kPassword=$_POST['kPassword'];
		if ($password==$kPassword) {
			$update=mysql_query("UPDATE `tb_user` SET `password`='$password' WHERE id_user='$idUser';");
			if ($update) { ?>
				<script type="text/javascript">
					alertify.alert("Password Gagal Di Ubah", function(){window.location.assign('../../user/profil')}).setHeader(' ').set({closable:false,transition:'fade'});
				</script>
			<?php
			}else{?>
                <script language="JavaScript">
                    alertify.alert("Password Gagal Di Ubah", function(){ window.location.assign('../../user/profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
               </script>
            <?php
            }
		}else{?>
           <script language="JavaScript">
                alertify.alert("Password Tidak Sesuai", function(){ window.location.assign('../../user/profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
           </script>
        <?php
        }
	}

	if (isset($_POST['update'])) {
		$idUser=$_POST['idUser'];
		$namaUser=$_POST['nama'];
		$username=$_POST['username'];
		if ($_POST['hari']=='0'||$_POST['bulan']=='0'||$_POST['tahun']=='0') {
			$tglLahir=str_to_tanggal($_POST['tgl_lahir']);
		}else{
			$tglLahir=$_POST['tahun']."-".$_POST['bulan']."-".$_POST['hari'];			
		}
		$jenisKelamin=$_POST['jenisKelamin'];
		$noHp=$_POST['noHp'];
		$email=$_POST['email'];
		$alamat=$_POST['alamat'];

		$ekstensi_diperbolehkan = array('jpg','jpeg', 'png');
		$sizeByte=1024*1000;
		$qGambar=mysql_query("SELECT foto_profil, foto_sampul FROM tb_user WHERE id_user='$idUser'") or die(mysql_error());
		$gambar=mysql_fetch_array($qGambar);


		if ($_FILES['fotoProfil']['name']=='') {
			$nama = $gambar['foto_profil'];
			$ukuran = 100;
        	$file_tmp = '';
        	$x = explode('.', $nama);
	        $ekstensi = strtolower(end($x));
	        $namaBaru=$nama;
		}else{
			$nama = $_FILES['fotoProfil']['name'];
			$ukuran = $_FILES['fotoProfil']['size'];
        	$file_tmp = $_FILES['fotoProfil']['tmp_name'];
        	$x = explode('.', $nama);
	        $ekstensi = strtolower(end($x));
	        $namaBaru=$idUser."-fp.".$ekstensi;
		}

		if ($_FILES['fotoSampul']['name']=='') {
			$nama1 = $gambar['foto_sampul'];
			$ukuran1 = 100;
        	$file_tmp1 = '';
        	$x1 = explode('.', $nama1);
	        $ekstensi1 = strtolower(end($x1));
	        $namaBaru1=$nama1;
		}else{
			$nama1 = $_FILES['fotoSampul']['name'];			
	        $ukuran1 = $_FILES['fotoSampul']['size'];
	        $file_tmp1 = $_FILES['fotoSampul']['tmp_name'];
	        $x1 = explode('.', $nama1);
	        $ekstensi1 = strtolower(end($x1));
	        $namaBaru1=$idUser."-sp.".$ekstensi1;
		}

		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true && in_array($ekstensi1, $ekstensi_diperbolehkan) === true){
			if (($ukuran<=$sizeByte && $ukuran!=0) && ($ukuran1<=$sizeByte && $ukuran1!=0)) {
				move_uploaded_file($file_tmp, '../../user/assets/images/user/'.$namaBaru);
				move_uploaded_file($file_tmp1, '../../user/assets/images/user/'.$namaBaru1);

                $update=mysql_query("UPDATE `tb_user` SET `id_user`='$idUser', `nama_user`='$namaUser', `tgl_lahir`='$tglLahir', `jenis_kelamin`='$jenisKelamin', `no_hp`='$noHp', `email`='$email', `username`='$username', `alamat`='$alamat', `foto_profil`='$namaBaru', `foto_sampul`='$namaBaru1' WHERE id_user='$idUser';");
				if ($update) { ?>
					<script type="text/javascript">
						alertify.alert("Data Telah Di Ubah", function(){window.location.assign('../../user/profil')}).setHeader(' ').set({closable:false,transition:'fade'});
					</script>
				<?php
				}else{?>
                    <script language="JavaScript">
                        alertify.alert("Gagal Upload", function(){ window.location.assign('../../user/profil'); }).setHeader(' ').set({closable:false,transition:'fade'});
                    </script>
                <?php
                }
			}else{?>
                <script language="JavaScript">
                    alertify.alert("Ukuran Tidak Sesuai, Ukuran Max Adalah 1MB", function(){ window.location.assign('../../user/profil'); }).setHeader(' ').set({closable:false,transition:'fade'});
                </script>
            <?php
            }
		}else{?>
            <script language="JavaScript">
                alertify.alert("Format Tidak Sesuai, Format Harus PNG / JPG / JPEG", function(){ window.location.assign('../profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?php                    
        }
	}

	if (isset($_POST['cekAkun'])) {
		$emailUsername=$_POST['email'];
		$pertanyaan=$_POST['pertanyaan']."-".strtolower($_POST['jawaban']);

		$cekAkun=mysql_num_rows(mysql_query("SELECT id_user FROM tb_user WHERE email='$emailUsername' OR username='$emailUsername'"));
		$cekPertanyaan=mysql_fetch_array(mysql_query("SELECT pertanyaan FROM tb_user WHERE email='$emailUsername' or username='$emailUsername'"));

		if ($cekAkun>0) {
			if ($pertanyaan==$cekPertanyaan['pertanyaan']) { 
					$_SESSION['emailUsername']=$emailUsername;
					$_SESSION['pertanyaan']=$pertanyaan;
				?>
	            <script language="JavaScript">
	                alertify.alert("Silahkan Ganti Password Anda", function(){ window.location.assign('../../reset-password'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
	        	<?php 
			}else{
				?>
	            <script language="JavaScript">
	                alertify.alert("Pertanyaan dan jawaban Tidak Sesuai", function(){ window.location.assign('../../lupa-password'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
	        	<?php 
			}
		}else{
			?>
	        <script language="JavaScript">
	            alertify.alert("Akun Tidak Ditemukan, Silahkan Buat Akun", function(){ window.location.assign('../register'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	     	<?php 
		}		
	}

	if (isset($_POST['resetPasword'])) {
		$emailUsername=$_SESSION['emailUsername'];
		$pertanyaan=$_SESSION['pertanyaan'];
		$password=$_POST['password'];
		$kPassword=$_POST['kPassword'];

		if ($password==$kPassword) {
			$update=mysql_query("UPDATE `tb_user` SET `password`='$password' WHERE email='$emailUsername' OR username='$emailUsername' AND pertanyaan='$pertanyaan';");

			if ($update) { ?>
				<script type="text/javascript">
					alertify.alert("Password Berhasil Di Ubah", function(){window.location.assign('../../login')}).setHeader(' ').set({closable:false,transition:'fade'});
				</script>
			<?php
			}else{?>
                <script language="JavaScript">
                    alertify.alert("Password Gagal Di Ubah", function(){ window.location.assign('../../login'); }).setHeader(' ').set({closable:false,transition:'pulse'});
               </script>
            <?php
            }

		}else{?>
           <script language="JavaScript">
                alertify.alert("Password Tidak Sesuai", function(){ window.location.assign('../../login'); }).setHeader(' ').set({closable:false,transition:'pulse'});
           </script>
        <?php
        }
	}
?>