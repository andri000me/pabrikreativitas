<?php ob_start();?>
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

        <!-- Custom styles for this template -->
        <link href="assets/user_admin/css/style_user.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#myModal').modal('show');
            });
        </script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>


    <body data-spy="scroll" data-target="#navbar-menu">

        <?php 
        include 'database/koneksi.php';
        include 'assets/part/header.php'; 
        ?>
        <!-- HOME -->
        <section class="home-wrapper bg" id="home">
            <div class="container-fluid">
                <div class="row vertical-content">
                    <div class="col-md-12">
                        <div class="text-right m-t-90">
                            <div class="owl-carousel">
                                <?php 
                                $qHeadline=mysql_query("SELECT * FROM tb_headline"); 
                                $rowHeadline=mysql_num_rows($qHeadline);                               
                                $path='admin/assets/images/headline/';
                                while ($headline=mysql_fetch_array($qHeadline)) {
                                    $gambarHeadline=$headline['gambar_headline'];
                                    $namaHeadline=$headline['nama_headline'];
                                ?>
                                <div class="item">
                                    <div class="testimonial-box">
                                        <img src="<?=$path.$gambarHeadline;?>" alt="<?=$namaHeadline;?>" style="width:100%">
                                        <button class="btn-image">Lihat Selengkapnya <span class="ion-arrow-right-c"></span></button>
                                    </div>
                                </div>
                                <?php
                                }
                                if ($rowHeadline<=1) {
                                ?>
                                <div class="item">
                                    <div class="testimonial-box">
                                        <img src="<?=$path.'fix-headline.png';?>" alt="Pabrik Kreativitas" style="width:100%">     
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END HOME -->



        <!-- Features -->
        <section class="section" id="services">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-left">
                        <h2>Our Services</h2>
                    </div>
                </div> <!-- end row -->

                <div class="row text-center">
                    <div class="col-sm-4 m-t-10 services card-cursor card-default-hover">
                        <a href="ugd?page=1&k=all"><img src="<?=$pathIcon.$Settings['ugd'];?>"></a>
                    </div> <!-- /col -->
                    <div class="col-sm-4 m-t-10 services card-cursor card-default-hover">
                        <a href="urc?page=1&k=all"><img src="<?=$pathIcon.$Settings['urc'];?>"></a>
                    </div> <!-- /col -->
                    <div class="col-sm-4 m-t-10 services card-cursor card-default-hover">
                        <a href="pasen?page=1&k=all"><img src="<?=$pathIcon.$Settings['pasen'];?>"></a>
                    </div> <!-- /col -->
                    <div class="col-sm-4 m-t-10 services card-cursor card-default-hover">
                        <a href="posyandu?page=1&k=all"><img src="<?=$pathIcon.$Settings['posyandu'];?>"></a>
                    </div> <!-- /col -->
                    <div class="col-sm-4 m-t-10 services card-cursor card-default-hover">
                        <a href="apotik?page=1&k=all"><img src="<?=$pathIcon.$Settings['apotik'];?>"></a>
                    </div> <!-- /col --> 
                    <div class="col-sm-4 m-t-10 services card-cursor card-default-hover">
                        <a href="vaksin?page=1&k=all"><img src="<?=$pathIcon.$Settings['vaksin'];?>"></a>
                    </div> <!-- /col -->                     
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end Features -->

        <!-- Barang section -->
        <section class="section" id="store"></section>
        <section class="brg-section" style="margin-top: -60px;">
                <div class="container">
                    <div class="row">
                         <div class="col-lg-11">
                             <h3>PASEN</h3>
                         </div> 
                         <div class="col-lg-1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-sm btn-menu" onclick="window.location.assign('pasen?page=1&k=all')">Lihat Semua <span class="ion-arrow-right-c"></span></button>                                 
                                </div>
                            </div>
                         </div>  
                    </div>
                    <div class="row">                    
                    <?php 
                        $qUgd=mysql_query("SELECT tb_desain.id_desain, nama_desain, harga FROM tb_desain LIMIT 6");
                        while ($desain=mysql_fetch_array($qUgd)) {
                            $idDesain=$desain['id_desain'];
                            $gambar=mysql_fetch_array(mysql_query("SELECT gambar_desain FROM tb_gambar_desain WHERE id_desain='$idDesain' LIMIT 1"));
                            if (strlen($desain['nama_desain'])>30) {
                                    $namaDesain=str_pad(substr($desain['nama_desain'],0,30),35,".");
                                }else{
                                    $namaDesain=$desain['nama_desain'];
                                }
                            ?>
                            <div class="col-sm-6 col-lg-2 col-xs-6" style="margin-top: 5px;">
                                <div class="form-group">
                                    <div class="card card-cursor" onclick="window.location.assign('detail_desain?id=<?=$desain['id_desain'];?>')">
                                        <img src="admin/assets/images/ugd/<?=$gambar['gambar_desain'];?>" class="card-img-top card-img"><br>
                                        <div class="card-name">
                                            <p class="card-title"><?=$namaDesain;?><br><b><?=rupiah($desain['harga']);?></b></p>
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
            <section class="brg-section bg-dark-gray">
                <div class="container">
                    <div class="row">
                         <div class="col-lg-11">
                             <h3>UGD</h3>
                         </div> 
                         <div class="col-lg-1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-sm btn-menu" onclick="window.location.assign('ugd?page=1&k=all')">Lihat Semua <span class="ion-arrow-right-c"></span></button>                                 
                                </div>
                            </div>
                         </div>  
                    </div>
                    <div class="row">                    
                    <?php 
                        $qUgd=mysql_query("SELECT tb_desain.id_desain, nama_desain, harga FROM tb_desain WHERE SUBSTR(pemilik,1,2)='AD' LIMIT 6");
                        while ($desain=mysql_fetch_array($qUgd)) {
                            $idDesain=$desain['id_desain'];
                            $gambar=mysql_fetch_array(mysql_query("SELECT gambar_desain FROM tb_gambar_desain WHERE id_desain='$idDesain' LIMIT 1"));
                            if (strlen($desain['nama_desain'])>30) {
                                    $namaDesain=str_pad(substr($desain['nama_desain'],0,30),35,".");
                                }else{
                                    $namaDesain=$desain['nama_desain'];
                                }
                            ?>
                            <div class="col-sm-6 col-lg-2 col-xs-6" style="margin-top: 5px;">
                                <div class="form-group">
                                    <div class="card card-cursor" onclick="window.location.assign('detail_desain?id=<?=$desain['id_desain'];?>')">
                                        <img src="admin/assets/images/ugd/<?=$gambar['gambar_desain'];?>" class="card-img-top card-img"><br>
                                        <div class="card-name">
                                            <p class="card-title"><?=$namaDesain;?><br><b><?=rupiah($desain['harga']);?></b></p>
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
            <section class="brg-section">
                <div class="container">
                    <div class="row">
                         <div class="col-lg-11">
                             <h3>URC</h3>
                         </div> 
                         <div class="col-lg-1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-sm btn-menu" onclick="window.location.assign('urc?page=1&k=all')">Lihat Semua <span class="ion-arrow-right-c"></span></button>                                 
                                </div>
                            </div>
                         </div>  
                    </div>
                    <div class="row">                    
                    <?php 
                        $qUrc=mysql_query("SELECT * FROM tb_cetak LIMIT 6");
                        while ($cetak=mysql_fetch_array($qUrc)) {
                            if (strlen($cetak['jenis_cetak'])>30) {
                                    $namaCetak=str_pad(substr($cetak['jenis_cetak'],0,30),35,".");
                                }else{
                                    $namaCetak=$cetak['jenis_cetak'];
                                }
                            ?>
                            <div class="col-sm-6 col-lg-2 col-xs-6" style="margin-top: 5px;">
                                <div class="form-group">
                                    <div class="card card-cursor" onclick="window.location.assign('detail_cetak?id=<?=$cetak['id_cetak'];?>')">
                                        <img src="admin/assets/images/urc/<?=$cetak['icon'];?>" class="card-img" style="object-fit: contain;"><br>
                                        <div class="card-name">
                                            <p class="card-title"><?=$namaCetak;?><br><b><?=rupiah($cetak['harga'])." ".$cetak['ket_harga'];?></b></p>
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
            <section class="brg-section bg-dark-gray">
                <div class="container">
                    <div class="row">
                         <div class="col-lg-11">
                             <h3>POSYANDU</h3>
                         </div> 
                         <div class="col-lg-1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-sm btn-menu" onclick="window.location.assign('posyandu?page=1&k=all')">Lihat Semua <span class="ion-arrow-right-c"></span></button>                                 
                                </div>
                            </div>
                         </div>  
                    </div>
                    <div class="row">                    
                    <?php 

                        $qPosyandu=mysql_query("SELECT * FROM tb_jobs JOIN tb_user ON tb_jobs.id_user=tb_user.id_user WHERE status='1' ORDER BY RAND() LIMIT 6");
                        while ($posyandu=mysql_fetch_array($qPosyandu)) {
                            $idPosyandu=$posyandu['id_jobs'];
                            $namaUser=$posyandu['nama_user'];

                            $qGambar=mysql_query("SELECT * FROM tb_gambar_jobs WHERE id_jobs='$idPosyandu' LIMIT 1") or die(mysql_error());
                            $gambar=mysql_fetch_array($qGambar);
                            $qgambar='admin/assets/images/portofolio/'.$gambar['gambar_jobs'];

                            if (strlen($posyandu['judul_jobs'])>30) {
                                    $namaArtikel=str_pad(substr($posyandu['judul_jobs'],0,30),35,".");
                                }else{
                                    $namaArtikel=$posyandu['judul_jobs'];
                                }
                            ?>
                            <div class="col-sm-6 col-lg-2 col-xs-6" style="margin-top: 5px;">
                                <div class="form-group">
                                    <div class="card card-cursor" onclick="window.location.assign('detail_posyandu?id=<?=$idPosyandu;?>')">
                                        <img src="<?=$qgambar;?>" class="card-img-top card-img"><br>
                                        <div class="card-name">
                                            <p class="card-title"><?=$namaArtikel;?></p>
                                            <p class="card-title"><i class="fa fa-user"></i> <?=$namaUser;?></p>
                                            <small><i class="ion-pricetag"></i> <?=rupiah($posyandu['harga']);?></small>
                                        </div>                                      
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
                </div>
            </section>
            <section class="brg-section">
                <div class="container">
                    <div class="row">
                         <div class="col-lg-11">
                             <h3>APOTIK</h3>
                         </div> 
                         <div class="col-lg-1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-sm btn-menu" onclick="window.location.assign('apotik?page=1&k=all')">Lihat Semua <span class="ion-arrow-right-c"></span></button>                                 
                                </div>
                            </div>
                         </div>  
                    </div>
                    <div class="row">                    
                    <?php 

                        $qApotik=mysql_query("SELECT * FROM tb_artikel JOIN tb_kategori ON tb_artikel.id_kategori=tb_kategori.id_kategori WHERE publish='1' ORDER BY RAND() LIMIT 6");
                        while ($artikel=mysql_fetch_array($qApotik)) {
                            $idArtikel=$artikel['id_artikel'];
                            $penulis=$artikel['id_user'];
                            $gambar=mysql_fetch_array(mysql_query("SELECT gambar_artikel FROM tb_gambar_artikel WHERE id_artikel='$idArtikel' LIMIT 1"));
                            switch (substr($artikel['id_user'], 0,2)) {
                                case 'US':
                                    $user=mysql_fetch_array(mysql_query("SELECT nama_user FROM tb_user WHERE id_user='$penulis'"));
                                    $namaUser=$user['nama_user'];
                                    $qgambar='user/assets/images/artikel/'.$gambar['gambar_artikel'];
                                    break;
                                case 'AD':
                                    $user=mysql_fetch_array(mysql_query("SELECT nama_admin FROM tb_admin WHERE id_admin='$penulis'"));
                                    $namaUser=$user['nama_admin'];
                                    $qgambar='admin/assets/images/artikel/'.$gambar['gambar_artikel'];
                                    break;
                            }
                            if (strlen($artikel['judul_artikel'])>30) {
                                    $namaArtikel=str_pad(substr($artikel['judul_artikel'],0,30),35,".");
                                }else{
                                    $namaArtikel=$artikel['judul_artikel'];
                                }
                            ?>
                            <div class="col-sm-6 col-lg-2 col-xs-6" style="margin-top: 5px;">
                                <div class="form-group">
                                    <div class="card card-cursor" onclick="window.location.assign('detail_apotik?id=<?=$idArtikel;?>')">
                                        <img src="<?=$qgambar;?>" class="card-img-top card-img"><br>
                                        <div class="card-name">
                                            <p class="card-title"><?=$namaArtikel;?></p>
                                            <p class="card-title"><i class="fa fa-user"></i> <?=$namaUser;?></p>
                                            <small><i class="ion-pricetag"></i> <?=$artikel['nama_kategori'];?> | <i class="fa fa-calendar"></i> <?=tanggal($artikel['tgl_artikel']);?></small>
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
            <section class="brg-section bg-dark-gray">
                <div class="container">
                    <div class="row">
                         <div class="col-lg-11">
                             <h3>VAKSIN</h3>
                         </div> 
                         <div class="col-lg-1">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button class="btn btn-sm btn-menu" onclick="window.location.assign('vaksin?page=1&k=all')">Lihat Semua <span class="ion-arrow-right-c"></span></button>                                 
                                </div>
                            </div>
                         </div>  
                    </div>
                    <div class="row">                    
                    <?php 
                        $qVisit=mysql_query("SELECT * FROM tb_visit LIMIT 6");
                        while ($visit=mysql_fetch_array($qVisit)) {
                            $idVisit=$visit['id_visit'];
                            $gambar=mysql_fetch_array(mysql_query("SELECT gambar_visit FROM tb_gambar_visit WHERE id_visit='$idVisit' LIMIT 1"));
                            if (strlen($visit['nama_visit'])>30) {
                                    $namaVisit=str_pad(substr($visit['nama_visit'],0,30),35,".");
                                }else{
                                    $namaVisit=$visit['nama_visit'];
                                }
                            ?>
                            <div class="col-sm-6 col-lg-2 col-xs-6" style="margin-top: 5px;">
                                <div class="form-group">
                                    <div class="card card-cursor">
                                        <img src="admin/assets/images/poster/<?=$gambar['gambar_visit'];?>" class="card-img-top card-img"><br>
                                        <div class="card-name">
                                            <p class="card-title"><?=$namaVisit;?><br><b><?=rupiah($visit['biaya']);?></b></p>
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
            <!-- End Testimonials section -->
        </section>

        <!-- Clients -->
        <section class="section" id="clients">
            <div class="container" style="<?=$dis;?>">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3 class="m-b-2"><?=strtoupper($client[1]);?></h3>
                        <div class="row">
                            <?php 
                                $qClient=mysql_query("SELECT nama_client FROM tb_client");
                                while ($client=mysql_fetch_array($qClient)) {
                                    $nama=$client['nama_client'];
                                    $namaAwal=explode(' ',$nama);
                                    $pNamaAwal=strlen($namaAwal[0]);
                                    $pNama=strlen($nama);
                                    $namaAkhir=substr($nama, $pNamaAwal, $pNama);
                                    ?>
                                    <div class="col-sm-12 col-lg-3">
                                        <div class="client-box m-b-1 ">
                                            <p><span><?=$namaAwal[0];?></span> <?=$namaAkhir;?></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
        </section>
        <!--End  Clients -->

          <!-- Modal -->
          <?php 
            $txtModal=$Settings['popup'];
            $txtNama=explode(' ', $Settings['nama']);
          ?>
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header" style="border: none;">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <h4>Selamat Datang Di <b><?=$txtNama[0]." ";?></b><?=$txtNama[1];?></h4>
                    <div style="background-color: #FFF; border-radius: 5px; padding: 5px;">
                        <?=$txtModal;?>
                    </div>
                </div>
              </div>
            </div>
          </div>

        <?php include 'assets/part/footer.php'; ?>
         <!-- Back to top -->    
        <a href="#" class="back-to-top" id="back-to-top"> <i class="ion-chevron-up"></i> </a>
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
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay: true,
                autoplayTimeout: 4000,
                responsive:{
                    0:{
                        items:1
                    }
                }
            })
        </script>

    </body>
</html>