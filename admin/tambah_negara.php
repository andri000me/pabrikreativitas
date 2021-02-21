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
        <title>Tambah Negara</title>

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
                                    <h4 class="page-title">Tambah Negara</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

                        <form method="POST" name="registerAdmin" action="php/proses_negara.php" enctype="multipart/form-data">                            
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
                                                                <label>Kode Negara </label><a href="https://www.maxmanroe.com/daftar-kode-telepon-internasional.html" target="blank" class="label label-warning" style="margin-left: 10px;">Daftar Kode Telepon Negara</a>
                                                                <input type="text" name="kodeNegara" class="form-control" placeholder="Masukan Kode Telepon Negara" required>
                                                            </div> 
                                                            <div class="form-group">
                                                                <label>Nama Negara</label>  
                                                                <input type="text" name="namaNegara" class="form-control" placeholder="Masukan Nama Negara" required>
                                                            </div>                                                             
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <br>
                                        <center>
                                            <button type="submit" name="daftarNegara" class="btn btn-md btn-primary-outline waves-effect waves-light w-md">Simpan</button>
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