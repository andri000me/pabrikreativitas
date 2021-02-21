<?php 
    session_start();
    ob_start();
    if (isset($_SESSION['idUser'])) {
        $idUser=$_SESSION['idUser'];
        $btnProfil='style="display:block;"';
        $btnLogin='style="display:none;"';
        $idUser=$_SESSION['idUser'];
    }else{
        $idUser='';
        $btnProfil='style="display:none;"';
        $btnLogin='style="display:block;"';
    }
    
    function rupiah($angka){    
    $hasil_rupiah = "Rp. " . number_format($angka);
    $rupiah=str_replace(',', '.', $hasil_rupiah);
    return $rupiah;     
    }
    
    function tanggal($a){
        $bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
        $tgl=date('d', strtotime($a))." ". $bulan[date('m', strtotime($a))]." ".date('Y', strtotime($a));
        return $tgl;
    }
    
    $qSet=mysql_query("SELECT * FROM tb_settings");
    $Settings=mysql_fetch_array($qSet);
    $pathIcon='../admin/assets/images/icon/';
    $txtclient=$Settings['client'];
    $client=explode('-', $Settings['client']);
        if ($client[0]==1) {
            $dis='display:block';
        }else{
            $dis='display:none';
        }
          
?>
<!-- Navbar -->
        <div class="navbar navbar-custom sticky navbar-fixed-top" role="navigation" id="sticky-nav">
            <div class="container">

                <!-- Navbar-header -->
                <div class="navbar-header">

                    <!-- Responsive menu button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- LOGO -->
                    <a class="navbar-brand" href="index">
                        <img src="<?=$pathIcon.$Settings['primary_logo'];?>">
                    </a>

                </div>
                <!-- end navbar-header -->

                <!-- menu -->
                <div class="navbar-collapse collapse" id="navbar-menu">

                    <!-- Navbar right -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#home" class="nav-link">Home</a>
                        </li>
                        <li>
                            <a href="#services" class="nav-link">Service</a>
                        </li>
                         <li>
                            <a href="#store" class="nav-link">Store</a>
                        </li>
                        <li>
                            <a href="#clients" class="nav-link">Clients</a>
                        </li>
                        <li class="nav-item dropdown notification-list" <?=$btnProfil;?>>
                            <a class="nav-link dropdown-toggle arrow-none btn btn-login-bordered navbar-btn" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">Profil
                            </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                    <div class="dropdown-item noti-title" onclick="window.location.assign('profil')">
                                        <small><a class="pull-xs-right">Profil</a></small>
                                    </div>
                                    <div class="dropdown-item noti-title cursor" onclick="window.location.assign('list_artikel')">
                                        <small><a class="pull-xs-right">Artikel</a></small>
                                    </div>
                                    <div class="dropdown-item noti-title cursor" onclick="window.location.assign('list_pasen')">
                                        <small><a class="pull-xs-right">Jadi PASEN</a></small>
                                    </div>
                                    <div class="dropdown-item noti-title cursor" onclick="window.location.assign('list_transaksi')">
                                        <small><a class="pull-xs-right">Transaksi</a></small>
                                    </div>
                                </div>
                            </li>
                        <li <?=$btnLogin;?>>
                            <a href="login" class="btn btn-login-bordered navbar-btn">Login | Register</a>
                        </li>
                    </ul>

                </div>
                <!--/Menu -->
            </div>
            <!-- end container -->
        </div>
        <?php 
           $keranjang=mysql_num_rows(mysql_query("SELECT tb_transaksi.no_invoice, pemilik FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain WHERE pemilik='$idUser' AND (tb_transaksi.status='3' OR tb_transaksi.status='7')"));

           $jobs=mysql_num_rows(mysql_query("SELECT tb_transaksi.no_invoice, tb_jobs.id_user FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs WHERE tb_jobs.id_user='$idUser' AND (tb_transaksi.status='3' OR tb_transaksi.status='7')"));

           $wallet=mysql_num_rows(mysql_query("SELECT id_item FROm tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain WHERE pemilik='$idUser' AND tb_transaksi.status='6'"));
           $wallet1=mysql_num_rows(mysql_query("SELECT id_jobs FROm tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs WHERE tb_jobs.id_user='$idUser' AND tb_transaksi.status='6'"));

           if ($keranjang==0) {
               $btn='display:none';
           }else{
                $btn='display:block';
           }

           if ($jobs==0) {
                $btn1='display:none';
           }else{
                $btn1='display:block';
           }

           if ($wallet==1|$wallet1==1) {
            $btn2='display:block';
            }else{
                $btn2='display:none';
            }

        ?>
        <div class="button-float">
            <ul>
                <li><button class="btn btn-sm btn-floating badge bg-btn-love" data-badge="&#10003;" onclick="window.location.assign('my_wallet')" style="border: none; <?=$btn2;?>"><i class="fa fa-money"></i></button></li>
                <li><button class="btn btn-sm btn-floating badge bg-btn-success" data-badge="<?=$keranjang;?>" onclick="window.location.assign('my_transaksi')" style="border: none; margin-top:10px; <?=$btn;?>"><i class="fa fa-shopping-basket"></i></button></li>
                <li><button class="btn btn-sm btn-floating badge bg-btn-love" data-badge="<?=$jobs;?>" onclick="window.location.assign('my_jobs')" style="border: none; margin-top:10px; <?=$btn1;?>"><i class="fa fa-calendar-plus-o"></i></button></li>
            </ul>
            
        </div>