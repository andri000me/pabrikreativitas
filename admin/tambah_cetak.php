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
        <title>Tambah Unit Cetak</title>

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
            $keuntungan=mysql_fetch_array(mysql_query("SELECT keuntungan FROM tb_settings"));
            $persen=($keuntungan['keuntungan']*100)."%";
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
                                    <h4 class="page-title">Tambah Unit Cetak</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        <form method="POST" name="unitCetak" action="php/proses_cetak.php" enctype="multipart/form-data">                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="card" style="padding: 10px;">
                                                    <h5 class="header-title">Data Unit Cetak</h5>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <div class="form-group">
                                                                <label>Jenis Cetak</label><small id="ketNama"></small>
                                                                <input type="text" name="jenisCetak" placeholder="Masukan Jenis Unit Cetak"  class="form-control" onkeyup="cekNama(this.value)">
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Format</label><small> Format Dari Jenis Unit Cetak</small>
                                                                <input type="text" name="format" class="form-control" placeholder="Pisahkan Dengan Koma. Ex : A4,A3,F4" required>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Icon</label>
                                                                <input type="file" name="icon[]" class="form-control" required>
                                                            </div>                                  
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label>Pemesanan</label>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-group">
                                                                        <input type="number" name="min" class="form-control" placeholder="Minimal Pemesanan" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-group">
                                                                        <input type="number" name="max" class="form-control" placeholder="Maksimal Pemesanan" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <div class="row">
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Harga URC (Rp)</label><small> Harga Jual Ditambah <?=$persen;?></small>
                                                                        <input type="text" name="hargaUnit" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Keterangan</label>
                                                                        <input type="text" name="ketHarga" class="form-control" placeholder="Ex : per pcs" required>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                            </div>                                    
                                                        </div>
                                                    </div>  
                                                    
                                                    <div class="form-group">
                                                        <label>Deskripsi</label><small id="ketCerita"> Minimal 200 Karakter dan Maksimal 500 Karakter</small><small id="sisaCerita"></small> 
                                                        <textarea name="text" id="text" class="form-control" rows="5" maxlength="500" style="resize: none;" onchange="addLine()" onkeyup="countChar()"></textarea>
                                                        <textarea name="dekripsi" id="dekripsi" class="form-control" rows="5" style="resize: none; display: none;"></textarea>
                                                    </div> 

                                                </div>
                                            </div>                                            
                                        </div>
                                        <!-- end row -->
                                        <br>
                                        <center>
                                            <button type="submit" name="simpanCetak" class="btn btn-md btn-primary-outline waves-effect waves-light w-md">Simpan</button>
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
          function cekNama(name){
                var l=name.length;
                if (l>=30&&l<=35) {
                    var ket='Hanya 30 karakter saja yang akan di tampilkan';
                }else if(l<20){
                    var ket='Nama desain minimal 20 karakter';
                }else if(l>35){
                    var ket='Nama desain maksimal 35 karakter';
                }else{
                    var ket='Nama desain sesuai';
                }
                document.getElementById('ketNama').innerHTML =' '+ket;
            }

            function countChar(){
                var txt=document.getElementById('text').value;
                var a=txt.length;
                var b=0;
                var c=b+a;
                if (a<200) {
                    document.getElementById('ketCerita').innerHTML =' Minimal 200 Karakter | ';
                }else{
                    document.getElementById('ketCerita').innerHTML =' Maksimal 500 Karakter | ';
                }            
                document.getElementById('sisaCerita').innerHTML =c+'/500';
            }

            function addLine(){
                var text=document.getElementById('text').value;
                var text=text.replace(/\r?\n/g, '<br>');
                document.getElementById('dekripsi').value=text;

            }
          jQuery(function($) {
              $('.autonumber').autoNumeric('init');
          });
        </script>

        

    </body>
</html>