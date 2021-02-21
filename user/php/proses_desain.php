<!DOCTYPE html>
<html>
<head>
	<title>Desain</title>
	<link rel="icon" type="image/ico" href="../../admin/assets/images/icon/favicon.ico" />
	<link href="../../assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">
	<link href="../../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
    <script src="../../assets/user_admin/js/alertify.min.js"></script>
</head>
<body>
	<?php
		session_start();
		include '../../database/koneksi.php';
		if (isset($_POST['favorit'])) {
			$idDesain=$_POST['idDesain'];
			$favorit=mysql_query("UPDATE tb_desain SET favorit=favorit+1 WHERE id_desain='$idDesain'");
			if ($favorit) {
				echo "<script>window.history.go(-1);</script>";
			}
		}

		//keranjang dulu
		/*if (isset($_GET['id'],$_GET['q'],$_GET['i'],$_GET['t'],$_GET['cg'],$_GET['txt'])) {
			$qty=$_GET['q'];
			$idUser=$_GET['id'];
			$item=$_GET['i'];
			$bgColor=$_GET['cg'];
			$csText=$_GET['txt'];
			$total=$_GET['t'];

			$qKeranjang=mysql_query("SELECT id_keranjang FROM tb_keranjang WHERE id_user='$idUser'");
			$keranjang=mysql_fetch_array($qKeranjang);
			$idKeranjang=$keranjang['id_keranjang'];

			//cari item sama
			$qItem=mysql_query("SELECT id_keranjang FROM tb_detail_keranjang WHERE id_item='$item' AND id_keranjang='$idKeranjang'");
			$rItem=mysql_num_rows($qItem);
			if ($rItem<1) {
				$insertKeranjang=mysql_query("INSERT INTO tb_detail_keranjang (id_keranjang, id_item, color_background, custom_text, qty, total) VALUES ('$idKeranjang','$item', '$bgColor', '$csText', '$qty','$total')");
				if ($insertKeranjang) {
					?>
			            <script type="text/javascript">
							window.location.assign('../../user/keranjang');
						</script>
			        <?php
				}else{
					?>
			            <script type="text/javascript">
							alertify.alert("Gagal", function(){window.history.go(-1)}).setHeader(' ').set({closable:false,transition:'fade'});
						</script>
			        <?php
				}
			}else{
				$updateKeranjang=mysql_query("UPDATE tb_detail_keranjang SET qty=qty+'$qty', total=total+'$total' WHERE id_item='$item' AND id_keranjang='$idKeranjang'");
				if ($updateKeranjang) {
					?>
			            <script type="text/javascript">
							window.location.assign('../../user/keranjang');
						</script>
			        <?php
				}else{
					?>
			            <script type="text/javascript">
							alertify.alert("Gagal", function(){window.history.go(-1)}).setHeader(' ').set({closable:false,transition:'fade'});
						</script>
			        <?php
				}
			}

		}*/
		
		//langsung bayar
		if (isset($_GET['kd'])) {
			$qty=$_GET['q'];
			$idUser=$_GET['id'];
			$item=$_GET['i'];
			$bgColor=$_GET['cg'];
			$cat=$_GET['cat'];
			$total=$_GET['t'];

			$tgl_transaksi=date("Y-m-d");
			$date=date("dmY");
			$urut=mysql_num_rows(mysql_query("SELECT no_invoice FROM tb_transaksi WHERE SUBSTR(no_invoice,5,1)='D'"))+1;
			$noInvoice="INV-D/".$date."/".date("Y")."/".$urut;

			$masukTransaksi=mysql_query("INSERT INTO `tb_transaksi` (`no_invoice`, `id_user`, `tgl_transaksi`, `sub_total`, `bukti_transfer`, `tgl_pembayaran`, `kurir`, `ongkir`,`id_bank`, `no_resi`, `status`, `keterangan`) VALUES ('$noInvoice', '$idUser', '$tgl_transaksi', '$total', '', '', '', '', '', '', '0', '')") or die(mysql_error());
			$masukItem=mysql_query("INSERT INTO `tb_detail_transaksi` (`no_invoice`, `id_item`, `qty`, `catatan`, `file`, `format`) VALUES ('$noInvoice', '$item', '$qty', '$cat', '-', '-')") or die(mysql_error());

			if ($masukTransaksi&&$masukItem) {
				$mdInvoice=md5($noInvoice);
				echo "<script>window.location.assign('../checkout?iv=".$mdInvoice."')</script>";
			}
		}

		if (isset($_GET['hps'])) {
			$idKeranjang=$_GET['ik'];
			$idItem=$_GET['it'];

			$hapusItem=mysql_query("DELETE FROM tb_detail_keranjang WHERE id_keranjang='$idKeranjang' AND id_item='$idItem'");
			if ($hapusItem) {
				echo "<script>window.location.assign('../keranjang');</script>";
			}else{
				?>
			        <script type="text/javascript">
						alertify.alert("Gagal", function(){window.history.go(-1)}).setHeader(' ').set({closable:false,transition:'fade'});
					</script>
			    <?php
			}
		}
	?>
</body>
</html>