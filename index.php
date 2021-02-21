<?php
	include 'database/koneksi.php';
	$qSet=mysql_query("SELECT * FROM tb_settings");
    $Settings=mysql_fetch_array($qSet);
    if ($Settings['maintenance']=='1') {
       ?>
       	<script type="text/javascript">
		    window.location.assign('maintenance');
		</script>
       <?php
    }else{
    	?>
       	<script type="text/javascript">
		    window.location.assign('home');
		</script>
       <?php
    }
?>