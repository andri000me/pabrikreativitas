<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" type="image/ico" href="../../admin/assets/images/icon/favicon.ico" />
	<link href="../../assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">
	<link href="../../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="../../assets/user_admin/js/alertify.min.js"></script>
</head>
<body>
<?php 
	session_start();
	include '../../database/koneksi.php';
	if (isset($_POST['login'])) {
		$email=$_POST['email'];
		$password=$_POST['password'];

		$login=mysql_query("SELECT id_user, password FROM tb_user WHERE username='$email' OR email='$email' AND password='$password';");
		$hasil = mysql_fetch_array($login);

		if(mysql_num_rows($login) == 0) {
		        ?>
		            <script language="JavaScript">
		                alertify.alert("Username Belum Terdaftar", function(){ window.location.assign('login'); }).setHeader(' ').set({closable:false,transition:'pulse'});
		            </script>
		        <?PHP
		      } else{
			        if($password <> $hasil['password']) {
			        ?>
			            <script language="JavaScript">
			                alertify.alert("Password Salah", function(){ window.location.assign('login'); }).setHeader(' ').set({closable:false,transition:'pulse'});
			            </script>
			        <?PHP
			        } else{
				        $_SESSION['idUser'] = $hasil['id_user'];
				        ?>
				            <script type="text/javascript">
								alertify.alert("Selamat Datang", function(){window.location.assign('../home')}).setHeader(' ').set({closable:false,transition:'fade'});
							</script>
				        <?PHP
			        }
		      }
	}
?>
</body>
</html>