@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
formRules = {
    judul: ['empty'],
};
</script>
@endsection

@section('content-frontend') 
<div class="terms-conditions-page">
  <div class="row">
    <div class="col-md-12 terms-conditions">
      <h2 class="heading-title">Bergabung Menjadi Kurir Ayokulakan</h2>
      <div class="alert alert-danger" role="alert">
        <p>Silahkan lakukan pendaftaran dengan menyertai file upload sebagai berikut :.</p>
        <p>
          1. Foto Kendaraan<br>
          2. Foto KTP<br>
          3. Foto SIM<br>
          4. Foto PKB<br>
          5. Foto SKCK<br>
        </p>
        <p>Agar pendaftar dapat ditindaklanjuti oleh ayokulakan, silakan lengkapi pemberkasan.</p>
        <hr>
        <p class="mb-0">Salam Hangat Ayokulakan.com</p>
      </div>
      <div class="content-ayokulakan">
      <form id="dataFormPage" action="{{ url($pageUrl.'store') }}" method="POST">
        {!! csrf_field() !!}
        <div class="row">

          <div class="col-lg-12 col-md-12">
            <div class="checkbox-form">
              <h3>Data Kurir</h3>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group country-select mb-30">
                    <label>NIK <span class="required">*</span></label>
                    <input type="numeric" name="nik" class="form-control" placeholder="NIK" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group country-select mb-30">
                    <label>Kendaraan Yang Dimiliki <span class="required">*</span></label>
                    <div class="custom-control custom-radio">
                      <input type="radio" name="kendaraan" class="custom-control-input" id="customCheck1" value="1">
                      <label class="custom-control-label" for="customCheck1">Motor</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" name="kendaraan" class="custom-control-input" id="customCheck2" value="2">
                      <label class="custom-control-label" for="customCheck2">Mobil</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" name="kendaraan" class="custom-control-input" id="customCheck3" value="3">
                      <label class="custom-control-label" for="customCheck3">Mobil & Motor</label>
                    </div>

                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group country-select mb-30">
                    <label>SIM Yang Dimiliki <span class="required">*</span></label>
                    <div class="custom-control custom-radio">
                      <input type="radio" name="sim" class="custom-control-input" id="customCheck4" value="1">
                      <label class="custom-control-label" for="customCheck4">SIM A</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" name="sim" class="custom-control-input" id="customCheck5" value="3">
                      <label class="custom-control-label" for="customCheck5">SIM C</label>
                    </div>
                    <div class="custom-control custom-radio">
                      <input type="radio" name="sim" class="custom-control-input" id="customCheck6" value="6">
                      <label class="custom-control-label" for="customCheck6">SIM A & C</label>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group country-select mb-30">
                    <label>Harga /KM <span class="required">*</span></label>
                    <input type="number" min="0" name="km" class="form-control" placeholder="Harga /KM">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group country-select mb-30">
                    <label>Harga /KG <span class="required">*</span></label>
                    <input type="number" min="0" name="kg" class="form-control" placeholder="Harga /KG">
                  </div>
                </div>
              </div>
              <div class="form-group">
                @include('partials.file-tab.attachment',['multi' => 'multiple','foto' => 'Unggah Dokumen Foto Kendaraan, KTP, SIM, PKB, SKCK.'])
              </div>
            </div>
          </div>
        </div>
        <div class="order-button-payment">
          <button type="button" class="btn btn-success save-page save-ayokulakan btn-lg btn-block" data-title="Bergabung Dengan Kurir Ayokulakan?" data-confirm="Bergabung" data-batal="Batal">Bergabung</button>
        </div>
      </form>
    </div>
  </div>          
</div>
</div>   
@endsection