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
    if (isset($_GET['st'])) {
        $status=$_GET['st'];
        $qTransaksi=mysql_query("SELECT no_tiket,tgl_transaksi FROM tb_transaksi_visit WHERE tb_transaksi_visit.id_user='$idUser' AND status='$status'") or die(mysql_error());
    }else{
        $status='';
        $qTransaksi=mysql_query("SELECT no_tiket,tgl_transaksi FROM tb_transaksi_visit WHERE tb_transaksi_visit.id_user='$idUser'") or die(mysql_error());
    }
    ?>
        <div class="box">
            <section id="profil" class="home-margin m-t-20">
                <div class="container">   
                <div class="row">
                    <div class="col-lg-10">
                        <h4 class="header-title">List Transaksi Anda</h4>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-control" onchange="sort(this.value)">
                            <option selected hidden>Status Transaksi</option>
                            <option value="0" <?php if ($status=='0') {echo "selected";} ;?> >Pending</option>
                            <option value="1" <?php if ($status=='1') {echo "selected";} ;?> >Proses</option>
                            <option value="2" <?php if ($status=='2') {echo "selected";} ;?> >Konfirmasi</option>
                            <option value="3" <?php if ($status=='3') {echo "selected";} ;?> >Dibayar</option>
                            <option value="7" <?php if ($status=='7') {echo "selected";} ;?> >Diproses</option>
                            <option value="5" <?php if ($status=='5') {echo "selected";} ;?> >Dikirim</option>
                            <option value="6" <?php if ($status=='6') {echo "selected";} ;?> >Selesai</option>
                            <option value="4" <?php if ($status=='4') {echo "selected";} ;?> >Gagal</option>
                            <option value="8" <?php if ($status=='8') {echo "selected";} ;?> >Tampilkan Semua</option>
                        </select>
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
                                    $noTiket=$dataTransaksi['no_tiket'];
                                    $tglTransaksi=$dataTransaksi['tgl_transaksi'];
                                    $mdInv=md5($noTiket);

                                    $query=mysql_query("SELECT * FROM tb_transaksi_visit JOIN tb_visit ON tb_transaksi_visit.id_visit=tb_visit.id_visit JOIN tb_gambar_visit ON tb_visit.id_visit=tb_gambar_visit.id_visit JOIN tb_user ON tb_transaksi_visit.id_user=tb_user.id_user JOIN tb_bank ON tb_transaksi_visit.id_bank=tb_bank.id_bank WHERE tb_transaksi_visit.no_tiket='$noTiket'") or die(mysql_error());
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
                                    switch ($result['status']) {
                                        case '1':
                                            $label='label label-default';
                                            $txtLabel='Belum Dibayar';
                                            $btnColor='bg-btn-dark';
                                            $btnText='Bayar Transaksi';
                                            $selesai='display:none';
                                            $cetak='display:none';
                                            break;
                                        case '2':
                                            $label='label label-default';
                                            $txtLabel='Menunggu Konfirmasi';
                                            $btnColor='bg-btn-dark display-none';
                                            $btnText='';
                                            $selesai='display:none';
                                            $cetak='display:none';
                                            break;
                                        case '3':
                                            $label='label label-success';
                                            $txtLabel='Telah Dibayar';
                                            $btnColor='btn-success display-none';
                                            $btnText='';
                                            $selesai='display:block';
                                            $cetak='display:none';
                                            break;
                                        case '4':
                                            $label='label label-danger';
                                            $txtLabel='Gagal / Dibatalkan';
                                            $btnColor='btn-danger display-none';
                                            $btnText='';
                                            $selesai='display:none';
                                            $cetak='display:none';
                                            break;
                                        case '6':
                                            $label='label label-primary';
                                            $txtLabel='Selesai';
                                            $btnColor='btn-primary display-none';
                                            $btnText='';
                                            $selesai='display:none';
                                            $cetak='display:block';
                                            break;
                                        case '7':
                                            $label='label label-default';
                                            $txtLabel='Diproses';
                                            $btnColor='btn-primary display-none';
                                            $btnText='';
                                            $selesai='display:none';
                                            $cetak='display:none';
                                            break;
                                        default:
                                            $label='label label-warning';
                                            $txtLabel='Pending';
                                            $btnColor='btn-warning';
                                            $btnText='Lanjutkan Transaksi';
                                            $selesai='display:none';
                                            $cetak='display:none';
                                            break;
                                    }
                                    ?>
                                        <div class="col-md-12 p-t-2">          
                                            <div class="card card-border">                                 
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
                                                            <p><span class="<?=$label;?>"><?=$txtLabel;?></span></p>
                                                            <center>
                                                                <br><button class="btn btn-sm <?=$btnColor;?>" onclick="lanjut('<?=$mdInv;?>','<?=$result['status'];?>')"><?=$btnText;?></button>
                                                            </center>
                                                            <form method="POST" action="php/proses_transaksi">
                                                                <input type="hidden" name="noInvoice" value="<?=$noTiket;?>">
                                                                <center>
                                                                    <br><button type="submit" name="selesai" class="btn btn-sm btn-success" style="<?=$selesai;?>">Selesai & Cetak Pembayaran</button>
                                                                </center>
                                                            </form>
                                                                <center>
                                                                    <br><button type="submit" name="selesai" class="btn btn-sm btn-primary" style="<?=$cetak;?>" onclick="print('<?=$noTiket;?>')">Cetak Pembayaran</button>
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
            function print(c){
                window.location.assign('cetak_payment?no='+c);
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
                    window.location.assign('payment_ticket?tiket='+iv);
                    break;
                  case '2':
                    var ongkir=10000;
                    break;
                  case '3':
                    var ongkir=10000;
                    break;
                  default:
                    window.location.assign('checkout_ticket?tiket='+iv);
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