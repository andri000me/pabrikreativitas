<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="../admin/assets/images/icon/favicon.ico" />
        <title>Pabrik Kreativitas | List Artikel</title>

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
    ?>
        <div class="box">
            <section id="profil" class="home-margin m-t-20">
                <div class="container">   
                <div class="row">
                    <div class="col-lg-10">
                        <h4 class="header-title">Pendapatan Anda</h4>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-sm bg-btn-dark" onclick="window.location.assign('my_transaksi')">List Pesanan Anda</button>
                    </div>
                </div>                 
                
                    <div class="row ">
                        <?php 
                            $qDesain=mysql_query("SELECT * FROM tb_desain JOIN tb_kategori ON tb_desain.id_kategori=tb_kategori.id_kategori JOIN tb_user ON tb_desain.pemilik=tb_user.id_user WHERE tb_desain.pemilik='$idUser'") or die(mysql_error());
                            $qJobs=mysql_query("SELECT * FROM tb_jobs JOIN tb_user ON tb_jobs.id_user=tb_user.id_user WHERE tb_jobs.id_user='$idUser'") or die(mysql_error());                          
                            $cek=mysql_num_rows($qDesain);
                            $cek1=mysql_num_rows($qJobs);
                            if ($cek==0&&$cek1==0) { ?>
                                <div class="col-md-12 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                            <div class="card-border">                                                
                                                <div class="row clearfix"> 
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="text-center">         
                                                            <h4>Oops..</h4>
                                                            <h5>Anda Belum Mendapatkan Pendapatan</h5>
                                                            <br>
                                                        </div>
                                                    </div>                                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>            
                                </div>
                            <?php  

                            }else{
                                $qWallet=mysql_fetch_array(mysql_query("SELECT tb_wallet.id_wallet FROM tb_wallet JOIN tb_detail_wallet ON tb_wallet.id_wallet=tb_detail_wallet.id_wallet WHERE id_user='$idUser' "));
                                $idWallet=$qWallet['id_wallet'];
                                $total=0;
                                $rincian=mysql_query("SELECT nominal, ket FROM tb_wallet JOIN tb_detail_wallet ON tb_wallet.id_wallet=tb_detail_wallet.id_wallet WHERE tb_wallet.id_wallet='$idWallet' AND status='1' ") or die(mysql_error());
                                while ($hitung=mysql_fetch_array($rincian)) {
                                    if ($hitung['ket']==0) {
                                        $total=$total-$hitung['nominal'];
                                    }else{
                                        $total=$total+$hitung['nominal'];
                                    }
                                    
                                }
                                

                                $rincian=mysql_query("SELECT * FROM tb_wallet JOIN tb_detail_wallet ON tb_wallet.id_wallet=tb_detail_wallet.id_wallet WHERE tb_wallet.id_wallet='$idWallet' AND status='1' ORDER BY tgl_transaksi DESC") or die(mysql_error());
                                ?>
                                    <div class="col-md-12 p-t-2">          
                                        <div class="card card-border">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-9">
                                                    <h5>Total Pendapatan Anda</h5>
                                                    <h3><?=rupiah($total);?></h3>
                                                </div> 
                                                <div class="col-sm-12 col-lg-3">
                                                    <h5>Carikan Dana</h5>
                                                    <form method="POST" action="php/proses_dana.php">
                                                        <div class="form-group">
                                                            <input type="hidden" name="idWallet" value="<?=$idWallet;?>">
                                                            <input type="number" name="cairUang" class="form-control" placeholder="Jumlah Yang Ditarik" style="padding: 10px 10px 10px 10px;">
                                                            <button type="submit" name="carikan" class="btn btn-sm bg-btn-dark pull-right">Carikan</button>
                                                        </div>
                                                    </form>
                                                </div>   
                                            </div>                                            
                                            <hr> 
                                            <div class="row clearfix">
                                                <div class="col-lg-12">
                                                    <div style=" overflow: scroll; height: 700px;">
                                                        <table border="1" class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Tanggal Pembayaran</th>
                                                                    <th>Debit</th>
                                                                    <th>Kredit</th>
                                                                    <th>Keterangan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no=1;
                                                                while ($data=mysql_fetch_array($rincian)) {
                                                                    if ($data['ket']==1) {
                                                                        $Kredit='-';
                                                                        $debit=rupiah($data['nominal']);
                                                                    }else{
                                                                        $Kredit=rupiah($data['nominal']);
                                                                        $debit='-';
                                                                    }


                                                                ?>
                                                                <tr>
                                                                    <td><?=$no++;?></td>
                                                                    <td><?=tanggal($data['tgl_transaksi']);?></td>
                                                                    <td><?=$debit;?></td>
                                                                    <td><?=$Kredit;?></td>
                                                                    <td><?=$data['transaksi'];?></td>
                                                                </tr>                                                            
                                                                <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>                                                                         
                                            </div>
                                        </div>            
                                    </div>                                
                                <?php
                            }?>
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