@extends('layouts.scaffold')

@section('content-frontend')
<div class="terms-conditions-page">
  <div class="container">
    <div class="row" >
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Bergabung Menjadi Partner Ayokulakan</h2>
        <div class="alert alert-success" role="alert">
          <p>Silahkan lakukan pendaftaran dengan menyertai file upload sebagai berikut :.</p>
          <p>
            1. Foto Usaha<br>
            2. Foto KTP<br>
            2. SWA Foto<br>
          </p>
          <p>Agar pendaftar dapat ditindaklanjuti oleh ayokulakan, silakan lengkapi pemberkasan.</p>
          <b><p class="mb-0 pull-right">Salam Hangat Ayokulakan.com</p></b>
          <hr>
        </div>

        <div class="content-ayokulakan panel">
          <div class="panel panel-default">
            <div class="panel-body">
              <form id="dataFormPage" action="{{ url($pageUrl.'store') }}" method="POST">
                {!! csrf_field() !!}
                <div class="row">
                  <div class="col-lg-12 col-md-12">
                    <div class="checkbox-form">
                      <h3>Data Pemilik</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Nama Lengkap</label>
                            <p class="form-control-static">{{ auth()->user()->nama ?? '' }}</p>
                            {{-- <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ auth()->user()->nama ?? '' }}"> --}}
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <p class="form-control-static">{{ auth()->user()->hp ?? '' }}</p>
                            <input type="hidden" name="nomor_telepon" value="{{ auth()->user()->hp ?? '' }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <p class="form-control-static">{{ auth()->user()->email ?? '' }}</p>
                            <input type="hidden" name="email" value="{{ auth()->user()->email ?? '' }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="ktp">Nomor KTP <span class="required">*</span></label>
                            <input type="text" class="form-control" name="ktp" placeholder="cth: 123456789000" value="{{ old('ktp') }}" required>
                          </div>
                        </div>
                      </div>
                      <h3>Data Kaki Lima</h3>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="name">Nama Toko <span class="required">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="cth: Es Pak Gur" required value="{{ old('name') }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="type_usaha">Jenis/Tipe Toko <span class="required">*</span></label>
                            <input type="text" class="form-control" name="type_usaha" placeholder="cth: Minuman, Makanan" required value="{{ old('type_usaha') }}">
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Wilayah Negara</label>
                            <select name="id_negara" class="form-control child-new target-new dynamic-more-than-5-select custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan">
                              {!! \App\Models\Master\WilayahNegara::options('negara', 'id', ['selected' => $record->id_negara], ('Pilih Wilayah Negara')) !!}
                            </select>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Wilayah Provinsi</label>
                            <select class="form-control child-new target-new id_provinsi custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_provinsi">
                              {!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', ['selected' => $record->id_provinsi,'filters' => ['id_negara' => $record->id_negara]], ('Pilih Wilayah Provinsi')) !!}
                            </select>
                            <div id="id_provinsi"></div>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Wilayah Kab/Kota</label>
                            <select class="form-control child-new target-new id_kota custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kota">
                              {!! \App\Models\Master\WilayahKota::options('kota', 'id', ['selected' => $record->id_kota,'filters' => ['id_provinsi' => $record->id_provinsi]], ('Pilih Wilayah Kab/Kota')) !!}
                            </select>
                            <div id="id_kota"></div>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="">Wilayah Kecamatan</label>
                            <select class="form-control child-new target-new id_kecamatan custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kecamatan">
                              {!! \App\Models\Master\WilayahKecamatan::options('kecamatan', 'id', ['selected' => $record->id_kecamatan,'filters' => ['id_kota' => $record->id_kota]], ('Pilih Wilayah Kecamatan')) !!}
                            </select>
                            <div id="id_kecamatan"></div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div id="googleMap" style="width:100%; height:380px; margin-bottom: 20px;"></div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Position Latitude <span class="required">*</span></label>
                            <input id="lat" type="text" name="lat" class="form-control" placeholder="cth: 1.565650" required value="">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Longitude <span class="required">*</span></label>
                            <input id="lng" type="text" name="lng" class="form-control" placeholder="cth: -1.565650">
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Kode Pos <span class="required">*</span></label>
                            <input type="text" name="kode_pos" class="form-control" placeholder="cth: 23445" required value="">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="alamat_toko">Alamat Toko <span class="required">*</span></label>
                            <textarea class="form-control" name="alamat_toko" placeholder="cth: Jln..." required></textarea>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group country-select mb-30">
                            <label>Keterangan Usaha <span class="required">*</span></label>
                            <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                          </div>
                        </div>
                      </div>
                      <h3>Upload Berkas</h3>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Foto Usaha</label>
                            <input name="foto_usaha" type="file" data-target="#blah" class="" />
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">Foto KTP</label>
                            <input name="foto_ktp" type="file" data-target="#blah2" class="" />
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="">SWA Foto</label>
                            <input name="swa_foto" type="file" data-target="#blah3" class="" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="order-button-payment">
                  <button type="button" class="btn btn-success save-page save-ayokulakan btn-lg btn-block" data-title="Bergabung Dengan Kami Lima Ayokulakan?" data-confirm="Bergabung" data-batal="Batal">Bergabung</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY"></script>
<script src="{{ asset('js/gmaps.js') }}"></script>
<script>
  var map = new GMaps({
      div: '#googleMap',
  });
  GMaps.geocode({
    address: $('#address').val(),
    callback: function(results, status) {
      if (status == 'OK') {
        var latlng = results[0].geometry.location;
        map.setCenter(latlng.lat(), latlng.lng());
        map.addMarker({
          lat: latlng.lat(),
          lng: latlng.lng()
        });
      }
    }
  });

  GMaps.geolocate({
      success: function(position) {
          let lat = position.coords.latitude;
          let lng = position.coords.longitude;

          $('#lat').val(lat.toFixed(5));
          $('#lng').val(lng.toFixed(5));

          map.setCenter(lat, lng);
          map.addMarker({
              lat: lat,
              lng: lng,
              draggable: true,
              dragend: function(event) {
                  var lat = event.latLng.lat();
                  var lng = event.latLng.lng();
                  $('#lat').val(lat.toFixed(5));
                  $('#lng').val(lng.toFixed(5));
              },
              infoWindow: {
                  content: '<p>Data yang ingin di tampilkan</p>'
              }
          });
      },
      error: function(error) {
          alert("Lokasi Anda Tidak Ditemukan");
      },
      not_supported: function() {
          alert("Browser Anda Tidak Support Geolokasi");
      },
      always: function(e) {

      }
  });
</script>
@endsection
