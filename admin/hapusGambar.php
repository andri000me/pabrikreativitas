<?php
	include '../database/koneksi.php';
	if (isset($_POST['namaGambarUgd'])) {
		$gambar=$_POST['namaGambarUgd'];
		$path='assets/images/ugd/';
			
		$sqlDelete=mysql_query("DELETE FROM tb_gambar_desain WHERE gambar_desain='$gambar'");
		if ($sqlDelete) {
			unlink($path.$gambar);	
			echo "Sukses";
		}else{
			echo "Gagal";
		}
		
	}
?>