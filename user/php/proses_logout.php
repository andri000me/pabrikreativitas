<?php
   session_start();
   unset($_SESSION['idUser']);
?>
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
<script language="JavaScript">
	alertify.alert("Terimakasih Banyak", function(){ window.location.assign('../../home'); }).setHeader(' ').set({closable:false,transition:'fade'});
</script>