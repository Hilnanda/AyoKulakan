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
                <h1 class="heading-title">Panduan Pembeli</h1>
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
                    <br>3. Kalau sudah selesai daftar dan sudah verifikasi email juga kalian bisa login lagi dan Untuk membeli produk kalian bisa pilih menu kategori barang atau menu beranda di situ tampil semua produk yang akan di beli seperti gambar di bawah ini.  .<br>
                    </b>
                    <br>

                    <img src="{{ asset('img/panduan/a.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>4.  Pilih barang yang akan di belih dan klik lihat barang untuk melihat detail dll nya seperti gambar di bawah ini .<br>
                    <br>
                    <img src="{{ asset('img/panduan/b.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <br>5. Kalau kalian ingin chat dengan penjual cukup pilih menu gambar chat kaliak klik nanti akan tampil halamanya seperti di bawah ini..</b>
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/c.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>6. Kalau kalian inging membagikan barang yang kalian beli keteman kalian cukup pilih menu Share kalian bisa mengshare ke media social kalian seperti contoh gambar dibawah ini.<br>

                    <br>

                    <img src="{{ asset('img/panduan/d.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>7.  Untuk membeli barang kaliak pilih menu masukan kerajang jika kalian ingin belaja lagi juga bisa menambahkan barang di kerajang seperti di bawah ini.<br>
                    <br>

                    <img src="{{ asset('img/panduan/e.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>8.  Kalua kalian sudah selesai memasukan barang ke kerajang kalian bisa melanjutkan ke pembayaran dan kalian cetang button putih kecil di bawah nama barang kalian terus klik lanjukan pembayaran nanti tampil seperti gambar di bawah ini.
                    <br>
                    <br>


                    <img src="{{ asset('img/panduan/f.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>9.  Tampilan Checkout kalian isi data kalian seperti data di atas kalua sudah lengkap klik bayar nanti muncul rincian pembayaran terus klik lanjut seperti gambar di bawah ini.<br>
                    <br>

                    <img src="{{ asset('img/panduan/g.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>10. Tampilan Pembayaran melalui Go pay kalian klik bayar sekarang seperti di bawah ini gambarnya.<br>

                    <br>
                    <img src="{{ asset('img/panduan/h.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>11. Setelah di klik bayar sekarang akan tampil kode Qr kalian tingal cocokan dengan saldo kalian di go pay kalua sudah kalian klik saya sudah bayar seperti gambar di bawah ini.<br>
                    <br>
                    <img src="{{ asset('img/panduan/i.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>12. Tampilan setelah di klik saya sudah bayar tampil seperti dibawah ini tampilan sukses<br>
                    <br>
                    <img src="{{ asset('img/panduan/j.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>
                    <img src="{{ asset('img/panduan/k.jpg') }}"  text-align="center" class="img-responsive">
                    <br>

                    <br>13. Tampilan detail orderan setelah di bayar akan tambil seperti di bawah ini.<br>
                    <br>
                    <img src="{{ asset('img/panduan/l.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>14. Untuk melihat barang kalian sudah di proses atau belum kalian bisa pilih menu my account pilih menu pengaturan pilih menu list order barang tampilanya menunya seperti di bawah ini.<br>
                    <br>
                    <img src="{{ asset('img/panduan/m.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>15. Tampilan list order barang tampil seperti di bawah ini kalian bisa melihat barang kalian sudah dikemas apabeluh di sini dll..<br>
                    <br>
                    <img src="{{ asset('img/panduan/n.jpg') }}"  text-align="center" class="img-responsive">
                    <br>
                    <br>16. Itu tadi panduan membeli produk ayokulakan.com selamat mencobanya <br>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
