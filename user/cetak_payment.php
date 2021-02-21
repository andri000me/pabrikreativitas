<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="icon" type="image/ico" href="../admin/assets/images/icon/favicon.ico" />
        <title>Pabrik Kreativitas</title>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sriracha" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="../assets/user_admin/css/bootstrap.min.css" rel="stylesheet">

        <!-- Owl Carousel CSS -->
        <link href="../assets/user_admin/css/owl.carousel.css" rel="stylesheet">
        <link href="../assets/user_admin/css/owl.theme.default.min.css" rel="stylesheet">

        <!-- Icon CSS -->
        <link href="../assets/user_admin/css/ionicons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Alertify -->
        <link href="../assets/user_admin/css/alertify.min.css" rel="stylesheet" type='text/css' />
        <script src="../assets/user_admin/js/alertify.min.js"></script>

        <!-- Custom styles for this template -->
        <link href="../assets/user_admin/css/style_user.css" rel="stylesheet">

        <style type="text/css">
        @media print {
            #print{
                display: none;
            }
            #border{
                border: none;
            }
        }
        </style>

    </head>

    <body data-spy="scroll" data-target="#navbar-menu">

    <?php 
    include '../database/koneksi.php';
    session_start();
    ob_start();
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
    $idUser=$_SESSION['idUser'];
    $qProfil=mysql_query("SELECT * FROM tb_user WHERE id_user='$idUser'");
    $profil=mysql_fetch_array($qProfil);
    $item=$_GET['no'];
    $qItem=mysql_query("SELECT * FROM tb_transaksi WHERE no_invoice='$item'") or die(mysql_error());
    $info=mysql_fetch_array($qItem);
    switch ($info['status']) {
        case '1':
            $label='label label-default';
            $txtLabel='Belum Dibayar';
            $btnColor='bg-btn-dark';
            break;
        case '2':
            $label='label label-default';
            $txtLabel='Menunggu Konfirmasi';
            break;
        case '3':
            $label='label label-success';
            $txtLabel='Telah Dibayar';
            break;
        case '4':
            $label='label label-danger';
            $txtLabel='Gagal / Dibatalkan';
            break;
        case '6':
            $label='label label-primary';
            $txtLabel='Selesai';
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
    $code=substr($item,4,1);
    switch ($code) {
        case 'D':
            $query=mysql_query("SELECT nama_desain AS item, harga AS hg, qty, sub_total, kurir, ongkir FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain WHERE tb_transaksi.no_invoice='$item' LIMIT 1");
            $query1=mysql_query("SELECT substr(pemilik,1,2) AS code FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain WHERE tb_transaksi.no_invoice='$item' LIMIT 1");
            $dta=mysql_fetch_array($query1);
            if ($dta['code']=='US') {
                $user=mysql_query("SELECT nama_user FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain JOIN tb_user ON tb_desain.pemilik=tb_user.id_user WHERE tb_transaksi.no_invoice='$item' LIMIT 1");
                $quser=mysql_fetch_array($user);
                $pengirim=$quser['nama_user'];
            }else{
                $pengirim='Pabrik Kreativitas';
            }
            $dataTables=mysql_fetch_array($query);
            $qty=$dataTables['qty'];
            $ongkir=$dataTables['ongkir'];
            $subTotal=$dataTables['sub_total'];
            $totalBayar=$dataTables['sub_total']+$ongkir;
            break;
        case 'C':
            $query=mysql_query("SELECT jenis_cetak AS item, harga AS hg, qty, sub_total, kurir, ongkir, catatan FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_cetak ON tb_detail_transaksi.id_item=tb_cetak.id_cetak WHERE tb_transaksi.no_invoice='$item' LIMIT 1");
            $dataTables=mysql_fetch_array($query);
            $pengirim='Pabrik Kreativitas';
            $qty=$dataTables['qty'];
            $ongkir=$dataTables['ongkir'];
            $subTotal=$dataTables['sub_total'];
            $totalBayar=$dataTables['sub_total']+$ongkir;
            break;
        case 'J':
            $query=mysql_query("SELECT judul_jobs AS item, harga AS hg, qty, sub_total, kurir, ongkir, nama_user FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs JOIN tb_user ON tb_jobs.id_user=tb_user.id_user WHERE tb_transaksi.no_invoice='$item' LIMIT 1") or die(mysql_error());
            $dataTables=mysql_fetch_array($query);
            $pengirim=$dataTables['nama_user'];
            $qty=$dataTables['qty'];
            $ongkir=$dataTables['ongkir'];
            $subTotal=$dataTables['sub_total'];
            $totalBayar=$dataTables['sub_total']+$ongkir;
            break;
        default:
            $query=mysql_query("SELECT nama_visit AS item, biaya AS hg, nama_user FROM tb_transaksi_visit JOIN tb_visit ON tb_transaksi_visit.id_visit=tb_visit.id_visit JOIN tb_user ON tb_transaksi_visit.id_user=tb_user.id_user WHERE tb_transaksi_visit.no_tiket='$item' LIMIT 1") or die(mysql_error());
            $dataTables=mysql_fetch_array($query);
            $pengirim='Pabrik Kreativitas';
            $qty='1';
            $ongkir='0';
            $subTotal=$dataTables['hg'];
            $totalBayar=$subTotal+$ongkir;
            break;
    }
        
    ?>
        <div class="box">
            <section id="profil" class="">
                <div class="container-fluid ">                    
                <h4 class="header-title" id="print">Invoice</h4>
                    <div class="card" id="border">
                        <div class="card-container">                            
                            <img src="../admin/assets/images/icon/logo.png" width="130">
                            <h4 class="pull-right">Invoice #<br><?=$item;?></h4><br>                            
                            <hr>
                        </div>
                        <div class="card-container clearfix">
                                <div class="pull-left">
                                    <h5><?=$profil['nama_user'];?></h5>
                                    <h5><?=$profil['alamat'];?></h5>
                                    <h5><?=$profil['no_hp'];?></h5>
                                </div>
                                <div class="pull-right">
                                    <table>
                                        <tr>
                                            <td>Pengirim</td>
                                            <td width="15" align="center">:</td>
                                            <td><?=$pengirim;?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Transaksi</td>
                                            <td width="15" align="center">:</td>
                                            <td><?=tanggal($info['tgl_transaksi']);?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td width="15" align="center">:</td>
                                            <td><span class="<?=$label;?>"><?=$txtLabel;?></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <br><br><br>                       
                            <hr>
                        </div>
                        <div class="card-container clearfix">
                            <div>
                                 <table width="100%" border="1">
                                    <tr align="center">
                                        <td>#</td>
                                        <td>Item</td>
                                        <td>Quantity</td>
                                        <td>Harga</td>
                                        <td>Total</td>  
                                    </tr>
                                    <tr align="center">
                                        <td>1</td>
                                        <td><?=$dataTables['item'];?></td>
                                        <td><?=$qty;?></td>
                                        <td><?=rupiah($dataTables['hg']);?></td>
                                        <td><?=rupiah($subTotal);?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-container clearfix">
                                <div class="pull-left">
                                    <h5>PAYMENT TERMS AND POLICIES</h5>
                                </div>
                                <div class="pull-right">
                                    <table>
                                        <tr>
                                            <td>Pengiriman</td>
                                            <td width="15" align="center">:</td>
                                            <td><?=$pengirim;?></td>
                                        </tr>
                                        <tr>
                                            <td>Ongkir</td>
                                            <td width="15" align="center">:</td>
                                            <td><?=rupiah($ongkir);?></td>
                                        </tr>
                                    </table>
                                </div>
                        </div>
                        <div class="card-container clearfix">
                            <div class="pull-right">
                                <h3><?=rupiah($totalBayar);?></h3>
                            </div>
                        </div>
                        <div class="card-container clearfix">
                            <div class="pull-right">
                                <button class="btn btn-sm bg-btn-dark" onclick="window.print();">Cetak</button>
                                <button class="btn btn-sm bg-btn-danger" onclick="window.close();">Batalkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script type="text/javascript">
            function hitungOngkir(kurir){
                switch(kurir) {
                  case 'jne':
                    var ongkir=11000;
                    break;
                  case 'pos':
                    var ongkir=10000;
                    break;
                  case 'tiki':
                    var ongkir=10000;
                    break;
                  case 'sicepat':
                    var ongkir=11000;
                    break;
                  case 'email':
                    var ongkir=8000;
                    break;
                }
                document.getElementById('ongkir').innerHTML='Rp. '+rupiah(ongkir);
                document.getElementById('ongkir1').value=ongkir;
                var harga=document.getElementById('hgItem').value;
                var total=parseInt(harga)+parseInt(ongkir); 
                document.getElementById('total').innerHTML='Rp. '+rupiah(total);      
            }
            const rupiah = (x) => {
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        </script>

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../assets/user_admin/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/user_admin/js/bootstrap.min.js"></script>

        <!-- Jquery easing -->                                                      
        <script type="text/javascript" src="../assets/user_admin/js/jquery.easing.1.3.min.js"></script>

        <!-- Owl Carousel -->                                                      
        <script type="text/javascript" src="../assets/user_admin/js/owl.carousel.min.js"></script>

        <!--sticky header-->
        <script type="text/javascript" src="../assets/user_admin/js/jquery.sticky.js"></script>

        <!--common script for all pages-->
        <script src="../assets/user_admin/js/jquery.app.js"></script>

        <script type="text/javascript">
            function hapus(ik,it,nm){
                alertify.confirm('Perhatian', 'Anda Yakin Akan Menghapus '+nm, function(){ window.location.assign('php/proses_desain?hps=1&ik='+ik+'&it='+it) }
                , function(){}).set({closable:false,transition:'pulse'});
            }
        </script>

    </body>
</html>