<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="icon" type="image/ico" href="assets/images/icon/favicon.ico" />

        <title>Pabrik Kreativitas | Admin</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="../assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">

        <!-- Icon CSS -->
        <link href="../assets/user_admin/css/ionicons.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="../assets/user_admin/css/style_user.css" rel="stylesheet">

</head>
<body class="login-back m-t-1">
        <div class="login-page">
            <img src="assets/images/icon/logo-typo.png" class="img-responsive">
            <h4>Login - Admin</h4>
            <div class="login-form">
                <form method="POST" action="php/proses_login">
                    <div class="form-group">
                        <label>Email / Username</label>
                        <input type="text" name="email" class="form-control" placeholder="Masukan Email / Username Anda" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukan Password Anda" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="loginAdmin" class="btn btn-sm btn-success form-control">Login</button>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-6">
                        <a href="" class="text-muted"><i class="ion-locked"></i> Forgot your password ?</a>
                    </div>
                </div>
                <hr>
            </div>
            <br>
        </div>
</body>
</html>