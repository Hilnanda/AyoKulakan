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
                <h1 class="heading-title">Panduan Pelapak</h1>
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
                    <br>3.	Kalau sudah selesai daftar dan sudah verifikasi email juga kalian bisa login lagi dan pilih menu my Account kalian klik terus pilih menu pengaturan kalian pilih menu setting lapak. <br>
                    </b>
                    <br>

                    <img src="{{ asset('img/panduan/3.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>4.	Tampilan dari menu setting lapak seperti gambar dibawah ini kalian bisa pilih menu button setting lapak kaliak klik .<br>
                    <br>
                    <img src="{{ asset('img/panduan/4.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <br>5.	Setelah klik setting lapak nanti muncul form inputan untuk mengisi data diri pastikan data diri kalian sesuai dengan data anda yang benar dan foto itu bisa foto took anda.</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/5.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>6.	Setelah kalian selesai mengisi kalian bisa klik simpan nanti kalua sudah di simpan tampil seperti gambar dibawah ini.<br>

                    <br>


                    <img src="{{ asset('img/panduan/6.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>7.	Untuk jual barang kalian klik menu jual di sebalah button setting lapak nanti muncul form inputan seperti di bawah ini kalian bisa isi data barang yang akan dijual.<br>
                    <br>

                    <img src="{{ asset('img/panduan/7.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>8.	Setelah kalian isi di data barang di jual nanti tampil barang kalian seperti di bawah ini kalian bisa mengedit, menghapus dan melihat produk kalian <br>
                    <br>


                    <img src="{{ asset('img/panduan/8.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>9.	Untuk melihat produk kalian sudah tampil di barang jual kalian bisa klik menu kategori barang yang kalian tadi inputkan kategorinya seperti gambar dibawah ini.<br>
                    <br>

                    <img src="{{ asset('img/panduan/9.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>10.	Kalian setelah klik kategori barang kalian nanti muncul produk kalian seperti di gambar di bawah ini kalian bisa melihat ,membagika, chat ke penjual, dan membeli produk kalian sendiri.<br>

                    <br>

                    <img src="{{ asset('img/panduan/10.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>11.	Itu tadi panduan untuk membuat setting lapak di ayo kulakan.com selamat mencobanya.<br>

                    <br>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
