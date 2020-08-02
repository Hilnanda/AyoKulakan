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
    <a href="{{ url('/') }}" style="margin-left: 35px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div id="page_1">
                        <div id="id1_1">
                            <p class="p0 ft1"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAoCAYAAAAyqOAwAAAAHUlEQVQ4jWO8+/HVfwYcgAmXxKjkqOSo5Kgk9SQBhoYEB09mOJEAAAAASUVORK5CYII=" id="p1inl_img1"><span class="ft0">Ayo</span>kulakan <img src="data:image/png;base64,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" id="p1inl_img2"></p>
                        </div>

                        <div id="id1_2">
                            <br>
                            <p class="p0 ft2">Perjanjian</p>
                            <p class="p1 ft4">Perjanjian ini adalah kesepakatan antara CV. AYOKULAKAN dan Anda (User). Perjanjian ini menetapkan pedoman umum, syarat dan ketentuan penggunaan situs <a href="https://ayokulakan.com/"><span class="ft3">ayokulakan.com </span></a>dan salah satu produk atau layanannya (secara kolektif, situs web atau Layanan).</p>
                            <br>
                            <p class="p4 ft2">Representasi</p>
                            <p class="p3 ft4">Setiap pandangan atau pendapat yang diwakili di situs web bersifat pribadi dan <nobr>semata-mata</nobr> milik CV. AYOKULAKAN dan tidak mewakili orang, lembaga atau organisasi yang pemiliknya mungkin atau mungkin tidak terkait dalam kapasitas profesional atau pribadi kecuali dinyatakan secara eksplisit. Setiap pandangan atau pendapat tidak dimaksudkan untuk memfitnah agama apapun, kelompok etnis, klub, organisasi, perusahaan, atau individu.</p>
                            <br>
                            <p class="p4 ft2">Konten dan postingan</p>
                            <p class="p3 ft4">Anda tidak diperkenankan mengubah, mencetak, atau menyalin bagian apa pun dari situs web. Penyertaan bagian mana pun dari situs web ini dalam karya lain, baik dalam bentuk cetak atau elektronik atau formulir lain atau penyertaan bagian mana pun dari situs web di situs web lain dengan menyematkan, membingkai, atau lainnya tanpa izin CV. AYOKULAKAN dilarang.</p>
                            <p class="p5 ft4">Anda dapat mengirimkan komentar untuk konten yang tersedia di situs web. Dengan mengunggah atau menyediakan informasi apa pun kepada CV. AYOKULAKAN, Anda memberikan CV. AYOKULAKAN hak yang tidak terbatas dan <nobr>terus-menerus</nobr> untuk mendistribusikan, menampilkan, mempublikasikan, memperbanyak, menggunakan kembali dan menyalin informasi yang terkandung didalamnya. Anda tidak boleh meniru identitas orang lain melalui situs web. Anda tidak boleh memposting konten yang memfitnah, menipu, cabul, mengancam, invasif hak privasi orang lain atau yang melanggar hukum. Anda tidak boleh memposting konten yang melanggar hak kekayaan intelektual orang atau entitas lain. Anda tidak boleh memposting konten apa pun yang mencakup virus komputer atau kode lain yang dirancang untuk mengganggu, merusak, atau membatasi fungsi perangkat lunak atau perangkat keras komputer. Dengan mengirimkan atau memposting konten pada situs web, Anda memberikan CV. AYOKULAKAN hak untuk mengedit dan, jika perlu, menghapus setiap konten setiap saat dan untuk alasan apapun.</p>
                            <br>
                            <p class="p6 ft2">Kompensasi dan sponsor</p>
                            <p class="p3 ft4">Website ini menerima bentuk iklan, sponsor, dibayar insersi atau bentuk lain dari kompensasi. CV. AYOKULAKAN dikompensasi untuk memberikan pendapat tentang produk, Layanan,</p>
                            <p class="p7 ft6"></p>

                            <p class="p8 ft4">website dan berbagai topik lainnya. Kompensasi yang diterima dapat memengaruhi konten iklan, topik, atau postingan yang dibuat di situs web. Konten Bersponsor, ruang iklan, atau postingan akan selalu diidentifikasi seperti itu.</p>
                            <br>
                            <p class="p4 ft2">Perjanjian kebugaran dan medis</p>
                            <p class="p3 ft4">Informasi yang tersedia di website adalah untuk informasi kesehatan umum saja dan tidak dimaksudkan untuk menjadi pengganti nasihat medis profesional, diagnosis atau pengobatan. Anda tidak boleh bergantung secara eksklusif pada informasi yang disediakan di situs web untuk kebutuhan kesehatan mereka sendiri. Semua pertanyaan medis tertentu harus disampaikan kepada penyedia layanan kesehatan Anda sendiri dan Anda harus mencari nasihat medis mengenai kesehatan Anda dan sebelum memulai apapun gizi, berat badan atau jenis lain dari program latihan.</p>
                            <p class="p9 ft4">Jika Anda memilih untuk menggunakan informasi yang tersedia di situs web tanpa konsultasi sebelumnya dengan dan persetujuan dari dokter Anda, Anda setuju untuk menerima tanggung jawab penuh atas keputusan Anda dan menyetujui untuk membebaskan CV. AYOKULAKAN, agen, karyawan, kontraktor, dan perusahaan afiliasi manapun dari segala tanggung jawab sehubungan dengan cedera atau penyakit kepada Anda atau properti Anda yang timbul dari atau berhubungan dengan penggunaan Anda atas informasi ini.</p>
                            <p class="p9 ft4">Mungkin ada risiko yang terkait dengan berpartisipasi dalam kegiatan yang disajikan pada situs web untuk orang dalam kesehatan yang baik atau buruk atau dengan <nobr>pra-ada</nobr> kondisi kesehatan fisik atau mental. Jika Anda memilih untuk berpartisipasi dalam risiko ini, Anda melakukannya dari kehendak bebas Anda sendiri dan sesuai, secara sadar dan sukarela dengan asumsi semua risiko yang terkait dengan kegiatan tersebut.</p>
                            <p class="p5 ft4">Hasil yang diperoleh dari informasi yang tersedia di situs web dapat bervariasi, dan akan didasarkan pada latar belakang individu Anda, kesehatan fisik, pengalaman sebelumnya, kapasitas, kemampuan untuk bertindak, motivasi dan variabel lainnya. Tidak ada jaminan mengenai tingkat keberhasilan yang mungkin Anda alami.</p>
                            <br>
                            <p class="p2 ft2">Bukan nasihat hukum</p>
                            <p class="p1 ft4">Informasi yang disediakan di situs web adalah untuk tujuan informasi umum saja dan bukan merupakan alternatif untuk nasihat hukum dari pengacara Anda, penyedia layanan profesional lainnya, atau ahli. Hal ini tidak dimaksudkan untuk memberikan nasihat hukum atau pendapat apapun. Anda tidak boleh bertindak, atau menahan diri dari bertindak, hanya berdasarkan informasi yang diberikan di situs web tanpa terlebih dahulu mencari nasihat hukum atau profesional yang sesuai. Jika Anda memiliki pertanyaan spesifik tentang masalah hukum, Anda harus berkonsultasi dengan pengacara Anda, penyedia layanan profesional lainnya, atau ahli. Anda tidak boleh menunda mencari nasihat hukum, mengabaikan nasihat hukum, atau memulai atau menghentikan tindakan hukum apa pun karena informasi di situs web.</p>
                            <p class="p1 ft4">Informasi di situs web disediakan hanya untuk kenyamanan Anda. Informasi ini mungkin tidak memiliki nilai pembuktian dan harus diperiksa terhadap sumber resmi sebelum digunakan untuk tujuan apapun. Adalah tanggung jawab Anda untuk menentukan apakah informasi ini dapat</p>
                            <p class="p10 ft6"></p>

                            <p class="p8 ft4">diterima dalam persidangan peradilan atau administratif tertentu dan apakah ada persyaratan pembuktian atau pengarsipan lain. Penggunaan Anda atas informasi ini adalah risiko Anda sendiri.</p>
                            <br>
                            <p class="p4 ft2">Bukan nasihat keuangan</p>
                            <p class="p3 ft4">Informasi di Situs web disediakan hanya untuk kenyamanan Anda dan tidak dimaksudkan untuk diperlakukan sebagai keuangan, investasi, pajak, atau saran lainnya. Tidak ada yang terkandung di Situs Web yang merupakan ajakan, rekomendasi, dukungan, atau penawaran oleh CV. AYOKULAKAN, agennya, karyawan, kontraktor, dan perusahaan afiliasi apa pun untuk membeli atau menjual sekuritas atau instrumen keuangan lainnya.</p>
                            <p class="p1 ft4">Semua Konten di situs ini adalah informasi yang bersifat umum dan tidak membahas keadaan individu atau entitas tertentu. Tidak ada sesuatu pun di Situs Web yang merupakan nasihat profesional dan / atau keuangan, dan informasi di Situs Web ini tidak merupakan pernyataan komprehensif atau lengkap dari <nobr>hal-hal</nobr> yang dibahas atau hukum yang berkaitan dengannya. Anda sendiri yang memikul tanggung jawab tunggal untuk mengevaluasi manfaat dan risiko yang terkait dengan penggunaan informasi apa pun atau konten lain di Situs Web sebelum membuat keputusan apa pun berdasarkan informasi tersebut. Anda setuju untuk tidak memiliki CV. AYOKULAKAN, agennya, karyawannya, kontraktornya, dan perusahaan terafiliasinya bertanggung jawab atas segala klaim kerusakan yang timbul dari keputusan apa pun yang Anda buat berdasarkan informasi yang disediakan untuk Anda melalui Situs web.</p>
                            <br>
                            <p class="p6 ft2">Bukan saran investasi</p>
                            <p class="p1 ft4">Semua investasi bersifat sangat spekulatif dan melibatkan risiko kerugian yang substansial. Kami mendorong semua orang untuk berinvestasi dengan sangat <nobr>hati-hati.</nobr> Kami juga mendorong investor untuk mendapatkan nasihat pribadi dari penasihat investasi profesional Anda dan melakukan penyelidikan independen sebelum bertindak berdasarkan informasi yang ditemukan di Situs Web. Kami tidak dengan cara apa pun menjamin atau menjamin keberhasilan tindakan apa pun yang Anda lakukan dengan mengandalkan pernyataan atau informasi yang tersedia di Situs Web.</p>
                            <p class="p3 ft4">Kinerja masa lalu tidak selalu menunjukkan hasil di masa mendatang. Semua investasi membawa risiko signifikan dan semua keputusan investasi individu tetap menjadi tanggung jawab spesifik individu tersebut. Tidak ada jaminan bahwa sistem, indikator, atau sinyal akan menghasilkan keuntungan atau bahwa mereka tidak akan menghasilkan kerugian penuh atau sebagian. Semua investor disarankan untuk sepenuhnya memahami semua risiko yang terkait dengan jenis investasi apa pun yang mereka pilih untuk lakukan.Reviews and testimonials</p>
                            <p class="p3 ft4">Testimoni diterima dalam berbagai bentuk melalui berbagai metode pengiriman. Mereka adalah pengalaman individu, yang mencerminkan pengalaman mereka yang telah menggunakan produk atau layanan di Situs Web dengan cara tertentu. Namun, mereka adalah hasil individual dan hasilnya sangat bervariasi. Kami tidak mengklaim bahwa itu adalah hasil khas yang umumnya dicapai konsumen. Kesaksian tidak selalu mewakili semua orang yang akan menggunakan produk atau layanan kami. CV. AYOKULAKAN tidak bertanggung jawab atas pendapat atau komentar yang diposting di Situs, dan tidak <nobr>serta-merta</nobr> membagikannya. Orang</p>
                            <p class="p11 ft6"></p>
                            <p class="p12 ft4">yang memberikan testimoni di Situs Web mungkin telah dikompensasi dengan produk atau diskon gratis untuk penggunaan pengalaman mereka. Semua pendapat yang dikemukakan sepenuhnya merupakan pandangan dari poster atau pengulas.</p>
                            <p class="p1 ft4">Kesaksian yang ditampilkan diberikan kata demi kata kecuali untuk koreksi kesalahan tata bahasa atau pengetikan. Beberapa testimonial mungkin telah diedit untuk kejelasan, atau disingkat dalam kasus di mana testimonial asli termasuk informasi asing yang tidak ada relevansinya dengan masyarakat umum. Testimonial dapat ditinjau keasliannya sebelum diposting untuk dilihat publik.</p>
                            <br>
                            <p class="p2 ft2">Ganti rugi dan jaminan</p>
                            <p class="p1 ft4">CV. AYOKULAKAN menjamin keakuratan, keandalan, dan kelengkapan informasi dan konten pada, didistribusikan melalui atau ditautkan, diunduh atau diakses dari Situs Web ini. Selain itu, informasi yang terkandung di Situs Web dan halaman apa pun yang ditautkan ke dan darinya dapat berubah <nobr>sewaktu-waktu</nobr> dan tanpa peringatan.</p>
                            <p class="p3 ft4">Kami berhak untuk mengubah Perjanjian ini terkait dengan Situs Web, produk atau layanan kapan saja, efektif setelah memposting versi terbaru Perjanjian ini di Situs Web. Ketika kami melakukannya, kami akan merevisi tanggal yang diperbarui di bagian bawah halaman ini. Terus menggunakan Situs Web setelah perubahan tersebut merupakan persetujuan Anda untuk perubahan tersebut.</p>
                            <br>
                            <p class="p7 ft2">Penerimaan Perjanjian ini</p>
                            <p class="p1 ft4">Anda mengakui bahwa Anda telah membaca Perjanjian ini dan menyetujui semua syarat dan ketentuannya. Dengan mengakses Situs Web Anda setuju untuk terikat oleh Perjanjian ini. Jika Anda tidak setuju untuk mematuhi ketentuan Perjanjian ini, Anda tidak berwenang untuk menggunakan atau mengakses Situs Web.</p>
                            <br>
                            <p class="p7 ft2">Menghubungi kami</p>
                            <p class="p5 ft4">Jika Anda ingin menghubungi kami untuk memahami lebih lanjut tentang Perjanjian ini atau ingin menghubungi kami mengenai masalah apa pun yang berkaitan dengannya, Anda dapat melakukannya dengan mengirim email ke <a href="mailto:ayokulakan01@gmail.com"><span class="ft7">ayokulakan01@gmail.com</span></a><a href="mailto:ayokulakan01@gmail.com">.</a></p>
                            <p class="p13 ft4">Dokumen ini terakhir diperbarui pada tanggal 6 Mei 2020.</p>
                            <p class="p14 ft8"><a href="https://ayokulakan.com/">https://ayokulakan.com</a></p>
                            <p class="p15 ft6"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
