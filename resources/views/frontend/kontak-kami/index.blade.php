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
<main class="outer-top"></main>
<div class="contact-page">
    <a href="{{ url('/') }}" style="margin-left: 35px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="row" style="margin: 60px 0 0">
        <div class="col-md-12 contact-map outer-bottom-vs">
            <iframe src="https://maps.google.com/maps?q=Jl.%20Raya%20Kembiritan%2C%20Genteng.%20Kabupaten%20Banyuwangi-Jawa%20Timur%2068465Jl.%20Raya%20Kembiritan%2C%20Genteng.%20Kabupaten%20Banyuwangi-Jawa%20Timur%2068465&t=&z=13&ie=UTF8&iwloc=&output=embed" style="border:0" width="600" height="450"></iframe>
        </div>

        <div class="col-md-9 contact-form">
            <div class="contact-title">
                <h4><b>Deskripsi</b></h4><br>
                Jika Anda ingin menghubungi kami untuk memahami lebih lanjut tentang ayokulakan.com ini, dapat mengirim email ke ayokulakan01@gmail.com
            </div>
            {{-- <div class="col-md-12 contact-title">
                <p>{!! $record->deskripsi or '' !!}</p>
            </div> --}}
        </div>
        <br>
        <div class="col-md-3 contact-info">
            <div class="contact-title">
                <h4><b>Informasi</b></h4>
                <div class="clearfix address">
                    <span class="contact-i"><i class="fa fa-map-marker"></i></span>
                    <span class="contact-span">Genteng. Kabupaten Banyuwangi-Jawa Timur 68465</span>
                </div>
                <div class="clearfix phone-no">
                    <span class="contact-i"><i class="fa fa-mobile"></i></span>
                    <span class="contact-span">+{{ $record->phone or '' }}</span>
                </div>
                <div class="clearfix email">
                    <span class="contact-i"><i class="fa fa-envelope"></i></span>
                    <span class="contact-span"><a href="#">{{ $record->email or '' }}</a></span>
                </div>
            </div>
        </div>          </div>
    </div>
@endsection
