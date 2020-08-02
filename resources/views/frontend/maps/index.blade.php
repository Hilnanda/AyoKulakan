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

@section('style')

@endsection

@section('content-frontend')
<main class="outer-top"></main>
<div class="body-content">
  <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="container">
      <div class="col-md-12" style="margin: 0 50px 50px">
          <div class="detail-block">
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" id="gmaps_lokasi" placeholder="Cari Lokasi Kaki Lima dan Mesjid " name="" value="">
              </div>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary" id="gmaps_cari" style="margin-right:10px">Cari Lokasi</button>
              <button type="button" class="btn btn-success" id="gmaps_center">Lokasi Saya</button>
            </div>
            <div class="col-md-12">
              <div id="map" style="width:100%;height:500px">

              </div>
            </div>
          </div>
      </div>
    </div>
</div>

@endsection
