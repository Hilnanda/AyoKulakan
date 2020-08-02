@extends('layouts.grid')

@section('js-filters')
d.nama = $("input[name='filter[nama]']").val();
@endsection

@section('scripts')
@include('backend.lapak.script.index')
@endsection

@section('rules')
<script type="text/javascript">
formRules = {
	judul: ['empty'],
};
</script>
@endsection
@section('filters')

@endsection
@section('toolbars')

@endsection
@section('subcontent')
<div class="shop-banner">
	<div class="row">
		<div class="card">
			<div class="card-body">
				<div class="content-ayokulakan">
					@if($recordKurir)
					<form id="dataFormPage" action="{{ url($pageUrl.$recordKurir->id) }}" method="POST">
						{!! csrf_field() !!}
						<input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="id" value="{{ $recordKurir->id or ''}}">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xs-12">
								<div class="banner_h2__left_image">
									@if($recordKurir->attachments->count() > 0)
									<center><img src="{{ ($recordKurir->attachments->sortByDesc('created_at')->first()) ? url('storage/'.$recordKurir->attachments->sortByDesc('created_at')->first()->url) : asset('img/users.png') }}" style=""></center>
									@else
									<center><img src="{{ asset('img/no-images.png') }}" style=""></center>
									@endif
								</div>
							</div>
							<div class="col-md-12 col-lg-12 col-xs-12">
								<div class="banner_h2_Right_text">	
									<div class="wpb_wrapper">
										<h3>PARTNER Kurir.</h3>
									</div>
								</div>
								<div class="form-group country-select mb-30">
									<label>NIK <span class="required">*</span></label>
									<input type="numeric" name="nik" class="form-control" placeholder="NIK" value="{{ $recordKurir->nik or '' }}">
								</div>
								<div class="form-group country-select mb-30">
									<label>Kendaraan Yang Dimiliki <span class="required">*</span></label>
									<div class="custom-control custom-radio">
										<input type="radio" name="kendaraan" class="custom-control-input" id="customCheck1" value="1" {{ ($recordKurir->kendaraan == 1) ? 'checked' : '' }}>
										<label class="custom-control-label" for="customCheck1">Motor</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" name="kendaraan" class="custom-control-input" id="customCheck2" value="2" {{ ($recordKurir->kendaraan == 2) ? 'checked' : '' }}>
										<label class="custom-control-label" for="customCheck2">Mobil</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" name="kendaraan" class="custom-control-input" id="customCheck3" value="3" {{ ($recordKurir->kendaraan == 3) ? 'checked' : '' }}>
										<label class="custom-control-label" for="customCheck3">Mobil & Motor</label>
									</div>

								</div>
								<div class="form-group country-select mb-30">
									<label>SIM Yang Dimiliki <span class="required">*</span></label>
									<div class="custom-control custom-radio">
										<input type="radio" name="sim" class="custom-control-input" id="customCheck4" value="1" {{ ($recordKurir->sim == 1) ? 'checked' : '' }}>
										<label class="custom-control-label" for="customCheck4">SIM A</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" name="sim" class="custom-control-input" id="customCheck5" value="3" {{ ($recordKurir->sim == 3) ? 'checked' : '' }}>
										<label class="custom-control-label" for="customCheck5">SIM C</label>
									</div>
									<div class="custom-control custom-radio">
										<input type="radio" name="sim" class="custom-control-input" id="customCheck6" value="6" {{ ($recordKurir->sim == 6) ? 'checked' : '' }}>
										<label class="custom-control-label" for="customCheck6">SIM A & C</label>
									</div>
								</div>
								<div class="form-group country-select mb-30">
									<label>Harga /KM <span class="required">*</span></label>
									<input type="number" min="0" name="km" class="form-control" placeholder="Harga /KM" value="{{ $recordKurir->km or '' }}">
								</div>
								<div class="form-group country-select mb-30">
									<label>Harga /KG <span class="required">*</span></label>
									<input type="number" min="0" name="kg" class="form-control" placeholder="Harga /KG" value="{{ $recordKurir->kg or '' }}">
								</div>

								<div class="form-group">
									@include('partials.file-tab.attachment',['multi' => 'multiple'])
								</div>
								<div class="card">
									<div class="card-body pull-right">
										<button type="button" class="btn btn-outline-success save-page save-ayokulakan pull-right"><i class="ion-ios-paper"></i> Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
