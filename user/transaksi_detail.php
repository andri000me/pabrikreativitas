<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="../admin/assets/images/icon/favicon.ico" />
        <title>Pabrik Kreativitas | List Transaksi</title>

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
    if ($profil['jenis_kelamin']==1) {
        $jenisKelamin='Laki-laki';
    }else{
        $jenisKelamin='Perempuan';
    }
    if (isset($_GET['iv'])) {
        $iv=$_GET['iv'];
        $tr=mysql_query("SELECT no_invoice,status FROM tb_transaksi WHERE MD5(tb_transaksi.no_invoice)='$iv' LIMIT 1");
        $data=mysql_fetch_array($tr);
        
    }
    ?>
        <div class="box">
            <section id="profil" class="home-margin m-t-20">
                <div class="container">   
                <div class="row">
                    <div class="col-lg-10">
                        <h4 class="header-title">List Transaksi Anda</h4>
                    </div>
                </div>                 
                
                    <div class="row ">
                        <?php                                               
                            $cek=mysql_num_rows($tr);
                            if ($cek<=0) { ?>
                                <div class="col-md-12 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                            <div class="card-border">                                                
                                                <div class="row clearfix"> 
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="text-center">         
                                                            <h4>Oops..</h4>
                                                            <h5>Ayo lakukan Transaksi</h5>
                                                            <br>
                                                            <div class="mini-menu">
                                                                <a href="../ugd?page=1&k=all">UGD</a>
                                                                <a href="../urc?page=1&k=all">URC</a>
                                                                <a href="../pasen?page=1&k=all">PASEN</a>
                                                            </div>
                                                        </div>
                                                    </div>                                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>            
                                </div>
                            <?php  

                            }else{
                                    $noInvoice=$data['no_invoice'];
                                    $code=substr($noInvoice,4,1);
                                    switch ($code) {
                                        case 'D':
                                            $query=mysql_query("SELECT nama_desain, sub_total, gambar_desain, qty, tb_transaksi.status, tgl_transaksi, tgl_pembayaran, no_resi, kurir, ongkir, catatan FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain JOIN tb_gambar_desain ON tb_desain.id_desain=tb_gambar_desain.id_desain WHERE tb_transaksi.no_invoice='$noInvoice' LIMIT 1") or die(mysql_error());
                                            $data1=mysql_fetch_array($query);
                                            $namaItem=$data1['nama_desain'];
                                            $noResi=$data1['no_resi'];
                                            $tglTransaksi=$data1['tgl_transaksi'];
                                            $tglPembayaran=$data1['tgl_pembayaran'];
                                            $qty=$data1['qty'];
                                            $catatan=$data1['catatan'];
                                            $ongkir=$data1['kurir']." - ".rupiah($data1['ongkir']);
                                            $hargaItem=$data1['sub_total'];
                                            $gambar='../admin/assets/images/ugd/'.$data1['gambar_desain'];
                                            break;
                                        case 'J':
                                            $query=mysql_query("SELECT judul_jobs, sub_total, gambar_jobs, qty, tb_transaksi.status, tgl_transaksi, tgl_pembayaran, no_resi, kurir, ongkir, catatan FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs JOIN tb_gambar_jobs ON tb_jobs.id_jobs=tb_gambar_jobs.id_jobs WHERE tb_transaksi.no_invoice='$noInvoice' LIMIT 1") or die(mysql_error());
                                            $data1=mysql_fetch_array($query);
                                            $namaItem=$data1['judul_jobs'];
                                            $noResi=$data1['no_resi'];
                                            $tglTransaksi=$data1['tgl_transaksi'];
                                            $tglPembayaran=$data1['tgl_pembayaran'];
                                            $qty=$data1['qty'];
                                            $catatan=$data1['catatan'];
                                            $ongkir=$data1['kurir']." - ".rupiah($data1['ongkir']);
                                            $hargaItem=$data1['sub_total'];
                                            $gambar='../admin/assets/images/portofolio/'.$data1['gambar_jobs'];
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                    switch ($data['status']) {
                                        case '1':
                                            $tampil='display:none';
                                            $tampil1='display:none';
                                            break;
                                        case '2':
                                            $tampil='display:none';
                                            $tampil1='display:none';
                                            break;
                                        case '3':
                                            $tampil='display:block';
                                            $tampil1='display:none';
                                            break;
                                        case '4':
                                            $tampil='display:none';
                                            $tampil1='display:none';
                                            break;
                                        case '5':
                                            $tampil='display:none';
                                            $tampil1='display:none';
                                            break;
                                        case '6':
                                            $tampil='display:none';
                                            $tampil1='display:none';
                                            break;
                                        case '7':
                                            $tampil='display:none';
                                            $tampil1='display:block';
                                            break;
                                        default:
                                            $tampil='display:none';
                                            $tampil1='display:none';
                                            break;
                                    }
                                    ?>
                                        <div class="col-md-12 p-t-2">          
                                            <div class="card card-border card-cursor">                                 
                                                <div class="row clearfix">
                                                    <div class="col-sm-12 col-lg-4">
                                                        <img src="<?=$gambar;?>" class="img-keranjang img-thumbnail pull-left">                       
                                                    </div> 
                                                    <div class="col-sm-12 col-lg-8">
                                                        <div class="detail-box">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <label>No Invoice</label>
                                                                    <p><?=$noInvoice;?></p> 
                                                                    <label>Item</label>
                                                                    <p><?=$namaItem;?></p> 
                                                                    <label>Harga</label>
                                                                    <p><?=rupiah($hargaItem);?></p>
                                                                    <label>Jumlah Beli</label>
                                                                    <p><?=$qty;?></p>
                                                                </div>  
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <label>Tanggal Transaksi</label>
                                                                    <p><?=tanggal($tglTransaksi);?></p> 
                                                                    <label>Tanggal Pembayaran</label>
                                                                    <p><?=tanggal($tglPembayaran);?></p>
                                                                    <label>Ongkir</label>
                                                                    <p><?=$ongkir;?></p>
                                                                    <label>Catatan</label>
                                                                    <p><?=$catatan;?></p>
                                                                </div>      

                                                                <form method="POST" action="php/proses_transaksi.php">
                                                                    <input type="hidden" name="noInvoice" value="<?=$noInvoice;?>">
                                                                    <center>
                                                                        <button type="submit" name="proses" class="btn btn-sm btn-primary" style="<?=$tampil;?>">Proses</button>
                                                                        <button type="button" class="btn btn-sm btn-success" onclick="tampil()" style="<?=$tampil1;?>" >Set Resi</button>
                                                                        <div id="resi">
                                                                            <div class="form-group" style="width: 40%;">
                                                                                <input type="text" name="noResi" id="kirim" class="form-control"  style="display: none; margin-top: 5px;">
                                                                                <button type="submit" name="updateResi" id="kirim1" class="btn btn-sm btn-primary"  style="display: none; margin-top: 5px;">Kirim</button>
                                                                            </div> 
                                                                    </center>
                                                                </form>
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
        <script type="text/javascript">
            function tampil(){
                document.getElementById('kirim').style.display='block';
                document.getElementById('kirim1').style.display='block';
            }
            function panggil(iv){
                window.location.assign('transaksi_detail?iv='+iv);
            }
            function sort(n){
                if (n=='8') {
                    window.location.assign('list_transaksi');
                }else{
                    window.location.assign('?st='+n);
                }
            }
            function lanjut(iv,st){
                switch(st) {
                  case '1':
                    window.location.assign('payment_checkout?iv='+iv);
                    break;
                  case '2':
                    var ongkir=10000;
                    break;
                  case '3':
                    var ongkir=10000;
                    break;
                  default:
                    window.location.assign('checkout?iv='+iv);
                    break;
                }
                
            }
        </script>
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