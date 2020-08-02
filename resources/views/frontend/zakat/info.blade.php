
@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('scripts')
<script type="text/javascript">

		$( document ).ready(function() {

		});

		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);


			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}

		// Fungsi untuk nisab penghasilan
		function hitung_nisab() {
			var gaji_perbulan = 0;
			var pendapatan_lain = 0;
			var hutang = 0;
			var beras = 0;

			gaji_perbulan = $('#pendapatan_perbulan').val() || 0;
			pendapatan_lain = $('#pendapatan_lain').val() || 0;
			hutang = $('#hutang').val() || 0;
			beras = $('#beras').val() || 0;

			console.log('gaji_perbulan : ', gaji_perbulan);
			console.log('pendapatan_lain : ', pendapatan_lain);
			console.log('hutang : ', hutang);
			console.log('beras : ', beras);

			pendapatan = parseInt(gaji_perbulan) + parseInt(pendapatan_lain) - parseInt(hutang);
			besar_nishab = parseInt(522 * parseInt(beras));

			console.log('pendapatan : ', pendapatan);
			console.log('besar_nishab : ', besar_nishab);

			$('#besar_nisab').text('Besar Nishab : ' + formatRupiah(besar_nishab, 'Rp '));
			$('#pendapatan').text('Pendapatan Bersih : ' + formatRupiah(pendapatan, 'Rp '));

			if (pendapatan > besar_nishab) {
				$('#hasil_nisab').text('Wajib Zakat : WAJIB');
				jumlah_wajib_zakat = parseInt(0.025 * pendapatan);
				$('#wajib_zakat').text('Jumlah Zakat : ' + formatRupiah(jumlah_wajib_zakat, 'Rp '));
			} else {
				$('#hasil_nisab').text('Wajib Zakat : TIDAK');
				jumlah_wajib_zakat = parseInt(0);
				$('#wajib_zakat').text('Jumlah Zakat : ' + formatRupiah(jumlah_wajib_zakat, 'Rp '));
			}

			$('#hasil_hisab').append(formatRupiah(jumlah_wajib_zakat, 'Rp '));
		}



		// Fungsi untuk nisab penghasilan
		function hitung_mal() {
			var tabungan = 0;
			var logam_mulia = 0;
			var property_kendaraan = 0;
			var harta_lainnya = 0 ;
			var hutang_jatuh_tempo = 0;
			var emas = 0;

			tabungan = $('#tabungan').val() || 0;
			logam_mulia = $('#logam_mulia').val() || 0;
			property_kendaraan = $('#property_kendaraan').val() || 0;
			harta_lainnya = $('#harta_lainnya').val() || 0;
			hutang_jatuh_tempo = $('#hutang_jatuh_tempo').val() || 0;
			emas = $('#emas').val() || 0;

			console.log('tabungan : ',tabungan);
			console.log('logam_mulia : ',logam_mulia);
			console.log('property_kendaraan : ',property_kendaraan);
			console.log('harta_lainnya : ',harta_lainnya);
			console.log('hutang_jatuh_tempo : ',hutang_jatuh_tempo);
			console.log('emas : ',emas);

			total = (parseInt(tabungan) + parseInt(logam_mulia) + parseInt(property_kendaraan) + parseInt(harta_lainnya)) - parseInt(hutang_jatuh_tempo);
			total_nishab_maal = parseInt(85 * parseInt(emas));

			console.log('total : ',total);
			console.log('total_nishab_maal : ',total_nishab_maal);


			$('#besar_nisab_maal').text('Besar Nishab : ' + formatRupiah(total_nishab_maal, 'Rp '));
			$('#total').text('Harta Bersih : ' + formatRupiah(total, 'Rp '));

			if (total > total_nishab_maal) {
				$('#hasil_nisab_maal').text('Wajib Zakat : WAJIB');
				jumlah_wajib_maal = parseInt(0.025 * total);
				$('#wajib_zakat_maal').text('Jumlah Zakat : ' + formatRupiah(jumlah_wajib_maal, 'Rp '));
			} else {
				$('#hasil_nisab_maal').text('Wajib Zakat : TIDAK');
				jumlah_wajib_maal = parseInt(0);
				$('#jumlah_wajib_maal').text('Jumlah Zakat : ' + formatRupiah(jumlah_wajib_maal, 'Rp '));
			}

		}

</script>
@endsection

@section('content-frontend')
	<main class="outer-top"></main>

        <div class="terms-conditions-page container" style="margin-bottom: 30px">

            <div class="row">
				<div class="col-md-12" style="padding: 0 50px 50px; margin-bottom: 50px; border-bottom: 1px solid #cccccc;">
					<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
						<div class="more-info-tab clearfix ">
						<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link" id="home-tab" data-toggle="tab" href="#Profesi" role="tab" aria-controls="home" aria-selected="true">Profesi</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#Maal" role="tab" aria-controls="profile" aria-selected="false">Maal</a>
							</li>
						</ul>
						</div>
					</div>

					<div class="tab-content outer-top-xs">
						<div class="tab-pane in active" id="Profesi">
							<h3>Ayo hitung zakat profesi Anda!</h3>
							<form autocomplete="off">

							<div class="row register-form">
								<div class="col-md-4">
											<label class="input-group-text">Pendapatan perbulan (Wajib diisi)</label>
										<input type="number" step="50000" id="pendapatan_perbulan" class="form-control" placeholder="Pendapatan perbulan (Wajib diisi)" value=""/>
								</div>
								<div class="col-md-4">
										<label class="input-group-text">Pendapatan lain (jika ada)</label>
										<input type="number" step="50000" id="pendapatan_lain" class="form-control" placeholder="Pendapatan lain (jika ada)" value="" />
								</div>
								<div class="col-md-4">
											<label class="input-group-text">Hutang/Cicilan (jika ada)</label>
										<input type="number" step="50000" id="hutang" class="form-control" placeholder="Hutang/Cicilan (jika ada)" value="">
								</div>
								<div class="col-md-4">
									<label>Harga Beras /Kg : </label>

										<input type="number" step="1000" id="beras" class="form-control" placeholder="Harga Beras saat ini" value="">
								</div>
								<div class="col-md-4">
									<br>
										<button type="button" class="btn btn-success" onclick="hitung_nisab()"><strong>HITUNG ZAKAT ANDA</strong></button>
								</div>
								<div class="col-md-12">
									<h3 id="pendapatan"></h3>
									<h3 id="besar_nisab"></h3>
									<h3 id="hasil_nisab"></h3>
									<h3 id="wajib_zakat"></h3>
								</div>
							</div>
							</form>
						</div>
						<div class="tab-pane in" id="Maal">
							<form autocomplete="off">
								<div class="container--small">
									<h3>Salurkan zakat maal Anda!</h3>
									<ul style="">
										<li>1. Zakat maal untuk properti dan kendaraan tidak kena zakat kecuali yang digunakan usaha seperti disewakan/dibuat kosan atau digunakan apa saja yang menghasilkan.</li>
										<li>2. Zakat mall untuk pertanian/perpanenan dengan irigasi dikenakan zakat sebesar 5%.</li>
										<li>3. Zakat mall untuk pertanian/perpanenan tadah hujan dikenakan zakat sebesar 10%</li>
										<li>4. Zakat Maal khusus untuk harta yang <strong>telah tersimpan selama lebih dari 1 tahun (haul) dan mencapai batas tertentu (nisab)</strong></li>
									</ul>
									<br>
									<div class="col-md-4">
											<label class="input-group-text">Rp</label>
										<input type="number" step="50000" id="tabungan" class="form-control" placeholder="Tabungan/ Giro/ Deposito" value=""/>
									</div>
									<div class="col-md-4">
											<label class="input-group-text">Logam Mulia atau sejenisnya</label>
										<input type="number" step="50000" id="logam_mulia" class="form-control" placeholder="Logam Mulia (Emas, perak, permata, atau sejenisnya)" value="" />
									</div>
									<div class="col-md-4">
											<label class="input-group-text">Nilai properti & kendaraan</label>
										<input type="number" step="50000" id="property_kendaraan" class="form-control" placeholder="Nilai properti & kendaraan" value="">
									</div>
									<div class="col-md-4">
											<label class="input-group-text">Harta Lainnya</label>
										<input type="number" step="50000" id="harta_lainnya" class="form-control" placeholder="Harta Lainnya" value="">
									</div>
									<div class="col-md-4">
											<label class="input-group-text">Hutang Jatuh Tempo </label>
										<input type="number" step="50000" id="hutang_jatuh_tempo" class="form-control" placeholder="Hutang Jatuh Tempo Saat Membayar Kewajiban Zakat" value="">
									</div>

									<div class="col-md-4">
											<label class="input-group-text">Harga Emas /gr</label>
										<input type="number" step="100000" id="emas" class="form-control" placeholder="Harga Emas saat ini" value="">
									</div>
									<div class="col-md-4 ">
										<br>
										<button type="button" class="btn btn-outline-success" onclick="hitung_mal()"><strong>HITUNG ZAKAT ANDA</strong></button>
									</div>
									<div class="col-md-12">
										<h3 id="total"></h3>
									<h3 id="besar_nisab_maal"></h3>
									<h3 id="hasil_nisab_maal"></h3>
									<h3 id="wajib_zakat_maal"></h3>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>

                <div class="terms-conditions" style="padding: 0 50px 50px;">
                    <h2 class="heading-title">Zakat & Infaq</h2>
                    <div class="row">

	                    <div class="col-md-12">
	                    	<center><img src="{{ asset('img/YayasanKesejahteraanUmat.jpg') }}" class="card-img-top" style="width:200px; margin-top:20px;"></center>
							  <div class="card-body">
							    <h5 class="card-title">Ayo Zakat Sekarang</h5>
							    <p class="card-text">"Ambillah zakat dari sebagian harta mereka karena dengan zakat itu kamu membersihkan dan mensucikan mereka", (QS. at-Taubah : 103)</p>
							    <h5 class="card-title">Ayo Infaq Sekarang</h5>
							    <p class="card-text pull-right">ذَلِكَ الْكِتَابُ لَا رَيْبَ فِيهِ هُدًى لِلْمُتَّقِينَ * الَّذِينَ يُؤْمِنُونَ بِالْغَيْبِ وَيُقِيمُونَ الصَّلَاةَ وَمِمَّا رَزَقْنَاهُمْ يُنْفِقُونَ</p>
							    <p class="card-text pull-right">"Kitab (Al-Qur’an) ini tidak ada keraguan padanya, petunjuk bagi mereka yang bertakwa, (2) (yaitu) mereka yang beriman kepada yang gaib, menegakkan shalat, dan menginfakkan sebagian rezeki yang Kami berikan kepada mereka. (3) – (Q.S Al-Baqarah: 2-3)"</p>
							    <br>
							    <p class="card-text"><small class="text-muted"><button class="btn btn-success pull-right" onclick="$('#rek').toggle()">
									<strong> ZAKAT & INFAQ SEKARANG</strong>
								</button></small></p>
							  </div>
	                    </div>
	                     <div class="col-md-12">
							<div class="card text-center" id="rek" style="display: none">
								  <div class="card-body">
								    <h5 class="card-title">
								    <strong>YAYASAN KESEJAHTERAAN UMAT BANYUWANGI</strong>
								    </h5>
								    <p class="card-text">SK Menteri Hukum dan HAM RI : No. AHU-0002845.AH.01.04 Tahun 2018</p>
								    <p class="card-text">Jln. Raya Kembiritan Nomor 315, RT.02/RW.06, Genteng, Kabupaten Banyuwangi, Jawa Timur.</p>
								    <div class="btn btn-primary"><strong>Kontak</strong><br>0822-1622-2162</div>
								  </div>
								  <div class="card-footer text-muted">
								    Pembayaran dapat melalui Bank Syariah Mandiri (BSM) No Rek 7117266901*<br> atas nama YAYASAN  KESEJAHTERAAN UMAT BWI  Kode Bank 451.
								    <img src="{{ asset('img/mandiri-syariah.png') }}" class="img-thumbnail pull-right" style="width:100px; margin-top:10px;">
								  </div>
								</div>
						</div>
	                </div>
	            </div>
	        </div>

	    </div>

@endsection
