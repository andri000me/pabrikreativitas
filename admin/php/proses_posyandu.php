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

		$keuntungan=mysql_fetch_array(mysql_query("SELECT keuntungan FROM tb_settings"));
        $persen=$keuntungan['keuntungan'];
        session_start();
        ob_start();
        
		if (isset($_GET['st'],$_GET['id'])) {
			$idJobs=$_GET['id'];
			$status=$_GET['st'];

			$ubahStatus=mysql_query("UPDATE tb_jobs SET status='$status' WHERE id_jobs='$idJobs'");

			if ($ubahStatus) {
				echo "<script>window.location.assign('../list_posyandu');</script>";
			}else{
				?>
	                <script type="text/javascript">
	                    alertify.alert("Gagal Publish Artikel", function(){ window.location.assign('../list_posyandu'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                </script>
	            <?php 
			}			
		}

		if (isset($_POST['tambahJobs'])) {
	    	$date=date("dmY");
			$time=date('s');
			$urut=mysql_num_rows(mysql_query("SELECT id_desain FROM tb_desain"))+1;
			$idJobs="J".$date."".$time.$urut;
	    	$judulPortofolio=$_POST['judulPortofolio'];
			$adm=$_POST['hargaJasa']*$persen;
			$hargaJual=$_POST['hargaJasa']*$adm;
			$ketHarga=$_POST['ketHarga'];
			$kategori=$_POST['kategori'];
			$deskripsi=$_POST['deskripsi'];
			$tanggalUpload=date('Y-m-d');			
			$idUser=$_SESSION['idAdmin'];
		    $format_file = array("jpg", "png", "jpeg", "bmp");
		    $max_file_size = 1024*1000; //maksimal 1mb
		    $path = "../assets/images/portofolio/"; // Lokasi folder untuk menampung file
		    $count = 0;
			
			$simpanDesain=mysql_query("INSERT INTO `tb_jobs` (`id_jobs`, `judul_jobs`, `harga`, `ket_harga`, `deskripsi`, `id_user`, `status`) VALUES ('$idJobs', '$judulPortofolio', '$hargaJual', '$ketHarga', '$deskripsi', '$idUser', '1');") or die(mysql_error());
			foreach ($_FILES['desain']['name'] as $i => $namaFile) {
	        $j=$i+1;
	        $ekstensi=explode('.', $namaFile);
	        $size=$_FILES['desain']['size'][$i];
	        $namaBaru=$idJobs."-".$j.".".$ekstensi[1];
		    if ($i<=5) {
	            if ($size < $max_file_size || $size!=0) {
	                if (in_array(pathinfo($namaFile, PATHINFO_EXTENSION), $format_file) ){
	                    if(move_uploaded_file($_FILES["desain"]["tmp_name"][$i], $path.$namaBaru)){
	                        $inputGambar=mysql_query("INSERT INTO `tb_gambar_jobs`(`id_jobs`,`gambar_jobs`) VALUES ('$idJobs','$namaBaru')");
	                        if ($inputGambar) {
	                            $count++;
	                        }else{
	                            $count=0;
	                        }
	                   }else{
	                    ?>
	                        <script type="text/javascript">
	                            alertify.alert("Gagal Upload Gambar", function(){ window.location.assign('../tambah_posyandu'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                        </script>
	                    <?php  
	                   }                
	                }else{
	                    ?>
	                    <script type="text/javascript">
	                        alertify.alert("Format <?=$namaFile;?> Tidak Sesuai", function(){ window.location.assign('../tambah_posyandu'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php  
	                }
	            }else{
	                ?>
	                    <script type="text/javascript">
	                        alertify.alert("Ukuran <?=$namaFile;?> Terlalu Besar", function(){ window.location.assign('../tambah_posyandu'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	                    </script>
	                <?php    
	            }
	        }else{
	            break;
	        }
	    }
		    if ($simpanDesain && $count>0) {
		        ?>
		        <script type="text/javascript">
		            alertify.alert("Berhasil Silahkan Tunggu Persetujuan Admin", function(){ window.location.assign('../list_posyandu'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		        </script>
		        <?php
		    }else{
		        ?>
		        <script type="text/javascript">
		            alertify.alert("Gagal Silahkan Coba Lagi", function(){ window.location.assign('../tambah_posyandu'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		        </script>
		        <?php
		    }
    	}
	?>
</body>
</html>