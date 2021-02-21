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

    if (isset($_POST['simpanHeadline'])) {
    	$date=date("dmY");
		$time=date('s');
		$urut=mysql_num_rows(mysql_query("SELECT id_headline FROM tb_headline"))+1;
		$idHeadline="H".$urut;
		$judulHeadline=$_POST['judulHeadline'];
		$tglHeadline=date('Y-m-d');
	    $format_file = array("jpg", "png", "jpeg", "bmp");
	    $max_file_size = 1024*1000; //maksimal 1mb
	    $path = "../assets/images/headline/"; // Lokasi folder untuk menampung file
	    $nama = $_FILES['gambar']['name'];
        $x = explode('.', $nama);
	    $ekstensi = strtolower(end($x));
        $namaBaru=$idHeadline.".".$ekstensi;
        $ukuran = $_FILES['gambar']['size'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $ukuranGambar=getimagesize($file_tmp);
        $width=1319;
        $height=423;
        $image_width = $ukuranGambar[0];
        $image_height = $ukuranGambar[1];
		
		
	    if(in_array($ekstensi, $format_file) === true){
            if ($ukuran<=$max_file_size && $ukuran!=0) {
                if ($image_width==$width&&$image_height==$height) {
                    move_uploaded_file($file_tmp, $path.$namaBaru);
                    $simpanHeadline=mysql_query("INSERT INTO `tb_headline` (`id_headline`, `gambar_headline`, `tgl_headline`, `nama_headline`) VALUES ('$idHeadline', '$namaBaru', '$tglHeadline', '$judulHeadline');");
                    if($simpanHeadline){ ?>
                        <script language="JavaScript">
                            window.location.assign('../settings_header');
                        </script>
                    <?php
                    }else{?>
                        <script language="JavaScript">
                            alertify.alert("Headline Gagal Dibuat", function(){ window.location.assign('../settings_header'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                        </script>
                    <?php
                    }
                }else{ ?>
                    <script language="JavaScript">
                        alertify.alert("Resolusi Tidak Sesuai", function(){ window.location.assign('../settings_header'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                    </script>
                <?php
                }
            }else{?>
                <script language="JavaScript">
                    alertify.alert("Ukuran Tidak Sesuai", function(){ window.location.assign('../settings_header'); }).setHeader(' ').set({closable:false,transition:'pulse'});
                </script>
            <?php
            }
        }else{?>
            <script language="JavaScript">
                alertify.alert("Format Tidak Sesuai", function(){ window.location.assign('../settings_header'); }).setHeader(' ').set({closable:false,transition:'pulse'});
            </script>
        <?php                    
        }
    }

    if (isset($_GET['hps'])) {
    	$idHeadline=$_GET['hps'];
    	$path='../assets/images/headline/';
    	$qGambar=mysql_query("SELECT gambar_headline FROM tb_headline WHERE id_headline='$idHeadline'");
    	$gambar=mysql_fetch_array($qGambar);
    	unlink($path.$gambar['gambar_headline']);
    	$deleteDesain=mysql_query("DELETE FROM tb_headline WHERE id_headline='$idHeadline'");
    	
    	if ($deleteDesain) {
    		?>
	        <script type="text/javascript">
	            alertify.alert("Headline Telah Dihapus", function(){ window.location.assign('../settings_header'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}else{
    		?>
	        <script type="text/javascript">
	            alertify.alert("Headline Gagal Dihapus", function(){ window.location.assign('../settings_header'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	        <?php
    	}
    }
?>