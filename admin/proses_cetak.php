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
        <title>Proses Unit Cetak</title>

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
            $noInvoice=$_GET['id'];
            $qCetak=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, jenis_cetak, tgl_transaksi, sub_total, tb_detail_transaksi.format, qty, catatan, file, kurir, ongkir  FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_cetak ON tb_detail_transaksi.id_item=tb_cetak.id_cetak JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user  WHERE tb_transaksi.no_invoice = '$noInvoice'") or die(mysql_error());
            $dataCetak=mysql_fetch_array($qCetak);
            $file='assets/file/'.$dataCetak['file'];
            
            switch ($dataCetak['status']) {
                case '7':
                    $proses='display:none';
                    $kirim='display:block';
                    break;
                
                default:
                    $proses='display:block';
                    $kirim='display:none';
                    break;
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
                                    <h4 class="page-title">Proses Unit Cetak</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        
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
                                                                <p class="buttom-border"><?=$dataCetak['jenis_cetak'];?></p>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Format</label><small> Format Dari Jenis Unit Cetak</small>
                                                                <p class="buttom-border"><?=$dataCetak['format'];?></p>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Jasa Pengiriman</label><br>
                                                                <p class="buttom-border"><?=$dataCetak['kurir']." - ".rupiah($dataCetak['ongkir']);?></p>
                                                            </div>                                  
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="form-group">
                                                                <label>Pemesanan</label>
                                                                <p class="buttom-border"><?=$dataCetak['qty'];?></p>
                                                            </div> 
                                                            <div class="form-group">
                                                                 <label>Keterangan</label>
                                                                <p class="buttom-border"><?=$dataCetak['catatan'];?></p> 
                                                            </div>          
                                                            <div class="form-group">
                                                                <label>Download File</label><br>
                                                                <a href="<?=$file;?>"><button type="button" class="btn btn-dark waves-effect waves-light"><i class="fa fa-download"></i> Download</button></a>
                                                            </div>                             
                                                        </div>
                                                    </div>  

                                                </div>
                                            </div>                                            
                                        </div>
                                        <!-- end row -->
                                        <br>
                                        <center>
                                            <form method="POST" action="php/proses_cetak.php" >
                                                <input type="hidden" name="noInvoice" value="<?=$_GET['id'];?>">
                                                <div class="form-inline">
                                                    <button type="submit" name="prosesCetak" class="btn btn-md btn-success-outline waves-effect waves-light w-md" style="<?=$proses;?>">Proses</button>
                                                    <div id="kirim" style="<?=$kirim;?>">
                                                        <input type="text" name="noResi" class="form-control" placeholder="Input No Resi">
                                                        <button type="submit" name="kirim" class="btn btn-md btn-dark-outline waves-effect waves-light w-md">Kirim Barang</button>                                           
                                                    </div>
                                                </div>
                                            </form>
                                        </center>
                            		</div>
                                </div><!-- end col-->                                
                            </div>
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