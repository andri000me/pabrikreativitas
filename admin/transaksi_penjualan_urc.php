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
        <title>List Transaksi Cetak (URC)</title>

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
                                    <h4 class="page-title">List Transaksi Cetak (URC)</h4>
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
                                                <th>No Invoice</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Total</th>
                                                <th>Item</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no=1;
                                                $dataTransaksi=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, jenis_cetak, tgl_transaksi, sub_total FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_cetak ON tb_detail_transaksi.id_item=tb_cetak.id_cetak JOIN tb_user ON tb_transaksi.id_user=tb_user.id_user  WHERE SUBSTR(tb_transaksi.no_invoice,5,1)='C'") or die(mysql_error());
                                                while ($dataTables=mysql_fetch_array($dataTransaksi)) {
                                                    if (strlen($dataTables['jenis_cetak'])>12) {
                                                        $namaDesain=str_pad(substr($dataTables['jenis_cetak'],0,12),15,".");
                                                    }else{
                                                        $namaDesain=$dataTables['jenis_cetak'];
                                                    }
                                                    switch ($dataTables['status']) {
                                                        case '1':
                                                            $label='label label-default';
                                                            $txtLabel='Unpaid';;
                                                            break;
                                                        case '2':
                                                            $label='label label-default';
                                                            $txtLabel='Unconfirmed';
                                                            break;
                                                        case '3':
                                                            $label='label label-success';
                                                            $txtLabel='Paid';
                                                            break;
                                                        case '4':
                                                            $label='label label-danger';
                                                            $txtLabel='Failed/Canceled';
                                                            break;
                                                        case '5':
                                                            $label='label label-info';
                                                            $txtLabel='Send';
                                                            break;
                                                        case '6':
                                                            $label='label label-primary';
                                                            $txtLabel='Done';
                                                            break;
                                                        case '7':
                                                            $label='label label-default';
                                                            $txtLabel='Diproses';
                                                            break;
                                                        default:
                                                            $label='label label-warning';
                                                            $txtLabel='Pending';
                                                            break;
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?=$no;?></td>
                                                    <td><?=$dataTables['no_invoice'];?></td>
                                                    <td><?=tanggal($dataTables['tgl_transaksi']);?></td>
                                                    <td><?=rupiah($dataTables['sub_total']);?></td>
                                                    <td><?=$namaDesain;?></td>
                                                    <td><span class="<?=$label;?>"><?=$txtLabel;?></span></td>
                                                    <td><a href="detail_transaksi?iv=<?=$dataTables['no_invoice'];?>" class="txt-look">Lihat</a></td>
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
            function hapusAdmin(id){
                alertify.confirm('Perhatian', 'Anda Yakin Akan Menghapus '+id, function(){ window.location.assign('php/proses_admin?hps='+id) }
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