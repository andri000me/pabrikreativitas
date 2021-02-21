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
        <title>Tambah Desain</title>

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- Angular js-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

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
                                    <h4 class="page-title">Tambah Admin</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        <form method="POST" name="registerAdmin" action="php/proses_admin.php" enctype="multipart/form-data">                            
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="card" style="padding: 10px;">
                                                    <h5 class="header-title">Data Diri</h5>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <div class="form-group">
                                                                <label>Nama Lengkap</label>
                                                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Jenis Kelamin</label>
                                                                <select name="jenisKelamin" class="form-control" required>
                                                                    <option selected hidden>Jenis Kelamin</option>
                                                                    <option value="1">Laki - Laki</option>
                                                                    <option value="0">Perempuan</option>
                                                                </select>
                                                            </div>  
                                                            <div class="form-group">
                                                                <label>Email</label>  
                                                                <input type="email" name="email" class="form-control" placeholder="Masukan Email Anda" required>
                                                            </div>  
                                                            <div class="form-group">
                                                                <label>Posisi</label>
                                                                <select name="posisi" class="form-control" required>
                                                                    <option selected hidden>Posisi</option>
                                                                    <?php 
                                                                        $data=mysql_query("SELECT * FROM tb_jabatan");
                                                                        while ($posisi=mysql_fetch_array($data)) {
                                                                            echo "<option value=".$posisi['kode_jabatan'].">".$posisi['nama_jabatan']."</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>                               
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <div class="form-group">
                                                                <label>Tanggal Lahir</label>
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
                                                                                $dateY=date("Y")-17;
                                                                                for ($i=1960; $i<=$dateY; $i++) {
                                                                                    echo "<option value=".$i.">".$i."</option>";
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                        
                                                                    </div>                                                           
                                                                </div>
                                                            </div>  
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label>Kode Negara</label>                            
                                                                        <select name="kodeNegara" class="form-control" required>
                                                                            <option value="0" selected hidden>Kode Negara</option>
                                                                            <?php 
                                                                                $data=mysql_query("SELECT * FROM tb_negara");
                                                                                while ($negara=mysql_fetch_array($data)) {
                                                                                    echo "<option value=".$negara['kode_negara']."> +".$negara['kode_negara']." - ".$negara['nama_negara']."</option>";
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-8">
                                                                    <div class="form-group">
                                                                        <label>Nomor Handphone</label>                            
                                                                        <input type="number" name="noHp" class="form-control" placeholder="Nomor Handphone ex : 85794762345" required>
                                                                    </div>                                                     
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Username</label> <small class="text-muted">Perhatikan Besar dan Kecil Huruf</small>
                                                                <input type="text" name="username" class="form-control" placeholder="Masukan Username Anda" required>
                                                            </div>                                          
                                                        </div>
                                                    </div>  
                                                    <div class="form-group"> 
                                                        <label>Alamat</label>
                                                        <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap" rows="3" required style="resize: none;"></textarea>
                                                    </div> 
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="card" style="padding: 10px;">
                                                    <h5 class="header-title">Account</h5>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <label>Password <small class="text-muted" id="ket"></small></label>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <small class="text-muted" id="ket1"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div ng-app="myapp">
                                                                        <div ng-controller="PasswordController">
                                                                            <input type="password" ng-model="password" ng-change="analyze(password)" ng-style="passwordStrength" name="password" class="form-control" placeholder="Masukan Password" id="password" maxlength="8">   
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-lg-6">
                                                                    <div class="form-group">
                                                                        <input type="password" name="kPassword" class="form-control" placeholder="Masukan Password Lagi"  maxlength="8" required onkeyup="konfirmPassword(this.value)">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="col-sm-12 col-lg-12">
                                                            <label>Pertanyaan Keamanan</label>
                                                        </div>    
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group">                                
                                                                <select name="pertanyaan" class="form-control" required>
                                                                    <option selected hidden>Pilih Pertanyaan</option>
                                                                    <option value="p1">Nama Ibu Kandung ?</option>
                                                                    <option value="p2">Nama Sekolah SD Kamu ?</option>
                                                                    <option value="p3">Nama Teman Dekat Kamu ?</option>
                                                                    <option value="p4">Makanan Kesukaan Kamu ?</option>
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="col-sm-12 col-lg-6">
                                                            <div class="form-group">                        
                                                                <input type="text" name="jawaban" class="form-control" placeholder="Masukan Jawaban Anda" required>
                                                            </div>
                                                        </div>             
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <br>
                                        <center>
                                            <button type="submit" name="daftarAdmin" class="btn btn-md btn-primary-outline waves-effect waves-light w-md">Simpan</button>
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
            var myApp = angular.module("myapp", []);
            myApp.controller("PasswordController", function($scope) {

                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                $scope.passwordStrength = {
                    "width": "100%"
                };

                $scope.analyze = function(value) {
                    var panjang=value.length;
                    if (value=='') {
                        $scope.passwordStrength["background-color"] = "#ffffff";
                        $scope.passwordStrength["border-color"] = "#CED4DA";
                        scope.passwordStrength["color"] = "#000";
                        document.getElementById('ket').innerHTML='';
                    }else{
                        if (panjang<8) {
                            if(strongRegex.test(value)) {
                                $scope.passwordStrength["background-color"] = "#CCFF90";
                                $scope.passwordStrength["border-color"] = "#CED4DA";
                                scope.passwordStrength["color"] = "#000";
                                $scope.passwordStrength["display"] = "block";
                            } else if(mediumRegex.test(value)) {
                                $scope.passwordStrength["background-color"] = "#F4FF81";
                                $scope.passwordStrength["border-color"] = "#CED4DA";
                                scope.passwordStrength["color"] = "#000";
                                $scope.passwordStrength["display"] = "block";
                            } else {
                               $scope.passwordStrength["background-color"] = "#EF9A9A";
                               $scope.passwordStrength["border-color"] = "#CED4DA";
                               $scope.passwordStrength["color"] = "#000";
                               $scope.passwordStrength["display"] = "block";
                            }
                            document.getElementById('ket').innerHTML='Password Harus 8 Karakter';
                        }                       
                    }
                };

            });

            function konfirmPassword(kPass){
                var pass=document.getElementById('password').value;
                if (kPass!='') {
                    if (pass==kPass) {
                        document.registerAdmin.kPassword.style.backgroundColor='#CCFF90';
                    }else{                    
                        document.registerAdmin.kPassword.style.backgroundColor='#FF8A80';
                    }
                }else{
                    document.registerAdmin.kPassword.style.backgroundColor='#FFFFFF';
                }
            }
        </script>
        <script>
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