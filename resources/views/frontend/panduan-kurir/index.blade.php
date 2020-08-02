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
                <h1 class="heading-title">Panduan Kurir</h1>
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
                    <br>3. Kalau sudah selesai daftar dan sudah verifikasi email juga kalian bisa login lagi dan Buka Menu YOUKUY KURIR .<br>
                    </b>
                    <br>
                    <img src="{{ asset('img/panduan/b1.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>4.Halaman awal YOUKUY KURIR .<br>
                    <br>
                    <img src="{{ asset('img/panduan/b2.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <br>5. isi biodata dengan lengkap, jika sudah lengkap klik bergabung</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/b3.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/b4.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/b5.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/b6.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/b7.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>6. jika sudah bergabung klik Download dan print id card Tampilanya Seperti gambar Di bawah ini<br>
                    <br>
                    <img src="{{ asset('img/panduan/b8.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>7. Selamat mencoba<br>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
