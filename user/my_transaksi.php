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
    $qTransaksi=mysql_query("SELECT tb_transaksi.no_invoice, tgl_transaksi, nama_desain, harga, qty, tb_transaksi.status FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain WHERE tb_desain.pemilik='$idUser' AND tb_transaksi.status>='3' ORDER BY no_invoice DESC");
    ?>
        <div class="box">
            <section id="profil" class="home-margin m-t-20">
                <div class="container">   
                <div class="row">
                    <div class="col-lg-10">
                        <h4 class="header-title">List Pesanan Anda</h4>
                    </div>
                </div>                 
                
                    <div class="row ">
                        <?php                                               
                            $cek=mysql_num_rows($qTransaksi);
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
                                while ($dataTransaksi=mysql_fetch_array($qTransaksi)) {
                                    $noInvoice=$dataTransaksi['no_invoice'];
                                    $qGambar=mysql_query("SELECT gambar_desain FROM tb_detail_transaksi JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain JOIN tb_gambar_desain ON tb_desain.id_desain=tb_gambar_desain.id_desain WHERE no_invoice='$noInvoice'");
                                    $dGambar=mysql_fetch_array($qGambar);
                                    $tglTransaksi=$dataTransaksi['tgl_transaksi'];
                                    $mdInv=md5($noInvoice);                                    
                                    $namaItem=$dataTransaksi['nama_desain'];
                                    $hargaItem=$dataTransaksi['harga']*$dataTransaksi['qty'];;
                                    $gambar='../admin/assets/images/ugd/'.$dGambar['gambar_desain'];
                                    switch ($dataTransaksi['status']) {
                                        case '1':
                                            $label='label label-default';
                                            $txtLabel='Belum Dibayar';
                                            $btnColor='bg-btn-dark';
                                            $btnText='Bayar Transaksi';
                                            break;
                                        case '2':
                                            $label='label label-default';
                                            $txtLabel='Menunggu Konfirmasi';
                                            $btnColor='bg-btn-dark display-none';
                                            $btnText='';
                                            break;
                                        case '3':
                                            $label='label label-success';
                                            $txtLabel='Telah Dibayar';
                                            $btnColor='btn-success display-none';
                                            $btnText='';
                                            break;
                                        case '4':
                                            $label='label label-danger';
                                            $txtLabel='Gagal / Dibatalkan';
                                            $btnColor='btn-danger display-none';
                                            $btnText='';
                                            break;
                                        case '5':
                                            $label='label label-info';
                                            $txtLabel='Di Kirim';
                                            $btnColor='btn-info display-none';
                                            $btnText='';
                                            break;
                                        case '6':
                                            $label='label label-primary';
                                            $txtLabel='Selesai';
                                            $btnColor='btn-primary display-none';
                                            $btnText='';
                                            break;
                                        case '7':
                                            $label='label label-default';
                                            $txtLabel='Diproses';
                                            $btnColor='btn-primary display-none';
                                            $btnText='';
                                            break;
                                        default:
                                            $label='label label-warning';
                                            $txtLabel='Pending';
                                            $btnColor='btn-warning';
                                            $btnText='Lanjutkan Transaksi';
                                            break;
                                    }
                                    ?>
                                        <div class="col-md-12 p-t-2">          
                                            <div class="card card-border card-cursor" onclick="panggil('<?=$mdInv;?>')">                                 
                                                <div class="row clearfix">
                                                    <div class="col-sm-12 col-lg-4">
                                                        <img src="<?=$gambar;?>" class="img-keranjang img-thumbnail pull-left">                       
                                                    </div> 
                                                    <div class="col-sm-12 col-lg-8">
                                                        <div>       
                                                            <h4><?=$noInvoice;?></h4>  
                                                            <h4><?=$namaItem;?></h4>              
                                                            <h4><?=rupiah($hargaItem);?></h4>

                                                            <h5 class="text-muted"><i class="fa fa-calendar"></i> <?=tanggal($tglTransaksi);?></h5></h5>
                                                            <span class="<?=$label;?>"><?=$txtLabel;?></span>
                                                            <center>
                                                                <button class="btn btn-sm <?=$btnColor;?>" onclick="lanjut('<?=$mdInv;?>','<?=$data['status'];?>')"><?=$btnText;?></button>
                                                            </center>
                                                        </div>
                                                    </div>                                            
                                                </div>
                                            </div>            
                                        </div>
                                    <?php
                                }
                                
                            }

                        ?>
                    </div>
                </div>
            </section>
        
        </div>
        <script type="text/javascript">
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