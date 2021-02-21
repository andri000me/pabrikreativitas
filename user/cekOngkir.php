<?php
	$asal = $_POST['asal'];
	$tujuan = $_POST['tujuan'];
	$kurir = $_POST['kurir'];
	$berat = $_POST['berat'];;

	if ($kurir=='kosong') {
		echo "<script>alertify.alert('Perhatian', 'Kurir Tidak Boleh Kosong', function(){ $('#tujuan option:contains(Pilih Kota Tujuan)').prop({selected: true}); $('#kurir').focus(); });</script>";
	}else if ($tujuan=='kosong') {
		# code...
	}else{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=".$asal."&destination=".$tujuan."&weight=".$berat."&courier=".$kurir."",
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: bb5a516a784598ea57bcd43a5d9c0db9"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $data = json_decode($response, true);
		}
		?>
		<div style="display: none;">
		<?php echo $data['rajaongkir']['origin_details']['city_name'];?> ke <?php echo $data['rajaongkir']['destination_details']['city_name'];?> @<?php echo $berat;?>gram Kurir : <?php echo strtoupper($kurir); ?>
		</div>
		<?php
		 for ($k=0; $k < count($data['rajaongkir']['results']); $k++) {
		?>
			 <div title="<?php echo strtoupper($data['rajaongkir']['results'][$k]['name']);?>" class="m-t-1">
				<?php
				echo "
				 <div class= \"form-group\">
					<h5>Ongkos Kirim</h5>	
					<select class=\"form-control\" name='kurir' id='harga' onchange='hitungOngkir(this.value)'>";
						echo "<option value='0' disabled selected >Pilih harga</option>";
						$data = json_decode($response, true);
						for ($l=0; $l < count($data['rajaongkir']['results'][$k]['costs']); $l++) { ?>
							<option value="<?=$data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value'];?>"><?=$data['rajaongkir']['results'][$k]['costs'][$l]['service']." - Rp ".str_replace(',', '.', number_format($data['rajaongkir']['results'][$k]['costs'][$l]['cost'][0]['value']));?></option>
						<?php
						}
						echo "</select>
						<input type='hidden' name='ongkir' id='hargaOngkir'>
					</div>";
					?>
			 </div>
		 <?php
		 }
	}
?>

