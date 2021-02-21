<!-- ========== Left Sidebar Start ========== -->
<?php
    include '../database/koneksi.php';
    $dataPosisi=mysql_fetch_array(mysql_query("SELECT posisi FROM tb_admin WHERE id_admin='$idAdmin'"));
    $posisi=$dataPosisi['posisi'];
    switch ($posisi) {
        case '1':
            $display='style="display:block"';
            break;        
        default:
            $display='style="display:none"';
            break;
    }
?>
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        	<li class="text-muted menu-title">&nbsp;</li>

                            <li class="has_sub">
                                <a href="home" class="waves-effect"><i class="fa fa-dashboard"></i><span> Dashboard </span> </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-balance-wallet"></i> <span> Pembukuan </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="my_book">Pembukuan</a></li>
                                    <li><a href="cair_dana">Cair Dana</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-gradient"></i> <span> UGD </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_desain">List UGD</a></li>
                                    <li><a href="tambah_desain">Tambah UGD</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ion-android-printer"></i> <span> URC </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_cetak">List URC</a></li>
                                    <li><a href="tambah_cetak">Tambah URC</a></li>
                                    <li><a href="list_proses_cetak">Proses URC</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-local-activity"></i> <span> VAKSIN</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_visit">List VAKSIN</a></li>
                                    <li><a href="tambah_visit">Tambah VAKSIN</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-file-text"></i> <span> APOTIK</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_artikel">List APOTIK</a></li>
                                    <li><a href="tambah_artikel">Tambah APOTIK</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-assignment"></i> <span> PASEN </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_pasen">List PASEN</a></li>
                                    <li><a href="tambah_pasen">Tambah PASEN</a></li>
                                </ul>
                            </li>
                            
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-case-check"></i> <span> POSYANDU </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_posyandu">List POSYANDU</a></li>
                                    <li><a href="tambah_posyandu">Tambah POSYANDU</a></li>
                                </ul>
                            </li>
                            
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-storage"></i> <span> Transaksi </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="transaksi_penjualan_ugd"><span>UGD</span></a></li>
                                    <li><a href="transaksi_penjualan_urc"><span>URC</span></a></li>
                                    <li><a href="transaksi_penjualan_pasen"><span>PASEN</span></a></li>
                                    <li><a href="transaksi_penjualan_visit"><span>VAKSIN</span></a></li>
                                    <li><a href="transaksi_penjualan_posyandu"><span>POSYANDU</span></a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-assignment-account"></i> <span> Client </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_client"><span>list Client</span></a></li>
                                    <li><a href="tambah_client"><span>Tambah Client</span></a></li>
                                </ul>
                            </li>

                            <li class="has_sub" <?=$display;?>>
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts-list-alt"></i> <span> Admin </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_admin">List Admin</a></li>
                                    <li><a href="tambah_admin">Tambah Admin</a></li>
                                </ul>
                            </li>
                            <li class="has_sub" <?=$display;?>>
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-map"></i> <span> Negara </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="list_negara">List Negara</a></li>
                                    <li><a href="tambah_negara">Tambah Negara</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="list_user" class="waves-effect"><i class="zmdi zmdi-account-circle"></i><span> User </span> </a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ion-gear-a"></i> <span> Settings</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="settings_profil">Profil Perusahaan</a></li>
                                    <li><a href="settings_image">Images Perusahaan</a></li>
                                    <li><a href="settings_header">Headline</a></li>
                                    <li><a href="settings_sosmed">Sosial Media</a></li>
                                    <li><a href="settings_kategori">Kategori</a></li>
                                </ul>
                            </li>

                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- Left Sidebar End -->