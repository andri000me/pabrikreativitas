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
	<?php
		include '../../database/koneksi.php';
		session_start();
		ob_start();
		if (isset($_GET['st'],$_GET['id'])) {
			$idArtikel=$_GET['id'];
			$status=$_GET['st'];

			$ubahStatus=mysql_query("UPDATE tb_artikel SET publish='$status' WHERE id_artikel='$idArtikel'");

			if ($ubahStatus) {
				echo "<script>window.location.assign('../list_artikel');</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Publish Artikel", function(){ window.location.assign('../list_artikel'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}			
		}

		if (isset($_POST['tambahApotek'])) {
			$date=date("dmY");
			$time=date('s');
			$urut=mysql_num_rows(mysql_query("SELECT id_artikel FROM tb_artikel"))+1;
			$idArtikel="A".$date."".$time."".$urut;
			$judul=$_POST['judul'];
			$kategori=$_POST['kategori'];
			$isi=$_POST['isi'];
			$tglArtikel=date('Y-m-d');
			$idUser=$_SESSION['idAdmin'];
			//gambar
			$format_file = array("jpg", "png", "jpeg", "bmp");
		    $max_file_size = 1024*1000; //maksimal 1mb
		    $path = "../assets/images/artikel/"; // Lokasi folder untuk menampung file
		    $count = 0;

		    $simpanArtikel=mysql_query("INSERT INTO `tb_artikel` (`id_artikel`, `judul_artikel`, `isi_artikel`, `tgl_artikel`, `id_kategori`, `id_user`, `publish`) VALUES ('$idArtikel', '$judul', '$isi', '$tglArtikel', '$kategori', '$idUser', '1');");

		    foreach ($_FILES['desain']['name'] as $i => $namaFile) {
		        $j=$i+1;
		        $ekstensi=explode('.', $namaFile);
		        $size=$_FILES['desain']['size'][$i];
		        $namaBaru=$idArtikel."-".$j.".".$ekstensi[1];
			    if ($i<=1) {
		            if ($size < $max_file_size || $size!=0) {
		                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
		                    if(move_uploaded_file($_FILES["desain"]["tmp_name"][$i], $path.$namaBaru)){
		                        $inputGambar=mysql_query("INSERT INTO `tb_gambar_artikel`(`id_artikel`,`gambar_artikel`) VALUES ('$idArtikel','$namaBaru')");
		                        if ($inputGambar) {
		                            $count++;
		                        }else{
		                            $count=0;
		                        }
		                   }else{
		                    ?>
		                        <script type="text/javascript">
		                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('../tambah_artikel'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                        </script>
		                    <?php  
		                   }                
		                }else{
		                    ?>
		                    <script type="text/javascript">
		                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('../tambah_artikel'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php  
		                }
		            }else{
		                ?>
		                    <script type="text/javascript">
		                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('../tambah_artikel'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		                    </script>
		                <?php    
		            }
		        }else{
		            break;
		        }
		    }
		    if ($simpanArtikel && $count>0) {
		        ?>
		        <script type="text/javascript">
		            alertify.alert("Artikel Telah Ditambahkan", function(){ window.location.assign('../list_artikel'); }).setHeader('Perhatian').set({closable:false,transition:'pulse'});
		        </script>
		        <?php
		    }else{
		        ?>
		        <script type="text/javascript">
		            alertify.alert("Artikel Gagal Ditambahkan", function(){ window.location.assign('./tambah_artikel'); }).setHeader('Perhatian').set({closable:false,transition:'pulse'});
		        </script>
		        <?php
		    }
		}

	?>
</body>
</html>