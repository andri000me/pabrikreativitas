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
        <title>Detail Transaksi</title>

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
                                    <h4 class="page-title">Detail Transaksi</h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <?php 
                            $noInvoice=$_GET['iv'];
                            $code=substr($noInvoice,4,1);
                            switch ($code) {
                                case 'D':
                                    $query=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, nama_desain, tgl_transaksi, sub_total, nama_bank, harga, ongkir, no_rek, nama_pemilik, tgl_pembayaran, bukti_transfer, pemilik FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain JOIN tb_bank ON tb_transaksi.id_bank=tb_bank.id_bank WHERE tb_transaksi.no_invoice='$noInvoice'") or die(mysql_error());
                                    $result=mysql_fetch_array($query);
                                    $namaItem=$result['nama_desain'];
                                    $hargaItem=$result['harga'];
                                    $total=$result['sub_total']+$result['ongkir'];
                                    $namaBank=$result['nama_bank'];
                                    $noRek=$result['no_rek'];
                                    $namaPemilikRek=$result['nama_pemilik'];
                                    $tglBayar=$result['tgl_pembayaran'];
                                    $tglTransaksi=$result['tgl_transaksi']; 
                                    $idUser=$result['pemilik'];
                                    $bukti='assets/images/payment/'.$result['bukti_transfer'];                                   
                                    break;
                                case 'C':
                                    $query=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, jenis_cetak, tgl_transaksi, sub_total, nama_bank, harga, ongkir, no_rek, nama_pemilik, tgl_pembayaran, bukti_transfer FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_cetak ON tb_detail_transaksi.id_item=tb_cetak.id_cetak JOIN tb_bank ON tb_transaksi.id_bank=tb_bank.id_bank WHERE tb_transaksi.no_invoice='$noInvoice'") or die(mysql_error());
                                    $result=mysql_fetch_array($query);
                                    $namaItem=$result['jenis_cetak'];
                                    $hargaItem=$result['harga'];
                                    $total=$result['sub_total']+$result['ongkir'];
                                    $namaBank=$result['nama_bank'];
                                    $noRek=$result['no_rek'];
                                    $namaPemilikRek=$result['nama_pemilik'];
                                    $tglBayar=$result['tgl_pembayaran'];
                                    $tglTransaksi=$result['tgl_transaksi']; 
                                    $idUser='';
                                    $bukti='assets/images/payment/'.$result['bukti_transfer'];                                   
                                    break;
                                case 'J':
                                    $query=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, judul_jobs, tgl_transaksi, sub_total, nama_bank, harga, ongkir, no_rek, nama_pemilik, tgl_pembayaran, bukti_transfer, tb_jobs.id_user FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs JOIN tb_bank ON tb_transaksi.id_bank=tb_bank.id_bank WHERE tb_transaksi.no_invoice='$noInvoice'") or die(mysql_error());
                                    $result=mysql_fetch_array($query);
                                    $namaItem=$result['judul_jobs'];
                                    $hargaItem=$result['harga'];
                                    $total=$result['sub_total']+$result['ongkir'];
                                    $namaBank=$result['nama_bank'];
                                    $noRek=$result['no_rek'];
                                    $namaPemilikRek=$result['nama_pemilik'];
                                    $tglBayar=$result['tgl_pembayaran'];
                                    $tglTransaksi=$result['tgl_transaksi']; 
                                    $idUser=$result['id_user'];
                                    $bukti='assets/images/payment/'.$result['bukti_transfer'];                                   
                                    break;
                                default:
                                    $query=mysql_query("SELECT * FROM tb_transaksi_visit JOIN tb_visit ON tb_transaksi_visit.id_visit=tb_visit.id_visit JOIN tb_user ON tb_transaksi_visit.id_user=tb_user.id_user JOIN tb_bank ON tb_transaksi_visit.id_bank=tb_bank.id_bank") or die(mysql_error());
                                    $result=mysql_fetch_array($query);
                                    $namaItem=$result['nama_visit'];
                                    $hargaItem=$result['biaya'];
                                    $total=$hargaItem;
                                    $namaBank=$result['nama_bank'];
                                    $noRek=$result['no_rek'];
                                    $namaPemilikRek=$result['nama_pemilik'];
                                    $tglBayar=$result['tgl_bayar'];
                                    $tglTransaksi=$result['tgl_transaksi']; 
                                    $idUser='';
                                    $bukti='assets/images/payment/'.$result['bukti_bayar']; 
                                    break;
                            }
                            if ($tglBayar=='0000-00-00') {
                                $tglBayar='-';
                            }else{
                                $tglBayar=tanggal($tglBayar);
                            }
                            switch ($result['status']) {
                                case '1':
                                    $label='label label-default';
                                    $txtLabel='Unpaid';
                                    $buktiTransfer='assets/images/icon/unpaid.png';
                                    $confirm='display:none;';
                                    break;
                                case '2':
                                    $label='label label-default';
                                    $txtLabel='Unconfirmed';
                                    $buktiTransfer=$bukti;
                                    $confirm='display:block;';
                                    break;
                                case '3':
                                    $label='label label-success';
                                    $txtLabel='Paid';
                                    $buktiTransfer=$bukti;
                                    $confirm='display:none;';
                                    break;
                                case '4':
                                    $label='label label-danger';
                                    $txtLabel='Failed/Canceled';
                                    $buktiTransfer=$bukti;
                                    $confirm='display:none;';
                                    break;
                                case '5':
                                    $label='label label-info';
                                    $txtLabel='Send';
                                    $buktiTransfer=$bukti;
                                    $confirm='display:none;';
                                    break;
                                case '6':
                                    $label='label label-primary';
                                    $txtLabel='Done';
                                    $buktiTransfer=$bukti;
                                    $confirm='display:none;';
                                    break;
                                case '7':
                                    $label='label label-default';
                                    $txtLabel='Processed';
                                    $buktiTransfer=$bukti;
                                    $confirm='display:none;';
                                    break;
                                default:
                                    $label='label label-default';
                                    $txtLabel='Unpaid';
                                    $buktiTransfer='assets/images/icon/unpaid.png';
                                    $confirm='display:none;';
                                    break;
                            }

                            switch (substr($idUser,0,2)) {
                                case 'US':
                                    $send='display:none;';
                                    break;
                                case 'AD':
                                    if ($result['status']!=3) {
                                       $send='display:none;';
                                    }else{
                                        $send='display:block;';
                                    }
                                    
                                    break;
                                default:
                                    $send='display:none;';
                                    break;
                            }

                        ?>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">                              
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="card" style="border:none;">
                                                <img src="<?=$buktiTransfer;?>" class="img-mini">
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-12 col-lg-8">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-7">
                                                    <div class="form-group">
                                                        <label>Nama Item</label>
                                                        <h5><?=$namaItem;?></h5>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Bank Transfer</label>
                                                        <h5><?=$namaBank." - ".$noRek." a/n ".$namaPemilikRek;?></h5>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>Total</label>
                                                        <h5><?=rupiah($total);?></h5>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-5">
                                                    <div class="form-group">
                                                        <label>Tanggal Transaksi</label>
                                                        <h5><?=tanggal($tglTransaksi);?></h5>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Tanggal Pembayaran</label>
                                                        <h5><?=$tglBayar;?></h5>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>Status Transaksi</label>
                                                        <h5><span class="<?=$label;?>"><?=$txtLabel;?></span></h5>
                                                    </div>                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                            <br>
                                            <form method="POST" action="php/proses_transaksi.php">
                                                <input type="hidden" name="noInvoice" value="<?=$noInvoice;?>">
                                                <div id="confirm" style="<?=$confirm;?>">
                                                    <center>
                                                        <button type="submit" name="konfirmasi" class="btn btn-primary-outline waves-effect waves-light w-md">Konfirmasi</button>
                                                        <button type="submit" name="batal" class="btn btn-danger-outline waves-effect waves-light w-md">Batalkan</button>
                                                    </center>                                                    
                                                </div>
                                                <div id="send" style="<?=$send;?>">
                                                    <center>
                                                        <div class="form-inline">
                                                            <button type="button" class="btn btn-primary-outline waves-effect waves-light w-md" onclick="tampil()">Kirim Barang</button>
                                                            <input type="text" name="noResi" id="kirim" class="form-control" placeholder="masukan no resi" style="display: none; margin-top: 5px;">
                                                            <button type="submit" name="kirim" id="kirim1" class="btn btn-dark-outline waves-effect waves-light w-md" style="display: none; margin-top: 5px;">Kirim</button>
                                                        </div>
                                                        
                                                    </center>                                                    
                                                </div>
                                            </form>
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
            function tampil(){
                document.getElementById('kirim').style.display='block';
                document.getElementById('kirim1').style.display='block';
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