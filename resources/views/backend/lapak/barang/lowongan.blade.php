<head>
	<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-lite.css') }}">
</head>
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.'store-lowongan') }}" method="POST" class="was-validated needs-validation"  novalidate>
			<h2>Sertakan Beberapa detail</h2>
			{!! csrf_field() !!}
			<input type="hidden" name="id_trans_lapak" value="{{ $record->id or '' }}">
			<input type="hidden" name="id_kategori" value="{{ $sub->kategori->id }}">
			<input type="hidden" name="id_sub_kategori" value="{{ $sub->id }}">
				@if ($sub->kategori->kat_nama == 'Lowongan')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="form-group">
							<label for="">Gaji</label>
							<input type="text" name="harga_barang" class="form-control" placeholder="Isi dengan number" required="">
							
						</div>	
						<div class="form-group">
							<label for="">Judul Lowongan</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama Lowongan" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi Lowongan</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi Lowongan" required=""></textarea>
							
						</div>
						<div class="form-group">
							@include('partials.file-tab.attachment',['multi' => 'multiple'])
							<span class="text-danger">Format Gambar Jpg Png</span>
							<br>
							<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Jasa')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="form-group">
							<label for="">Judul Jasa</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama Jasa" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi Jasa</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi Lowongan" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						<div class="form-group">
							@include('partials.file-tab.attachment',['multi' => 'multiple'])
							<span class="text-danger">Format Gambar Jpg Png</span>
							<br>
							<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Hobi dan Olahraga')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="form-group">
							<label for="">Kondisi</label>
							<select name="kondisi_barang" id="" class="form-control">
								<option value="">Pilih Kondisi Barang</option>
								<option value="baru">Baru</option>
								<option value="bekas">Bekas</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Judul Iklan</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama Hobi & Olahraga" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi Iklan</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi Hobi & Olahraga" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						<div class="form-group">
							@include('partials.file-tab.attachment',['multi' => 'multiple'])
							<span class="text-danger">Format Gambar Jpg Png</span>
							<br>
							<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Industri Perkantoran')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="form-group">
							<label for="">Kondisi</label>
							<select name="kondisi_barang" id="" class="form-control">
								<option value="">Pilih Kondisi Barang</option>
								<option value="baru">Baru</option>
								<option value="bekas">Bekas</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Judul Iklan</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama Iklan" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi Iklan</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi Iklan" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						<div class="form-group">
							@include('partials.file-tab.attachment',['multi' => 'multiple'])
							<span class="text-danger">Format Gambar Jpg Png</span>
							<br>
							<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'otomotif')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="form-group">
							<label for="">Kondisi</label>
							<select name="kondisi_barang" id="" class="form-control">
								<option value="">Pilih Kondisi Barang</option>
								<option value="baru">Baru</option>
								<option value="bekas">Bekas</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Tipe Bahan Bakar</label>
							<select name="satuan_barang" id="" class="form-control">
								<option value="">Pilih bahan Bakar</option>
								<option value="Bensin">Bensin</option>
								<option value="Diesel">Diesel</option>
								<option value="Solar">Solar</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Jumlah Muatan</label>
							<input type="number" name="stock_barang" id="" class="form-control" value="1">
						</div>
						<div class="form-group">
							<label for="">Muatan</label>
							<select name="attribut_barang" id="" class="form-control">
								<option value="">Pilih Muatan</option>
								<option value="orang">Orang</option>
								<option value="barang">Barang</option>
								<option value="Tidakbermesin">Tidak-bermesin</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Merek Mobil</label>
							<input type="text" name="merek" class="form-control" placeholder="Merek Barang" required="">
						</div>
						<div class="form-group">
							<label for="">Judul Iklan</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama Iklan" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi Iklan</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi Iklan" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Kelengkapan fasilitas</label>
							<input type="text" name="status_barang" class="form-control" placeholder="Kelengkapan Fasilitas" required="">
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>
						<div class="form-group">
							@include('partials.file-tab.attachment',['multi' => 'multiple'])
							<span class="text-danger">Format Gambar Jpg Png</span>
							<br>
							<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Pupuk')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->kategori->kat_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->kategori->kat_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->kategori->kat_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->kategori->kat_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Elektronik')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Perlengkapan Rumah Tangga')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Properti')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Kesehatan dan farmasi')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Perlengkapan Bayi dan Anak')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Gadget')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Pertanian')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Peternakan')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Perikanan')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
				@if ($sub->kategori->kat_nama == 'Perkebunan')
					<div class="col-md-12 mt-5" style="margin-top: 30px">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Satuan Barang</label>
									<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
										<option>Pilih Satuan</option>
										<option value="Buah">Buah</option>
										<option value="Lusin">Lusin</option>
										<option value="Box">Box</option>
										<option value="Kodi">Kodi</option>
										<option value="Gross">Gross</option>
										<option value="Rim">Rim</option>
										<option value="Drum">Drum</option>
										<option value="Krat">Krat</option>
										<option value="Slop">Slop</option>
										<option value="Pcs">Pcs</option>
										<option value="Liter">Liter</option>
									</select>					
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Kondisi</label>
									<select name="kondisi_barang" id="" class="form-control">
										<option value="">Pilih Kondisi Barang</option>
										<option value="baru">Baru</option>
										<option value="bekas">Bekas</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">	
								<div class="form-group">
									<label for="">Jumlah Barang</label>
									<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="form-group">
										<label for="">Berat Barang</label>
										  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">					
									</div>
								</div>	
							</div>	
						</div>
						<div class="form-group">
							<label for="">Judul {{ $sub->sub_nama }}</label>
							<input type="text" name="nama_barang" class="form-control" placeholder="Nama {{ $sub->sub_nama }}" required="">
						</div>
						<div class="form-group">
							<label for="">Deskripsi {{ $sub->sub_nama }}</label>
							<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi {{ $sub->sub_nama }}" required=""></textarea>
						</div>
						<div class="form-group">
							<label for="">Tentukan Harga</label>
							<div class="row" style="padding: 0px; margin-left:5px">
								<div class="col-md-1" style="height: 35px ; border: 1px solid rgba(0, 0, 0, 0.414); border-radius:5px 0px 0px 5px">
									<span class="input-group-text" id="basic-addon3" style="padding-top: 10px; font-size:20px">Rp. </span>
								</div>
								<div class="col-md-8" style="padding-left: 0px">
									<input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jasa" required="" value="0">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Expired</label>
									<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
									<span class="text-danger">Format Gambar Jpg Png</span>
									<br>
									<span class="text-danger">Ukuran Gambar tidak Boleh lebih dari 2mb</span>
								</div>	
							</div>
						</div>
					</div>
				@endif
			</form>
		</div>
	</div>
<div class="modal-footer">
	<button type="button" class="btn btn-outline-secondary " data-dismiss="modal" aria-label="Close"><i class="ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-outline-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>
