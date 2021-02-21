<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/icon/favicon.ico">

        <!-- App title -->
        <title>Pasar Kreativitas | Admin</title>

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <?php 
            include 'part/top_bar.php'; 
            include 'part/side_bar.php'; 
            include '../database/koneksi.php';
            $qUser=mysql_query("SELECT id_user FROM tb_user");
            $jmlUser=mysql_num_rows($qUser); 
            $qSet=mysql_query("SELECT * FROM tb_settings");
            $Settings=mysql_fetch_array($qSet);
            $txtclient=$Settings['client'];
            $client=explode('-', $Settings['client']);
                if ($client[0]=='1') {
                    $dis='checked';
                    $dis1='';
                }else{
                    $dis='';
                    $dis1='checked';
                }

                if ($Settings['maintenance']=='1') {
                    $maintenance='checked';
                    $maintenance1='';
                }else{
                    $maintenance='';
                    $maintenance1='checked';
                }
            ?>
          
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Settings <small>Profil Perusahaan</small></h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="php/proses_settings.php">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Nama Perusahaan</label>
                                        <input type="text" name="nama" class="form-control" value="<?=$Settings['nama'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>No Telepon Perusahaan</label>
                                        <input type="text" name="nomor" class="form-control" value="<?=$Settings['nomor'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Perusahaan</label>
                                        <input type="email" name="email" class="form-control" value="<?=$Settings['email'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Perusahaan</label>
                                        <textarea class="form-control no-resize" rows="3" name="alamat"><?=$Settings['alamat'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>TagLine Perusahaan</label>
                                        <input type="text" name="tagline" class="form-control" value="<?=$Settings['tagline'];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Text Pop Up</label>
                                        <textarea class="form-control no-resize" rows="4" name="popup"><?=$Settings['popup'];?></textarea>
                                    </div>
                                </div>  
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        <label>Visi Perusahaan</label>
                                        <textarea class="form-control no-resize" rows="4" name="visi"><?=$Settings['visi'];?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Misi Perusahaan</label>
                                        <textarea class="form-control no-resize" rows="4" name="misi"><?=$Settings['misi'];?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Biaya Admin (Dalam %)</label>
                                                <input type="text" name="admin" class="form-control" value="<?=$Settings['keuntungan']*100;?>">
                                            </div>                                                                                        
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Biaya Admin Vaksin (Dalam %)</label>
                                                <input type="text" name="adminVaksin" class="form-control" value="<?=$Settings['keuntungan_visit']*100;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Section Client</label>
                                                <div class="form-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="client" value="1" <?=$dis;?>>On
                                                    </label>
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="client" value="0" <?=$dis1;?>>Off
                                                    </label>
                                                </div>                                                
                                            </div>
                                            <div class="form-group">
                                                <label>Maintenance Mode</label>
                                                <div class="form-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="maintenance" value="1" <?=$maintenance;?>>On
                                                    </label>
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="maintenance" value="0" <?=$maintenance1;?>>Off
                                                    </label>
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Section Client</label>
                                                <input type="text" name="sectionClient" class="form-control" value="<?=$client[1];?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                            <center><button type="submit" name="update" class="btn btn-primary-outline waves-effect waves-light">Simpan</button></center>
                        </div>  
                        </form>
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->

            <?php include 'part/footer.php';?>


        </div>
        <!-- END wrapper -->


        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/plugins/switchery/switchery.min.js"></script>

        <!--Morris Chart-->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

    </body>
</html>