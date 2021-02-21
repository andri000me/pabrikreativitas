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
		if (isset($_POST['simpanKategori'])) {
			$row=mysql_num_rows(mysql_query("SELECT id_kategori FROM tb_kategori"))+1;
			$idKategori='KB'.$row;
			$namaKategori=$_POST['nama'];

			$tambahKategori=mysql_query("INSERT INTO tb_kategori (`id_kategori`,`nama_kategori`) VALUES ('$idKategori','$namaKategori')");
			if ($tambahKategori) {?>
				<script type="text/javascript">
	                alertify.alert("Kategori Berhasil Ditambah", function(){ window.location.assign('../settings_kategori'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}else{?>
				<script type="text/javascript">
	                alertify.alert("Kategori Gagal Ditambah", function(){ window.location.assign('../tambah_kategori'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}
		}

		if (isset($_POST['ubahKategori'])) {
			$id=$_POST['id'];
			$nama=$_POST['nama'];

			$updateKategorit=mysql_query("UPDATE tb_kategori SET `nama_kategori`='$nama' WHERE `id_kategori`='$id'");
			if ($updateKategorit) {?>
				<script type="text/javascript">
	                alertify.alert("Client Berhasil Diubah", function(){ window.location.assign('../settings_kategori'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}else{?>
				<script type="text/javascript">
	                alertify.alert("Client Gagal Diubah", function(){ window.location.assign('../edit_kategori?id=<?=$$id;?>'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
			<?php
			}
		}

		if (isset($_GET['hps'])) {
			$idKategori=$_GET['hps'];
			$deleteKategori=mysql_query("DELETE FROM tb_kategori WHERE `id_kategori`='$idKategori'");
			if ($deleteKategori) {?>
				<script type="text/javascript">
	                window.location.assign('../settings_kategori');
	            </script>
			<?php
			}else{?>
				<script type="text/javascript">
	                window.location.assign('../settings_kategori');
	            </script>
			<?php
			}
		}
	?>
</body>
</html>