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
            if (isset($_GET['id'])) {
                $idClient=$_GET['id'];
                $client=mysql_query("SELECT * FROM tb_client WHERE id_client='$idClient'");
                $dataClient=mysql_fetch_array($client);
                $tgl=explode('-', $dataClient['tgl_mou']);
            }else{
                echo "<script>window.location.assign('list_desain');</script>";
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
                                    <h4 class="page-title">Edit Client <small>Kerja Sama</small></h4>
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
                                                                <input type="text" name="nama" class="form-control" value="<?=$dataClient['nama_client'];?>" required>
                                                                <input type="hidden" name="idClient" class="form-control" value="<?=$dataClient['id_client'];?>" required>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Tanggal Kerja Sama</label>
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <select name="hari" class="form-control" required>
                                                                            <option value="0" selected hidden>Hari</option>
                                                                            <?php 
                                                                                for ($i=1; $i<=31 ; $i++) { 
                                                                                    if ($i==$tgl[2]) {
                                                                                        $selected='selected';
                                                                                    }else{
                                                                                        $selected='';
                                                                                    }?>
                                                                                    <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>   
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <select name="bulan" class="form-control" required>
                                                                            <option value="0" selected hidden>Bulan</option> 
                                                                            <?php
                                                                                for ($i=1; $i<=12 ; $i++) { 
                                                                                    if (strlen($i)=='1') {
                                                                                        $v='0'.$i;
                                                                                    }else{
                                                                                        $v=$i;
                                                                                    }
                                                                                    if ($v==$tgl[1]) {
                                                                                        $selected='selected';
                                                                                    }else{
                                                                                        $selected='';
                                                                                    }
                                                                                    ?>
                                                                                        <option value="<?=$v;?>" <?=$selected;?>><?=bulan($v);?></option>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                            
                                                                        </select>                                        
                                                                    </div>                               
                                                                    <div class="col-sm-12 col-lg-4">
                                                                        <select name="tahun" class="form-control" required>
                                                                            <option value="0" selected hidden>Tahun</option>
                                                                            <?php 
                                                                                $dateY=date("Y");
                                                                                for ($i=2000; $i<=$dateY; $i++) {
                                                                                    if ($i==$tgl[0]) {
                                                                                        $selected='selected';
                                                                                    }else{
                                                                                        $selected='';
                                                                                    }?>
                                                                                        <option value="<?=$i;?>" <?=$selected;?>><?=$i;?></option>
                                                                                    <?php
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
                                                                <input type="text" name="pemilik" class="form-control" value="<?=$dataClient['pemilik'];?>" required>
                                                            </div>                                                   
                                                            <div class="form-group">
                                                                <label>Nomor Handphone</label>                            
                                                                <input type="number" name="noHp" class="form-control" value="<?=$dataClient['no_hp'];?>" required>
                                                            </div>                                   
                                                        </div>
                                                    </div>  
                                                    
                                                    <div class="form-group"> 
                                                        <label>Alamat</label>
                                                        <textarea class="form-control" name="alamat" rows="3" required style="resize: none;"><?=$dataClient['alamat'];?></textarea>
                                                    </div>  

                                                </div>
                                            </div>                                            
                                        </div>
                                        <!-- end row -->
                                        <br>
                                        <center>
                                            <button type="submit" name="ubahClient" class="btn btn-md btn-primary-outline waves-effect waves-light w-md">Ubah</button>
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