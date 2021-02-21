<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="../admin/assets/images/icon/favicon.ico" />
        <title>Tambah Pasen</title>

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
    $keuntungan=mysql_fetch_array(mysql_query("SELECT keuntungan FROM tb_settings"));
    $persen=$keuntungan['keuntungan']*100;
    ?>
        <div class="box">
            <!-- HOME -->
            <form method="POST" name="pasen" action="php/proses_pasen" enctype="multipart/form-data">
            <section id="home" class="home-margin">
                <div class="container">
                	<h4>Tambah Pasen</h4>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 ">                    
                                    <div class="card">
                                        <div class="card-container">
                                        		<label>Foto PASEN</label>
                                                <p class="text-muted font-13 m-b-30">
                                                    Masukan foto yang akan dijual, dengan format png, jpg, jpeg atau bmp. Ukuran maksimal gambar adalah 1MB dan jumlah Gambar yang akan masuk hanya 5 gambar
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
                                                        <label>Nama PASEN</label><small id="ketNama"></small>
                                                        <input type="text" name="namaPasen" class="form-control" onkeyup="cekNama(this.value)" required>   
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Harga Jual (Rp)</label><small> Biaya Admin <?=$persen;?>% Dari Harga Jual</small>
                                                        <input type="number" name="hargaPasen" class="form-control" placeholder="Harga Desain Atau Barang Yang Dijual" required>
                                                    </div>
                                                    <div class="form-group" id="ckWarna">
                                                        <label>Pilihan Warna</label><br>
                                                        <input type="radio" name="cw" id="cwY" value="1" class="radio-inline" onclick="cW();"> Ya
                                                        <input type="radio" name="cw" id="cwT" value="0" class="radio-inline" onclick="cW();"> Tidak
                                                    </div>
                                                    <div class="form-group" id="warna" style="display: none;">
                                                        <input type="text" name="warna" id="warna" class="form-control" placeholder="Masukan Pilihan Warna.. Contoh Red,Green,Blue">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">   
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
                                                    <div class="form-group">
                                                        <label>Berat (dalam gram)</label>
                                                        <input type="number" name="berat" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label><small id="ketCerita"> Minimal 200 Karakter dan Maksimal 500 Karakter</small><small id="sisaCerita"></small> 
                                                <textarea name="text" id="text" class="form-control" rows="5" maxlength="500" style="resize: none;" onchange="addLine()" onkeyup="countChar()"></textarea>
                                                <textarea name="dekripsi" id="dekripsi" class="form-control" rows="5" style="resize: none; display: none;"></textarea>
                                            </div> 

                                            <div id="button">
                                                <center>  
                                                    <button type="submit" name="tambahPasen" class="btn btn-success btn-sm" id="simpan">Simpan</button>
                                                    <button type="button" onclick="window.location.assign('tambah_pasen')" class="btn btn-danger btn-sm" id="batal">Batal</button>
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

        </script>

    </body>
</html>