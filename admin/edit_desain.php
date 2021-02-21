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
        <title>Edit Desain (UDG)</title>

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

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
            if (isset($_GET['id'])) {
                $idDesain=$_GET['id'];
                $desain=mysql_query("SELECT * FROM tb_desain JOIN tb_kategori ON tb_desain.id_kategori=tb_kategori.id_kategori WHERE id_desain='$idDesain'");
                $dataDesain=mysql_fetch_array($desain);
                $deskripsi=str_replace('<br>', "\r\n", $dataDesain['deskripsi']);
                $gambar=mysql_query("SELECT gambar_desain FROM tb_gambar_desain WHERE id_desain='$idDesain'");
                $path='assets/images/ugd/';
            }else{
                echo "<script>window.location.assign('list_desain');</script>";
            }
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
                                    <h4 class="page-title">Edit Desain (UGD)</h4>
                                    <ol class="breadcrumb p-0">
                                        <li>
                                            <a href="list_desain">List Desain</a>
                                        </li>
                                        <li class="active">
                                            Edit Desain
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <form method="POST" action="php/proses_desain.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h4 class="m-t-0 m-b-1 header-title"><b><?=$idDesain;?></b></h4>
                                    <input type="hidden" name="idDesain" class="form-control" value="<?=$idDesain;?>">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Desain</label><small id="ketNama"></small>
                                                <input type="text" name="namaDesain" class="form-control" value="<?=$dataDesain['nama_desain'];?>" onkeyup="cekNama(this.value)">
                                            </div>
                                            <div class="form-group">
                                                <label>Harga Desain (Rp)</label>
                                                <input type="text" name="hargaDesain" class="form-control autonumber" data-a-sep="." data-a-dec="," value="<?=$dataDesain['harga'];?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Berat (dalam gram)</label>
                                                <input type="number" name="berat" class="form-control" value="<?=$dataDesain['berat'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Edit</label>
                                                <input type="text" name="tanggalUpload" class="form-control" value="<?=tanggal(date("Y-m-d"));?>" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <select name="kategori" class="form-control">
                                                    <option value="0" selected hidden>Kategori</option>
                                                    <?php
                                                        $qKategori=mysql_query("SELECT * FROM tb_kategori");
                                                        while ($kategori=mysql_fetch_array($qKategori)) { 
                                                            if ($dataDesain['id_kategori']==$kategori['id_kategori']) {
                                                                $selected='selected';
                                                            }else{
                                                                $selected='';
                                                            }
                                                            ?>
                                                            <option value="<?=$kategori['id_kategori'];?>" <?=$selected;?>><?=$kategori['nama_kategori'];?></option>;
                                                        <?php                                          
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label><small id="ketCerita"> Minimal 200 Karakter dan Maksimal 500 Karakter</small><small id="sisaCerita"></small> 
                                                <textarea name="text" id="text" class="form-control" rows="8" maxlength="500" style="resize: none;" onchange="addLine()" onkeyup="countChar()"><?=$deskripsi;?></textarea>
                                                <textarea name="dekripsi" id="dekripsi" class="form-control" rows="5" style="resize: none; display: none;"></textarea>
                                            </div> 
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                <?php 
                                                    $no=1;
                                                    while ($dataGambar=mysql_fetch_array($gambar)) {
                                                        $tampilGambar=$path.$dataGambar['gambar_desain'];
                                                        $namaF=explode('.',$dataGambar['gambar_desain']);
                                                        $nameFile='gambar'.$no;
                                                        ?>
                                                        <div class="col-sm-12 col-lg-6 m-b-1">
                                                            <div class="edit-box-image">
                                                                <img src="<?=$tampilGambar;?>">
                                                                <input type="file" name="<?=$nameFile;?>" id="<?=$nameFile;?>" style="margin-top: 5px; margin-bottom: 5px; display: none;" onchange="ganti('editGambar.php', '#<?=$nameFile;?>', '#<?=$namaF[0];?>');">
                                                                <center>
                                                                    <span class="fa fa-trash txt-hapus" onclick="hapusGambar('<?=$dataGambar['gambar_desain'];?>')"></span>
                                                                </center>                                                                
                                                            </div>                                                            
                                                        </div>
                                                        <?php
                                                        $no++;
                                                    }
                                                ?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="card-box">
                                                    <label>Foto Desain</label>
                                                    <div class="card">
                                                        <div class="p-20">
                                                            <div class="form-group clearfix">
                                                                <div class="col-sm-12 p-t-1">
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
                                    <div class="test">
                                        
                                    </div>
                                    </div>
                                    <hr>
                                    <center>
                                        <button type="submit" name="ubahData" class="btn btn-md btn-success">Simpan</button>
                                    </center>
                                </div>
                            </div>
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


        <script>
            function ubahGambar(n){
                document.getElementById(n).style.display='block';
            }

            function hapusGambar(a){
                $.ajax({
                    type : 'post',
                    url : 'hapusGambar.php',
                    data :  {namaGambarUgd: a},
                    success : function(data){
                     location.reload();
                    }
                });
            }

            function addLine(){
                var text=document.getElementById('text').value;
                var text=text.replace(/\r?\n/g, '<br>');
                document.getElementById('dekripsi').value=text;

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

        <!-- Required datatable js -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>
        <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            jQuery(function($) {
              $('.autonumber').autoNumeric('init');
            });
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: true,
                    buttons: ['copy', 'excel', 'pdf']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

    </body>
</html>