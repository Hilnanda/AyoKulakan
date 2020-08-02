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
    .ft5{font: 11px 'Arial';line-height: 14px;}
    .ft6{font: 15px 'Arial';color: #0000ff;line-height: 17px;}
    .ft7{font: bold 15px 'Arial';color: #0000ee;line-height: 18px;}

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
                            <P class="p0 ft2">Syarat dan ketentuan</P>
                            <P class="p1 ft4">Syarat dan ketentuan ini adalah kesepakatan antara CV. AYOKULAKAN dan Anda (User). Perjanjian ini menetapkan syarat dan ketentuan umum penggunaan situs web <A href="https://ayokulakan.com/"><SPAN class="ft3">ayokulakan.com </SPAN></A>dan setiap produk atau layanannya (secara kolektif disebut, "situs web" atau "Layanan").</P>
                            <br>
                            <P class="p2 ft2">Akun dan keanggotaan</P>
                            <P class="p1 ft4">Anda harus berusia minimal 16 tahun untuk menggunakan situs web ini. Dengan menggunakan situs web ini dan dengan menyetujui perjanjian ini, Anda menjamin dan menyatakan bahwa Anda <nobr>sekurang-kurangnya</nobr> berusia 18 tahun.</P>
                            <P class="p3 ft4">Jika Anda membuat akun di situs web, Anda bertanggung jawab untuk menjaga keamanan akun Anda dan Anda bertanggung jawab penuh atas semua aktivitas yang terjadi di bawah akun dan tindakan lain yang diambil sehubungan dengan itu. Kami dapat memantau dan meninjau akun baru sebelum Anda dapat masuk dan menggunakan layanan kami. Memberikan informasi kontak palsu dalam bentuk apa pun dapat mengakibatkan penghentian akun Anda. Anda harus segera memberi tahu kami tentang penggunaan akun Anda yang tidak sah atau pelanggaran keamanan lainnya. Kami tidak akan bertanggung jawab atas setiap tindakan atau kelalaian oleh Anda, termasuk kerusakan apapun yang timbul sebagai akibat dari tindakan atau kelalaian tersebut. Kami dapat menangguhkan, menonaktifkan, atau menghapus akun Anda (atau bagian daripadanya) jika kami menentukan bahwa Anda telah melanggar ketentuan apa pun dari Perjanjian ini atau bahwa perilaku atau konten Anda akan cenderung merusak reputasi dan niat baik kami. Jika kami menghapus akun Anda untuk alasan tersebut di atas, Anda tidak dapat mendaftar ulang untuk layanan kami. Kami dapat memblokir alamat email Anda dan alamat Protokol Internet untuk mencegah pendaftaran lebih lanjut.</P>
                            <br>
                            <P class="p4 ft2">Penagihan dan pembayaran</P>
                            <P class="p1 ft4">Anda harus membayar semua biaya atau biaya ke akun Anda sesuai dengan biaya, biaya, dan ketentuan penagihan yang berlaku pada saat biaya atau biaya jatuh tempo dan harus dibayar. Pertukaran data sensitif dan Pribadi terjadi melalui saluran komunikasi yang diamankan SSL dan dienkripsi dan dilindungi dengan tanda tangan digital, dan situs web kami juga sesuai dengan standar kerentanan PCI untuk menciptakan keamanan lingkungan yang mungkin bagi pengguna. Pemindaian untuk malware dilakukan secara rutin untuk keamanan dan perlindungan tambahan. Jika, dalam penilaian kami, pembelian Anda merupakan transaksi berisiko tinggi, kami akan mewajibkan Anda untuk memberikan salinan identifikasi foto yang dikeluarkan oleh pemerintah yang valid kepada kami, dan mungkin juga salinan laporan mutasi</P>
                            <P class="p1 ft4">Bank terbaru untuk kartu kredit atau debit yang digunakan untuk pembelian. Kami berhak untuk mengubah produk dan harga produk setiap saat. Kami juga berhak untuk menolak pesanan apa pun yang Anda tempatkan dengan kami. Kami dapat, atas kebijakan kami sendiri, membatasi atau membatalkan jumlah pembelian per orang, per rumah tangga, atau per pesanan. Pembatasan ini dapat mencakup perintah yang ditempatkan oleh atau di bawah akun pelanggan yang sama, kartu kredit yang sama, dan/atau perintah yang menggunakan alamat penagihan dan/atau pengiriman yang sama. Jika kami melakukan perubahan atau membatalkan pesanan, kami dapat mencoba memberi tahu Anda dengan menghubungi <nobr>e-mail</nobr> dan/atau nomor penagihan/telepon yang diberikan pada saat pesanan dibuat.</P>

                            <br>
                            <P class="p2 ft2">Keakuratan informasi</P>
                            <P class="p1 ft4">Terkadang mungkin ada informasi di situs web yang berisi kesalahan ketik, ketidakakuratan atau kelalaian yang mungkin berhubungan dengan promosi dan penawaran. Kami berhak untuk memperbaiki kesalahan, ketidakakuratan atau kelalaian, dan untuk mengubah atau memperbarui informasi atau membatalkan pesanan jika ada informasi pada situs web atau pada setiap layanan yang terkait tidak akurat setiap saat tanpa pemberitahuan sebelumnya (termasuk setelah Anda mengirimkan pesanan Anda). Kami tidak berkewajiban untuk memperbarui, mengubah atau mengklarifikasi informasi di situs web termasuk, tanpa batasan, informasi harga, kecuali sebagaimana diharuskan oleh hukum. Tidak ada update tertentu atau refresh tanggal yang diterapkan pada website harus diambil untuk menunjukkan bahwa semua informasi pada website atau pada layanan terkait telah dimodifikasi atau diperbarui.</P>
                            <br>
                            <P class="p7 ft2">Layanan pihak ketiga</P>
                            <P class="p1 ft4">Jika Anda memutuskan untuk mengaktifkan, mengakses, atau menggunakan layanan pihak ketiga, disarankan bahwa akses Anda dan penggunaan Layanan lainnya tersebut diatur <nobr>semata-mata</nobr> oleh syarat dan Ketentuan Layanan lainnya, dan kami tidak mendukung, tidak bertanggung jawab atau berkewajiban atas, dan tidak membuat pernyataan mengenai aspek apa pun dari layanan lain tersebut, termasuk, tanpa batasan, konten mereka atau cara mereka menangani data (termasuk data Anda) atau interaksi apa pun antara Anda dan penyedia Layanan lain tersebut. Anda tidak dapat ditarik kembali melepaskan setiap klaim terhadap CV. AYOKULAKAN sehubungan dengan layanan lain tersebut. CV. AYOKULAKAN tidak bertanggung jawab atas segala kerusakan atau kerugian yang disebabkan atau diduga disebabkan oleh atau berhubungan dengan pemberdayaan Anda, akses atau penggunaan Layanan lain tersebut, atau ketergantungan Anda pada praktik privasi, proses keamanan data atau kebijakan lain dari layanan lain tersebut. Anda mungkin diminta untuk mendaftar atau masuk ke layanan lain tersebut di situs web <nobr>masing-masing.</nobr> Dengan mengaktifkan layanan lain, Anda secara tegas mengizinkan CV. AYOKULAKAN untuk mengungkapkan data Anda jika diperlukan untuk memfasilitasi penggunaan atau pengaktifan layanan lain tersebut.</P>
                            <br>
                            <P class="p4 ft2">Iklan</P>
                            <P class="p1 ft4">Selama penggunaan situs web, Anda dapat melakukan korespondensi dengan atau berpartisipasi dalam promosi pengiklan atau sponsor yang menunjukkan barang atau layanan</P>

                            <P class="p6 ft4">mereka melalui situs web. Setiap kegiatan tersebut, dan setiap syarat, ketentuan, jaminan atau representasi yang terkait dengan aktivitas tersebut, adalah <nobr>semata-mata</nobr> antara Anda dan pihak ketiga yang berlaku. Kami tidak memiliki kewajiban, kewajiban atau tanggung jawab atas korespondensi, pembelian atau promosi antara Anda dan pihak ketiga tersebut.</P>
                            <br>
                            <P class="p9 ft2">Tautan ke situs web lain</P>
                            <P class="p10 ft4">Meskipun situs web ini dapat menautkan ke situs web lain, kami tidak, secara langsung atau tidak langsung, menyiratkan persetujuan, Asosiasi, sponsor, pengesahan, atau afiliasi dengan situs web yang tertaut, kecuali disebutkan secara khusus di sini. Kami tidak bertanggung jawab untuk memeriksa atau mengevaluasi, dan kami tidak menjamin persembahan dari, setiap bisnis atau individu atau konten situs web mereka. Kami tidak bertanggung jawab atau berkewajiban atas tindakan, produk, Layanan, dan konten pihak ketiga lainnya. Anda harus meninjau pernyataan hukum dan ketentuan lain penggunaan situs web yang Anda akses melalui tautan dari situs web ini secara saksama. Anda menghubungkan ke situs <nobr>off-situs</nobr> lain adalah risiko Anda sendiri.</P>
                            <br>
                            <P class="p2 ft2">Penggunaan yang dilarang</P>
                            <P class="p11 ft4">Selain persyaratan lain sebagaimana tercantum dalam Perjanjian, Anda dilarang menggunakan situs web atau kontennya: (a) untuk tujuan yang melanggar hukum; (b) untuk meminta orang lain untuk melakukan atau berpartisipasi dalam tindakan yang melanggar hukum; (c) untuk melanggar setiap internasional, Federal, peraturan provinsi atau negara, aturan, hukum, atau tata cara lokal; (d) untuk melanggar atau melanggar hak kekayaan intelektual atau hak kekayaan intelektual orang lain; (e) untuk melecehkan, menyalahgunakan, menghina, membahayakan, mencemarkan, memfitnah, meremehkan, mengintimidasi, atau melakukan diskriminasi berdasarkan jenis kelamin, orientasi seksual, agama, etnis, ras, usia, <nobr>asal-usul</nobr> kebangsaan, atau kecacatan; (f) untuk mengirimkan informasi palsu atau menyesatkan; (g) untuk mengunggah atau mentransmisikan virus atau jenis kode berbahaya lainnya yang akan atau dapat digunakan dengan cara apa pun yang akan memengaruhi fungsi atau pengoperasian layanan atau situs web terkait, situs web lain, atau internet; (h) untuk mengumpulkan atau melacak informasi pribadi orang lain; (i) untuk spam, Phish, Pharm, dalih, spider, merangkak, atau mengikis; (j) untuk tujuan cabul atau tidak bermoral; atau (k) mengganggu atau mengakali fitur keamanan Layanan atau situs web terkait, situs web lain, atau internet. Kami berhak untuk menghentikan penggunaan layanan atau situs web terkait untuk melanggar salah satu penggunaan yang dilarang.</P>
                            <br>
                            <P class="p7 ft2">Intelektual</P>
                            <P class="p1 ft4">Perjanjian ini tidak mengalihkan kepada Anda setiap kekayaan intelektual yang dimiliki oleh CV. AYOKULAKAN atau pihak ketiga, dan semua hak, gelar, dan kepentingan dalam dan ke properti tersebut akan tetap (antara para pihak) <nobr>semata-mata</nobr> dengan CV. AYOKULAKAN. Semua merek dagang, merek layanan, grafis, dan logo yang digunakan dalam kaitannya dengan situs web atau layanan kami, adalah merek dagang atau merek dagang terdaftar CV. AYOKULAKAN atau CV. AYOKULAKAN pemberi lisensi. Merek dagang, merek layanan, grafis,</P>

                            <P class="p6 ft4">dan logo lain yang digunakan sehubungan dengan situs web atau layanan kami mungkin merupakan merek dagang dari pihak ketiga lainnya. Penggunaan Anda atas situs web dan layanan kami tidak memberi Anda hak atau lisensi untuk mereproduksi atau menggunakan CV. AYOKULAKAN atau merek dagang pihak ketiga.</P>
                            <br>
                            <P class="p9 ft2">Disclaimer garansi</P>
                            <P class="p10 ft4">Anda setuju bahwa penggunaan Anda atas situs web atau layanan kami <nobr>semata-mata</nobr> merupakan risiko Anda sendiri. Anda setuju bahwa layanan tersebut disediakan dengan dasar "sebagaimana adanya" dan "sebagaimana tersedia". Kami secara tegas menyangkal semua jaminan dalam bentuk apa pun, baik tersurat maupun tersirat, termasuk namun tidak terbatas pada jaminan tersirat tentang kelayakan untuk diperdagangkan, kesesuaian untuk tujuan tertentu, dan ketiadaan pelanggaran. Kami tidak memberikan jaminan bahwa layanan akan memenuhi kebutuhan Anda, atau bahwa layanan tidak akan terganggu, tepat waktu, aman, atau bebas dari kesalahan; Kami juga tidak membuat jaminan atas hasil yang dapat diperoleh dari penggunaan layanan atau untuk akurasi atau keandalan informasi yang diperoleh melalui layanan atau bahwa cacat dalam layanan akan diperbaiki. Anda memahami dan menyetujui bahwa setiap materi dan/atau data yang diunduh atau diperoleh melalui penggunaan Layanan dilakukan atas kebijaksanaan dan risiko Anda sendiri dan bahwa Anda akan bertanggung jawab sepenuhnya atas kerusakan pada sistem komputer Anda atau hilangnya data yang dihasilkan dari pengunduhan materi dan/atau data tersebut. Kami tidak membuat jaminan mengenai barang atau layanan apa pun yang dibeli atau diperoleh melalui layanan atau transaksi apa pun yang dilakukan melalui Layanan. Tidak ada saran atau informasi, baik lisan maupun tulisan, yang Anda peroleh dari kami atau melalui Layanan akan menciptakan jaminan yang tidak dibuat secara tersurat di sini.</P>
                            <br>
                            <P class="p7 ft2">Batasan tanggung jawab</P>
                            <P class="p10 ft4">Sejauh yang diizinkan oleh hukum yang berlaku, dalam keadaan apa pun CV. AYOKULAKAN, para afiliasi, pejabat, Direktur, karyawan, agen, pemasok atau pemberi lisensi bertanggung jawab kepada setiap orang untuk (a): setiap kerusakan tidak langsung, insidental, khusus, hukuman, penutup atau konsekuensial (termasuk, tanpa batasan, kerusakan untuk kehilangan keuntungan, pendapatan, penjualan, niat baik, penggunaan konten, dampak pada bisnis, gangguan Bisnis, kehilangan tabungan diantisipasi , hilangnya peluang bisnis) namun disebabkan, berdasarkan teori tanggung jawab, termasuk, tanpa batasan, kontrak, wanprestasi, jaminan, pelanggaran kewajiban hukum, kelalaian atau sebaliknya, bahkan jika CV. AYOKULAKAN telah diberitahukan mengenai kemungkinan kerusakan tersebut atau dapat meramalkan kerusakan tersebut. Sejauh yang diizinkan oleh hukum yang berlaku, kewajiban agregat CV. AYOKULAKAN beserta afiliasinya, pejabat, karyawan, agen, pemasok dan pemberi lisensinya, yang berkaitan dengan layanan akan terbatas pada jumlah yang lebih besar dari satu dolar atau jumlah yang sebenarnya dibayarkan secara tunai oleh Anda ke CV. AYOKULAKAN untuk jangka waktu satu bulan sebelum kejadian pertama atau kejadian yang menimbulkan kewajiban tersebut. Keterbatasan dan pengecualian juga berlaku jika obat ini tidak sepenuhnya mengkompensasi Anda untuk setiap kerugian atau gagal dari tujuan penting.</P>
                            <br>
                            <br>
                            <P class="p0 ft2">Ganti rugi</P>
                            <P class="p1 ft4">Anda setuju untuk mengganti rugi dan memegang CV. AYOKULAKAN dan afiliasinya, Direktur, pejabat, karyawan, dan agen tidak berbahaya dari dan terhadap setiap kewajiban, kerugian, kerusakan atau biaya, termasuk biaya pengacara yang wajar, yang timbul sehubungan dengan atau yang timbul dari dugaan, klaim, tindakan, sengketa, atau tuntutan pihak ketiga yang dinyatakan terhadap salah satu dari mereka sebagai akibat dari atau terkait dengan konten Anda, penggunaan Anda atas situs web atau layanan, atau kesalahan yang disengaja pada bagian Anda.</P>
                            <br>
                            <P class="p2 ft2">Keterpisahan</P>
                            <P class="p14 ft4">Semua hak dan batasan yang terkandung dalam Perjanjian ini dapat dilaksanakan dan akan berlaku dan mengikat hanya sejauh mereka tidak melanggar hukum yang berlaku dan dimaksudkan untuk dibatasi sejauh yang diperlukan sehingga mereka tidak akan membuat Perjanjian ini ilegal, tidak valid atau tidak bisa diterapkan. Jika ada ketentuan atau bagian dari ketentuan apa pun dari Perjanjian ini akan dianggap ilegal, tidak valid atau tidak dapat dilaksanakan oleh pengadilan yang berwenang, itu adalah maksud para pihak bahwa ketentuan atau bagian yang tersisa daripadanya akan membentuk perjanjian mereka sehubungan dengan subjek dari Perjanjian ini, dan semua ketentuan yang tersisa atau bagiannya akan tetap berlaku sepenuhnya.</P>
                            <br>
                            <P class="p15 ft2">Penyelesaian sengketa</P>
                            <P class="p10 ft4">Pembentukan, interpretasi, dan kinerja dari Perjanjian ini dan setiap perselisihan yang timbul dari itu akan diatur oleh hukum substantif dan prosedural Indonesia tanpa memperhatikan aturan tentang konflik atau pilihan hukum dan, sejauh yang berlaku, hukum Indonesia. Yurisdiksi eksklusif dan tempat untuk tindakan yang berkaitan dengan materi pokok di sini adalah pengadilan yang berlokasi di Indonesia, dan dengan ini Anda tunduk pada yurisdiksi pribadi pengadilan tersebut. Anda dengan ini mengesampingkan hak apa pun atas pengadilan juri dalam proses hukum apa pun yang timbul dari atau terkait dengan perjanjian ini. Konvensi PBB tentang kontrak untuk penjualan barang internasional tidak berlaku untuk Perjanjian ini.</P>
                            <br>
                            <P class="p2 ft2">Tugas</P>
                            <P class="p1 ft4">Anda tidak diperkenankan untuk mengalihkan, menjual kembali, mensublisensikan, atau mengalihkan atau mendelegasikan hak atau kewajiban Anda berdasarkan Perjanjian ini, secara keseluruhan atau sebagian, tanpa persetujuan tertulis sebelumnya dari kami, yang mana persetujuan tersebut adalah atas kebijakan kami sendiri dan tanpa kewajiban; setiap penugasan atau pengalihan tersebut akan menjadi batal demi hukum. Kita bebas untuk menetapkan salah satu hak atau kewajiban berdasarkan Perjanjian ini, secara keseluruhan atau sebagian, kepada pihak ketiga sebagai bagian dari penjualan semua atau secara substansial semua aset atau saham atau sebagai bagian dari merger.</P>
                            <P class="p16 ft5"></P>

                            <div id="p6dimg1">
                            <img src="data:image/jpg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAAEAAEDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwDP/wCF/wdiv/oH6N/35l/+OUUUV+rf2Jl3/PmP4/5nD7Sfc//Z" id="p6img1"></div>

                            <br>
                            <P class="p0 ft2">Perubahan dan Amandemen</P>
                            <P class="p1 ft4">Kami berhak untuk memodifikasi Perjanjian ini atau kebijakannya yang berkaitan dengan situs web atau layanan setiap saat, efektif setelah memposting versi terbaru dari Perjanjian ini di situs web. Ketika kami melakukannya, kami akan merevisi tanggal yang diperbarui di bagian bawah halaman ini. Terus menggunakan website setelah perubahan tersebut akan merupakan persetujuan Anda terhadap perubahan tersebut.</P>
                            <br>
                            <P class="p2 ft2">Penerimaan persyaratan ini</P>
                            <P class="p10 ft4">Anda mengakui bahwa Anda telah membaca Perjanjian ini dan menyetujui semua syarat dan ketentuannya. Dengan menggunakan situs web atau layanannya, Anda setuju untuk terikat dengan perjanjian ini. Jika Anda tidak setuju untuk mematuhi ketentuan Perjanjian ini, Anda tidak berwenang untuk menggunakan atau mengakses situs web dan layanannya.</P>
                            <br>
                            <P class="p9 ft2">Menghubungi kami</P>
                            <P class="p10 ft4">Jika Anda ingin menghubungi kami untuk memahami lebih lanjut tentang perjanjian ini atau ingin menghubungi kami mengenai masalah apa pun yang berkaitan dengannya, Anda dapat melakukannya dengan mengirim email ke <A href="mailto:ayokulakan01@gmail.com"><SPAN class="ft6">ayokulakan01@gmail.com</SPAN></A><A href="mailto:ayokulakan01@gmail.com">.</A></P>
                            <P class="p17 ft4">Dokumen ini terakhir diperbarui pada tanggal 6 Mei 2020</P>
                            <P class="p15 ft7"><A href="https://ayokulakan.com/">https://ayokulakan.com</A></P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <embed src="{{ asset('documents/ayokulakan.com-syarat-dan-ketentuan.pdf') }}#zoom=150&toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="800px" /> --}}

@endsection
