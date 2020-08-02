@extends('layouts.scaffold')

@section('styles')
<meta name="asset-url" content="{{ config('app.url') }}">
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">
<style>
    .outline-top {
        margin-top: 200px;
    }

    @media (max-width: 500px) {
        .outline-top {
            margin-top: 299px;
        }
    }
</style>
@endsection

@section('scripts')
{{-- <script src="{{ asset('js/vueapp.js') }}" defer></script> --}}
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script>
    $(document).ready(function() {
        checkReturnDate('#tripType');
        $('#tripType').click(function(){
            checkReturnDate(this);
        });

        $('.bots-date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });

    function checkReturnDate(id) {
        if($(id).prop('checked') == true){
            $('#returnDate').val('').removeAttr('disabled');
        }
        else if($(id).prop('checked') == false){
            $('#returnDate').val('').attr('disabled', 'disabled');
        }
    }
</script>
@endsection

@section('content-frontend')
{{-- <div id="vueapp">
    <airline-component></airline-component>
</div> --}}

<form action="{{ url('airline/schedule') }}" method="GET">

    <div class="container outline-top">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                                <input id="tripType" type="checkbox" name="tripType" value="RoundTrip"> Pulang Pergi
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Dari</label>
                            <select name="origin" class="form-control selectpicker" required="" data-live-search="true"
                                data-dropup-auto="false" data-size="10">
                                @foreach ($cities as $city)
                                <option value="{{ $city->airport_code }}">
                                    {{ $city->country_name . ', ' . $city->location_name . ' - ' . $city->airport_name . ' ( ' . $city->airport_code . ' )' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ke</label>
                            <select name="destination" class="form-control selectpicker" required=""
                                data-live-search="true" data-dropup-auto="false" data-size="10">
                                @foreach ($cities as $city)
                                <option value="{{ $city->airport_code }}">
                                    {{ $city->country_name . ', ' . $city->location_name . ' - ' . $city->airport_name . ' ( ' . $city->airport_code . ' )' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kelas Kabin</label>
                            <select name="cabinClass" class="form-control selectpicker" required=""
                                data-live-search="true" data-dropup-auto="false" data-size="10">
                                <option value="ECONOMY">Economy</option>
                                <option value="BUSSINES">Bussines</option>
                                <option value="FIRST">First</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Berangkat</label>
                            <input type="text" name="departDate" class="form-control bots-date"
                                placeholder="Tanggal Keberangkatan">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Pulang</label>
                            <input type="text" name="returnDate" class="form-control bots-date" id="returnDate"
                                placeholder="Tanggal Kepulangan">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Dewasa(12+)</label>
                            <input type="number" min="1" name="paxAdult" class="form-control" value="1">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Anak (&#60;12thn)</label>
                            <input type="number" min="0" name="paxChild" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Bayi(&#60;2thn)</label>
                            <input type="number" min="0" name="paxInfant" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-8">
                        <button type="submit" class="btn btn-primary btn-block">Lihat Jadwal Penerbangan</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection
