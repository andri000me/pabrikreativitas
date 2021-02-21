<?php
    include 'database/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="icon" type="image/ico" href="admin/assets/images/icon/favicon.ico" />

        <title>Pabrik Kreativitas | Register</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">

        <!-- Icon CSS -->
        <link href="assets/user_admin/css/ionicons.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="assets/user_admin/css/style_user.css" rel="stylesheet">

        <!-- Angular js-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

        <!-- Alertify -->
        <link href="assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
        <script src="assets/user_admin/js/alertify.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

</head>
<body>
        <div class="register-page">
            <img src="admin/assets/images/icon/logo-typo.png" class="img-responsive">
            <h4>Register</h4>
            <div class="register-form">
                <form method="POST" name="register" action="user/php/proses_user">
                    <div class="row">                        
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">                            
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenisKelamin" class="form-control" required>
                                    <option selected hidden>Jenis Kelamin</option>
                                    <option value="1">Laki - Laki</option>
                                    <option value="0">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
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
                        </div>
                        <div class="col-sm-12 col-lg-6">
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
                                        <input type="number" name="noHp" class="form-control" placeholder="Nomor Handphone" required>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Email</label>  
                                <input type="email" name="email" class="form-control" placeholder="Masukan Email Anda" required>
                            </div>   
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Username</label> <small class="text-muted">Perhatikan Besar dan Kecil Huruf</small>
                                <input type="text" name="username" class="form-control" placeholder="Masukan Username Anda" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group"> 
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap" rows="3" required></textarea>
                            </div>
                        </div>                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div ng-app="myapp">
                                <div ng-controller="PasswordController">
                                        <label>Password</label><small class="text-muted" id="ket"></small>
                                        <input type="password" ng-model="password" ng-change="analyze(password)" ng-style="passwordStrength" name="password" class="form-control" placeholder="Masukan Password" id="password" maxlength="8">
                                        
                                </div>
                            </div>                           
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                               <label>&nbsp;</label><small class="text-muted" id="ket1"></small>
                                <input type="password" name="kPassword" class="form-control" placeholder="Masukan Password Lagi"  maxlength="8" required onkeyup="konfirmPassword(this.value)">
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
                    <hr>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <label>Nama Bank</label>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <select class="form-control" name="bank" onchange="isiBank(this.value)">
                                        <option value="0" selected hidden>Nama Bank</option>
                                        <?php
                                            include 'database/koneksi.php';
                                            $bank=mysql_query("SELECT * FROM tb_bank");
                                            while ($hasil=mysql_fetch_array($bank)) {
                                                echo "<option value='".$hasil['id_bank']."'>".$hasil['nama_bank']."</option>";
                                            }
                                        ?>
                                        <option value="1">Lain-Lain</option>
                                    </select>                                        
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <input type="text" name="namaBank" id="namaBank" class="form-control" placeholder="...." readonly>               
                                </div>
                            </div>                           
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label>Rekening</label>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <input type="text" name="noRek" class="form-control" placeholder="Nomor Rekening">           
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <input type="text" name="namaPemilik" class="form-control" placeholder="Pemilik Rekening">               
                                </div>
                            </div>                            
                        </div>             
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" name="register" class="btn btn-sm btn-success form-control">Daftarkan Akun</button>
                    </div>
                </form>
            </div>
        </div>
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
                        document.register.kPassword.style.backgroundColor='#CCFF90';
                    }else{                    
                        document.register.kPassword.style.backgroundColor='#FF8A80';
                    }
                }else{
                    document.register.kPassword.style.backgroundColor='#FFFFFF';
                }
            }

            function isiBank(idBank){
                if (idBank==1) {
                    document.getElementById("namaBank").readOnly = false;
                    document.getElementById("namaBank").placeholder = "Masukan Nama Bank";
                }else{
                    document.getElementById("namaBank").readOnly = true;
                    document.getElementById("namaBank").placeholder = "....";
                }
            }
        </script>
</body>
</html>