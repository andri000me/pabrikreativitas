<?php
	include '../database/koneksi.php';

	$path = "assets/images/ugd/";
	$format_file = array("jpg", "png", "jpeg", "bmp");
	$max_file_size = 1024*1000;
	$namaFile=$_FILES['file']['name'];
	$size=$_FILES['file']['size'];
	$ekstensi=explode('.', $namaFile);
	$namaBaru="aa.".$ekstensi[1];
	if ($size < $max_file_size || $size!=0) {
		if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){

			if(move_uploaded_file($_FILES["file"]["tmp_name"], $path.$namaBaru)){
				echo "<label>Coba cek</label>";
			}
			else{
				echo "Gagal Upload";
			}
		}else{
			echo "Tipe File Tidak Didukung";
		}
	}else{
		echo "Gambar Terlalu Besar";
	}
	
?>