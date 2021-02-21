<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="admin/assets/images/icon/favicon.ico" />
        <title>Pabrik Kreativitas | Detail</title>

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

    $halaman=24;
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;           
    $getK=$_GET['k'];
    $cari='';
    $qKategori=mysql_query("SELECT * FROM tb_kategori");
    $path='admin/assets/images/ugd/';

    if ($getK!='all') { 
        $kb=$_GET['k'];
        $qDesain = mysql_query("SELECT * FROM tb_desain WHERE id_kategori='$kb' LIMIT $mulai, $halaman")or die(mysql_error); 
        $result = mysql_query("SELECT id_desain FROM tb_desain");
    } else { 
        $kb='all'; 
        $qDesain = mysql_query("SELECT * FROM tb_desain LIMIT $mulai, $halaman")or die(mysql_error);
        $result = mysql_query("SELECT id_desain FROM tb_desain");
    }

    if (isset($_GET['search'])){        
        $cari=$_GET['search'];
        if ($getK!='all') { 
            $kb=$_GET['k'];
            $qDesain = mysql_query("SELECT * FROM tb_desain WHERE id_kategori='$kb' AND nama_desain LIKE '%$cari%' LIMIT $mulai, $halaman")or die(mysql_error); 
            $result = mysql_query("SELECT id_desain FROM tb_desain");
          } else { 
            $kb='all'; 
            $qDesain = mysql_query("SELECT * FROM tb_desain WHERE nama_desain LIKE '%$cari%' LIMIT $mulai, $halaman")or die(mysql_error);
            $result = mysql_query("SELECT id_desain FROM tb_desain");
          }
    }

    $total = mysql_num_rows($result);
    $pages = ceil($total/$halaman); 
    $no =$mulai+1;
    ?>
    <form method="POST" action="assets/php/proses_desain.php">        
        <div class="box">
            <!-- HOME -->
            <section id="home" class="home-margin">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-sm-12 col-md-5">
                            <div class="owl-carousel text-center">
                            	<?php 
                            		while ($gambar=mysql_fetch_array($qGambar)) {
                            			?>
                            			<div class="item">
    		                                <div class="detail-slider">
    		                                    <img src="<?=$path.$gambar['gambar_desain'];?>" class="detail-img" style="width:100%">
    		                                </div>
    		                            </div>
                            			<?php
                            		}
                            	?>
                            </div>
                            <br>
                            <center>
                                <input type="hidden" name="idDesain" value="<?=$idDesain;?>">
                            	<button  type="button" class="btn btn-sm bg-btn-dark" onclick="order('<?=$idDesain;?>')"><i class="ion-bag" style="margin-right: 10px;"></i> Buy</button>
                                <button type="submit" name="favorit" class="btn btn-sm bg-btn-love"><i class="ion-heart" style="margin-right: 10px;"></i> Favorit</button>
                            </center>                        
                        </div>
                        <div class="col-md-7">
                        	<div class="card">
                    			<div class="card-container">
                    				<div class="detail-box">
                    					<?php $desain=mysql_fetch_array($qDesain); ?>
                    					<h4><?=$desain['nama_desain'];?></h4>
                    					<div class="row">
                    						<div class="col-sm-12 col-lg-6">
                    							<label>Harga Desain</label>
                    							<p><?=rupiah($desain['harga']);?></p>
                    							<label>Difavoritkan</label>
                    							<p><?=$desain['favorit']." Orang";?></p>
                    						</div>
                    						<div class="col-sm-12 col-lg-6">
                    							<label>Tanggal Upload</label>
                    							<p><?=tanggal($desain['tgl_upload']);?></p>
                    							<label>Kategori</label>
                    							<p><?=$desain['nama_kategori'];?></p>
                    						</div>
                    					</div>
                    					<label>Deskripsi</label>
                    					<p><?=$desain['deskripsi'];?></p>
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
                        $dataDesain=mysql_query("SELECT id_desain, harga, nama_desain FROM tb_desain ORDER BY RAND() LIMIT 6");
                        while ($desain=mysql_fetch_array($dataDesain)) {
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
                                    <div class="card card-cursor" onclick="window.location.assign('detail_desain')">
                                        <img src="<?=$path.$gambar['gambar_desain'];?>" class="card-img-top card-img"><br>
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
            </section>
            <!-- END HOME -->
        </div>
    </form>
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
            function order(id){
                window.location.assign('order_desain?id='+id);
            }

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