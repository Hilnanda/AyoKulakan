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

@section('css')
<style>
    .content {
        padding: 0 40px 40px 60px;
    }

    @media (max-width: 500px) {
        .outer-top {
            margin-top: 280px;
        }
    }
</style>
@endsection

@section('content-frontend')
<main class="outer-top"></main>
<div class="terms-conditions-page container">
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <div class="content">
                <h1 class="heading-title">Panduan Haji & Umroh</h1>
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
                    <br>3. Kalau sudah selesai daftar dan sudah verifikasi email juga kalian bisa login lagi dan Pilih menu haji dan umroh pilih menu daftar haji dan umroh seperti di bawah ini gambarnya .<br>
                    </b>
                    <br>
                    <img src="{{ asset('img/panduan/c1.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>4. Tampilan daftar haji umroh seperti di bawah ini ..<br>
                    <br>
                    <img src="{{ asset('img/panduan/c2.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c3.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <br>5. Kalian isikan form pendaftaran dan jangan lupa pilih paketnya juga datanya harus lengka dan klik simpan.</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c4.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>6. Kalau mau lihat Riwayat haji kalian pilih menu my account – Pengaturan – Haji dan Umroh – Riwayat haji.</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c5.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <br>7.  Tampilan dari Riwayat haji dan Umroh di bawah ini</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c6.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>8. Selamat mencoba<br>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
