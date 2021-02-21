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

    if (!isset($_SESSION['idUser'])) {
        $ds='0';
    }else{
        $ds='1';
    }

    if (isset($_GET['id'])) {
    	$idCetak=$_GET['id'];
 		$qCetak=mysql_query("SELECT * FROM tb_cetak WHERE id_cetak='$idCetak'");
        $cetak=mysql_fetch_array($qCetak);
 		$qGambar=$cetak['icon'];
 		$path='admin/assets/images/urc/';
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
                            <div class="item">
                                <div class="detail-slider">
                                    <img src="<?=$path.$qGambar;?>" class="detail-img" style="width:100%">
                                </div>
                            </div>
                            <br>
                            <center>
                                <input type="hidden" name="idDesain" value="<?=$idDesain;?>">
                            	<button  type="button" class="btn btn-sm bg-btn-dark" onclick="order(1,'<?=$ds;?>')"><i class="ion-forward" style="margin-right: 10px;"></i> Pesan</button>
                            </center>                        
                        </div>
                        <div class="col-md-7">
                            <form method="POST" action="user/php/proses_urc.php" enctype="multipart/form-data">
                            	<div class="card">
                        			<div class="card-container">
                        				<div class="detail-box">
                        					<h4><?=$cetak['jenis_cetak'];?></h4>
                                            <input type="hidden" name="idItem" value="<?=$_GET['id'];?>">
                        					<div class="row">
                        						<div class="col-sm-12 col-lg-6">
                        							<label>Harga Desain</label>
                        							<p><?=rupiah($cetak['harga'])." ".$cetak['ket_harga'];?></p>
                                                    <input type="hidden" id="hg" value="<?=$cetak['harga'];?>">
                        							<label>Format</label>
                        							<p><?=$cetak['format'];?></p>
                        						</div>
                        						<div class="col-sm-12 col-lg-6">
                        							<label>Pemesanan</label>
                        							<p><?='Minimal '.$cetak['min_pesan'].' / Maksimal '.$cetak['max_pesan'];?></p>
                                                    <input type="hidden" name="min_max" id="min_max" value="<?=$cetak['min_pesan'].",".$cetak['max_pesan'];?>">
                        						</div>
                        					</div>
                        					<label>Deskripsi</label>
                        					<p><?=$cetak['deskripsi'];?></p>
                                            <div class="row" id="buy" style="display: none;">
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label>Upload Desain</label><small> "jpg", "png", "jpeg", "bmp", "psd", "cdr"</small>
                                                        <input type="file" name="desain[]" class="form-control" autofocus>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Catatan Pesanan</label>
                                                        <input type="text" name="keterangan" class="form-control" placeholder="catatan untuk penjual">                    
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group form-inline">
                                                        <label>Format</label><small id="ketHarga"></small><br>
                                                        <?php
                                                            $pilihan=explode(',',$cetak['format']);
                                                            $bPilihan=count($pilihan);
                                                            for ($i=0; $i<$bPilihan ; $i++) { 
                                                            ?>
                                                            <input type="radio" name="format" value="<?=$pilihan[$i];?>"> <?=$pilihan[$i];?>
                                                            <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-lg-4">
                                                            <div class="form-group">
                                                                <label>Jumlah Pesan</label><small id="ketHarga"></small>
                                                                <input type="text" name="qty" class="form-control" onkeyup="cekPesanan(this.value)">
                                                            </div>                                                            
                                                        </div>
                                                        <div class="col-sm-12 col-lg-8">
                                                            <div class="form-group">
                                                                <label>Total (Rp)</label><small id="ketHarga"></small>
                                                                <input type="text" name="total" id="total" class="form-control" readonly>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                                <center>
                                                    <button type="submit" name="beli" class="btn btn-sm bg-btn-dark" onclick="order()"><i class="ion-bag" style="margin-right: 10px;"></i> Buy</button>
                                                    <button type="button" name="favorit" class="btn btn-sm bg-btn-love" onclick="order(0)"><i class="ion-close" style="margin-right: 10px;"></i> Batalkan</button>
                                                </center>  
                        				</div>
                        			</div>
                        		</div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section" style="padding: 0px 30px 0px 30px; margin-top: 50px;">
            		<div class="row" style="margin-bottom: 10px;">
                         <div class="col-lg-11">
                             <h4>Unit Gawat Cetak Lainnya</h4>
                         </div>  
                    </div>
                    <div class="row">                    
                    <?php 
                        $dataDesain=mysql_query("SELECT * FROM tb_cetak ORDER BY RAND() LIMIT 6");
                        while ($desain=mysql_fetch_array($dataDesain)) {
                            if (strlen($desain['jenis_cetak'])>30) {
                                    $idDesain=$desain['id_cetak'];
                                    $namaDesain=str_pad(substr($desain['jenis_cetak'],0,30),35,".");
                                }else{
                                    $namaDesain=$desain['jenis_cetak'];
                                }
                            ?>
                            <div class="col-sm-6 col-lg-2 col-xs-6" style="margin-top: 5px;">
                                <div class="form-group">
                                    <div class="card card-cursor" onclick="window.location.assign('detail_cetak?id=<?=$idDesain;?>')">
                                        <img src="<?=$path.$desain['icon'];?>" class="card-img-list img-thumbnail"  style="border:none; object-fit: cover;"><br>
                                        <div class="card-name">
                                            <p class="card-title"><?=$namaDesain;?><br><b><?=rupiah($desain['harga'])." ".$desain['ket_harga'];?></b></p>
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
            function order(x,y){
                if (y=='1') {
                    if (x==1) {
                        document.getElementById('buy').style.display='block';
                    }else{
                        document.getElementById('buy').style.display='none';
                    }                    
                }else{
                    window.location.assign('login');
                }
                
            }
            function titik(x){
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
            function cekPesanan(jml){
                var str=document.getElementById('min_max').value;
                var ex=str.split(",");
                var min=parseInt(ex[0]);
                var max=parseInt(ex[1]);
                var qty=parseInt(jml);
                var hg=parseInt(document.getElementById('hg').value);
                if (qty>=min && qty<=max) {
                    document.getElementById('ketHarga').innerHTML='';
                    document.getElementById('total').value=titik(qty*hg);
                }else{
                    document.getElementById('ketHarga').innerHTML=' min '+min+' max '+max;
                    document.getElementById('total').value='';
                }
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