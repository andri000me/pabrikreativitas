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

    $halaman=24;
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
    $cari='';
    $path='admin/assets/images/portofolio/';

    
    if (isset($_GET['search'])){        
        $cari=$_GET['search'];
        $qJobs = mysql_query("SELECT * FROM tb_jobs WHERE status='1' LIMIT $mulai, $halaman")or die(mysql_error);
        $result = mysql_query("SELECT id_jobs FROM tb_jobs");        
    }else{
        $qJobs = mysql_query("SELECT * FROM tb_jobs WHERE status='1' LIMIT $mulai, $halaman")or die(mysql_error);
        $result = mysql_query("SELECT id_jobs FROM tb_jobs"); 
    }

    $total = mysql_num_rows($result);
    $pages = ceil($total/$halaman); 
    $no =$mulai+1;
    ?>
        <div id="home" class="home-margin">
            <div class="container-fluid">
            <!-- Profil -->
                <div class="row">
                    <div class="col-lg-2">  
                        <div class="card">
                            <div class="card-container-search">
                                <input type="search" name="search" id="search" class="form-control" value="<?=$cari;?>" placeholder="Search...">                                    
                                <button class="btn btn-sm bg-btn-dark form-control" onclick="cari(<?=$page?>,'<?=$kb;?>',document.getElementById('search').value)"><span class="ion-search"></span></button>
                            </div>
                        </div>  
                    </div>
                    <div class="col-lg-10">         
                        <div class="card">
                            <div class="card-container">
                                <div class="form-inline">
                                    <div class="row">
                                        <?php
                                        if (mysql_num_rows($qJobs)<=0) { ?>
                                        <div class="col-md-12 p-t-2">          
                                    <div class="card card-border">                                               
                                        <div class="row clearfix"> 
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="text-center">         
                                                    <h4>Oops..</h4>
                                                    <h5>Data Tidak Ditemukan</h5>
                                                    <br>
                                                    <div class="mini-menu">
                                                        <a href="pasen?page=1&k=all">PASEN</a>
                                                        <a href="ugd?page=1&k=all">UGD</a>
                                                        <a href="urc?page=1&k=all">URC</a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>            
                                </div>
                                        <?php
                                        }else{
                                            while ($jobs=mysql_fetch_array($qJobs)) {
                                                $idJobs=$jobs['id_jobs'];
                                                $gambar=mysql_query("SELECT * FROM tb_gambar_jobs WHERE id_jobs='$idJobs' LIMIT 1")or die(mysql_error);
                                                $qGambar=mysql_fetch_array($gambar);
                                                if (strlen($jobs['judul_jobs'])>30) {
                                                    $namaUnit=str_pad(substr($jobs['judul_jobs'],0,30),35,".");
                                                }else{
                                                    $namaUnit=$jobs['judul_jobs'];
                                                }
                                            ?>
                                                <div class="col-sm-6 col-lg-2 col-xs-6 p-t-1">
                                                    <div class="form-group card card-cursor" onclick="detail('<?=$idJobs;?>')">
                                                        <img src="<?=$path.$qGambar['gambar_jobs'];?>" class="card-img-list img-thumbnail" style="border:none;"><br>
                                                        <div class="card-block">
                                                            <div class="card-name">
                                                                <p class="card-title text-left"><b><?=$namaUnit;?></b> <br> <?=rupiah($jobs['harga'])." ".$jobs['ket_harga'];?></p>
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
                            </div>
                        </div>
                    </div>
                </div>  
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                    <div class="col-lg-6">                        
                        <div class="m-b-20">
                            <center>
                                <button type="button" class="btn btn-sm bg-btn-dark waves-effect" onclick="pageBaru(1,'<?=$kb;?>')"><<</button>
                                <?php for ($i=1; $i<=$pages ; $i++){ ?>
                                    <button type="button" class="btn btn-sm bg-btn-light waves-effect" onclick="pageBaru(<?=$i;?>,'<?=$kb;?>')"><?=$i;?></button> 
                                <?php } ?>
                                <button type="button" class="btn btn-sm bg-btn-dark waves-effect" onclick="pageBaru(<?=$pages;?>,'<?=$kb;?>')">>></button>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        &nbsp;
                    </div>
                </div>
                <br> 
            <!-- END Profil -->
            </div>
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

       <script>
            var resizefunc = [];
            function detail(id){
                window.location.assign('detail_posyandu?id='+id);
            }
            function cari(page,cari){
                window.location.assign('?page='+page+'&search='+cari);
            }
            function pageBaru(page, kategori){
                window.location.assign('?page='+page+'&k='+kategori);
            }
        </script>

    </body>
</html>