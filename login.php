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

</head>
<body class="login-back">
        <div class="login-page">
            <img src="admin/assets/images/icon/logo-typo.png" class="img-responsive">
            <h4>Login</h4>
            <div class="login-form">
                <form method="POST" action="assets/php/proses_login">
                    <div class="form-group">
                        <label>Email / Username</label>
                        <input type="text" name="email" class="form-control" placeholder="Masukan Email / Username Anda" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukan Password Anda" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login" class="btn btn-sm btn-success form-control">Login</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-6">
                        <a href="lupa-password" class="text-muted"><i class="ion-locked"></i> Forgot your password ?</a>
                    </div>
                </div>
                <hr>
                <div class="col-sm-12 text-center">
                    <h5 class="text-muted"><b>Belum Punya Akun ?</b></h5>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-sm btn-dark form-control" onclick="window.location.assign('register')">Buat Akun</button>
                </div>
                <!--<div class="row">
                    <div class="col-lg-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="cursor: pointer;" onclick="kurang()">-</span>
                            </div>
                            <input type="number" class="form-control" id="hasil" value="0" style="pointer-events: none;">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="cursor: pointer;" onclick="tambah()">+</span>
                            </div>
                        </div>                        
                    </div>
                </div>-->
            </div>
        </div>
        <script type="text/javascript">
            function kurang(){
                var awal=document.getElementById('hasil').value;
                document.getElementById('hasil').value=parseInt(awal)-1;
            }
            function tambah(){
                var awal=document.getElementById('hasil').value;
                document.getElementById('hasil').value=parseInt(awal)+1;
            }
        </script>
</body>
</html>