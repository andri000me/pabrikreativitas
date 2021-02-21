<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="../admin/assets/images/icon/favicon.ico" />
        <title>Pabrik Kreativitas</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="../assets/user_admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- Owl Carousel CSS -->
        <link href="../assets/user_admin/css/owl.carousel.css" rel="stylesheet">
        <link href="../assets/user_admin/css/owl.theme.default.min.css" rel="stylesheet">

        <!-- Angular js-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>

        <!-- Icon CSS -->
        <link href="../assets/user_admin/css/ionicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Custom styles for this template -->
        <link href="../assets/user_admin/css/style_user.css" rel="stylesheet">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body data-spy="scroll" data-target="#navbar-menu">

    <?php 
    include '../database/koneksi.php';
    include 'part/header_menu.php'; 
    $qProfil=mysql_query("SELECT * FROM tb_user WHERE id_user='$idUser'");
    $profil=mysql_fetch_array($qProfil);
    if ($profil['jenis_kelamin']==1) {
        $jenisKelamin='Laki-laki';
    }else{
        $jenisKelamin='Perempuan';
    }
    ?>
        <div class="box">
            <!-- HOME -->
            <section id="home" class="home-margin">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 ">                    
                                    <div class="card-block">
                                        <img class="card-img img-fluid sampul" src="assets/images/user/<?=$profil['foto_sampul'];?>">
                                        <div class="card-profil">
                                            <img src="assets/images/user/<?=$profil['foto_profil'];?>" alt="user" class="img-foto img-profil" style="border: 1px solid">
                                        </div>
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END HOME -->
            <section id="profil" class="m-t-20">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="p-t-2">            
                                <div class="card">
                                    <div class="card-container">
                                        <form method="POST" name="profil" action="php/proses_user" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">                                
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" name="nama" class="form-control" value="<?=$profil['nama_user'];?>" readonly>
                                                        <input type="hidden" name="idUser" class="form-control" value="<?=$idUser;?>">
                                                    </div>
                                                    <div class="form-group"> 
                                                        <label>Tanggal Lahir</label>
                                                        <input type="text" name="tgl_lahir" class="form-control" value="<?=tanggal($profil['tgl_lahir']);?>" readonly>
                                                        <div class="row" id="tglLahir" style="display: none;">
                                                            <div class="col-sm-12 col-lg-3">
                                                                <select name="hari" class="form-control" required>
                                                                    <option value="0" selected hidden>Hari</option>
                                                                    <?php 
                                                                        for ($i=1; $i<=31 ; $i++) { 
                                                                            echo "<option value=".$i.">".$i."</option>";
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>   
                                                            <div class="col-sm-12 col-lg-3">
                                                                <select name="bulan" class="form-control" required>
                                                                    <option value="0" selected hidden>Bulan</option> 
                                                                    <option value="1">January</option>
                                                                    <option value="2">February</option>
                                                                    <option value="3">March</option>
                                                                    <option value="4">April</option>
                                                                    <option value="5">May</option>
                                                                    <option value="6">June</option>
                                                                    <option value="7">July</option>
                                                                    <option value="8">August</option>
                                                                    <option value="9">September</option>
                                                                    <option value="10">October</option>
                                                                    <option value="11">November</option>
                                                                    <option value="12">December</option>
                                                                </select>                                        
                                                            </div>                               
                                                            <div class="col-sm-12 col-lg-3">
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
                                                    <div class="form-group"> 
                                                        <label>Jenis Kelamin</label>
                                                        <input type="text" name="jk" class="form-control" value="<?=$jenisKelamin;?>" readonly>
                                                        <select name="jenisKelamin" id="jenisKelamin" class="form-control" required style="display: none;">
                                                            <option value="1" <?php if($profil['jenis_kelamin']=='1'){echo "selected";} ?>>Laki - Laki</option>
                                                            <option value="0" <?php if($profil['jenis_kelamin']=='0'){echo "selected";} ?>>Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group"> 
                                                        <div id="no_hp">
                                                            <label>Nomor Handphone</label>
                                                            <input type="text" name="noHp" class="form-control" value="<?=$profil['no_hp'];?>" readonly>
                                                        </div>
                                                        <div id="edit_hp" style="display: none;">
                                                            <label>Nomor Handphone</label>
                                                            <div class="row">
                                                                <div class="col-lg-2 col-sm-12">
                                                                    <select name="kodeNegara" class="form-control">
                                                                        <?php
                                                                            $sN=substr($profil['no_hp'],0,2);
                                                                            $qN=mysql_query("SELECT * FROM tb_negara");
                                                                            while ($r=mysql_fetch_array($qN)) {
                                                                                if ($r['kode_negara']==$sN) $s='selected'; else $s='';
                                                                            ?>
                                                                            <option value="<?=$r['kode_negara'];?>" <?=$s;?>><?=$r['kode_negara'];?></option>
                                                                            <?php
                                                                            }

                                                                        ?>                                                                
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-10 col-sm-12">
                                                                    <input type="text" name="noHp" class="form-control" value="<?=substr($profil['no_hp'],2,12);?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group"> 
                                                        <label>Email</label>
                                                        <input type="email" name="email" class="form-control" value="<?=$profil['email'];?>" readonly>
                                                    </div>
                                                    <div class="form-group"> 
                                                        <label>Nomor Handphone</label>
                                                        <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap" rows="2" readonly><?=$profil['alamat'];?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">                                
                                                        <label>Username</label>
                                                        <input type="text" name="username" class="form-control" value="<?=$profil['username'];?>" readonly>
                                                    </div>                                
                                                    <div class="form-group">                                
                                                        <label>Foto Profil</label>
                                                        <input type="file" name="fotoProfil" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group">                                
                                                        <label>Foto Sampul</label>
                                                        <input type="file" name="fotoSampul" class="form-control" disabled>
                                                    </div>
                                                    <div class="form-group">                                
                                                        <label>Password</label><small class="text-muted" id="ket"></small>
                                                        <div ng-app="myapp">
                                                            <div ng-controller="PasswordController">
                                                                <input type="password" ng-model="password" ng-change="analyze(password)" ng-style="passwordStrength" name="password" class="form-control" placeholder="Masukan Password" id="password" maxlength="8" readonly>
                                                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <small class="text-muted" id="ket1"></small>
                                                        <input type="password" name="kPassword" class="form-control" placeholder="Masukan Password Lagi"  maxlength="8" onkeyup="konfirmPassword(this.value)" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="button" style="display: none;">
                                                <center>  
                                                    <button type="submit" name="update" class="btn btn-success btn-sm" id="simpan">Simpan</button>
                                                    <button type="button" onclick="window.location.assign('profil')" class="btn btn-danger btn-sm" id="batal">Batal</button>
                                                </center>
                                            </div>
                                            <div id="button1" style="display: none;">
                                                <center>
                                                    <button type="submit" name="updatePasword" class="btn btn-success btn-sm" id="simpanpass">Simpan</button>
                                                    <button type="button" onclick="window.location.assign('profil')" class="btn btn-danger btn-sm" id="batal">Batal</button>
                                                </center>
                                            </div>
                                        </form>
                                            <center>                        
                                                <button type="button" class="btn btn-primary btn-sm" id="edit" onclick="edit()">Edit Profil</button>
                                                <button type="button" class="btn btn-primary btn-sm" id="editPass" onclick="editPass()">Ubah Password</button>
                                            </center>
                                    </div>            
                                </div> 
                            </div>  
                        </div>
                    </div>
                </div>
            </section>
        
        </div>
        <?php include 'part/footer.php'; ?>


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../assets/user_admin/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/user_admin/js/bootstrap.min.js"></script>

        <!-- Jquery easing -->                                                      
        <script type="text/javascript" src="../assets/user_admin/js/jquery.easing.1.3.min.js"></script>

        <!-- Owl Carousel -->                                                      
        <script type="text/javascript" src="../assets/user_admin/js/owl.carousel.min.js"></script>

        <!--sticky header-->
        <script type="text/javascript" src="../assets/user_admin/js/jquery.sticky.js"></script>

        <!--common script for all pages-->
        <script src="../assets/user_admin/js/jquery.app.js"></script>

        <script type="text/javascript">
            function edit(){
                document.getElementById('edit').style.display='none';
                document.getElementById('editPass').style.display='none';
                document.getElementById('simpanpass').style.display='none';
                document.getElementById('button').style.display='block';
                document.profil.nama.readOnly=false;
                document.profil.tgl_lahir.style.display='none';
                document.getElementById('tglLahir').style.display='block';
                document.profil.jk.style.display='none';
                document.getElementById('jenisKelamin').style.display='block';
                document.getElementById('edit_hp').style.display='block';
                document.getElementById('no_hp').style.display='none';
                document.profil.email.readOnly=false;
                document.profil.alamat.readOnly=false;
                document.profil.username.readOnly=false;;
                document.profil.fotoProfil.disabled=false;
                document.profil.fotoSampul.disabled=false;
            }

            function editPass(){  
                document.getElementById('edit').style.display='none';
                document.getElementById('editPass').style.display='none';
                document.getElementById('simpan').style.display='none'; 
                document.getElementById('button1').style.display='block';             
                document.profil.password.readOnly=false;
                document.profil.kPassword.readOnly=false
            }
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
                                $scope.passwordStrength["background-color"] = "#CCFF90";
                                $scope.passwordStrength["border-color"] = "#CED4DA";
                                scope.passwordStrength["color"] = "#000";
                                $scope.passwordStrength["display"] = "block";
                            } else {
                               $scope.passwordStrength["background-color"] = "#EF9A9A";
                               $scope.passwordStrength["border-color"] = "#CED4DA";
                               $scope.passwordStrength["color"] = "#000";
                               $scope.passwordStrength["display"] = "block";
                            }
                            document.getElementById('ket').innerHTML=' Password Harus 8 Karakter';
                        }                       
                    }
                };

            });

            function konfirmPassword(kPass){
                var pass=document.getElementById('password').value;
                if (kPass!='') {
                    if (pass==kPass) {
                        document.profil.kPassword.style.backgroundColor='#CCFF90';
                    }else{                    
                        document.profil.kPassword.style.backgroundColor='#FF8A80';
                    }
                }else{
                    document.profil.kPassword.style.backgroundColor='#FFFFFF';
                }
            }
        </script>

    </body>
</html>