<!-- Top Bar Start -->
<?php 
    session_start();
    ob_start();
    if (!isset($_SESSION['idAdmin'])) {
        echo "<script>window.location.assign('index')</script>";
    }else{
        $idAdmin=$_SESSION['idAdmin'];
    }

    include '../database/koneksi.php';
    $dataNama=mysql_fetch_array(mysql_query("SELECT nama_admin, foto_profil FROM tb_admin WHERE id_admin='$idAdmin'"));
    $nama=explode(' ',$dataNama['nama_admin']);
    $path='assets/images/user/'.$dataNama['foto_profil'];

    function rupiah($angka){    
    $hasil_rupiah = "Rp. " . number_format($angka);
    $rupiah=str_replace(',', '.', $hasil_rupiah);
    return $rupiah;     
    }

    function uang($nominal){    
    $hasil_nominal = number_format($nominal);
    $hasil=str_replace(',', '.', $hasil_nominal);
    return $hasil;     
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

    function bulan($b){
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
        $bln=$bulan[$b];
        return $bln;
    }
?>
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="home">
                        <img src="assets/images/icon/logo-typo.png" class="logo-typo">
                        <img src="assets/images/icon/logo.png" class="logo">
                    </a>
                </div>


                <nav class="navbar navbar-custom">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="zmdi zmdi-menu"></i>
                            </button>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav pull-right">
                        <!--<li class="nav-item dropdown notification-list ">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="zmdi zmdi-notifications-none noti-icon"></i>
                                <span class="noti-icon-badge"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger pull-xs-right">7</span>Notification</small></h5>
                                </div>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                    <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1min ago</small></p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info"><i class="icon-user"></i></div>
                                    <p class="notify-details">New user registered.<small class="text-muted">1min ago</small></p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1min ago</small></p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>


                        <li class="nav-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="zmdi zmdi-email noti-icon"></i>
                                <span class="noti-icon-badge"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow  dropdown-lg" aria-labelledby="Preview">
                                <div class="dropdown-item noti-title ">
                                    <h5><small><span class="label label-danger pull-xs-right">7</span>Messages</small></h5>
                                </div>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="<?=$path;?>" alt="img" class="img-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>Robert Taylor</b>
                                        <span>New tasks needs to be done</span>
                                        <small class="text-muted">1min ago</small>
                                    </p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="assets/images/img_avatar-woman.png" alt="img" class="img-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>Carlos Crouch</b>
                                        <span>New tasks needs to be done</span>
                                        <small class="text-muted">1min ago</small>
                                    </p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="assets/images/img_avatar-man.png" alt="img" class="img-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>Robert Taylor</b>
                                        <span>New tasks needs to be done</span>
                                        <small class="text-muted">1min ago</small>
                                    </p>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>-->

                        <li class="nav-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="<?=$path;?>" alt="user" class="img-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Welcome ! <?=$nama[0];?></small> </h5>
                                </div>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a>

                                <!-- item
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                </a>-->

                                <!-- item
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-lock-open"></i> <span>Lock Screen</span>
                                </a>-->

                                <!-- item-->
                                <a href="php/proses_logout.php" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->