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
    if ($profil['jenis_kelamin']==1) {
        $jenisKelamin='Laki-laki';
    }else{
        $jenisKelamin='Perempuan';
    }
    ?>
        <div class="box">
            <section id="profil" class="home-margin m-t-20">
                <div class="container">                    
                <h4 class="header-title">Keranjang</h4>
                    <div class="row ">
                        <?php 
                            $qKeranjang=mysql_query("SELECT * FROM tb_keranjang WHERE id_user='$idUser'");
                            $keranjang=mysql_fetch_array($qKeranjang);
                            $idKeranjang=$keranjang['id_keranjang'];
                            $qItem=mysql_query("SELECT * FROM tb_detail_keranjang JOIN tb_desain ON tb_detail_keranjang.id_item=tb_desain.id_desain WHERE id_keranjang='$idKeranjang'") or die(mysql_error());
                            
                            $cek=mysql_num_rows($qItem);
                            if ($cek<=0) { ?>
                                <div class="col-md-12 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                            <div class="card-border">                                                
                                                <div class="row clearfix"> 
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="text-center">         
                                                            <h4>Keranjang Kosong</h4>
                                                            <h5>Silahkan lakukan Pembelian</h5>
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

                                while ($itemKeranjang=mysql_fetch_array($qItem)) {
                                    $idDesain=$itemKeranjang['id_desain'];
                                    $namaDesain=$itemKeranjang['nama_desain'];
                                    $qGambar=mysql_fetch_array(mysql_query("SELECT * FROM tb_gambar_desain WHERE id_desain='$idDesain' LIMIT 1"));
                                    $gambar='../admin/assets/images/ugd/'.$qGambar['gambar_desain'];
                                    ?>
                                        <div class="col-md-12 p-t-2">          
                                            <div class="card">
                                                <div class="card-container">
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
                                                            <div class="col-sm-12 col-lg-8 m-t-1">
                                                                <center> 
                                                                    <button class="btn btn-sm bg-btn-danger" onclick="hapus('<?=$idKeranjang;?>','<?=$idDesain;?>','<?=$namaDesain;?>')"><span class="ion-trash-b"></span> Hapus</button>
                                                                    <button class="btn btn-sm bg-btn-success" onclick="window.location.assign('checkout')"><span class="ion-pricetags"></span> Bayar</button>
                                                                </center>
                                                            </div>                                            
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