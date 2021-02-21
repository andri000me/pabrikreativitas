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
        <style type="text/css">
            .img-pembuat{
                width: 180px;
                margin-bottom: 5px;
                object-fit: cover;
            }
        </style>
    </head>


    <body data-spy="scroll" data-target="#navbar-menu">

    <?php 
    include 'database/koneksi.php';
    include 'assets/part/header_menu.php'; 

    if (isset($_GET['id'])) {
    	$idJobs=$_GET['id'];
        $getUser=mysql_fetch_array(mysql_query("SELECT id_user FROM tb_jobs WHERE id_jobs='$idJobs'"));
        $code=substr($getUser['id_user'],0,2);
        if ($code=='AD') {
            $qJobs=mysql_query("SELECT * FROM tb_jobs JOIN tb_admin ON tb_jobs.id_user=tb_admin.id_admin WHERE id_jobs='$idJobs'") or die(mysql_error());
            $jobs=mysql_fetch_array($qJobs);
            $path1='admin/assets/images/user/';
            $nama=$jobs['nama_admin'];
        }else{
            $qJobs=mysql_query("SELECT * FROM tb_jobs JOIN tb_user ON tb_jobs.id_user=tb_user.id_user WHERE id_jobs='$idJobs'") or die(mysql_error());
            $jobs=mysql_fetch_array($qJobs);
            $path1='user/assets/images/user/';
            $nama=$jobs['nama_user'];
        }
 		
        
 		$qGambar=mysql_query("SELECT * FROM tb_gambar_jobs WHERE id_jobs='$idJobs'");
 		$path='admin/assets/images/portofolio/';
    }else{
    	echo "<script>window.history.go(-1);</script>";
    }
    ?>  
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
    		                                    <img src="<?=$path.$gambar['gambar_jobs'];?>" class="detail-img" style="width:100%">
    		                                </div>
    		                            </div>
                            			<?php
                            		}
                            	?>
                            </div>
                            <br>
                            <center>
                                <input type="hidden" name="idDesain" value="<?=$idDesain;?>">
                            	<button  type="button" class="btn btn-sm bg-btn-dark" onclick="order('<?=$idJobs;?>')"><i class="ion-bag" style="margin-right: 10px;"></i> Buy</button>
                                <button type="submit" name="favorit" class="btn btn-sm bg-btn-love"><i class="ion-heart" style="margin-right: 10px;"></i> Favorit</button>
                            </center>                        
                        </div>
                        <div class="col-md-7">
                        	<div class="card">
                    			<div class="card-container">
                    				<div class="detail-box">
                    					
                    					<h4><?=$jobs['judul_jobs'];?></h4>
                    					<div class="row">
                    						<div class="col-sm-12 col-lg-6">
                    							<label>Pembuat</label>
                                                <p><?=$nama;?></p>
                                                <label>Harga Desain</label>
                    							<p><?=rupiah($jobs['harga'])." @ ".$jobs['ket_harga'];?></p>
                                            </div>
                    						<div class="col-sm-12 col-lg-6">
                    							<label>Creator</label>
                    							<p>
                                                <img class="img-thumbnail img-pembuat" src="<?=$path1.$jobs['foto_profil'];?>">                     
                                                </p>
                    						</div>
                    					</div>
                    					<label>Deskripsi</label>
                    					<p><?=$jobs['deskripsi'];?></p>
                    				</div>
                    			</div>
                    		</div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- END HOME -->
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
            function order(id){
                window.location.assign('order_jasa?id='+id);
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