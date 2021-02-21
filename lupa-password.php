<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="icon" type="image/ico" href="admin/assets/images/icon/favicon.ico" />

        <title>Pabrik Kreativitas | Lupa Password</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="assets/user_admin/css/bootstrap.4.min.css" rel="stylesheet">

        <!-- Icon CSS -->
        <link href="assets/user_admin/css/ionicons.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="assets/user_admin/css/style_user.css" rel="stylesheet">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

</head>
<body class="login-back">
        <div class="login-page">
            <img src="admin/assets/images/icon/logo-typo.png" class="img-responsive">
            <h4>Lupa Password</h4>
            <div class="login-form">
                <form method="POST" action="assets/php/proses_user">
                    <div class="form-group">
                        <label>Email / Username</label>
                        <input type="text" name="email" class="form-control" placeholder="Masukan Email / Username Anda" required>
                    </div>
                    <div class="form-group">
                        <label>Pertanyaan</label>
                        <select name="pertanyaan" class="form-control" required>
                            <option selected hidden>Pilih Pertanyaan</option>
                            <option value="p1">Nama Ibu Kandung ?</option>
                            <option value="p2">Nama Sekolah SD Kamu ?</option>
                            <option value="p3">Nama Teman Dekat Kamu ?</option>
                            <option value="p4">Makanan Kesukaan Kamu ?</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jawaban</label>
                        <input type="text" name="jawaban" class="form-control" placeholder="Masukan Jawaban Anda" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="cekAkun" class="btn btn-sm btn-success form-control">Reset</button>
                    </div>
                </form>
            </div>
            <br>
        </div>
</body>
</html>