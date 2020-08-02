@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty']
    , };

</script>
@endsection

@section('css')
<style>
    .outer-top {
        margin-top: 188px;
    }

    @media only screen and (max-width: 768px) {
        .outer-top {
            margin-top: 387px;
        }
    }

</style>
@endsection

@section('content-frontend')
<div class="body-content">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div id="GoogleMap" style="width:100%;height:500px"></div>
</div>
@endsection

@section('scripts')
<script>
    navigator.geolocation.getCurrentPosition(position => {
        localCoord = position.coords;
        window.apiUrl = `/api/cari-lokasi-terdekat?lat=${localCoord.latitude}&lng=${localCoord.longitude}&type=restaurant`;
        window.mapIcon = "{{ asset('img/rsz_loggo.png') }}";
    });
</script>
<script src="{{ asset('js/maps-init.js') }}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY&callback=initMap"></script>
@endsection
