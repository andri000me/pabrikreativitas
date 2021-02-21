<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="admin/assets/images/icon/favicon.ico" />
        <title>Pabrik Kreativitas | Order</title>

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
       echo "<script>window.location.assign('login');</script>";
    }
    if (isset($_GET['id'])) {
        $idJobs=$_GET['id'];
        $qDesain=mysql_query("SELECT * FROM tb_jobs WHERE id_jobs='$idJobs'");
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
                            <input type="hidden" id="kd" value="<?=md5($idUser),md5($idJobs);?>">
                            <button class="btn btn-sm bg-btn-danger" onclick="window.history.go(-1);"><i class="ion-close" style="margin-right: 10px;"></i> Batalkan</button>
                            <button class="btn btn-sm bg-btn-dark" onclick="keranjang('<?=$idJobs;?>','<?=$idUser;?>')"><i class="ion-bag" style="margin-right: 10px;"></i> Buy</button>
                        </center>                        
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-container">
                                <div class="detail-box">
                                    <?php $desain=mysql_fetch_array($qDesain); ?>
                                    <h4><?=$desain['judul_jobs'];?></h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Harga Desain</label>
                                                <p><?=rupiah($desain['harga']);?></p>
                                                <input type="hidden" id="hg" value="<?=$desain['harga'];?>">   
                                            </div>
                                            <div class="form-group">
                                                <label>Qty</label><small id="ketQty"></small>
                                                <input type="number" name="qty" id="qty" class="form-control" style="margin-bottom: 5px;" onkeyup="cekQty(this.value)" autofocus>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Tanggal Transaksi</label>
                                                <p><?=tanggal(date('Y-m-d'));?></p>
                                            </div>
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" name="total" id="total" class="form-control" style="margin-bottom: 5px;" readonly>
                                            </div>
                                        </div>  
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="form-group">
                                                <label>Penjelasan Pesanan</label>
                                                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="catatan untuk penjual">                    
                                            </div>
                                        </div>
                                    </div>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
            function customText(maxText){
                txt=document.getElementById('customText').value;
                lengthTxt=txt.length;
                sisa=0+parseInt(lengthTxt)
                document.getElementById('txtCs').innerHTML=' '+sisa+'/'+maxText;
            }
            function cekQty(q) {
                if (q<0) {
                    document.getElementById('ketQty').innerHTML=' Minimal Pembelian 1 Buah';
                }else{
                    var r = document.getElementById('hg').value;
                    var t = q*r;
                    document.getElementById('total').value=titik(t);
                }
            }

            function titik(x){
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function color(clr){
                document.getElementById('bgColor').value=clr;
            }
            function keranjang(idDesain, user){
                var qty=document.getElementById('qty').value;
                if (qty!='') {
                    var kd=document.getElementById('kd').value;
                    var idUser=user;
                    var item=idDesain;
                    var csTxt=document.getElementById('keterangan').value;
                    var t=document.getElementById('total').value;
                    var total=t.replace('.','');
                    window.location.assign('user/php/proses_jasa?kd='+kd+'&id='+idUser+'&q='+qty+'&i='+item+'&t='+total+'&cat='+csTxt);
                }else{
                    document.getElementById('qty').focus();
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