
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
     <div class="row">
      <div class="col-md-12">
        <div class="form-group country-select mb-30">
            <label>Nama Pemilik <span class="required">*</span></label>
            <select name="user_id" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
              {!! \App\Models\User::options('nama', 'id', [], 'Pilih User') !!}
            </select>
          </div>
      </div>
      <div class="col-md-6">
        <div class="form-group country-select mb-30">
          <label>Nomor Telepon <span class="required">*</span></label>
          <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group country-select mb-30">
          <label>Email <span class="required">*</span></label>
          <input type="email" name="email" class="form-control" placeholder="Email">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group country-select mb-30">
          <label>Nomor KTP <span class="required">*</span></label>
          <input type="text" name="ktp" class="form-control" placeholder="Nomor KTP">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group country-select mb-30">
          <label>Nama Toko <span class="required">*</span></label>
          <input type="text" name="name" class="form-control" placeholder="Nama Toko">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group country-select mb-30">
          <label>Alamat Toko <span class="required">*</span></label>
          <input type="text" name="alamat_toko" class="form-control" placeholder="Alamat Toko">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group country-select mb-30">
          <label>Tipe Toko <span class="required">*</span></label>
          <input type="text" name="type_usaha" class="form-control" placeholder="Tipe Toko">
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label for="">Negara <span class="required">*</span></label>
          <select name="negara" class="form-control child-new target-new dynamic-more-than-5-select custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan">
            {!! \App\Models\Master\WilayahNegara::options('negara', 'id', ['selected'], ('Pilih Wilayah Negara')) !!}
          </select>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="">Provinsi <span class="required">*</span></label>
          <select name="provinsi" class="form-control child-new target-new provinsi custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none">
            {!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', ['selected'], ('Pilih Wilayah Provinsi')) !!}
          </select>
          <div id="provinsi"></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="">Kab/Kota <span class="required">*</span></label>
          <select name="kota" class="form-control child-new target-new kota custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none">
            {!! \App\Models\Master\WilayahKota::options('kota', 'id', ['selected'], ('Pilih Wilayah Kab/Kota')) !!}
          </select>
          <div id="kota"></div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="">Kecamatan <span class="required">*</span></label>
          <select name="distrik" class="form-control child-new target-new distrik custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none">
            {!! \App\Models\Master\WilayahKecamatan::options('kecamatan', 'id', ['selected'], ('Pilih Wilayah Kecamatan')) !!}
          </select>
          <div id="distrik"></div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group country-select mb-30">
          <label>Kode POS <span class="required">*</span></label>
          <input type="text" name="kode_pos" class="form-control" placeholder="kode_pos">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group country-select mb-30">
          <label>Latitude <span class="required">*</span></label>
          <input type="text" name="lat" class="form-control" placeholder="Lat">
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group country-select mb-30">
          <label>Longitude <span class="required">*</span></label>
          <input type="text" name="lng" class="form-control" placeholder="Lng">
        </div>
      </div>

      <div class="col-md-12">
        <div class="form-group country-select mb-30">
          <label>Keterangan Usaha <span class="required">*</span></label>
          <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
        </div>
      </div>
    </div>

    <div class="form-group">
      @include('partials.file-tab.attachment-without-delete',['multi' => 'multiple'])
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
