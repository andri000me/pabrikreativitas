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
        <title>List Kategori</title>

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
        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">
            <?php 
            include 'part/top_bar.php';
            include 'part/side_bar.php'; 
            include '../database/koneksi.php';
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
                                    <h4 class="page-title">List Kategori</h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <form method="POST" action="php/proses_kategori.php"> 
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group">
                                                    <label>Nama Kategori</label>
                                                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Kategori" required disabled>
                                                </div> 
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group">
                                                    <label>Tanggal</label>
                                                    <input type="text" name="tgl" class="form-control" value="<?=tanggal(date('Y-m-d'));?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <center>
                                            <button type="button" id="tambah" class="btn btn-dark-outline waves-effect waves-light" onclick="aktifkan()">Tambah Kategori</button>
                                            <button  type="submit" id="simpan" name="simpanKategori" class="btn btn-success-outline waves-effect waves-light" disabled>Simpan</button>
                                        </center>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card-box scroll-xy">                              
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Kategori</th>
                                                <th>Nama Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no=1;
                                                $dataKategori=mysql_query("SELECT * FROM tb_kategori");
                                                while ($dataTables=mysql_fetch_array($dataKategori)) {
                                                ?>
                                                <tr>
                                                    <td><?=$no;?></td>
                                                    <td><?=$dataTables['id_kategori'];?></td>
                                                    <td><?=$dataTables['nama_kategori'];?></td>
                                                    <td><a href="edit_kategori?id=<?=$dataTables['id_kategori'];?>" class="txt-edit">Edit</a>&nbsp;<a href="javascript:hapusAdmin('<?=$dataTables['id_kategori'];?>','<?=$dataTables['nama_kategori'];?>')" class="txt-hapus">Hapus</a></td>
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
            <!-- ============================================================== -->

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
                document.getElementById('nama').disabled=false;
                document.getElementById('simpan').disabled=false;
                document.getElementById('tambah').disabled=true;
            }
            function hapusAdmin(id,nama){
                alertify.confirm('Perhatian', 'Anda Yakin Akan Menghapus Kategori '+nama, function(){ window.location.assign('php/proses_kategori?hps='+id) }
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