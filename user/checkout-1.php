<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="../admin/assets/images/icon/favicon.ico" />
        <title>Pabrik Kreativitas</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="../assets/user_admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- Owl Carousel CSS -->
        <link href="../assets/user_admin/css/owl.carousel.css" rel="stylesheet">
        <link href="../assets/user_admin/css/owl.theme.default.min.css" rel="stylesheet">

        <!-- Icon CSS -->
        <link href="../assets/user_admin/css/ionicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Alertify -->
        <link href="../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
        <script src="../assets/user_admin/js/alertify.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="../assets/user_admin/css/style_user.css" rel="stylesheet">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body data-spy="scroll" data-target="#navbar-menu">

    <?php 
    include '../database/koneksi.php';
    include 'part/header_menu.php'; 
    $qProfil=mysql_query("SELECT * FROM tb_user WHERE id_user='$idUser'");
    $profil=mysql_fetch_array($qProfil);
    $qKeranjang=mysql_query("SELECT * FROM tb_keranjang WHERE id_user='$idUser'");
    $keranjang=mysql_fetch_array($qKeranjang);
    $idKeranjang=$keranjang['id_keranjang'];
    $qItem=mysql_query("SELECT * FROM tb_detail_keranjang JOIN tb_desain ON tb_detail_keranjang.id_item=tb_desain.id_desain WHERE id_keranjang='$idKeranjang'") or die(mysql_error());
    ?>
        <div class="box">
            <section id="profil" class="home-margin m-t-20">
                <div class="container-fluid">                    
                <h4 class="header-title">Checkout</h4>
                    <div class="row ">
                        <?php 
                            
                            
                            $cek=mysql_num_rows($qItem);
                            if ($cek<=0) {   
                            	echo "<script>window.location.assign('keranjang')</script>";
                            }else{ ?>

                            	<div class="col-lg-8 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                        	<?php
                                        		while ($itemKeranjang=mysql_fetch_array($qItem)) {
			                                    $idDesain=$itemKeranjang['id_desain'];
			                                    $namaDesain=$itemKeranjang['nama_desain'];
			                                    $qGambar=mysql_fetch_array(mysql_query("SELECT * FROM tb_gambar_desain WHERE id_desain='$idDesain' LIMIT 1"));
			                                    $gambar='../admin/assets/images/ugd/'.$qGambar['gambar_desain'];

			                                ?>
	                                            <div class="card-border">                                                
	                                                <div class="row clearfix">
                                                        <div class="col-sm-12 col-lg-4">
                                                            <img src="<?=$gambar;?>" class="img-keranjang img-thumbnail pull-left">
                                                                
                                                        </div> 
                                                        <div class="col-sm-12 col-lg-8">
                                                            <div>         
                                                                <h4><?=$namaDesain;?></h4>                        
                                                                <h4><?=rupiah($itemKeranjang['total']);?></h4>
                                                                <h5><?=$itemKeranjang['qty'];?> Buah</h5>
                                                            </div>
                                                        </div>                                            
                                                    </div>
	                                            </div>	
                                                <br>		                                
			                                <?php
			                                }
                                        	?>
                                        </div>
                                    </div> 
                                    <div class="card c-t-1">
                                        <div class="card-container">
                                            <div class="card-border">                                                
                                                <div class="row clearfix"> 
                                                    <div class="col-sm-12 col-lg-12">
                                                        <h5 class="text-left">Data Pembeli <small>Dapat diubah melalui edit profil</small></h5><hr>
                                                        <div class="row">
                                                        	<div class="col-sm-12 col-lg-6">
		                                                        <div class="form-group">
		                                                        	<label>Nama Pembeli</label>
		                                                        	<input type="text" name="nmPembeli" class="form-control" value="<?=$profil['nama_user'];?>" readonly>
		                                                        </div>                                   		
                                                        	</div>
                                                        	<div class="col-sm-12 col-lg-6">	 
		                                                        <div class="form-group">
		                                                        	<label>Nomor Telepon</label>
		                                                        	<input type="number" name="noTelp" class="form-control" value="<?=$profil['no_hp'];?>" readonly>
		                                                        </div>
		                                                    </div>
                                                        </div>
		                                                    <div class="form-group">
		                                                     	<label>Alamat</label>
		                                                     	<textarea class="form-control" name="alamat" readonly><?=$profil['alamat'];?></textarea>
		                                                    </div>
                                                    </div>                                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>           
                                </div>
                                <div class="col-lg-4 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                            <div class="card-border">                                                
                                                <div class="row clearfix"> 
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="text-left">         
                                                            <div class="form-group">
                                                            	<h5>Jasa Pengiriman</h5>
                                                            	<select name="kurir" class="form-control">
                                                            		<option value="jne">JNE</option>
                                                            		<option value="pos">POS</option>
                                                            		<option value="tiki">TIKI</option>
                                                            		<option value="sicepat">SICEPAT</option>
                                                            	</select>
                                                            </div>
                                                            <div class="form-group">
                                                            	<h5>Ongkos Kirim</h5>
                                                            	<input type="text" name="ongkir" class="form-control" value="Rp. 11.000">
                                                            </div>
                                                            <div class="form-group">
                                                            	<h5>Pembayaran Bank</h5>
                                                            	<select name="kurir" class="form-control">
                                                            		<option value="bni">BNI - 1234567891011</option>
                                                            		<option value="bri">BRI - 1234567891012</option>
                                                            	</select>
                                                            </div>
                                                            <h4>Total</h4>
                                                            <h4><?=rupiah(16000);?></h4>

                                                            <button class="btn btn-sm bg-btn-success"><span class="ion-pricetags"></span> Bayar</button>
                                                            <button class="btn btn-sm bg-btn-danger" onclick="window.history.go(-1);"><i class="ion-close" style="margin-right: 10px;"></i> Batalkan</button>
                                                            
                                                        </div>
                                                    </div>                                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>            
                                </div>
                            <?php
                            }

                        ?>
                    </div>
                </div>
            </section>
        
        </div>
        <?php include 'part/footer.php'; ?>


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../assets/user_admin/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/user_admin/js/bootstrap.min.js"></script>

        <!-- Jquery easing -->                                                      
        <script type="text/javascript" src="../assets/user_admin/js/jquery.easing.1.3.min.js"></script>

        <!-- Owl Carousel -->                                                      
        <script type="text/javascript" src="../assets/user_admin/js/owl.carousel.min.js"></script>

        <!--sticky header-->
        <script type="text/javascript" src="../assets/user_admin/js/jquery.sticky.js"></script>

        <!--common script for all pages-->
        <script src="../assets/user_admin/js/jquery.app.js"></script>

        <script type="text/javascript">
            function hapus(ik,it,nm){
                alertify.confirm('Perhatian', 'Anda Yakin Akan Menghapus '+nm, function(){ window.location.assign('php/proses_desain?hps=1&ik='+ik+'&it='+it) }
                , function(){}).set({closable:false,transition:'pulse'});
            }
        </script>

    </body>
</html>