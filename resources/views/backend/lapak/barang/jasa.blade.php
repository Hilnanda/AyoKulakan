<head>
	<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-lite.css') }}">
</head>
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.'store-jasa') }}" method="POST" class="was-validated needs-validation"  novalidate>
			{!! csrf_field() !!}
			<input type="hidden" name="id_trans_lapak" value="{{ $id_lapak }}">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4" style="display: none">
							<div class="form-group">
								<label for="">Kategori</label>
								<input type="hidden" name="id_kategori" value="14">
								{{-- <select name="id_kategori" class="form-control child target dynamic-more-than-5-select selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_sub_kategori,id_child_kategori">
									{!! \App\Models\Master\KategoriBarang::options('kat_nama', 'id', [], ('Pilih Kategori')) !!}
								</select>					 --}}
							</div>		
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Pilih Jenis Jasa</label>
								<select name="id_sub_kategori" id="" class="form-control child target id_child_kategori selectpicker">
									<option value="">Jenis Jasa</option>
									@foreach($sub as $item)
									<option value="{{ $item->id }}">{{ $item->sub_nama }}</option>
									@endforeach
								</select>
								{{-- <select class="form-control child target id_sub_kategori selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
								</select>	
								<div id="id_sub_kategori">
									
								</div>					 --}}
							</div>		
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Nama Jasa</label>
								<input type="text" name="nama_barang" class="form-control" placeholder="Nama Jasa" required="">
								{{-- <label for="">Nama Child Kategori</label>
								<select class="form-control child target id_child_kategori selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
								</select>	
								<div id="id_child_kategori">
									
								</div>	 --}}
								
							</div>		
						</div>
					</div>
					<div class="form-group">
						{{-- <label for="">Nama Jasa</label>
						<input type="text" name="nama_barang" class="form-control" placeholder="Nama Jasa" required=""> --}}
						
					</div>	
					<div class="form-group">
						<label for="">Deskripsi Jasa</label>
						<textarea name="deskripsi_barang" class="form-control summernote" rows="2" placeholder="Deskripsi Jasa" required=""></textarea>
						
					</div>
					{{-- <div class="row">
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
								<label for="">Berat Barang</label>
								<div class="input-group mb-3">
								  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="">
								  <div class="input-group-append">
								    <span class="input-group-text" id="basic-addon2">Gram</span>
								  </div>
								</div>					
							</div>
						</div>
					</div> --}}
						
					{{-- <div class="row">
						<div class="col-md-6">		
							<div class="form-group">
								<label for="">Jumlah Barang</label>
								<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required="">			
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Kondisi Barang</label>
								 <div class="custom-control custom-radio">
								    <input type="radio" class="custom-control-input" id="customControlValidation2" name="kondisi_barang" required value="Baru">
								    <label class="custom-control-label" for="customControlValidation2">Baru</label>
								  </div>
								  <div class="custom-control custom-radio mb-3">
								    <input type="radio" class="custom-control-input" id="customControlValidation3" name="kondisi_barang" required value="Bekas">
								    <label class="custom-control-label" for="customControlValidation3">Bekas</label>
								  </div>
							</div>	
						</div>
					</div> --}}
					{{-- <div class="row">
						<div class="col-md-6">	
							<div class="form-group">
								<label for="">Harga Jual Barang</label>
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="basic-addon3">Rp. </span>
								  </div>
								  <input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_barang" placeholder="Harga Jual Barang" required="" value="0">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Merek Barang</label>
								<input type="text" name="merek" class="form-control" placeholder="Merek Barang" required="">
							</div>	
						</div>	
					</div> --}}
					<div class="row">
						{{-- <div class="col-md-6">
							<div class="form-group">
								<label for="">Expired</label>
								<input type="text" name="expired" class="form-control" placeholder="Expired" required="">
							</div>
						</div> --}}
						<div class="col-md-6">
							<div class="form-group">
								@include('partials.file-tab.attachment',['multi' => 'multiple'])
							</div>	
						</div>
					</div>
				</div>
			</div>
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
