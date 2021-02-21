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
        <title>Tambah Posyandu</title>

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
            $persen=$keuntungan['keuntungan']*100;
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
                                    <h4 class="page-title">Tambah Posyandu</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        <form method="POST" action="php/proses_posyandu.php" enctype="multipart/form-data">                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <h4 class="header-title m-t-0">Gambar Portofolio</h4>
                                                <p class="text-muted font-13 m-b-30">
                                                   Masukan bukti dokumentasi portofolio anda, dengan format png, jpg, jpeg atau bmp. Ukuran maksimal gambar adalah 1MB dan jumlah Gambar yang akan masuk hanya 5 gambar
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
                                                                <label>Nama Anda</label>
                                                                <input type="text" name="namaUser" class="form-control" required>   
                                                            </div>
                                                            <div class="form-group">  
                                                                <label>Judul Portofolio</label><small id="ketNama"></small>
                                                                <input type="text" name="judulPortofolio" class="form-control" onkeyup="cekNama(this.value)" maxlength="35" required>   
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Harga Jasa (Rp)</label>
                                                                        <input type="number" name="hargaJasa" class="form-control" placeholder="Harga Jasa Pembuatan" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label>Keterangan Harga</label>
                                                                        <input type="text" name="ketHarga" class="form-control" placeholder="Ex : per pcs" required>
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
                                                                <label>Kategori</label>
                                                                <select name="kategori" class="form-control" required>
                                                                    <option value="0" selected hidden>Kategori</option>
                                                                        <?php
                                                                            $qKategori=mysql_query("SELECT * FROM tb_kategori");
                                                                            while ($kategori=mysql_fetch_array($qKategori)) {
                                                                                echo "<option value=".$kategori['id_kategori'].">".$kategori['nama_kategori']."</option>";
                                                                            }
                                                                        ?>
                                                                </select>
                                                            </div>                                                  
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deskripsi</label><small id="ketCerita"> Minimal 200 Karakter dan Maksimal 500 Karakter</small><small id="sisaCerita"></small> 
                                                        <textarea name="text" id="text" class="form-control" rows="5" maxlength="500" style="resize: none;" onchange="addLine()" onkeyup="countChar()"></textarea>
                                                        <textarea name="deskripsi" id="dekripsi" class="form-control" rows="5" style="resize: none; display: none;"></textarea>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <br>
                                        <center>
                                            <button type="submit" name="tambahJobs" class="btn btn-md btn-primary-outline waves-effect waves-light w-md">Simpan</button>
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