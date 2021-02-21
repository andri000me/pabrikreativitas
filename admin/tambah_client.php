<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="icon" type="image/ico" href="assets/images/icon/favicon.ico" />

        <!-- App title -->
        <title>Tambah Client</title>

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
                                    <h4 class="page-title">Tambah Client <small>Kerja Sama</small></h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        <form method="POST" name="registerAdmin" action="php/proses_client.php" enctype="multipart/form-data">                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="card" style="padding: 10px;">
                                                    <h5 class="header-title">Data Client</h5>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <div class="form-group">
                                                                <label>Nama Client</label>
                                                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Perusahaan/Organisasi" required>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Tanggal Kerja Sama</label>
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <select name="hari" class="form-control" required>
                                                                            <option value="0" selected hidden>Hari</option>
                                                                            <?php 
                                                                                for ($i=1; $i<=31 ; $i++) { 
                                                                                    echo "<option value=".$i.">".$i."</option>";
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>   
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <select name="bulan" class="form-control" required>
                                                                            <option value="0" selected hidden>Bulan</option> 
                                                                            <option value="01">Januari</option>
                                                                            <option value="02">Februari</option>
                                                                            <option value="03">Maret</option>
                                                                            <option value="04">April</option>
                                                                            <option value="05">Mei</option>
                                                                            <option value="06">Juni</option>
                                                                            <option value="07">Juli</option>
                                                                            <option value="08">Agustus</option>
                                                                            <option value="09">September</option>
                                                                            <option value="10">Oktober</option>
                                                                            <option value="11">November</option>
                                                                            <option value="12">Desember</option>
                                                                        </select>                                        
                                                                    </div>                               
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <select name="tahun" class="form-control" required>
                                                                            <option value="0" selected hidden>Tahun</option>
                                                                            <?php 
                                                                                $dateY=date("Y");
                                                                                for ($i=2000; $i<=$dateY; $i++) {
                                                                                    echo "<option value=".$i.">".$i."</option>";
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                        
                                                                    </div>                                                           
                                                                </div>
                                                            </div>                                  
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="form-group">
                                                                <label>Pemilik</label>
                                                                <input type="text" name="pemilik" class="form-control" placeholder="Masukan Nama Pemilik Perusahaan/Organisasi" required>
                                                            </div>                                                   
                                                            <div class="form-group">
                                                                <label>Nomor Handphone</label>                            
                                                                <input type="number" name="noHp" class="form-control" placeholder="Nomor Handphone Pemilik Perusahaan/Organisasi" required>
                                                            </div>                                   
                                                        </div>
                                                    </div>  
                                                    
                                                    <div class="form-group"> 
                                                        <label>Alamat</label>
                                                        <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap Perusahaan/Organisasi" rows="3" required style="resize: none;"></textarea>
                                                    </div>  

                                                </div>
                                            </div>                                            
                                        </div>
                                        <!-- end row -->
                                        <br>
                                        <center>
                                            <button type="submit" name="simpanClient" class="btn btn-md btn-primary-outline waves-effect waves-light w-md">Simpan</button>
                                            <button type="reset" class="btn btn-md btn-danger-outline waves-effect waves-light w-md">Batal</button>
                                        </center>
                            		</div>
                                </div><!-- end col-->                                
                            </div>
                        </form>
                        <!-- end row -->
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>
            <!-- End content-page -->

            <?php include 'part/footer.php';?>


        </div>
        <!-- END wrapper -->

        <script type="text/javascript">
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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

        <script type="text/javascript">
          jQuery(function($) {
              $('.autonumber').autoNumeric('init');
          });
        </script>

        

    </body>
</html>