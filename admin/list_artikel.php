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
        <title>List Apotik</title>

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
                                    <h4 class="page-title">List Apotik</h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box card-scroll-2 scroll-xy">                              
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Artikel</th>
                                                <th>Judul Artikel</th>
                                                <th>Penulis</th>
                                                <th>Kategori</th>
                                                <th>Tanggal Upload</th>
                                                <th>Isi Artikel</th>
                                                <th>Proses</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no=1;
                                                $dataArtikel=mysql_query("SELECT * FROM tb_artikel JOIN tb_kategori ON tb_artikel.id_kategori=tb_kategori.id_kategori");
                                                while ($dataTables=mysql_fetch_array($dataArtikel)) {
                                                    $publish=$dataTables['publish'];
                                                    $penulis=$dataTables['id_user'];
                                                    switch (substr($dataTables['id_user'], 0,2)) {
                                                        case 'US':
                                                            $user=mysql_fetch_array(mysql_query("SELECT nama_user FROM tb_user WHERE id_user='$penulis'"));
                                                            $namaUser=$user['nama_user'];
                                                            break;
                                                        case 'AD':
                                                            $user=mysql_fetch_array(mysql_query("SELECT nama_admin FROM tb_admin WHERE id_admin='$penulis'"));
                                                            $namaUser=$user['nama_admin'];
                                                            break;
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?=$no;?></td>
                                                    <td><?=$dataTables['id_artikel'];?></td>
                                                    <td><?=$dataTables['judul_artikel'];?></td>
                                                    <td><?=$namaUser;?></td>
                                                    <td><?=$dataTables['nama_kategori'];?></td>
                                                    <td><?=tanggal($dataTables['tgl_artikel']);?></td>
                                                    <td><a href="../detail_apotik?id=<?=$dataTables['id_artikel'];?>" class="txt-look" target='blank'>Lihat Artikel</a></td>
                                                    <td>
                                                        <select onchange="ubahStatus(this.value,'<?=$dataTables['id_artikel'];?>')">
                                                            <option value="0" <?php if($publish=='0'){echo "selected";}else{echo "";}?>>Pending</option>
                                                            <option value="1" <?php if($publish=='1'){echo "selected";}else{echo "";}?>>Publish</option>
                                                            <option value="2" <?php if($publish=='2'){echo "selected";}else{echo "";}?>>Tolak</option>
                                                        </select>
                                                    </td>
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
            function ubahStatus(status,idArtikel){
                window.location.assign('php/proses_artikel.php?st='+status+'&id='+idArtikel);
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