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
        <script src="../assets/user_admin/js/jquery.min.js"></script>
        <!-- Custom styles for this template -->
        <link href="../assets/user_admin/css/style_user.css" rel="stylesheet">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body data-spy="scroll" data-target="#navbar-menu">

    <?php 
    include '../database/koneksi.php';
    include 'part/header_menu.php'; 
    $qProfil=mysql_query("SELECT * FROM tb_user WHERE id_user='$idUser'");
    $profil=mysql_fetch_array($qProfil);
    $mdInv=$_GET['iv'];
    $qItem=mysql_query("SELECT no_invoice, tgl_transaksi FROM tb_transaksi WHERE md5(no_invoice)='$mdInv'") or die(mysql_error());
    $item=mysql_fetch_array($qItem);
    ?>
        <div class="box">
            <form method="POST" action="php/proses_checkout">
            <section id="profil" class="home-margin m-t-20">
                <div class="container-fluid">                    
                <h4 class="header-title">Checkout</h4>
                    <div class="row ">
                        <?php                   
                            $cek=mysql_num_rows($qItem);
                            if ($cek<=0) {   
                            	echo "Silahkan Lakukan Pembelian";
                            }else{ ?>

                            	<div class="col-lg-8 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                        	<?php
                                                    $noInvoice=$item['no_invoice'];
                                                    $code=substr($noInvoice,4,1);
                                                    switch ($code) {
                                                        case 'D':
                                                            $query=mysql_query("SELECT DISTINCT nama_desain, harga, berat, gambar_desain, qty, sub_total, tb_transaksi.status, catatan, pemilik FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_desain ON tb_detail_transaksi.id_item=tb_desain.id_desain JOIN tb_gambar_desain ON tb_desain.id_desain=tb_gambar_desain.id_desain WHERE tb_transaksi.no_invoice='$noInvoice' LIMIT 1");
                                                            $result=mysql_fetch_array($query);
                                                            $namaItem=$result['nama_desain'];
                                                            $p=$result['pemilik'];
                                                            $id=substr($result['pemilik'],0,2);
                                                            $hargaItem=$result['harga'];
                                                            $qty=$result['qty'];
                                                            $berat=$result['berat'];
                                                            $brt=$berat/1000;
                                                            $catatan=$result['catatan'];
                                                            $subTotal=$result['sub_total'];
                                                            $gambar='../admin/assets/images/ugd/'.$result['gambar_desain'];

                                                            if ($id=='AD') {
                                                                $ambilAsal=mysql_query("SELECT kota_asal FROM tb_admin WHERE id_admin='$p'");
                                                            }else{
                                                                $ambilAsal=mysql_query("SELECT kota_asal FROM tb_user WHERE id_user='$p'");
                                                            }
                                                            break;
                                                        case 'C':
                                                            $query=mysql_query("SELECT jenis_cetak, harga, berat, icon, qty, sub_total, tb_transaksi.status, catatan, pemilik FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_cetak ON tb_detail_transaksi.id_item=tb_cetak.id_cetak WHERE tb_transaksi.no_invoice='$noInvoice' LIMIT 1");
                                                            $result=mysql_fetch_array($query);
                                                            $namaItem=$result['jenis_cetak'];
                                                            $hargaItem=$result['harga'];
                                                            $qty=$result['qty'];
                                                            $p=$result['pemilik'];
                                                            $berat=$result['berat'];
                                                            $brt=$berat/1000;
                                                            $catatan=$result['catatan'];
                                                            $subTotal=$result['sub_total'];
                                                            $ambilAsal=mysql_query("SELECT kota_asal FROM tb_admin WHERE id_admin='$p'");
                                                            $gambar='../admin/assets/images/urc/'.$result['icon'];
                                                            break;
                                                        case 'J':
                                                            $query=mysql_query("SELECT judul_jobs, harga, berat, qty, sub_total, tb_transaksi.status, catatan, gambar_jobs, tb_transaksi.id_user FROM tb_transaksi JOIN tb_detail_transaksi ON tb_transaksi.no_invoice=tb_detail_transaksi.no_invoice JOIN tb_jobs ON tb_detail_transaksi.id_item=tb_jobs.id_jobs JOIN tb_gambar_jobs ON tb_jobs.id_jobs=tb_gambar_jobs.id_jobs WHERE tb_transaksi.no_invoice='$noInvoice' LIMIT 1") or die(mysql_error());
                                                            $result=mysql_fetch_array($query);
                                                            $namaItem=$result['judul_jobs'];
                                                            $hargaItem=$result['harga'];
                                                            $qty=$result['qty'];
                                                            $berat=$result['berat'];
                                                            $brt=$berat/1000;
                                                            $catatan=$result['catatan'];
                                                            $p=$result['id_user'];
                                                            $subTotal=$result['sub_total'];
                                                            $gambar='../admin/assets/images/portofolio/'.$result['gambar_jobs'];
                                                            $ambilAsal=mysql_query("SELECT kota_asal FROM tb_user WHERE id_user='$p'");
                                                            break;
                                                        default:
                                                            # code...
                                                            break;
                                                    }

                                                    
                                                    ?>
    	                                            <div class="card-border">
                                                    <input type="hidden" name="noInvoice" value="<?=$noInvoice;?>">                      
    	                                                <div class="row clearfix">
                                                            <div class="col-sm-12 col-lg-4">
                                                                <img src="<?=$gambar;?>" class="img-keranjang img-thumbnail pull-left">
                                                                    
                                                            </div> 
                                                            <div class="col-sm-12 col-lg-8">
                                                                <div>         
                                                                    <h4><?=$namaItem;?></h4>                        
                                                                    <h4><?=rupiah($hargaItem);?></h4>
                                                                    <h5>Berat : <?=$brt;?> Kg</h5>
                                                                    <h5>Jumlah Beli : <?=$qty;?></h5>
                                                                    <h5>Catatan : <?=$catatan;?></h5>
                                                                </div>
                                                            </div>                                            
                                                        </div>
    	                                            </div>	
                                                    <br>	                                     
			                                <?php
                                        
                                        ?>
                                        </div>
                                    </div> 
                                    <div class="card c-t-1">
                                        <div class="card-container">
                                            <div class="card-border">                                                
                                                <div class="row clearfix"> 
                                                    <div class="col-sm-12 col-lg-12">
                                                        <h5 class="text-left">Data Pembeli <small>Dapat diubah melalui edit profil</small></h5><hr>
                                                        <div class="row">
                                                        	<div class="col-sm-12 col-lg-6">
		                                                        <div class="form-group">
		                                                        	<label>Nama Pembeli</label>
		                                                        	<input type="text" name="nmPembeli" class="form-control" value="<?=$profil['nama_user'];?>" readonly>
		                                                        </div>                                   		
                                                        	</div>
                                                        	<div class="col-sm-12 col-lg-6">	 
		                                                        <div class="form-group">
		                                                        	<label>Nomor Telepon</label>
		                                                        	<input type="number" name="noTelp" class="form-control" value="<?=$profil['no_hp'];?>" readonly>
		                                                        </div>
		                                                    </div>
                                                        </div>
		                                                    <div class="form-group">
		                                                     	<label>Alamat</label>
		                                                     	<textarea class="form-control" name="alamat" readonly><?=$profil['alamat'];?></textarea>
		                                                    </div>
                                                    </div>                                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>           
                                </div>
                                <div class="col-lg-4 p-t-2">          
                                    <div class="card">
                                        <div class="card-container">
                                            <div class="card-border">                                                
                                                <div class="row clearfix"> 
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="text-left">         
                                                            <div class="form-group">
                                                                <input type="hidden" id="berat" value="<?=$berat;?>">
                                                            	<h5>Jasa Pengiriman</h5>
                                                                <select name="kurir" id="kurir" class="form-control" required>
                                                                    <option value="kosong" selected hidden>Pilih Kurir</option>
                                                            		<option value="jne">JNE</option>
                                                            		<option value="pos">POS</option>
                                                            		<option value="tiki">TIKI</option>
                                                                    <option value="email">Email</option>
                                                            	</select>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php
                                                                    $dapatAsal=mysql_fetch_array($ambilAsal);
                                                                    $asal = $dapatAsal['kota_asal'];
                                                                    $curl = curl_init();    
                                                                    curl_setopt_array($curl, array(
                                                                      CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
                                                                      CURLOPT_RETURNTRANSFER => true,
                                                                      CURLOPT_ENCODING => "",
                                                                      CURLOPT_MAXREDIRS => 10,
                                                                      CURLOPT_TIMEOUT => 30,
                                                                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                      CURLOPT_CUSTOMREQUEST => "GET",
                                                                      CURLOPT_HTTPHEADER => array(
                                                                        "key: bb5a516a784598ea57bcd43a5d9c0db9"
                                                                      ),
                                                                    ));

                                                                    $response = curl_exec($curl);
                                                                    $err = curl_error($curl);

                                                                    curl_close($curl);
                                                                    $data = json_decode($response, true);
                                                                    $cityId=$data['rajaongkir']['results'][$asal-1]['city_id'];
                                                                    $cityName=$data['rajaongkir']['results'][$asal-1]['city_name'];
                                                                    ?>
                                                                    <h5>Kota Asal</h5>
                                                                    <input type="text" name="asalName" id="asalName" class="form-control" value="<?=$cityName;?>" style="pointer-events: none;">
                                                                    <input type="hidden" name="asal" id="asal" class="form-control" value="<?=$cityId;?>">
                                                                    <?php
                                                                ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <h5>Kota Tujuan</h5>
                                                                <select name="tujuan" id="tujuan" class="form-control tujuan">
                                                                    <option value="kosong" selected hidden>Pilih Kota Tujuan</option> 
                                                                    <?php
                                                                        $curl = curl_init();    
                                                                        curl_setopt_array($curl, array(
                                                                          CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
                                                                          CURLOPT_RETURNTRANSFER => true,
                                                                          CURLOPT_ENCODING => "",
                                                                          CURLOPT_MAXREDIRS => 10,
                                                                          CURLOPT_TIMEOUT => 30,
                                                                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                                                          CURLOPT_CUSTOMREQUEST => "GET",
                                                                          CURLOPT_HTTPHEADER => array(
                                                                            "key: bb5a516a784598ea57bcd43a5d9c0db9"
                                                                          ),
                                                                        ));

                                                                        $response = curl_exec($curl);
                                                                        $err = curl_error($curl);

                                                                        curl_close($curl);
                                                                        $data = json_decode($response, true);
                                                                        for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
                                                                                $cityId1=$data['rajaongkir']['results'][$i]['city_id'];
                                                                                $cityName1=$data['rajaongkir']['results'][$i]['city_name'];
                                                                            ?>
                                                                            <option value="<?=$cityId1;?>"><?=$cityName1;?></option>
                                                                            <?php
                                                                            }
                                                                    ?>
                                                                </select>
                                                                
                                                                    
                                                                    
                                                            </div>
                                                            <div class="form-group">
                                                            	<h5>Pembayaran Bank</h5>
                                                            	<select name="bank" class="form-control" required>
                                                                    <option selected hidden> Pilih Bank </option>
                                                                    <?php
                                                                    $qBank=mysql_query("SELECT id_bank, nama_bank FROM tb_bank");
                                                                    while ($hasil=mysql_fetch_array($qBank)) { ?>
                                                                		<option value="<?=$hasil['id_bank'];?>"><?=$hasil['nama_bank'];?></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                            	</select>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-12 col-lg-4">
                                                                    <h5>Sub Total</h5>
                                                                    <h5 id="subtotal"><?=rupiah($subTotal);?></h5>
                                                                    <input type="hidden" name="hgItem" id="hgItem" value="<?=$subTotal;?>">
                                                                </div>
                                                                <div class="col-sm-12 col-lg-8">
                                                                    <div class="ongkir">
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            
                                                            <h4>Total</h4>
                                                            <h4 id="total">-</h4>

                                                            <button class="btn btn-sm bg-btn-success" type="submit" name="bayarTransaksi"><span class="ion-pricetags"></span> Bayar</button>
                                                            <button class="btn btn-sm bg-btn-danger" type="submit" name="batalTransaksi"><i class="ion-close"></i> Batalkan</button>
                                                            
                                                        </div>
                                                    </div>                                             
                                                </div>
                                            </div>
                                        </div>
                                    </div>            
                                </div>
                            <?php
                            }

                        ?>
                    </div>
                </div>
            </section>
            </form>
        </div>
        <?php include 'part/footer.php'; ?>
        <script>
            $(document).ready(function(){
              $("#tujuan").change(function(){
                var asal = $("#asal").val();
                var tujuan = $("#tujuan").val();
                var kurir = $("#kurir").val();
                var berat = $("#tujuan").val();
                    $.ajax({
                        type : 'post',
                        url : 'cekOngkir.php',
                        data :  {asal: asal, tujuan: tujuan, kurir: kurir, berat: berat},
                        success : function(data){
                        $('.ongkir').html(data);
                        }
                    });
                 });
            });
        </script>
        <script type="text/javascript">
            function hitungOngkir(o){
                var subTotal=document.getElementById('hgItem').value;
                var total=parseInt(o)+parseInt(subTotal);
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
        function kode(kb){
            alert(kb);
        }
            function hapus(ik,it,nm){
                alertify.confirm('Perhatian', 'Anda Yakin Akan Menghapus '+nm, function(){ window.location.assign('php/proses_desain?hps=1&ik='+ik+'&it='+it) }
                , function(){}).set({closable:false,transition:'pulse'});
            }
        </script>

    </body>
</html>