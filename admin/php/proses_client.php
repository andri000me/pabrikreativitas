<!DOCTYPE html>
<html>
<head>
	<title>Client</title>
	<link rel="icon" type="image/ico" href="../../admin/assets/images/icon/favicon.ico" />
	<link href="../../assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">
	<link href="../../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="../../assets/user_admin/js/alertify.min.js"></script>
</head>
<body>
	<?php 
		session_start();
		include '../../database/koneksi.php';
		if (isset($_POST['simpanClient'])) {
			$date=date("dmY");
			$time=date('s');
			$urut=mysql_num_rows(mysql_query("SELECT id_client FROM tb_client"))+1;
			$idClient="C".$date."".$time."".$urut;
			$nama=$_POST['nama'];
			$tgl_mou=$_POST['tahun']."-".$_POST['bulan']."-".$_POST['hari'];
			$pemilik=$_POST['pemilik'];
			$noHp=$_POST['noHp'];
			$alamat=$_POST['alamat'];

			$tambahClient=mysql_query("INSERT INTO `tb_client` (`id_client`, `nama_client`, `alamat`, `pemilik`, `no_hp`, `tgl_mou`) VALUES ('$idClient', '$nama', '$alamat', '$pemilik', '$noHp', '$tgl_mou');");
			if ($tambahClient) {?>
				<script type="text/javascript">
	                alertify.alert("Client Berhasil Ditambahkan", function(){ window.location.assign('../list_client'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}else{?>
				<script type="text/javascript">
	                alertify.alert("Client Gagal Ditambahkan", function(){ window.location.assign('../tambah_client'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}
		}

		if (isset($_POST['ubahClient'])) {
			$idClient=$_POST['idClient'];
			$nama=$_POST['nama'];
			$tgl_mou=$_POST['tahun']."-".$_POST['bulan']."-".$_POST['hari'];
			$pemilik=$_POST['pemilik'];
			$noHp=$_POST['noHp'];
			$alamat=$_POST['alamat'];

			$updateClient=mysql_query("UPDATE tb_client SET `nama_client`='$nama', `alamat`='$alamat', `pemilik`='$pemilik', `no_hp`='$noHp', `tgl_mou`='$tgl_mou' WHERE `id_client`='$idClient'");
			if ($updateClient) {?>
				<script type="text/javascript">
	                alertify.alert("Client Berhasil Diubah", function(){ window.location.assign('../list_client'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}else{?>
				<script type="text/javascript">
	                alertify.alert("Client Gagal Diubah", function(){ window.location.assign('../edit_client?id=<?=$idClient;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}
		}

		if (isset($_GET['hps'])) {
			$idClient=$_GET['hps'];
			$deleteClient=mysql_query("DELETE FROM tb_client WHERE `id_client`='$idClient'");
			if ($deleteClient) {?>
				<script type="text/javascript">
	                alertify.alert("Client Berhasil Dihapus", function(){ window.location.assign('../list_client'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}else{?>
				<script type="text/javascript">
	                alertify.alert("Client Gagal Dihapus", function(){ window.location.assign('../list_client'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}
		}
	?>
</body>
</html>