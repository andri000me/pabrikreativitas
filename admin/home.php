<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/icon/favicon.ico">

        <!-- App title -->
        <title>Pasar Kreativitas | Admin</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

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
            $qUser=mysql_query("SELECT id_user FROM tb_user");
            $jmlUser=mysql_num_rows($qUser); 
            $qArtikel=mysql_query("SELECT id_artikel FROM tb_artikel");
            $jmlArtikel=mysql_num_rows($qArtikel); 
            
            //hitung keuntungan
            $inNow=date("Y-m");
            $per=date("M")." ".date("Y");
            $dataincome=mysql_query("SELECT nominal, ket FROM tb_buku_besar WHERE status='1' AND SUBSTR(tgl_transaksi,1,7)='$inNow'");
            $masuk=0;
            $keluar=0;
            while ($income=mysql_fetch_array($dataincome)) {
                if ($income['ket']==0) {
                    $masuk=$masuk-$income['nominal'];
                    $keluar=$keluar+$income['nominal'];
                }else{
                    $masuk=$masuk+$income['nominal'];
                    $keluar=$keluar;
                }
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
                                    <h4 class="page-title">Dashboard</h4>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->


                        <div class="row">

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-2">
                                <div class="card-box tilebox-one">
                                    <i class="icon-people pull-xs-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20">Users</h6>
                                    <h2 class="m-b-20"><span data-plugin="counterup"><?=$jmlUser;?></span></h2>
                                    <span class="label label-pink">Jumlah Pengguna</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-2">
                                <div class="card-box tilebox-one">
                                    <i class="icon icon-book-open pull-xs-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20">Artikel</h6>
                                    <h2 class="m-b-20" data-plugin="counterup"><?=$jmlArtikel;?></h2>
                                    <span class="label label-success">Jumlah Artikel</span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4" onclick="window.location.assign('my_book')" style="cursor: pointer;">
                                <div class="card-box tilebox-one">
                                    <i class="icon-wallet pull-xs-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20">Revenue</h6>
                                    <h2 class="m-b-20">Rp<span data-plugin="counterup"><?=uang($masuk);?></span></h2>
                                    <span class="label label-danger">Pendapatan Bulan <?=$per;?></span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-md-6 col-lg-6 col-xl-4" onclick="window.location.assign('my_book')" style="cursor: pointer;">
                                <div class="card-box tilebox-one">
                                    <i class="icon-rocket pull-xs-right text-muted"></i>
                                    <h6 class="text-muted text-uppercase m-b-20">Expense</h6>
                                    <h2 class="m-b-20">Rp<span data-plugin="counterup"><?=uang($keluar);?></span></h2>
                                    <span class="label label-warning">Pengeluaran Bulan <?=$per;?></span>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-xs-12 col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-20" onclick="window.location.assign('transaksi_penjualan_ugd')" style="cursor: pointer;">Transaksi UGD</h4>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>No Invoice</td>
                                            <td>Tgl Transaksi</td>
                                            <td>Status</td>
                                        </tr>                                    
                                    <?php
                                        $qDesain=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, sub_total, ongkir, tgl_transaksi, nama_desain, harga FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain WHERE SUBSTR(tb_transaksi.no_invoice,5,1)='D' AND pemilik NOT IN (SELECT id_user FROM tb_user) LIMIT 6") or die(mysql_error());
                                        while ($dataTransaksiUGD=mysql_fetch_array($qDesain)) {
                                            switch ($dataTransaksiUGD['status']) {
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
                                                    $txtLabel='On Process';
                                                    break;
                                                default:
                                                    $label='label label-warning';
                                                    $txtLabel='Pending';
                                                    break;
                                            }
                                            $total=$dataTransaksiUGD['sub_total']+$dataTransaksiUGD['ongkir'];
                                            ?>
                                            <tr onclick="window.location.assign('detail_transaksi?iv=<?=$dataTransaksiUGD['no_invoice'];?>')" style="cursor: pointer;">
                                                <td><?=$dataTransaksiUGD['no_invoice'];?></td>
                                                <td><?=tanggal($dataTransaksiUGD['tgl_transaksi']);?></td>
                                                <td><span class="label <?=$label;?>"><?=$txtLabel;?></span></td>
                                            </tr> 
                                            <?php
                                        }
                                    ?>
                                    </table>
                        		</div>
                            </div><!-- end col-->
                        
                            <div class="col-xs-12 col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-20" onclick="window.location.assign('transaksi_penjualan_pasen')" style="cursor: pointer;">Transaksi PASEN</h4>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>No Invoice</td>
                                            <td>Tgl Transaksi</td>
                                            <td>Status</td>
                                        </tr>                                    
                                    <?php
                                        $qDesain=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, sub_total, ongkir, tgl_transaksi, nama_desain, harga FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain WHERE SUBSTR(tb_transaksi.no_invoice,5,1)='D' AND pemilik IN (SELECT id_user FROM tb_user) LIMIT 6") or die(mysql_error());
                                        while ($dataTransaksiUGD=mysql_fetch_array($qDesain)) {
                                            switch ($dataTransaksiUGD['status']) {
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
                                                    $txtLabel='On Process';
                                                    break;
                                                default:
                                                    $label='label label-warning';
                                                    $txtLabel='Pending';
                                                    break;
                                            }
                                            $total=$dataTransaksiUGD['sub_total']+$dataTransaksiUGD['ongkir'];
                                            ?>
                                            <tr onclick="window.location.assign('detail_transaksi?iv=<?=$dataTransaksiUGD['no_invoice'];?>')" style="cursor: pointer;">
                                                <td><?=$dataTransaksiUGD['no_invoice'];?></td>
                                                <td><?=tanggal($dataTransaksiUGD['tgl_transaksi']);?></td>
                                                <td><span class="label <?=$label;?>"><?=$txtLabel;?></span></td>
                                            </tr> 
                                            <?php
                                        }
                                    ?>
                                    </table>
                                </div>
                            </div><!-- end col-->
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-xs-12 col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-20" onclick="window.location.assign('transaksi_penjualan_pasen')" style="cursor: pointer;">Transaksi URC</h4>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>No Invoice</td>
                                            <td>Tgl Transaksi</td>
                                            <td>Status</td>
                                        </tr>                                    
                                    <?php
                                        $qDesain=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, sub_total, ongkir, tgl_transaksi, harga FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_cetak ON tb_detail_transaksi.id_item=tb_cetak.id_cetak LIMIT 6") or die(mysql_error());
                                        while ($dataTransaksiUGD=mysql_fetch_array($qDesain)) {
                                            switch ($dataTransaksiUGD['status']) {
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
                                                    $txtLabel='On Process';
                                                    break;
                                                default:
                                                    $label='label label-warning';
                                                    $txtLabel='Pending';
                                                    break;
                                            }
                                            $total=$dataTransaksiUGD['sub_total']+$dataTransaksiUGD['ongkir'];
                                            ?>
                                            <tr onclick="window.location.assign('detail_transaksi?iv=<?=$dataTransaksiUGD['no_invoice'];?>')" style="cursor: pointer;">
                                                <td><?=$dataTransaksiUGD['no_invoice'];?></td>
                                                <td><?=tanggal($dataTransaksiUGD['tgl_transaksi']);?></td>
                                                <td><span class="label <?=$label;?>"><?=$txtLabel;?></span></td>
                                            </tr> 
                                            <?php
                                        }
                                    ?>
                                    </table>
                                </div>
                            </div><!-- end col-->
                        
                            <div class="col-xs-12 col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-20" onclick="window.location.assign('transaksi_penjualan_posyandu')" style="cursor: pointer;">Transaksi POSYANDU</h4>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>No Invoice</td>
                                            <td>Tgl Transaksi</td>
                                            <td>Status</td>
                                        </tr>                                    
                                    <?php
                                        $qDesain=mysql_query("SELECT tb_transaksi.no_invoice, tb_transaksi.status, sub_total, ongkir, tgl_transaksi, harga FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs LIMIT 6") or die(mysql_error());
                                        while ($dataTransaksiUGD=mysql_fetch_array($qDesain)) {
                                            switch ($dataTransaksiUGD['status']) {
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
                                                    $txtLabel='On Process';
                                                    break;
                                                default:
                                                    $label='label label-warning';
                                                    $txtLabel='Pending';
                                                    break;
                                            }
                                            $total=$dataTransaksiUGD['sub_total']+$dataTransaksiUGD['ongkir'];
                                            ?>
                                            <tr onclick="window.location.assign('detail_transaksi?iv=<?=$dataTransaksiUGD['no_invoice'];?>')" style="cursor: pointer;">
                                                <td><?=$dataTransaksiUGD['no_invoice'];?></td>
                                                <td><?=tanggal($dataTransaksiUGD['tgl_transaksi']);?></td>
                                                <td><span class="label <?=$label;?>"><?=$txtLabel;?></span></td>
                                            </tr> 
                                            <?php
                                        }
                                    ?>
                                    </table>
                                </div>
                            </div><!-- end col-->
                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-xs-12 col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-20" onclick="window.location.assign('transaksi_penjualan_visit')" style="cursor: pointer;">Transaksi VAKSIN</h4>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>No Invoice</td>
                                            <td>Tgl Transaksi</td>
                                            <td>Status</td>
                                        </tr>                                    
                                    <?php
                                        $qVisit=mysql_query("SELECT * FROM tb_transaksi_visit JOIN tb_visit ON tb_transaksi_visit.id_visit=tb_visit.id_visit LIMIT 6") or die(mysql_error());
                                        while ($dataTransaksiVisit=mysql_fetch_array($qVisit)) {
                                            switch ($dataTransaksiVisit['status']) {
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
                                                    $txtLabel='On Process';
                                                    break;
                                                default:
                                                    $label='label label-warning';
                                                    $txtLabel='Pending';
                                                    break;
                                            }
                                            $total=$dataTransaksiVisit['biaya'];
                                            ?>
                                            <tr onclick="window.location.assign('detail_transaksi?iv=<?=$dataTransaksiVisit['no_tiket'];?>')" style="cursor: pointer;">
                                                <td><?=$dataTransaksiVisit['no_tiket'];?></td>
                                                <td><?=tanggal($dataTransaksiVisit['tgl_transaksi']);?></td>
                                                <td><span class="label <?=$label;?>"><?=$txtLabel;?></span></td>
                                            </tr> 
                                            <?php
                                        }
                                    ?>
                                    </table>
                                </div>
                            </div><!-- end col-->
                        
                            <div class="col-xs-12 col-lg-6">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0 m-b-20" onclick="window.location.assign('list_artikel')" style="cursor: pointer;">PUBLISH ARTIKEL</h4>
                                    <table class="table table-striped table-bordered table-hover">
                                        <tr>
                                            <td>Id Artikel</td>
                                            <td>Tgl Pemasangan</td>
                                            <td>Status</td>
                                        </tr>                                    
                                    <?php
                                        $qDesain=mysql_query("SELECT * FROM tb_artikel LIMIT 6") or die(mysql_error());
                                        while ($dataTransaksiUGD=mysql_fetch_array($qDesain)) {
                                            switch ($dataTransaksiUGD['publish']) {
                                                case '1':
                                                    $label='label label-primary';
                                                    $txtLabel='Publish';;
                                                    break;
                                                case '2':
                                                    $label='label label-danger';
                                                    $txtLabel='Tolak';
                                                    break;
                                                default:
                                                    $label='label label-default';
                                                    $txtLabel='Pending';
                                                    break;
                                            }
                                            ?>
                                            <tr>
                                                <td><?=$dataTransaksiUGD['id_artikel'];?></td>
                                                <td><?=tanggal($dataTransaksiUGD['tgl_artikel']);?></td>
                                                <td><span class="label <?=$label;?>"><?=$txtLabel;?></span></td>
                                            </tr> 
                                            <?php
                                        }
                                    ?>
                                    </table>
                                </div>
                            </div><!-- end col-->
                        </div>
                        <!-- end row -->


                    </div> <!-- container -->

                </div> <!-- content -->



            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <div class="nicescroll">
                    <ul class="nav nav-tabs text-xs-center">
                        <li class="nav-item">
                            <a href="#home-2"  class="nav-link active" data-toggle="tab" aria-expanded="false">
                                Activity
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#messages-2" class="nav-link" data-toggle="tab" aria-expanded="true">
                                Settings
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="home-2">
                            <div class="timeline-2">
                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">5 minutes ago</small>
                                        <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">30 minutes ago</small>
                                        <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">59 minutes ago</small>
                                        <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">1 hour ago</small>
                                        <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">3 hours ago</small>
                                        <p><a href="" class="text-info">Lorem</a> commented your post.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>

                                <div class="time-item">
                                    <div class="item-info">
                                        <small class="text-muted">5 hours ago</small>
                                        <p><a href="" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                        <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="messages-2">

                            <div class="row m-t-20">
                                <div class="col-xs-8">
                                    <h5 class="m-0">Notifications</h5>
                                    <p class="text-muted m-b-0"><small>Do you need them?</small></p>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#64b0f2" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-xs-8">
                                    <h5 class="m-0">API Access</h5>
                                    <p class="m-b-0 text-muted"><small>Enable/Disable access</small></p>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#64b0f2" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-xs-8">
                                    <h5 class="m-0">Auto Updates</h5>
                                    <p class="m-b-0 text-muted"><small>Keep up to date</small></p>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#64b0f2" data-size="small"/>
                                </div>
                            </div>

                            <div class="row m-t-20">
                                <div class="col-xs-8">
                                    <h5 class="m-0">Online Status</h5>
                                    <p class="m-b-0 text-muted"><small>Show your status to all</small></p>
                                </div>
                                <div class="col-xs-4 text-right">
                                    <input type="checkbox" checked data-plugin="switchery" data-color="#64b0f2" data-size="small"/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end nicescroll -->
            </div>
            <!-- /Right-bar -->

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

        <!--Morris Chart-->
		<script src="assets/plugins/morris/morris.min.js"></script>
		<script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Counter Up  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!-- Page specific js -->
        <script src="assets/pages/jquery.dashboard.js"></script>

    </body>
</html>