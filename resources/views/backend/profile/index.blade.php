@extends('layouts.grid')

@section('js-filters')
d.nama = $("input[name='filter[nama]']").val();
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

<div class="content-ayokulakan">

	<form id="dataFormPage" action="{{ url($pageUrl.$record->id) }}" method="POST" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<input type="hidden" name="_method" value="PUT">
		<input type="hidden" name="id" value="{{ $record->id or ''}}">
		<div class="detail-block">
			<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
				<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder" style="text-align: left">
					<div class="product-item-holder size-big single-product-gallery small-gallery">
						<div id="owl-single-product" style="opacity: 1; display: block;" class="owl-carousel owl-theme">
							<div class="owl-wrapper-outer">
								<div class="owl-wrapper" style="width: 4608px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);">
									<div class="owl-item" style="width: 256px;">
										<div class="single-product-gallery-item" id="slide1">
											<a data-lightbox="image-1" data-title="Gallery" href="{{ ($record->pictureusers->sortByDesc('created_at')->first()) ? url('storage/'.$record->pictureusers->sortByDesc('created_at')->first()->url) : asset('img/users.png') }}">
												<center><img class="img-responsive" alt="" src="{{ ($record->pictureusers->sortByDesc('created_at')->first()) ? url('storage/'.$record->pictureusers->sortByDesc('created_at')->first()->url) : asset('img/users.png') }}"></center>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-7 product-info-block">
					<div class="product-info" style="text-align: left;">
						<div class="form-group">
							<label for="">Wilayah Negara</label>
							<select name="id_negara" class="form-control child-new target-new dynamic-more-than-5-select custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan">
								{!! \App\Models\Master\WilayahNegara::options('negara', 'id', ['selected' => $record->id_negara], ('Pilih Wilayah Negara')) !!}
							</select>
						</div>
						<div class="form-group">
							<label for="">Wilayah Provinsi</label>
							<select class="form-control child-new target-new dynamic-more-than-5-select id_provinsi custom-select" required="" data-dropup-auto="false" data-size="10" data-arraynama="id_kota,id_kecamatan" data-style="none" name="id_provinsi">
								{!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', ['selected' => $record->id_provinsi,'filters' => ['id_negara' => $record->id_negara]], ('Pilih Wilayah Provinsi')) !!}
							</select>
							<div id="id_provinsi">

							</div>
						</div>
						<div class="form-group">
							<label for="">Wilayah Kab/Kota</label>
							<select class="form-control child-new target-new dynamic-more-than-5-select id_kota custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kota" data-arraynama="id_kecamatan">
								{!! \App\Models\Master\WilayahKota::options('kota', 'id', ['selected' => $record->id_kota,'filters' => ['id_provinsi' => $record->id_provinsi]], ('Pilih Wilayah Kab/Kota')) !!}
							</select>
							<div id="id_kota">

							</div>
						</div>
						<div class="form-group">
							<label for="">Wilayah Kecamatan</label>
							<select class="form-control child-new target-new id_kecamatan custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kecamatan">
								{!! \App\Models\Master\WilayahKecamatan::options('kecamatan', 'id', ['selected' => $record->id_kecamatan,'filters' => ['id_kota' => $record->id_kota]], ('Pilih Wilayah Kecamatan')) !!}
							</select>
							<div id="id_kecamatan">

							</div>
						</div>
						<div class="form-group">
							<label for="">Kode Pos</label>
							<input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" required="" value="{{ $record->kode_pos or '' }}">

						</div>
						<div class="form-group">
							<label for="">Nama</label>
							<input type="text" name="nama" class="form-control" placeholder="Nama" required="" value="{{ $record->nama or '' }}">
						</div>
						<div class="form-group">
							<label for="">Jenis Kelamin</label>
							<select name="gender" class="form-control" placeholder="Jenis Kelamin" required>
								<option value="">- Pilih Jenis Kelamin -</option>
								<option value="Laki - Laki" {{ ($record->gender == 'Laki - Laki') ? 'selected' : '' }}>Laki - Laki</option>
								<option value="Perempuan" {{ ($record->gender == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">No Telp / HP </label>
							<input type="text" name="hp" class="form-control" placeholder="No Telp / HP" required="" value="{{ $record->hp or '' }}" minlength="12" maxlength="13" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
						</div>
						<div class="form-group">
							<label for="">Alamat</label>
							<textarea class="form-control" name="alamat" rows="1">{{ $record->alamat or '' }}</textarea>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								@include('partials.file-tab.foto-users',['label' => 'Lampiran Foto','shows' => false])
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div style="width: 100%; height: 20px; border-bottom: 1px solid black; margin-bottom: 20px; text-align: center">
						<span style="font-size: 22px; background-color: #FFFFFF; padding: 0 10px;">
							Setting Akun Anda
						</span>
					</div>

					<div class="col-md-6" style="text-align: left">
						<div class="form-group">
							<label for="">Username</label>
							<input type="text" name="username" class="form-control" placeholder="Username" required=""  value="{{ $record->username or '' }}">
						</div>
					</div>
					<div class="col-md-6" style="text-align: left">
						<div class="form-group">
							<label for="">Email </label>
							<input type="email" name="email" class="form-control" placeholder="Email" required="" value="{{ $record->email or '' }}">
						</div>
					</div>
					<div class="col-md-6" style="text-align: left">
						<div class="form-group">
							<label for="">Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
					</div>
					<div class="col-md-6" style="text-align: left">
						<div class="form-group">
							<label for="">Confirm Password</label>
							<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body pull-right">
					<button type="button" class="btn btn-success save-page save-ayokulakan pull-right"><i class="ion-ios-paper"></i> Simpan</button>
				</div>
			</div>
		</div>
	</form>
</div>


@endsection
