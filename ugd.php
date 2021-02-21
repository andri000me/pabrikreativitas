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
    $getK=$_GET['k'];
    $cari='';
    $qKategori=mysql_query("SELECT * FROM tb_kategori");
    $path='admin/assets/images/ugd/';

    if ($getK!='all') { 
        $kb=$_GET['k'];
        $qDesain = mysql_query("SELECT * FROM tb_desain WHERE id_kategori='$kb' AND pemilik NOT IN (SELECT id_user FROM tb_user) LIMIT $mulai, $halaman")or die(mysql_error); 
        $result = mysql_query("SELECT id_desain FROM tb_desain");
    } else { 
        $kb='all'; 
        $qDesain = mysql_query("SELECT * FROM tb_desain WHERE pemilik NOT IN (SELECT id_user FROM tb_user) LIMIT $mulai, $halaman")or die(mysql_error);
        $result = mysql_query("SELECT id_desain FROM tb_desain");
    }

    if (isset($_GET['search'])){        
        $cari=$_GET['search'];
        if ($getK!='all') { 
            $kb=$_GET['k'];
            $qDesain = mysql_query("SELECT * FROM tb_desain WHERE id_kategori='$kb' AND pemilik NOT IN (SELECT id_user FROM tb_user) LIMIT $mulai, $halaman")or die(mysql_error);
            $result = mysql_query("SELECT id_desain FROM tb_desain");
          } else { 
            $kb='all'; 
            $qDesain = mysql_query("SELECT * FROM tb_desain WHERE pemilik NOT IN (SELECT id_user FROM tb_user) LIMIT $mulai, $halaman")or die(mysql_error);
            $result = mysql_query("SELECT id_desain FROM tb_desain");
          }
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
                        <div class="card c-t-1 c-b-2">
                            <div class="card-container">
                                <h4>Kategori</h4>
                                <div class="form-group">
                                    <div class="radio radio-warning">
                                    <?php 
                                        while ($kategori=mysql_fetch_array($qKategori)) {
                                            if ($getK==$kategori['id_kategori']) {
                                                $checked='checked';
                                            }else{
                                                $checked='';
                                            }
                                            ?>
                                            <input type="radio" name="kb" id="radio" value="<?=$kategori['id_kategori'];?>" onclick="cekCoba(<?=$page?>,this.value)" <?=$checked;?>>
                                            <label for="radio1"><?=$kategori['nama_kategori'];?></label><br>
                                            <?php
                                        }
                                    ?>
                                    </div>
                                </div>
                                <button class="btn btn-sm bg-btn-dark" style="width: 100%"; onclick="window.location.assign('ugd?page=1&k=all')">Tampilkan Semua</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-10">         
                        <div class="card">
                            <div class="card-container">
                                <div class="form-inline">
                                    <div class="row">
                                        <?php
                                        while ($desain=mysql_fetch_array($qDesain)) {
                                            $idDesain=$desain['id_desain'];
                                            $qGambar=mysql_query("SELECT * FROM tb_gambar_desain WHERE id_desain='$idDesain' LIMIT 1");
                                            $gambar=mysql_fetch_array($qGambar);
                                            if (strlen($desain['nama_desain'])>30) {
                                                $namaDesain=str_pad(substr($desain['nama_desain'],0,30),35,".");
                                            }else{
                                                $namaDesain=$desain['nama_desain'];
                                            }
                                        ?>
                                            <div class="col-sm-6 col-lg-2 col-xs-6 p-t-1">
                                                <div class="form-group card card-cursor" onclick="detail('<?=$idDesain;?>')">
                                                    <img src="<?=$path.$gambar['gambar_desain'];?>" class="card-img-list img-thumbnail"  style="border:none; object-fit: contain;"><br>
                                                    <div class="card-block">
                                                        <div class="card-name">
                                                            <p class="card-title text-left"><b><?=$namaDesain;?></b> <br> <?=rupiah($desain['harga']);?></p>
                                                        </div>                                      
                                                    </div>
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
                window.location.assign('detail_desain?id='+id);
            }
            function cari(page, kategori, cari){
                window.location.assign('?page='+page+'&k='+kategori+'&search='+cari);
            }
            function pageBaru(page, kategori){
                window.location.assign('?page='+page+'&k='+kategori);
            }
            function cekCoba(b,v){
                window.location.assign('?page='+b+'&k='+v);
            }
            function cari(page, kategori, cari){
                window.location.assign('?page='+page+'&k='+kategori+'&search='+cari);
            }
        </script>

    </body>
</html>