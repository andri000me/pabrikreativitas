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
    if (isset($_POST['update'])) {
    	$nama=addslashes($_POST['nama']);
		$nomor=addslashes($_POST['nomor']);
		$email=addslashes($_POST['email']);
		$alamat=addslashes($_POST['alamat']);
		$tagline=addslashes($_POST['tagline']);
		$popup=addslashes($_POST['popup']);
		$visi=addslashes($_POST['visi']);
		$misi=addslashes($_POST['misi']);
		$admin=addslashes($_POST['admin']/100);
		$adminVaksin=addslashes($_POST['adminVaksin']/100);
		$client=$_POST['client'].'-'.addslashes($_POST['sectionClient']);	
		$maintenance=$_POST['maintenance'];	
		$update=mysql_query("UPDATE tb_settings SET `nama`='$nama', `nomor`='$nomor', `email`='$email', `alamat`='$alamat', `tagline`='$tagline', `popup`='$popup', `visi`='$visi', `misi`='$misi', `maintenance`='$maintenance', `keuntungan`='$admin', `keuntungan_visit`='$adminVaksin', `client`='$client'") or die(mysql_error());
		if ($update) {
			echo "<script>window.location.assign('../settings_profil')</script>";
		}else{
			?>
	            <script type="text/javascript">
	                alertify.alert("Gagal", function(){ window.location.assign('../settings_profil'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
	        <?php
		}
    }

    if (isset($_POST['gambar'])) {
		$ekstensi_diperbolehkan = array('jpg','png');
		$path='../assets/images/icon/';
		$a=0;$b=0;$c=0;$d=0;$e=0;$f=0;$g=0;$h=0;
		$maxFile=1024*2000;
		//primaryLogo
	    $primaryLogo = $_FILES['primaryLogo']['name'];
	    $x = explode('.', $primaryLogo);
	    $nama=strtolower(current($x));
	    $ekstensi = strtolower(end($x));
	    $primaryLogoBaru="logo-typo.".$ekstensi;
	    $ukuran = $_FILES['primaryLogo']['size'];
	    $file_tmp = $_FILES['primaryLogo']['tmp_name'];
	    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
		    if($ukuran < $maxFile){      
		      	if (move_uploaded_file($file_tmp, $path.$primaryLogoBaru)) { 
		      		$a=1;
		        }else{
		        	$a=0;
		        }    
		    }else{?>
		    	<script type="text/javascript">
	                alertify.alert("File Primary Logo Terlalu Besar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
		    <?php
		    }
	    }else{?>
	    	<script type="text/javascript">
	            alertify.alert("Tipe File Primary Logo Tidak Didukung", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	    <?php
	    }

	    //secondaryLogo
	    $secondaryLogo = $_FILES['secondaryLogo']['name'];
	    $x1 = explode('.', $secondaryLogo);
	    $nama1=strtolower(current($x1));
	    $ekstensi1 = strtolower(end($x1));
	    $secondaryLogoBaru="logo.".$ekstensi1;
	    $ukuran1 = $_FILES['secondaryLogo']['size'];
	    $file_tmp1 = $_FILES['secondaryLogo']['tmp_name'];
	    if(in_array($ekstensi1, $ekstensi_diperbolehkan) === true){
		    if($ukuran1 < $maxFile){      
		      	if (move_uploaded_file($file_tmp1, $path.$secondaryLogoBaru)) { 
		      		$b=1;
		        }else{
		        	$b=0;
		        }    
		    }else{?>
		    	<script type="text/javascript">
	                alertify.alert("File Secondary Logo Terlalu Besar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
		    <?php
		    }
	    }else{?>
	    	<script type="text/javascript">
	            alertify.alert("Tipe File Secondary Logo Tidak Didukung", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	    <?php
	    }

	    //ugdLogo
	    $ugdLogo = $_FILES['ugdLogo']['name'];
	    $x2 = explode('.', $ugdLogo);
	    $nama2=strtolower(current($x2));
	    $ekstensi2 = strtolower(end($x2));
	    $ugdLogoBaru="ugd.".$ekstensi2;
	    $ukuran2 = $_FILES['ugdLogo']['size'];
	    $file_tmp2 = $_FILES['ugdLogo']['tmp_name'];
	    if(in_array($ekstensi2, $ekstensi_diperbolehkan) === true){
		    if($ekstensi2 < $maxFile){      
		      	if (move_uploaded_file($file_tmp1, $path.$ugdLogoBaru)) { 
		      		$c=1;
		        }else{
		        	$c=0;
		        }    
		    }else{?>
		    	<script type="text/javascript">
	                alertify.alert("File UGD Logo Terlalu Besar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
		    <?php
		    }
	    }else{?>
	    	<script type="text/javascript">
	            alertify.alert("Tipe File UGD Logo Tidak Didukung", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	    <?php
	    }

	    //urcLogo
	    $urcLogo = $_FILES['urcLogo']['name'];
	    $x3 = explode('.', $urcLogo);
	    $nama3=strtolower(current($x3));
	    $ekstensi3 = strtolower(end($x3));
	    $urcLogoBaru="urc.".$ekstensi3;
	    $ukuran3 = $_FILES['urcLogo']['size'];
	    $file_tmp3 = $_FILES['urcLogo']['tmp_name'];
	    if(in_array($ekstensi3, $ekstensi_diperbolehkan) === true){
		    if($ekstensi3 < $maxFile){      
		      	if (move_uploaded_file($file_tmp1, $path.$urcLogoBaru)) { 
		      		$d=1;
		        }else{
		        	$d=0;
		        }    
		    }else{?>
		    	<script type="text/javascript">
	                alertify.alert("File UGD Logo Terlalu Besar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
		    <?php
		    }
	    }else{?>
	    	<script type="text/javascript">
	            alertify.alert("Tipe File UGD Logo Tidak Didukung", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	    <?php
	    }

	    //pasenLogo
	    $pasenLogo = $_FILES['pasenLogo']['name'];
	    $x4 = explode('.', $pasenLogo);
	    $nama4=strtolower(current($x4));
	    $ekstensi4 = strtolower(end($x4));
	    $pasenLogoBaru="pasen.".$ekstensi4;
	    $ukuran4 = $_FILES['pasenLogo']['size'];
	    $file_tmp4 = $_FILES['pasenLogo']['tmp_name'];
	    if(in_array($ekstensi4, $ekstensi_diperbolehkan) === true){
		    if($ekstensi4 < $maxFile){      
		      	if (move_uploaded_file($file_tmp1, $path.$pasenLogoBaru)) { 
		      		$e=1;
		        }else{
		        	$e=0;
		        }    
		    }else{?>
		    	<script type="text/javascript">
	                alertify.alert("File PASEN Logo Terlalu Besar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
		    <?php
		    }
	    }else{?>
	    	<script type="text/javascript">
	            alertify.alert("Tipe File PASEN Logo Tidak Didukung", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	    <?php
	    }

	    //posyanduLogo
	    $posyanduLogo = $_FILES['posyanduLogo']['name'];
	    $x5 = explode('.', $posyanduLogo);
	    $nama5=strtolower(current($x5));
	    $ekstensi5 = strtolower(end($x5));
	    $posyanduLogoBaru="posyandu.".$ekstensi5;
	    $ukuran5 = $_FILES['posyanduLogo']['size'];
	    $file_tmp5 = $_FILES['posyanduLogo']['tmp_name'];
	    if(in_array($ekstensi5, $ekstensi_diperbolehkan) === true){
		    if($ekstensi5 < $maxFile){      
		      	if (move_uploaded_file($file_tmp1, $path.$posyanduLogoBaru)) { 
		      		$f=1;
		        }else{
		        	$f=0;
		        }    
		    }else{?>
		    	<script type="text/javascript">
	                alertify.alert("File POSYANDU Logo Terlalu Besar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
		    <?php
		    }
	    }else{?>
	    	<script type="text/javascript">
	            alertify.alert("Tipe File POSYANDU Logo Tidak Didukung", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	    <?php
	    }

	    //apotekLogo
	    $apotekLogo = $_FILES['apotekLogo']['name'];
	    $x6 = explode('.', $apotekLogo);
	    $nama6=strtolower(current($x6));
	    $ekstensi6 = strtolower(end($x6));
	    $apotekLogoBaru="apotik.".$ekstensi6;
	    $ukuran6 = $_FILES['apotekLogo']['size'];
	    $file_tmp6 = $_FILES['apotekLogo']['tmp_name'];
	    if(in_array($ekstensi6, $ekstensi_diperbolehkan) === true){
		    if($ekstensi6 < $maxFile){      
		      	if (move_uploaded_file($file_tmp1, $path.$apotekLogoBaru)) { 
		      		$g=1;
		        }else{
		        	$g=0;
		        }    
		    }else{?>
		    	<script type="text/javascript">
	                alertify.alert("File APOTIK Logo Terlalu Besar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
		    <?php
		    }
	    }else{?>
	    	<script type="text/javascript">
	            alertify.alert("Tipe File APOTIK Logo Tidak Didukung", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	    <?php
	    }

	    //vaksinLogo
	    $vaksinLogo = $_FILES['vaksinLogo']['name'];
	    $x7 = explode('.', $vaksinLogo);
	    $nama7=strtolower(current($x7));
	    $ekstensi7 = strtolower(end($x7));
	    $vaksinLogoBaru="vaksin.".$ekstensi7;
	    $ukuran7 = $_FILES['vaksinLogo']['size'];
	    $file_tmp7 = $_FILES['vaksinLogo']['tmp_name'];
	    if(in_array($ekstensi7, $ekstensi_diperbolehkan) === true){
		    if($ekstensi7 < $maxFile){      
		      	if (move_uploaded_file($file_tmp1, $path.$vaksinLogoBaru)) { 
		      		$h=1;
		        }else{
		        	$h=0;
		        }    
		    }else{?>
		    	<script type="text/javascript">
	                alertify.alert("File APOTIK Logo Terlalu Besar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	            </script>
		    <?php
		    }
	    }else{?>
	    	<script type="text/javascript">
	            alertify.alert("Tipe File APOTIK Logo Tidak Didukung", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        </script>
	    <?php
	    }

	    if ($a=1&&$b=1&&$c=1&&$d=1&&$e=1&&$f=1&&$g=1&&$h=1) {
			$update=mysql_query("UPDATE tb_settings SET `primary_logo`='$primaryLogoBaru', `secondary_logo`='$secondaryLogoBaru', `ugd`='$ugdLogoBaru', `urc`='$urcLogoBaru', `posyandu`='$posyanduLogoBaru', `pasen`='$pasenLogoBaru', `apotik`='$apotekLogoBaru', `vaksin`='$vaksinLogoBaru'") or die(mysql_error());
	    	if ($update) {
	    	?>
	    		<script type="text/javascript">
	            	alertify.alert("Sukses Ubah Gambar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        	</script>
	    	<?php
	    	}else{
	    	?>
	    		<script type="text/javascript">
	            	alertify.alert("Gagal Ubah Gambar", function(){ window.location.assign('../settings_image'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        	</script>
	    	<?php
	    	}
	    }
		
    }

    if (isset($_POST['updateSosmed'])) {
    	$facebook=$_POST['facebook'];
		$twitter=$_POST['twitter'];
		$instagram=$_POST['instagram'];
		$update=mysql_query("UPDATE tb_settings SET `facebook`='$facebook', `twitter`='$twitter', `instagram`='$instagram'") or die(mysql_error());
	    	if ($update) {
	    	?>
	    		<script type="text/javascript">
	            	alertify.alert("Berhasil", function(){ window.location.assign('../settings_sosmed'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        	</script>
	    	<?php
	    	}else{
	    	?>
	    		<script type="text/javascript">
	            	alertify.alert("Gagal", function(){ window.location.assign('../settings_sosmed'); }).setHeader(' ').set({closable:false,transition:'pulse'});
	        	</script>
	    	<?php
	    	}
    }
?>