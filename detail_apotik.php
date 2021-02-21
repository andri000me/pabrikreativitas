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
    if (isset($_GET['id'])) {
        $idArtikel=$_GET['id'];
        $qArtikel=mysql_query("SELECT * FROM tb_artikel JOIN tb_kategori ON tb_artikel.id_kategori=tb_kategori.id_kategori WHERE id_artikel='$idArtikel'");
        $artikel=mysql_fetch_array($qArtikel);
        $qGambar=mysql_query("SELECT * FROM tb_gambar_artikel WHERE id_artikel='$idArtikel'");
        $gambar=mysql_fetch_array($qGambar);
        
        $penulis=$artikel['id_user'];
        switch (substr($artikel['id_user'], 0,2)) {
            case 'US':
                $user=mysql_fetch_array(mysql_query("SELECT nama_user FROM tb_user WHERE id_user='$penulis'"));
                $namaUser=$user['nama_user'];
                $path='user/assets/images/artikel/';
                break;
            case 'AD':
                $user=mysql_fetch_array(mysql_query("SELECT nama_admin FROM tb_admin WHERE id_admin='$penulis'"));
                $namaUser=$user['nama_admin'];
                $path='admin/assets/images/artikel/';
                break;
        }
    }else{
        echo "<script>window.history.go(-1);</script>";
    }
    ?>
        <form method="POST" action="assets/php/proses_desain.php">        
        <div class="box">
            <!-- HOME -->
            <section id="home" class="home-margin">
                <div class="container">
                    <div class="row ">
                        <div class="col-sm-12 col-md-12">
                            <div class="owl-carousel">
                                <?php 
                                $qHeadline=mysql_query("SELECT gambar_artikel FROM tb_gambar_artikel WHERE id_artikel='$idArtikel'") or die(mysql_error());  
                                $rowHeadline=mysql_num_rows($qHeadline);
                                while ($headline=mysql_fetch_array($qHeadline)) {
                                    $gambarHeadline=$headline['gambar_artikel'];
                                ?>                                
                                <div class="detail-slider">
                                    <div class="testimonial-box">
                                        <img src="<?=$path.$gambarHeadline;?>" alt="<?=$gambarHeadline;?>" class="detail-img" style="width:100%">
                                    </div>
                                </div>
                                <?php
                                }
                                if ($rowHeadline<=1) {
                                ?>
                                <div class="detail-slider">
                                    <div class="testimonial-box">
                                        <img src="<?=$path.'fix-headline.png';?>" alt="Pabrik Kreativitas" class="detail-img" style="width:100%">     
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <br>
                            <center>
                                <input type="hidden" name="idArtikel" value="<?=$idArtikel;?>">
                                <button type="submit" name="favorit" class="btn btn-sm bg-btn-love"><i class="ion-heart" style="margin-right: 10px;"></i> Favorit</button>
                            </center>                        
                        </div>
                        <div class="col-md-12 c-t-1">
                            <div class="card">
                                <div class="card-container">
                                    <div class="bottom-line">                                        
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12">
                                                <h4><i class="fa fa-user"></i> <?=$namaUser;?> | <?=$artikel['judul_artikel'];?></h4>
                                            </div>
                                            <div class="col-lg-12 col-lg-3">
                                                <h4><small><i class="ion-pricetag"></i> <?=$artikel['nama_kategori'];?> | <i class="fa fa-calendar"></i> <?=tanggal($artikel['tgl_artikel']);?></small></h4>
                                            </div>
                                        </div>                                        
                                    </div>
                                        
                                        <div class="break c-t-1" style="text-align: justify;">
                                            <p><?=$artikel['isi_artikel'];?></p>
                                        </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section" style="padding: 0px 30px 0px 30px; margin-top: 50px;">
                    <div class="row" style="margin-bottom: 10px;">
                         <div class="col-lg-11">
                             <h4>Unit Gawat Desain Lainnya</h4>
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
            </section>
            <!-- END HOME -->
        </div>
    </form>
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