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
    $mdInv=$_GET['iv'];
    $qItem=mysql_query("SELECT * FROM tb_detail_transaksi JOIN tb_transaksi ON tb_detail_transaksi.no_invoice=tb_transaksi.no_invoice JOIN tb_bank ON tb_transaksi.id_bank=tb_bank.id_bank WHERE md5(tb_transaksi.no_invoice)='$mdInv'") or die(mysql_error());
    $item=mysql_fetch_array($qItem);
    $total=$item['sub_total']+$item['ongkir'];
    ?>
        <div class="box">
            <form method="POST" action="php/proses_checkout" enctype="multipart/form-data">
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
                                        		$mdInvo=$_GET['iv'];
                                                if ($mdInvo!=$mdInv) {
                                                    echo "<script>window.location.assign('list_transaksi');</script>";
                                                }else{
                                                    $noInvoice=$item['no_invoice'];
                                                    $code=substr($noInvoice,4,1);
                                                    switch ($code) {
                                                        case 'D':
                                                            $query=mysql_query("SELECT * FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain JOIN tb_gambar_desain ON tb_desain.id_desain=tb_gambar_desain.id_desain WHERE tb_transaksi.no_invoice='$noInvoice'  LIMIT 1") or die(mysql_error()); 
                                                            $result=mysql_fetch_array($query);
                                                            $namaItem=$result['nama_desain'];
                                                            $hargaItem=$result['harga'];
                                                            $gambar='../admin/assets/images/ugd/'.$result['gambar_desain'];
                                                            $qty=$result['qty']; 
                                                            $catatan=$result['catatan'];
                                                            break;
                                                        case 'C':
                                                            $query=mysql_query("SELECT * FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_cetak ON tb_detail_transaksi.id_item=tb_cetak.id_cetak WHERE tb_transaksi.no_invoice='$noInvoice' LIMIT 1") or die(mysql_error());
                                                            $result=mysql_fetch_array($query);
                                                            $namaItem=$result['jenis_cetak'];
                                                            $hargaItem=$result['harga'];
                                                            $gambar='../admin/assets/images/urc/'.$result['icon'];
                                                            $kurir=$result['kurir'];
                                                            $qty=$result['qty'];  
                                                            $catatan=$result['catatan'];  
                                                            break; 
                                                        case 'J':
                                                            $query=mysql_query("SELECT * FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs JOIN tb_gambar_jobs ON tb_jobs.id_jobs=tb_gambar_jobs.id_jobs WHERE tb_transaksi.no_invoice='$noInvoice' LIMIT 1") or die(mysql_error());
                                                            $result=mysql_fetch_array($query);
                                                            $namaItem=$result['judul_jobs'];
                                                            $noResi=$result['no_resi'];
                                                            $qty=$result['qty']; 
                                                            $hargaItem=$result['harga']*$result['qty'];
                                                            $catatan=$result['catatan'];
                                                            $gambar='../admin/assets/images/portofolio/'.$result['gambar_jobs'];
                                                            break;              
                                                        default:
                                                            # code...
                                                            break;
                                                    }
                                                    
                                                    ?>
    	                                            <div class="card-border">
                                                    <input type="hidden" name="noInvoice" value="<?=$noInvoice;?>">                      
    	                                                <div class="row clearfix">
                                                            <div class="col-sm-12 col-lg-4">
                                                                <img src="<?=$gambar;?>" class="img-keranjang img-thumbnail pull-left">
                                                                    
                                                            </div> 
                                                            <div class="col-sm-12 col-lg-8">
                                                                <div>         
                                                                    <h4><?=$namaItem;?></h4>                        
                                                                    <h4><?=rupiah($hargaItem);?></h4>
                                                                    <h5>Jumlah Beli : <?=$qty;?></h5>
                                                                    <h5>Catatan : <?=$catatan;?></h5>
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
                                                                <div class="col-sm-12 col-lg-5">
                                                                    <h5>Jasa Pengiriman</h5>
                                                                    <h5><?=strtoupper($result['kurir'])." - ".rupiah($result['ongkir']);?></h5>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-7">
                                                                    <h5>Pembayaran Bank</h5>
                                                                    <h5><?=$item['nama_bank']." - ".$item['no_rek']." a/n ".$item['nama_pemilik'];?></h5>
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