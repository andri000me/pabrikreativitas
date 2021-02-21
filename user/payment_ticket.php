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
    $mdInv=$_GET['tiket'];
    $qItem=mysql_query("SELECT no_tiket, tgl_transaksi FROM tb_transaksi_visit  WHERE md5(no_tiket)='$mdInv'") or die(mysql_error());
    $item=mysql_fetch_array($qItem);
    ?>
        <div class="box">
            <form method="POST" action="php/proses_tiket.php" enctype="multipart/form-data">
            <section id="profil" class="home-margin m-t-20">
                <div class="container-fluid">                    
                <h4 class="header-title">Payment Checkout</h4>
                    <div class="row ">
                        <?php                   
                            $cek=mysql_num_rows($qItem);
                            if ($cek<=0) {   
                            	echo "Silahkan Lakukan Pembelian";
                            }else{ ?>

                            	<div class="col-lg-8 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                        	<?php
                                        		$mdInvo=$_GET['tiket'];
                                                if ($mdInvo!=$mdInv) {
                                                    echo "<script>window.location.assign('list_transaksi');</script>";
                                                }else{
                                                    $noInvoice=$item['no_tiket'];
                                                    $code=substr($noInvoice,4,1);
                                                    $query=mysql_query("SELECT * FROM tb_transaksi_visit JOIN tb_visit ON tb_transaksi_visit.id_visit=tb_visit.id_visit JOIN tb_gambar_visit ON tb_visit.id_visit=tb_gambar_visit.id_visit JOIN tb_user ON tb_transaksi_visit.id_user=tb_user.id_user JOIN tb_bank ON tb_transaksi_visit.id_bank=tb_bank.id_bank WHERE no_tiket='$noInvoice' LIMIT 1") or die(mysql_error());
                                                    $result=mysql_fetch_array($query);
                                                    $namaItem=$result['nama_visit'];
                                                    $hargaItem=$result['biaya'];
                                                    $total=$hargaItem;
                                                    $namaBank=$result['nama_bank'];
                                                    $noRek=$result['no_rek'];
                                                    $namaPemilikRek=$result['nama_pemilik'];
                                                    $tglBayar=$result['tgl_bayar'];
                                                    $tglTransaksi=$result['tgl_transaksi']; 
                                                    $idUser='';
                                                    $gambar='../admin/assets/images/poster/'.$result['gambar_visit'];
                                                    ?>
    	                                            <div class="card-border">
                                                    <input type="hidden" name="noTiket" value="<?=$noInvoice;?>">                      
    	                                                <div class="row clearfix">
                                                            <div class="col-sm-12 col-lg-4">
                                                                <img src="<?=$gambar;?>" class="img-keranjang img-thumbnail pull-left">
                                                                    
                                                            </div> 
                                                            <div class="col-sm-12 col-lg-8">
                                                                <div>         
                                                                    <h4><?=$namaItem;?></h4>  
                                                                    <h5><i class="fa fa-credit-card-alt"></i> <?=rupiah($hargaItem);?></h5>   
                                                                    <h4><small><i class="fa fa-calendar"></i> <?=tanggal($result['tgl_visit']);?></small></h4>
                                                                    <h4><small><i class="ion-location"></i> <?=$result['lokasi'];?></small></h4>
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
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-12">
                                                                    <h5>Pembayaran Bank</h5>
                                                                    <h5><?=$result['nama_bank']." - ".$result['no_rek']." a/n ".$result['nama_pemilik'];?></h5>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <h4>Total</h4>
                                                                <h4><?=rupiah($total);?></h4>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group">
                                                                <h5>Upload Bukti Pembayaran</h5>
                                                                <input type="file" name="buktiPembayaran" class="form-control">
                                                            </div>

                                                            <button class="btn btn-sm bg-btn-success" type="submit" name="uploadTransaksi"><span class="fa fa-upload"></span> Upload</button>                                                            
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
            </form>
        </div>
        <?php include 'part/footer.php'; ?>

        <script type="text/javascript">
            function hitungOngkir(kurir){
                switch(kurir) {
                  case 'jne':
                    var ongkir=11000;
                    break;
                  case 'pos':
                    var ongkir=10000;
                    break;
                  case 'tiki':
                    var ongkir=10000;
                    break;
                  case 'sicepat':
                    var ongkir=11000;
                    break;
                }
                document.getElementById('ongkir').innerHTML='Rp. '+rupiah(ongkir);
                document.getElementById('ongkir1').value=ongkir;
                var harga=document.getElementById('hgItem').value;
                var total=parseInt(harga)+parseInt(ongkir); 
                document.getElementById('total').innerHTML='Rp. '+rupiah(total);      
            }
            const rupiah = (x) => {
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        </script>

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