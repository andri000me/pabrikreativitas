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
        <title>Settings Headline</title>

        <!-- DataTables -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Switchery css -->
        <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

        <!-- App CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!--alertify-->
        <link href="../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
        <script src="../assets/user_admin/js/alertify.min.js"></script>
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
                                    <h4 class="page-title">Settings <small>Headline</small></h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <form method="POST" action="php/proses_headline.php" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group">
                                                    <label>Judul Headline</label>
                                                    <input type="text" name="judulHeadline" id="judulHeadline" class="form-control" placeholder="Masukan Judul Headline" disabled>      
                                                </div>
                                                <div class="form-group">
                                                    <label>Gambar Headline</label>
                                                    <input type="file" name="gambar" id="gambar" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group">
                                                    <label>Tanggal Headline</label>
                                                    <input type="text" name="tglHeadline" class="form-control" value="<?=tanggal(date("Y-m-d"));?>" readonly>      
                                                </div>                                                
                                                <div class="form-group">
                                                    <label>&nbsp;</label><br>
                                                    <button type="button" id="tambah" class="btn btn-dark-outline waves-effect waves-light" onclick="aktifkan()">Tambah Headline</button>
                                                    <button  type="submit" id="simpan" name="simpanHeadline" class="btn btn-success-outline waves-effect waves-light" disabled>Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card-box card-scroll-2 scroll-xy">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Judul Headline</th>
                                                <th>Gambar Headline</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no=1;
                                                $dataClient=mysql_query("SELECT * FROM tb_headline");
                                                while ($dataTables=mysql_fetch_array($dataClient)) { ?>
                                                <tr>
                                                    <td><?=$no;?></td>
                                                    <td><?=$dataTables['id_headline'];?></td>
                                                    <td><?=$dataTables['nama_headline'];?></td>
                                                    <td><?=$dataTables['gambar_headline'];?></td>
                                                    <td><a href="edit_client?id=<?=$dataTables['id_client'];?>" class="txt-edit">Edit</a>&nbsp;<a href="javascript:hapusDesain('<?=$dataTables['id_headline'];?>','<?=$dataTables['nama_headline'];?>')" class="txt-hapus">Hapus</a></td>
                                                </tr>
                                                <?php
                                                $no++;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
 
            <?php include 'part/footer.php';?>


        </div>
        <!-- END wrapper -->


        <script>
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

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            function aktifkan(){
                document.getElementById('judulHeadline').disabled=false;
                document.getElementById('gambar').disabled=false;
                document.getElementById('simpan').disabled=false;
                document.getElementById('tambah').disabled=true;
            }
            function hapusDesain(id,nm){
                alertify.confirm('Perhatian', 'Anda Yakin Akan Menghapus '+nm, function(){ window.location.assign('php/proses_headline?hps='+id) }
                , function(){}).set({closable:false,transition:'pulse'});
            }
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