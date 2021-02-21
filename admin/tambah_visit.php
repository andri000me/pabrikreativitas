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
        <title>Tambah VAKSIN</title>

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
                                    <h4 class="page-title">Tambah VAKSIN</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        <form method="POST" action="php/proses_visit.php" enctype="multipart/form-data">                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <h4 class="header-title m-t-0">Gambar Poster</h4>
                                                <p class="text-muted font-13 m-b-30">
                                                    Masukan gambar poster, dengan format png, jpg, jpeg atau bmp. Ukuran maksimal gambar adalah 1MB dan jumlah Gambar yang akan masuk hanya 5 gambar
                                                </p>
                                                <div class="card">
                                                    <div class="p-20">
                                                        <div class="form-group clearfix">
                                                            <div class="col-sm-12 p-t-2">
                                                                <input type="file" name="desain[]" id="fileUpload" multiple="multiple" class="form-control" onchange="file()" style="margin-bottom: 5px;">
                                                                <ol id="list" type="1"></ol>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="card" style="padding: 10px;">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Nama Acara</label><small id="ketNama"></small>
                                                                <input type="text" name="namaAcara" class="form-control" onkeyup="cekNama(this.value)">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pemilik Acara</label>
                                                                <input type="text" name="pemilikAcara" class="form-control">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-5">
                                                                    <div class="form-group">
                                                                        <label>Biaya (Rp)</label>
                                                                        <input type="text" name="biaya" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                                                                    </div>                                            
                                                                </div>
                                                                <div class="col-sm-12 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Tiket</label>
                                                                        <select name="tiket" class="form-control">
                                                                            <option selected hidden>Pilih Status Tiket</option>
                                                                            <option value="1"> Ya </option>
                                                                            <option value="0"> Tidak </option>
                                                                        </select>
                                                                    </div> 
                                                                </div>
                                                                <div class="col-sm-12 col-lg-3">
                                                                    <div class="form-group">
                                                                        <label>Jml Tiket</label>
                                                                        <input type="text" name="jmlTiket" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                                                                    </div>                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Upload</label>
                                                                <input type="text" name="tanggalUpload" class="form-control" value="<?=tanggal(date("Y-m-d"));?>" readonly>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Lokas Acara</label>
                                                                <input type="text" name="lokasi" class="form-control">
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Tanggal Visit</label>
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
                                                                                $dateX=date("Y")-10;
                                                                                $dateY=date("Y");
                                                                                for ($i=$dateX; $i<=$dateY; $i++) {
                                                                                    echo "<option value=".$i.">".$i."</option>";
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                        
                                                                    </div>                                                           
                                                                </div>
                                                            </div>                                                      
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Include</label> 
                                                        <textarea name="includetxt" id="includetxt" class="form-control" rows="5" maxlength="500" style="resize: none;" onchange="addLinee()"></textarea>
                                                        <textarea name="include" id="include" class="form-control" rows="5" style="resize: none; display: none;"></textarea>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <br>
                                        <center>
                                            <button type="submit" name="daftar" class="btn btn-md btn-primary-outline waves-effect waves-light w-md">Simpan</button>
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

            <footer class="footer text-right">
                2016 © Uplon.
            </footer>


        </div>
        <!-- END wrapper -->

        <script type="text/javascript">
            function cW(){
                if (document.getElementById('cwY').checked) {
                  document.getElementById('warna').style.display='block';
                }else{
                  document.getElementById('warna').style.display='none'; 
                } 
            }
            function cT(){
                if (document.getElementById('ctY').checked) {
                  document.getElementById('txt').style.display='block';
                }else{
                  document.getElementById('txt').style.display='none'; 
                } 
            }

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
            function addLinee(){
                var text=document.getElementById('includetxt').value;
                var text=text.replace(/\r?\n/g, '<br>');
                document.getElementById('include').value=text;

            }
            function file() {
                $("#list").empty();
                var fi = document.getElementById('fileUpload');
                // VALIDATE OR CHECK IF ANY FILE IS SELECTED.
                if (fi.files.length<=5) {

                    // RUN A LOOP TO CHECK EACH SELECTED FILE.
                    for (var i = 0; i <= fi.files.length - 1; i++) {

                        var fname = fi.files.item(i).name;// THE NAME OF THE FILE.
                        var fsize = fi.files.item(i).size;// THE SIZE OF THE FILE.
                        var fmb = (fsize/1048576).toFixed(2);
                        $("#list").append("<li>"+fname+" (<b>"+fmb+"MB</b>)"+"</li>");
                        // SHOW THE EXTRACTED DETAILS OF THE FILE.
                    }
                }
                else { 
                    alert('Maksimal 5 Gambar'); 
                    document.getElementById('fileUpload').value='';
                }
            }
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