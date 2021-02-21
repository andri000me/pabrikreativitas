<?php
	include 'database/koneksi.php';
	$j=0;
	for ($i=1; $i <=21 ; $i++) { 
		$date=date("dmY");
		$time=date('s');
		$urut=mysql_num_rows(mysql_query("SELECT id_desain FROM tb_desain"))+1;
		$idDesain="D".$date."".$time."".$urut;
    	$namaDesain=$i.'Nama Desain1';
		$hargaDesain='50000';
		$tanggalUpload=date('Y-m-d');
		$kategori='KB1';
		$dekripsi='Yayayayayyayyayayayaya<br>yayaya<br>ay';
		$gambarDesain='blank.jpg';
	    $simpanDesain=mysql_query("INSERT INTO `tb_desain` (`id_desain`, `nama_desain`, `tgl_upload`, `harga`, `favorit`, `deskripsi`, `id_kategori`) VALUES ('$idDesain', '$namaDesain', '$tanggalUpload', '$hargaDesain', '0', '$dekripsi', '$kategori');");
	    $simpanGambar=mysql_query("INSERT INTO `tb_gambar_desain` (`id_desain`, `gambar_desain`) VALUES ('$idDesain', '$gambarDesain');");	    
		
		if ($simpanDesain&&$simpanGambar) {
			$j++;
		}else{
			$j=0;
		}
	}
	 if ($j>0) {
	  	echo "input berhasil";
	  }else{
	  	echo "gagal";
	  }
?>