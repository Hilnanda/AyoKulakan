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
    <style type="text/css">
        .ft0{font: bold 32px 'Arial';color: #ffc000;line-height: 37px;}
        .ft1{font: bold 32px 'Arial';color: #00b050;line-height: 37px;}
        .ft2{font: bold 19px 'Arial';line-height: 22px;}
        .ft3{font: 15px 'Arial';color: #0000ee;line-height: 17px;}
        .ft4{font: 15px 'Arial';line-height: 17px;}
        .ft5{font: 15px 'Arial';margin-left: 20px;line-height: 17px;}
        .ft6{font: 15px 'Arial';line-height: 16px;}
        .ft7{font: 15px 'Arial';margin-left: 20px;line-height: 16px;}
        .ft8{font: 15px 'Arial';margin-left: 10px;line-height: 17px;}
        .ft9{font: 11px 'Arial';line-height: 14px;}
        .ft10{font: 15px 'Arial';color: #222222;line-height: 17px;}
        .ft11{font: bold 19px 'Arial';color: #222222; line-height: 22px;}
        .ft12{font: 15px 'Arial';color: #222222;background-color: #f8f9fa;line-height: 17px;}
        .ft13{font: bold 15px 'Arial';color: #0000ee;line-height: 18px;}

        .terms-conditions {
            margin-top: 120px;
            text-align: justify;
        }

        @media only screen and (max-width: 768px) {
            .terms-conditions {
                margin-top: 220px;
                padding: 0 20px 0 40px;
            }
        }

    </style>
@endsection

@section('content-frontend')
<main class="outer-top"></main>
<div class="terms-conditions-page container">
    <div class="row">
        <a href="{{ url('/') }}" style="margin-left: 35px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
        <div class="col-md-12 terms-conditions">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div id="page_1">
                        <div id="id1_1">
                            <p class="p0 ft1"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAoCAYAAAAyqOAwAAAAHUlEQVQ4jWO8+/HVfwYcgAmXxKjkqOSo5Kgk9SQBhoYEB09mOJEAAAAASUVORK5CYII=" id="p1inl_img1"><span class="ft0">Ayo</span>kulakan <img src="data:image/png;base64,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" id="p1inl_img2"></p>
                        </div>

                        <div id="id1_2">
                            <br/>
                            <p class="p0 ft2">Aturan pengguna</p>
                            <p class="p1 ft4">Kebijakan penggunaan yang dapat diterima ini adalah perjanjian antara Kami (operator situs web) dan Anda (User). Kebijakan ini menetapkan Pedoman Umum dan penggunaan situs web <a href="https://ayokulakan.com/"><span class="ft3">ayokulakan.com </span></a>yang dapat diterima dan dilarang, serta setiap produk atau layanannya (secara kolektif disebut, "situs web" atau "Layanan").</p>
                            <br/>
                            <p class="p2 ft2">Aktivitas yang dilarang dan menggunakan</p>
                            <p class="p1 ft4">Anda tidak boleh menggunakan layanan untuk mempublikasikan konten atau terlibat dalam aktivitas yang ilegal menurut hukum yang berlaku, yang berbahaya bagi orang lain, atau yang akan tunduk pada tanggung jawab kami, termasuk, tanpa batasan, sehubungan dengan salah satu hal berikut, yang <NOBR>masing-masing</NOBR> dilarang berdasarkan kebijakan ini:</p>
                            <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Mendistribusikan malware atau kode berbahaya lainnya.</span></p>
                            <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Mengungkapkan informasi pribadi yang sensitif tentang orang lain.</span></p>
                            <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Mengumpulkan, atau mencoba untuk mengumpulkan, informasi pribadi tentang pihak ketiga tanpa sepengetahuan atau persetujuan mereka.</span></p>
                            <p class="p0 ft6"><span class="ft6">●</span><span class="ft7">Menyebarkan pornografi atau konten terkait dewasa.</span></p>
                            <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Mempromosikan atau memfasilitasi prostitusi atau layanan pendamping.</span></p>
                            <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Menghosting, mendistribusikan, atau menautkan pornografi anak atau konten yang berbahaya bagi anak di bawah umur.</span></p>
                            <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Mempromosikan atau memfasilitasi perjudian, kekerasan, kegiatan teroris atau menjual senjata atau amunisi.</span></p>
                            <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Terlibat dalam distribusi melanggar hukum zat yang dikendalikan, obat selundupan atau obat resep.</span></p>
                            <p class="p3 ft6"><span class="ft6">●</span><span class="ft7">Mengelola agregator pembayaran atau fasilitator seperti memproses pembayaran atas nama bisnis lain atau badan amal.</span></p>
                            <p class="p4 ft4"><span class="ft4">●</span><span class="ft5">Memfasilitasi skema piramida atau model lain yang dimaksudkan untuk mencari pembayaran dari pelaku publik.</span></p>
                            <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Mengancam membahayakan orang atau properti atau perilaku melecehkan lainnya.</span></p>
                            <p class="p0 ft4"><span class="ft4">●</span><span class="ft5">Melanggar kekayaan intelektual atau hak kepemilikan lainnya dari pihak lain.</span></p>
                            <p class="p3 ft4"><span class="ft4">●</span><span class="ft5">Memfasilitasi, membantu, atau mendorong salah satu kegiatan di atas melalui layanan kami.</span></p>
                            <br/>
                            <p class="p5 ft2">Penyalahgunaan sistem</p>
                            <p class="p1 ft4">Setiap pengguna yang melanggar keamanan Layanan kami tunduk pada tanggung jawab pidana dan perdata, serta penghentian akun segera. Contohnya termasuk, namun tidak terbatas pada hal berikut:</p>
                            <p class="p0 ft4"><span class="ft4">●</span><span class="ft8">Penggunaan atau distribusi alat yang dirancang untuk mengorbankan keamanan Layanan.</span></p>
                            <p class="p0 ft4"><span class="ft4">●</span><span class="ft8">Sengaja atau lalai mentransmisikan file yang berisi virus komputer atau data yang rusak.</span></p>
                            <p class="p7 ft4"><span class="ft4">●</span><span class="ft8">Mengakses jaringan lain tanpa izin, termasuk untuk menyelidiki atau memindai kerentanan atau pelanggaran keamanan atau tindakan otentikasi.</span></p>
                            <p class="p8 ft4"><span class="ft4">●</span><span class="ft8">Pemindaian yang tidak sah atau pemantauan data pada jaringan atau sistem tanpa otorisasi yang tepat dari pemilik sistem atau jaringan.</span></p>
                            <br/>
                            <p class="p2 ft2">Sumber daya Layanan</p>
                            <p class="p1 ft4">Anda tidak boleh mengonsumsi layanan secara berlebihan atau menggunakan layanan dengan cara apa pun yang menghasilkan masalah kinerja atau yang mengganggu Layanan bagi pengguna lain. Kegiatan yang dilarang yang berkontribusi terhadap penggunaan berlebihan, termasuk tanpa batasan:</p>
                            <p class="p8 ft4"><span class="ft4">●</span><span class="ft8">Upaya yang disengaja untuk membebani layanan dan serangan siaran (yaitu penolakan serangan layanan).</span></p>
                            <p class="p0 ft4"><span class="ft4">●</span><span class="ft8">Terlibat dalam kegiatan lain yang menurunkan kegunaan dan kinerja layanan kami.</span></p>
                            <br/>
                            <p class="p9 ft2">Tidak ada kebijakan spam</p>
                            <p class="p1 ft6">Anda tidak boleh menggunakan layanan kami untuk mengirim spam atau pesan yang tidak diminta massal. Kami mempertahankan kebijakan nol toleransi untuk penggunaan Layanan kami dengan cara apa pun yang terkait dengan transmisi, distribusi, atau pengiriman email massal, termasuk massal yang tidak diminta atau <NOBR>e-mail</NOBR> komersial yang tidak diminta, atau pengiriman, bantuan, atau commissioning transmisi email komersial yang tidak sesuai dengan <NOBR>Undang-Undang</NOBR> yang berlaku.</p>
                            <p class="p10 ft4">Produk atau layanan Anda yang diiklankan melalui SPAM (yaitu Spamvertised) tidak dapat digunakan bersamaan dengan layanan kami. Ketentuan ini mencakup, namun tidak terbatas pada, SPAM dikirim melalui Faks, telepon, Surat pos, email, pesan instan, atau newsgroup.</p>
                            <br/>
                            <p class="p9 ft2">Pencemaran nama baik dan konten yang tidak pantas</p>
                            <p class="p11 ft4">Kami menghargai kebebasan berekspresi dan mendorong pengguna untuk menghormati konten yang mereka posting. Kami bukan penerbit konten pengguna dan tidak berada dalam posisi untuk menyelidiki kebenaran klaim pencemaran nama baik individu atau untuk menentukan apakah materi tertentu, yang dapat kita temukan tidak pantas, harus disensor. Namun, kami berhak untuk memoderasi, menonaktifkan, atau menghapus konten apa pun untuk mencegah bahaya bagi orang lain atau kepada kami atau layanan kami, sebagaimana ditentukan dalam kebijakan kami sendiri.</p>
                            <br/>
                            <p class="p9 ft2">Konten berhak cipta</p>
                            <p class="p1 ft4">Materi yang dilindungi hak cipta tidak boleh dipublikasikan melalui layanan kami tanpa izin eksplisit dari pemilik hak cipta atau orang yang secara eksplisit berwenang untuk memberikan izin tersebut oleh pemilik hak cipta. Setelah menerima klaim atas pelanggaran hak cipta, atau</p>
                            <p class="p12 ft9"></p>
                            <p class="p13 ft4">pemberitahuan pelanggaran tersebut, kami akan segera menjalankan investigasi penuh dan, setelah konfirmasi, akan segera menghapus materi yang melanggar dari layanan. Kami dapat menghentikan layanan pengguna dengan pelanggaran hak cipta berulang. Prosedur lebih lanjut dapat dilakukan jika diperlukan. Kami tidak akan bertanggung jawab kepada pengguna layanan untuk menghapus materi tersebut.</p>
                            <p class="p14 ft10">Jika Anda yakin bahwa hak cipta Anda dilanggar oleh seseorang atau beberapa orang yang menggunakan Layanan kami, silakan kirim laporan pelanggaran hak cipta ke detail kontak yang tercantum di bagian akhir Kebijakan ini.</p>
                            <p class="p15 ft11">Keamanan</p>
                            <p class="p16 ft10">Anda bertanggung jawab penuh untuk menjaga keamanan yang masuk akal untuk akun Anda. Anda bertanggung jawab untuk melindungi dan memperbarui akun login apa pun yang <span class="ft12">diberikan kepada Anda untuk Layanan kami.</span></p>
                            <p class="p17 ft11">Pelaksanaan</p>
                            <p class="p1 ft10">Kami berhak untuk menjadi penengah tunggal dalam menentukan keseriusan setiap pelanggaran dan untuk segera mengambil tindakan korektif, termasuk tetapi tidak terbatas pada:</p>
                            <p class="p18 ft4"><span class="ft4">●</span><span class="ft8">Menonaktifkan atau menghapus konten apa pun yang dilarang oleh kebijakan ini, termasuk untuk mencegah bahaya bagi orang lain atau kepada kami atau layanan kami, sebagaimana ditentukan oleh kami berdasarkan pertimbangan kami sendiri.</span></p>
                            <p class="p7 ft4"><span class="ft4">●</span><span class="ft8">Melaporkan pelanggaran penegakan hukum sebagaimana ditentukan oleh kami berdasarkan pertimbangan kami sendiri.</span></p>
                            <p class="p19 ft4"><span class="ft4">●</span><span class="ft8">Kegagalan untuk menanggapi email dari tim penyalahgunaan kami dalam waktu 2 hari, atau sebagaimana dinyatakan dalam komunikasi kepada Anda, dapat mengakibatkan penangguhan atau penghentian layanan Anda.</span></p>
                            <p class="p20 ft4">Ditangguhkan dan diakhiri akun pengguna karena pelanggaran tidak akan diaktifkan kembali. Tidak ada yang terkandung dalam kebijakan ini yang akan ditafsirkan untuk membatasi tindakan atau upaya hukum kami dengan cara apa pun sehubungan dengan aktivitas yang dilarang. Selain itu, kami selalu mencadangkan semua hak dan upaya hukum yang tersedia bagi kami sehubungan dengan kegiatan yang dilakukan oleh <NOBR>undang-undangan</NOBR> atau ekuitas.</p>
                            <br/>
                            <p class="p9 ft2">Melaporkan pelanggaran</p>
                            <p class="p21 ft4">Jika Anda telah menemukan dan ingin melaporkan pelanggaran kebijakan ini, silahkan hubungi kami segera. Kami akan menyelidiki situasi dan memberi Anda bantuan penuh.</p>
                            <br/>
                            <p class="p2 ft2">Perubahan dan Amandemen</p>
                            <p class="p22 ft4">Kami berhak untuk mengubah kebijakan ini atau persyaratannya yang berkaitan dengan situs</p>
                            <p class="p23 ft9"></p>
                            <p class="p13 ft4">web atau layanan setiap saat, efektif setelah memposting versi terbaru kebijakan ini di situs web. Ketika kami melakukannya, kami akan mengirimkan email untuk memberitahu Anda. Terus menggunakan website setelah perubahan tersebut akan merupakan persetujuan Anda terhadap perubahan tersebut.</p>
                            <br/>
                            <p class="p2 ft2">Penerimaan kebijakan ini</p>
                            <p class="p1 ft4">Anda mengakui bahwa Anda telah membaca kebijakan ini dan menyetujui semua syarat dan ketentuannya. Dengan menggunakan situs web atau layanannya, Anda setuju untuk terikat dengan kebijakan ini. Jika Anda tidak setuju untuk mematuhi ketentuan kebijakan ini, Anda tidak berwenang untuk menggunakan atau mengakses situs web dan layanannya.</p>
                            <br/>
                            <p class="p9 ft2">Menghubungi kami</p>
                            <p class="p24 ft4">Jika Anda ingin menghubungi kami untuk memahami lebih lanjut tentang kebijakan ini atau ingin menghubungi kami mengenai masalah apapun yang berkaitan dengan hal itu, Anda dapat mengirim email ke <span class="ft3">Ayokulakan01@gmail.com</span><span class="ft10">.</span></p>
                            <p class="p25 ft4">Dokumen ini terakhir diperbarui pada tanggal 6 Mei 2020.</p>
                            <p class="p15 ft13"><a href="https://ayokulakan.com/">https://ayokulakan.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
