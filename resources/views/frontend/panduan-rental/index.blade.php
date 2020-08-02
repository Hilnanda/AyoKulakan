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
                <h1 class="heading-title">Panduan Sewa</h1>
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
                <br>3. Kalau sudah selesai daftar dan sudah verifikasi email juga kalian bisa login lagi dan Buka My Account – pengaturan – setting lapak.  .<br>
                </b>
                <br>

                <img src="{{ asset('img/panduan/a1.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>4.Halaman setting lapak .<br>
                <br>
                <img src="{{ asset('img/panduan/a2.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <br>5. Isi form inputan setting lapak - simpan.</b>
                <br>
                <br>
                <img src="{{ asset('img/panduan/a3.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>6. Daftar lapak berhasil <br>

                <br>

                <img src="{{ asset('img/panduan/a4.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>7.Tampilan awal setting lapak <br>
                <br>

                <img src="{{ asset('img/panduan/a5.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>8. Buka My Accont – pengaturan – setting sewa
                <br>
                <br>


                <img src="{{ asset('img/panduan/a6.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>9. Buka buat rental- isi form inputanya - simpan<br>
                <br>

                <img src="{{ asset('img/panduan/a7.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>10.jika form inputan sukses tersimpan <br>

                <br>
                <img src="{{ asset('img/panduan/a8.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <hi> PANDUAN PENYEWA/PERENTAL </hi>
                <br>
                <br>
                1.  Pilih menu login Gambar seperti di bawah ini
                <br>

                <br>
                <img src="{{ asset('img/panduan/1.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                2.  Jika belum mempunyai akun kalian bisa klik menu daftar kalain bisa daftar melalui facebook , gmail dll. Seperti gambar di bawah ini.
                <br>
                <br>

                <img src="{{ asset('img/panduan/2.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>
                <br>3. Beranda – Sewa – (pilih barang yang dicari) contoh : mobil – .<br>
                <br>
                <img src="{{ asset('img/panduan/a9.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>4. Halaman sewa mobil – pilih mobil yang dicari <br>
                <br>
                <img src="{{ asset('img/panduan/a10.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>5. Lihat detail <br>
                <br>
                <img src="{{ asset('img/panduan/a11.jpg') }}"  text-align="center" class="img-responsive">
                <br>

                <br>6. Masuk keranjang <br>
                <br>
                <img src="{{ asset('img/panduan/a12.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>7. Detail Orderan <br>
                <br>
                <img src="{{ asset('img/panduan/a13.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                <br>7. Lanjut pembayaran <br>

                <br>
                <img src="{{ asset('img/panduan/a14.jpg') }}"  text-align="center" class="img-responsive">
                <br>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
