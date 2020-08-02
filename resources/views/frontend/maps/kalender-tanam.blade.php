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
<div class="terms-conditions-page" style="height: 220px">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <div class="content-address-area">
                <center>
                    <p style="font-size: 30px; color: orange; font-weight:bold">Api Belum Tersedia</p>
                </center>
            </div>
        </div>
    </div>
</div>
@endsection