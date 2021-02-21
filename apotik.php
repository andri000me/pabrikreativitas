<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="admin/assets/images/icon/favicon.ico" />
        <title>Pabrik Kreativitas</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="assets/user_admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- Owl Carousel CSS -->
        <link href="assets/user_admin/css/owl.carousel.css" rel="stylesheet">
        <link href="assets/user_admin/css/owl.theme.default.min.css" rel="stylesheet">

        <!-- Icon CSS -->
        <link href="assets/user_admin/css/ionicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Alertify -->
        <link href="assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
        <script src="assets/user_admin/js/alertify.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="assets/user_admin/css/style_user.css" rel="stylesheet">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body data-spy="scroll" data-target="#navbar-menu">

    <?php 
    include 'database/koneksi.php';
    include 'assets/part/header_menu.php'; 
    $qProfil=mysql_query("SELECT * FROM tb_user WHERE id_user='$idUser'");
    $profil=mysql_fetch_array($qProfil);
    ?>
        <div class="box">
            <section id="profil" class="home-margin m-t-20">
                <div class="container">                    
                <h4 class="header-title">Artikel Persoalan Tips, Inspirasi & Kreativitas</h4>
                    <div class="row ">
                        <?php 

                            $qArtikel=mysql_query("SELECT * FROM tb_artikel JOIN tb_kategori ON tb_artikel.id_kategori=tb_kategori.id_kategori WHERE publish='1'");

                            $cek=mysql_num_rows($qArtikel);
                            if ($cek>0) {
                                while ($itemArtikel=mysql_fetch_array($qArtikel)) {
                                    $idArtikel=$itemArtikel['id_artikel'];
                                    $namaArtikel=$itemArtikel['judul_artikel'];
                                    $qGambar=mysql_fetch_array(mysql_query("SELECT * FROM tb_gambar_artikel WHERE id_artikel='$idArtikel' LIMIT 1"));
                                    
                                    $isiArtikel=str_pad(substr($itemArtikel['isi_artikel'],0,350),355,".");
                                    $penulis=$itemArtikel['id_user'];
                                    switch (substr($itemArtikel['id_user'], 0,2)) {
                                        case 'US':
                                            $user=mysql_fetch_array(mysql_query("SELECT nama_user FROM tb_user WHERE id_user='$penulis'"));
                                            $namaUser=$user['nama_user'];
                                            $gambar='user/assets/images/artikel/'.$qGambar['gambar_artikel'];
                                            break;
                                        case 'AD':
                                            $user=mysql_fetch_array(mysql_query("SELECT nama_admin FROM tb_admin WHERE id_admin='$penulis'"));
                                            $namaUser=$user['nama_admin'];
                                            $gambar='admin/assets/images/artikel/'.$qGambar['gambar_artikel'];
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
                                                        <h4><?=$namaArtikel;?></h4> 
                                                        <h4><small><i class="fa fa-user"></i> <?=$namaUser;?></small></h4>                
                                                        <h4><small><i class="ion-pricetag"></i> <?=$itemArtikel['nama_kategori'];?> | <i class="fa fa-calendar"></i> <?=tanggal($itemArtikel['tgl_artikel']);?></small></h4>

                                                        <div class="break">
                                                            <h5><?=$isiArtikel;?></h5>
                                                        </div> 
                                                                                                        
                                                    </div>                                            
                                                </div><br>
                                                <center> 
                                                    <button class="btn btn-sm bg-btn-dark" onclick="detail('<?=$idArtikel;?>')"><span class="ion-eye"></span> Lihat Artikel</button>
                                                </center>
                                            </div>            
                                        </div>                                
                                    <?php
                                }
                            }else{ ?>
                                <div class="col-md-12 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                            <div class="card-border">                                 
                                                <div class="row clearfix"> 
                                                    <div class="col-sm-12 col-lg-12">
                                                        <h4>Artikel Tidak Ditemukan</h4>               
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
        <?php include 'assets/part/footer.php'; ?>


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="assets/user_admin/js/jquery-2.1.4.min.js"></script>
        <script src="assets/user_admin/js/bootstrap.min.js"></script>

        <!-- Jquery easing -->                                                      
        <script type="text/javascript" src="assets/user_admin/js/jquery.easing.1.3.min.js"></script>

        <!-- Owl Carousel -->                                                      
        <script type="text/javascript" src="assets/user_admin/js/owl.carousel.min.js"></script>

        <!--sticky header-->
        <script type="text/javascript" src="assets/user_admin/js/jquery.sticky.js"></script>

        <!--common script for all pages-->
        <script src="assets/user_admin/js/jquery.app.js"></script>

        <script type="text/javascript">
            function detail(id){
                window.location.assign('detail_apotik?id='+id);
            }
        </script>

    </body>
</html>