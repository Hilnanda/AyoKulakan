
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="alert alert-success" role="alert">
				<h4 class="alert-heading">Data User !</h4>
				<div class="row">
					<div class="col-md-6">
		                <div class="footer-menu">
							<ul>
							  <li><a>Nama : {{ $record->user->nama or '' }}</a></li>
							  <li><a>Email : {{ $record->user->email or '' }}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
		                <div class="footer-menu">
							<ul>
							  <li><a>Tlp : {{ $record->user->phone or '' }}</a></li>
							  <li><a>Alamat : {{ $record->user->alamat or '' }}</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="">NIK</label>
						<input type="text" name="nik" class="form-control" placeholder="NIK" required="" value="{{ $record->nik or '' }}">
					</div>	
				</div>	
				<div class="col-md-4">
					<div class="form-group country-select mb-30">
						<label>Kendaraan Yang Dimiliki <span class="required">*</span></label>
						<div class="custom-control custom-radio">
							<input type="radio" name="kendaraan" class="custom-control-input" id="customCheck1" value="1" {{ ($record->kendaraan == 1) ? 'checked' : '' }}>
							<label class="custom-control-label" for="customCheck1">Motor</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" name="kendaraan" class="custom-control-input" id="customCheck2" value="2" {{ ($record->kendaraan == 2) ? 'checked' : '' }}>
							<label class="custom-control-label" for="customCheck2">Mobil</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" name="kendaraan" class="custom-control-input" id="customCheck3" value="3" {{ ($record->kendaraan == 3) ? 'checked' : '' }}>
							<label class="custom-control-label" for="customCheck3">Mobil & Motor</label>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group country-select mb-30">
						<label>SIM Yang Dimiliki <span class="required">*</span></label>
						<div class="custom-control custom-radio">
							<input type="radio" name="sim" class="custom-control-input" id="customCheck4" value="1" {{ ($record->sim == 1) ? 'checked' : '' }}>
							<label class="custom-control-label" for="customCheck4">SIM A</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" name="sim" class="custom-control-input" id="customCheck5" value="3" {{ ($record->sim == 2) ? 'checked' : '' }}>
							<label class="custom-control-label" for="customCheck5">SIM C</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" name="sim" class="custom-control-input" id="customCheck6" value="6" {{ ($record->sim == 3) ? 'checked' : '' }}>
							<label class="custom-control-label" for="customCheck6">SIM A & C</label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group country-select mb-30">
						<label>Harga /KM <span class="required">*</span></label>
						<input type="number" min="0" name="km" class="form-control" placeholder="Harga /KM" value="{{ $record->km or '' }}">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group country-select mb-30">
						<label>Harga /KG <span class="required">*</span></label>
						<input type="number" min="0" name="kg" class="form-control" placeholder="Harga /KG" value="{{ $record->kg or '' }}">
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						@include('partials.file-tab.attachment-without-delete',['multi' => 'multiple'])
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
