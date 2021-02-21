<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="../admin/assets/images/icon/favicon.ico" />
        <title>Artikel</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="../assets/user_admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- Owl Carousel CSS -->
        <link href="../assets/user_admin/css/owl.carousel.css" rel="stylesheet">
        <link href="../assets/user_admin/css/owl.theme.default.min.css" rel="stylesheet">

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
    ?>
        <div class="box">
            <!-- HOME -->
            <form method="POST" name="artikel" action="php/proses_artikel" enctype="multipart/form-data">
            <section id="home" class="home-margin">
                <div class="container">
                	<h4>Tambah Artikel</h4>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 ">                    
                                    <div class="card">
                                        <div class="card-container">
                                        		<label>Gambar Artikel</label>
                                                <p class="text-muted font-13 m-b-30">
                                                    Masukan gambar artikel anda, dengan format png, jpg, jpeg atau bmp. Ukuran maksimal gambar adalah 1MB dan jumlah Gambar yang akan masuk hanya 5 gambar
                                                </p>
                                                <div class="card-border">
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
                                    </div>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END HOME -->
            <section id="profil" class="m-t-10">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="p-t-2">            
                                <div class="card">
                                    <div class="card-container">
                                        <div class="card-border">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">                                
                                                        <label>Judul Artikel</label>
                                                        <input type="text" name="judul" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">                                                    
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
                                                <label>Isi Artikel</label><small id="ketCerita"> Minimal 500 Karakter dan Maksimal 1000 Karakter</small><small id="sisaCerita"></small> 

                                                <div style="border:1px solid #CCCCCC; padding: 10px; width: 100%; border-radius: 5px;">
                                                	<textarea name="text" id="text" rows="15" cols="90" maxlength="1000" style="resize: none; border:none; outline: none;" onchange="addLine()" onkeyup="countChar()" required></textarea>
                                                </div>
                                                
                                                <textarea name="isi" id="dekripsi" cols="90" class="form-control" rows="5" style="resize: none; display: none;"></textarea>
                                            </div>

                                            <div id="button">
                                                <center>  
                                                    <button type="submit" name="tambahApotek" class="btn btn-success btn-sm" id="simpan">Simpan</button>
                                                    <button type="button" onclick="window.location.assign('tambah_apotek')" class="btn btn-danger btn-sm" id="batal">Batal</button>
                                                </center>
                                            </div>
                                        </div>
                                    </div>            
                                </div> 
                            </div>  
                        </div>
                    </div>
                </div>
            </section>
        	</form>
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

        function countChar(){
            var txt=document.getElementById('text').value;
            var a=txt.length;
            var b=0;
            var c=b+a;
            if (a<500) {
                document.getElementById('ketCerita').innerHTML =' Minimal 500 Karakter | ';
            }else{
                document.getElementById('ketCerita').innerHTML =' Maksimal 1000 Karakter | ';
            }            
            document.getElementById('sisaCerita').innerHTML =c+'/1000';
        }

        function addLine(){
            var text=document.getElementById('text').value;
            var text=text.replace(/\r?\n/g, '<br>');
            document.getElementById('dekripsi').value=text;

        }

        </script>

    </body>
</html>