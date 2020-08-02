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
<div class="terms-conditions-page container">
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <div class="content">
                <h1 class="heading-title">Panduan Kaki Lima</h1>
                <hr>
                <p>
                1.	Pilih menu login Gambar seperti di bawah ini
                <br>
                <br>
                <img src="{{ asset('img/panduan/1.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                2.	Jika belum mempunyai akun kalian bisa klik menu daftar kalain bisa daftar melalui facebook , gmail dll. Seperti gambar di bawah ini.
                <br>
                <br>
                <img src="{{ asset('img/panduan/2.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <br>3. Kalau sudah selesai daftar dan sudah verifikasi email juga kalian bisa login lagi dan Pilih menu Kaki lima seperti gambar dibawah ini .<br>
                </b>
                <br>
                <img src="{{ asset('img/panduan/d1.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>4.  Tampilan awal menu kaki lima di bawah ini dan tekan bergabung.<br>
                <br>
                <img src="{{ asset('img/panduan/d2.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <br>5. Isikan form inputan pengisian data kaki lima kalian dengan sebenar – benarnya seperti gambar dibawah ini.</b>
                <br>
                <br>
                <img src="{{ asset('img/panduan/d3.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <img src="{{ asset('img/panduan/d4.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <img src="{{ asset('img/panduan/d5.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>6.  Tekan bergabung kaki  lima seperti di bawah ini</b>
                <br>
                <br>
                <img src="{{ asset('img/panduan/d6.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <br>7.  Kalau sudah nanti tampil gambar download kalian tekan download dan cetak kartu kaki limanya</b>
                <br>
                <br>
                <img src="{{ asset('img/panduan/d7.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>8.  Tampilan kartu kaki lima seperti di bawah ini.<br>
                <br>
                <br>
                <img src="{{ asset('img/panduan/d8.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
