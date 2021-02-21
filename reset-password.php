<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="icon" type="image/ico" href="admin/assets/images/icon/favicon.ico" />

        <title>Pabrik Kreativitas | Login</title>

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



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

</head>
<body class="login-back">
        <div class="login-page">
            <img src="admin/assets/images/icon/logo-typo.png" class="img-responsive">
            <h4>Reset Password</h4>
            <div class="login-form">
                <form method="POST" name="reset" action="assets/php/proses_user">
                    <div class="form-group">                                
                        <label>Password Baru</label><small class="text-muted" id="ket"></small>
                        <div ng-app="myapp" class="m-t-1">
                            <div ng-controller="PasswordController">
                                <input type="password" ng-model="password" ng-change="analyze(password)" ng-style="passwordStrength" name="password" class="form-control" placeholder="Masukan Password" id="password" maxlength="8" required>
                                                    
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label><small class="text-muted" id="ket1"></small>
                        <input type="password" name="kPassword" class="form-control" placeholder="Masukan Password Lagi"  maxlength="8" onkeyup="konfirmPassword(this.value)" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="resetPasword" class="btn btn-sm btn-danger form-control">Ubah Password</button>
                    </div>
                </form>
            </div>
            <br>
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
                                $scope.passwordStrength["border-color"] = "#CCFF90";
                                scope.passwordStrength["color"] = "#000";
                                $scope.passwordStrength["display"] = "block";
                            } else if(mediumRegex.test(value)) {
                                $scope.passwordStrength["background-color"] = "#F4FF81";
                                $scope.passwordStrength["border-color"] = "#F4FF81";
                                scope.passwordStrength["color"] = "#000";
                                $scope.passwordStrength["display"] = "block";
                            } else {
                               $scope.passwordStrength["background-color"] = "#EF9A9A";
                               $scope.passwordStrength["border-color"] = "#EF9A9A";
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
                        document.reset.kPassword.style.backgroundColor='#CCFF90';
                    }else{                    
                        document.reset.kPassword.style.backgroundColor='#FF8A80';
                    }
                }else{
                    document.reset.kPassword.style.backgroundColor='#FFFFFF';
                }
            }
        </script>
</body>
</html>