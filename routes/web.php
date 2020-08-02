<?php

use Intervention\Image\Facades\Image;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::view('katam-terpadu', 'welcome');


// FRONT END;
if (substr(Request::path(), 0, 2) == 's/') {
    Route::group(['namespace' => 'NotFound'], function () {
        Route::get(Request::path(), 'NotFoundController@index');
        Route::get('404', 'NotFoundController@index');
        Route::get('notfound', 'NotFoundController@index');
    });
}

Route::get('/card_yokurir', 'ImageControl@kartu_yokurir')->name("kartu_yokurir.card");
Route::get('/card_kakilima', 'ImageControl@kartu_kakilima')->name("kakilima.card");
Route::group(['namespace' => 'Notification'], function () {
    Route::get('/mess-not/{id}/{review}', 'NotificationController@showNotif');
    Route::get('/mess-not', 'NotificationController@indexNotification');
    Route::get('/mess-not/show-all', 'NotificationController@showNotifAll');
    Route::post('/mess-not/store', 'NotificationController@store');
});

Route::group(['namespace' => 'Picture'], function () {
    Route::post('/picture/bulk-unlink', 'PictureController@bulkUnlink');
});

Route::group(['namespace' => 'FrontEnd'], function () {

    Route::group(['namespace' => 'Home'], function () {
        Route::get('/', 'HomeController@index');
        Route::get('/fbarang/{id}/{name}', 'HomeController@show');
    });

    Route::group(['namespace' => 'Tentang'], function () {
        Route::get('/tentang', 'TentangController@index');
        Route::get('/aturan-pengguna', 'AturanPenggunaController@index');
        Route::get('/identitas-brand', 'IdentitasBrandController@index');
        Route::get('/kebijakan-privasi', 'KebijakanPrivasiController@index');
        Route::get('/kontak-kami', 'KontakKamiController@index');
        Route::get('/syarat-dan-ketentuan', 'SyaratDanKetentuan@index');
        Route::get('/perjanjian', 'PerjanjianController@index');
        // Route::get('/fbarang/{id}/{name}', 'TentangController@show');
    });

    Route::group(['prefix' => 'fiturs', 'namespace' => 'PanduanPelapak'], function () {
        Route::get('/pelapak/panduan-pelapak', 'PanduanPelapakController@indexWebViews');

        Route::get('/pembeli/panduan-pembeli', 'PanduanPembeliController@indexWebViews');

        Route::get('/rental/rental-perental', 'PanduanRentalController@indexWebViews');

        Route::get('/kurir/panduan-kurir', 'PanduanKurirController@indexWebViews');

        Route::get('/kaki-lima/panduan-kaki-lima', 'PanduanKakiLimaController@indexWebViews');

        Route::get('/haji-umroh/panduan', 'PanduanHajiUmrohController@indexWebViews');
    });

    Route::group(['prefix' => 'fitur', 'namespace' => 'PanduanPelapak'], function () {
        Route::get('/pelapak/panduan-pelapak', 'PanduanPelapakController@index');

        Route::get('/pembeli/panduan-pembeli', 'PanduanPembeliController@index');

        Route::get('/rental/sewa', 'PanduanRentalController@index');

        Route::get('/kurir/panduan-kurir', 'PanduanKurirController@index');

        Route::get('/kaki-lima/panduan-kaki-lima', 'PanduanKakiLimaController@index');

        Route::get('/haji-umroh/panduan', 'PanduanHajiUmrohController@index');
    });

    Route::group(['namespace' => 'KabarTerbaru'], function () {
        Route::get('/kabar-terbaru', 'KabarTerbaruController@index');
        Route::get('/kabar-terbaru/{id}/kabar-terbaru/{judul}', 'KabarTerbaruController@show');
    });
    Route::group(['namespace' => 'PendaftaranKurir'], function () {
        Route::get('/yokuy-kurir', 'PendaftaranKurirController@index');
        Route::post('/yokuy-kurir/store', 'PendaftaranKurirController@store');
        Route::get('/yokuy-kurir/show', 'PendaftaranKurirController@tentang')->name('kurir-tentang');
        Route::post('/yokuy-kurir/newStore', 'PendaftaranKurirController@newStore');
        Route::get('/yokuy-kurir/pendaftaran', 'PendaftaranKurirController@create');
        Route::get('/yokuy-kurir/{id}/kabar-terbaru/{judul}', 'PendaftaranKurirController@show');
    });

    Route::group(['namespace' => 'KakiLima'], function () {
        Route::post('/kaki-lima/store', 'KakiLimaController@store');
        Route::get('/kaki-lima', 'KakiLimaController@index');
        Route::get('/kaki-lima/show','KakiLimaController@tentang')->name('kaki-lima');
        Route::get('/kaki-lima/pendaftaran', 'KakiLimaController@create');
    });

    Route::group(['prefix' => 'sc', 'namespace' => 'Searching'], function () {
        Route::get('/barang', 'SearchingController@index');
        Route::get('/barang/rental', 'SearchingController@rentalSerch')->name('search-rental');
        Route::get('/cat-barang/{categ}/{name}', 'SearchingController@categorySearch');
        Route::get('/aj-barang', 'SearchingController@ajIndex');
        Route::get('/aj-cat', 'SearchingController@ajcat');
        Route::get('/barang/{id}/{name}', 'SearchingController@show');
        Route::get('/barang/{id}', 'SearchingController@detail');
        Route::get('/sewa/{id}', 'SearchingController@details');

        Route::get('/rental', 'SearchingController@indexRental');
        Route::get('/rental/{id}/{name}', 'SearchingController@showRental');
        Route::get('/cat-rental/{categ}/{name}', 'SearchingController@categorySearchRental');
        Route::get('/aj-rental', 'SearchingController@ajIndexRental');
    });

    Route::group(['prefix' => 'favorit', 'namespace' => 'Favorit'], function () {
        Route::get('/{id}', 'LikeFavoritBarangController@show');
        Route::get('/rental/{id}', 'LikeFavoritBarangController@showRental');
        Route::post('/hapus', 'LikeFavoritBarangController@hapus');
    });

    Route::group(['namespace' => 'Cart', 'middleware' => 'guest'], function () {
        Route::get('keranjang/{id}/{jml}/{type}', 'CartController@tambahKeranjang');
        Route::get('keranjang/show', 'CartController@show');
        Route::get('keranjang/store', 'CartController@getKeranjang');
        Route::get('keranjang/pengiriman', 'CartController@getPengiriman');

        Route::post('keranjang/upload', 'CartController@upload');
        Route::post('keranjang/hapus', 'CartController@hapusKeranjang');
        Route::post('keranjang/pembayaran', 'CartController@storeKeranjang');
        Route::post('keranjang/store-mt', 'CartController@storeMidtrans');

        Route::post('keranjang-sewa/upload', 'CartSewaController@upload');
        Route::get('keranjang-sewa/{id}/{jml}/{type}', 'CartSewaController@tambahKeranjang');
        Route::get('keranjang-sewa/show', 'CartSewaController@show');
        Route::post('keranjang-sewa/hapus', 'CartSewaController@hapusKeranjang');
        Route::post('keranjang-sewa/pembayaran', 'CartSewaController@storeKeranjang');
        Route::get('keranjang-sewa/store', 'CartSewaController@getKeranjang');
        Route::post('keranjang-sewa/store-mt', 'CartSewaController@storeMidtrans');
    });

    Route::group(['namespace' => 'Transaksi', 'middleware' => 'guest'], function () {
        Route::get('transaksi/confirmation/{order_id}', 'TransaksiController@confirmMidtrans');
        Route::post('transaksi/delete', 'TransaksiController@deleteTransaksi');
    });


    Route::group(['namespace' => 'HajiUmroh'], function () {
        Route::get('berita-terbaru', 'BeritaTerbaruHajiUmrohController@index');
        Route::get('berita-terbaru/{id}', 'BeritaTerbaruHajiUmrohController@show');
        Route::resource('tentang-haji-umroh', 'TentangHajiUmrohController');
        Route::resource('gallery-photo', 'GalleryHajiUmrohController');
        Route::post('daftar-haji-umroh/store', 'DaftarHajiUmrohController@store');
        Route::get('daftar-haji-umroh', 'DaftarHajiUmrohController@index');
        Route::get('daftar-haji-umroh/paket/{id}', 'DaftarHajiUmrohController@paket');
        Route::get('daftar-haji-umroh/jadwal/{id}', 'DaftarHajiUmrohController@jadwal');
    });


    Route::group(['namespace' => 'Zakat'], function () {
        Route::get('zakat-info', 'ZakatController@info');
        Route::resource('gallery-zakat-infaq', 'GalleryZakatController');
    });

    Route::group(['namespace' => 'KonversiMataUang'], function () {
        Route::get('konversi-mata-uang', 'KonversiMataUangController@index');
    });

    Route::group(['namespace' => 'Maps'], function () {
        Route::get('maps-ayokulakan', 'MapController@index');
        Route::get('maps-ayokulakan-search', 'MapController@search');
        Route::get('cari-mesjid', 'MapController@mesjid');
        Route::get('cari-kaki-lima', 'MapController@kakiLima');
        Route::get('perkiraan-cuaca', 'MapController@cuaca');
        Route::get('kalender-tanam', 'MapController@tanam');
        Route::get('pencarian-ikan', 'MapController@ikan');
    });

    Route::group(['namespace' => 'PPOB'], function () {
        Route::post('ppob-pulsa/store', 'PPOBPulsaController@storeMidtrans');
        Route::post('ppob-pulsa/check-game', 'PPOBPulsaController@checkGame');

        Route::post('ppob-pasca/check-esamsat', 'PPOBPascaController@PPOBIquiryEsamsat');
        Route::post('ppob-pasca/check-bpjs', 'PPOBPascaController@PPOBIquiryBpjs');
        Route::post('ppob-pasca/check-pdam', 'PPOBPascaController@PPOBIquiryPdam');
        Route::post('ppob-pasca/check-pln-prabayar', 'PPOBPascaController@PPOBIquiryPlnPrabayar');
        Route::post('ppob-pasca/check-pln-postpaid', 'PPOBPascaController@PPOBIquiryPlnPostpaid');
        Route::post('ppob-pasca/check-tv', 'PPOBPascaController@PPOBIquiryTv');
        Route::post('ppob-pasca/check-internet', 'PPOBPascaController@PPOBIquiryInternet');
        Route::post('ppob-pasca/check-tlp-rmh', 'PPOBPascaController@PPOBIquiryTLpRmh');

        Route::post('ppob-pasca/store', 'PPOBPascaController@storeMidtrans');
    });

    Route::group(['namespace' => 'Ticket'], function () {
        Route::post('check-ticket/pelni', 'TiketPelniController@checkPelni');

        Route::post('check-ticket/hotel', 'HotelController@checkHotel');
        // Route::post('check-ticket/pesawat/store', 'TiketPesawatController@store');

        Route::post('check-ticket/pesawat', 'TiketPesawatController@checkPesawat');
        Route::post('check-ticket/pesawat/store', 'TiketPesawatController@store');

        Route::post('check-ticket/store', 'CheckTiketController@store');
        Route::post('check-ticket/check-kursi', 'CheckTiketController@checkKursi');
        Route::post('check-ticket/kereta', 'CheckTiketController@checkKereta');
    });

    Route::group(['namespace' => 'Chat'], function () {
        Route::post('chat/notif', 'ChatController@postNotif');
        Route::post('chat/send', 'ChatController@sendChat');
        Route::get('chat/show-list', 'ChatController@showList');
        Route::get('chat', 'ChatController@index');

        Route::get('chat-sewa', 'ChatController@indexSewa');
    });

    Route::prefix('airline')->namespace('Darmawisata')->group(function () {
        Route::get('/', 'AirlineController@showAirlineForm')->name('airline');
        Route::get('/schedule', 'AirlineController@showAirlineSchedule')->name('airline.schedule');
        Route::get('/booking', 'AirlineController@showFormAirlineBookingList')->name('airline.booking');
        Route::get('/booking/list', 'AirlineController@getBookingList')->name('airline.booking.list');
        Route::post('/booking', 'AirlineController@setAirlineBooking');
        Route::post('/issued', 'AirlineController@setIssued')->name('airline.issued');
        Route::post('/cart/{cart}', 'AirlineController@showAirlineCart')->name('airline.cart');
    });

    Route::group(['prefix' => 'hotel','namespace' => 'Darmawisata'], function () {
        Route::get('/search', 'HotelController@search');
        Route::get('/', 'HotelController@index');
    });
});

Route::get('404', 'Dashboard\DashboardController@notFoundPage');
Route::get('/ampas', 'Ajax\MailJobQueueController@queue');

// BACKENd
Auth::routes();
Route::get('login/phone', 'Auth\LoginPhoneController@index');
Route::post('login/phone', 'Auth\LoginPhoneController@checkCredentials');
Route::post('login/checkNumber', 'Auth\LoginPhoneController@checkPhoneNumber');

// Route::group(['middleware' => 'auth'], function () {

Route::group(['prefix' => 'option', 'namespace' => 'Ajax'], function () {
    Route::get('id_sub_kategori/{id}', 'OptionController@showSubKategori');
    Route::get('id_child_kategori/{id}', 'OptionController@showSubChildKategori');
    Route::get('showSubProvinsi/{id}', 'OptionController@showSubProvinsi');
    Route::get('id_provinsi/{id}', 'OptionController@showSubProvinsi');
    Route::get('id_kota/{id}', 'OptionController@showSubKota');
    Route::get('id_kecamatan/{id}', 'OptionController@showSubKecamatan');
    Route::get('showBarang/{id}', 'OptionController@showBarang');
    Route::get('showRental/{id}', 'OptionController@showRental');
    Route::get('showJadwalPaket/{id}', 'OptionController@showJadwalPaket');

    Route::get('sub_kategori_id/{id}', 'OptionController@showSubKategoriRental');
    //PPOB
    Route::get('PPOBPulsa/{type}/{val}', 'OptionController@PPOBPulsa');
    Route::get('PPOBPaket/{type}/{val}', 'OptionController@PPOBPulsa');

    // DARMAWISATA HOTEL
    Route::get('cityID/{id}', 'OptionController@darmawisataHotelKota');

});

Route::get('/hapus-download-file/{id}', 'DownloadController@deleteFile');
Route::get('/hapus-download-attachment/{id}', 'DownloadController@deletePicture');
Route::get('/download-picture/{id}', 'DownloadController@picture');
Route::get('/download/{id}', 'DownloadController@index');
Route::get('/download-multiple-file/{id}/{type}', 'DownloadController@multipleDownloadFile');
Route::get('/download-multiple-picture/{id}/{type}', 'DownloadController@multipleDownloadPicture');

/* Lapak */
Route::group(['namespace' => 'BackEnd\Lapak', 'middleware' => 'guest'], function () {
    Route::post('settings-lapak/hapus-barang', 'SettingLapakController@hapusBarang');
    Route::post('settings-lapak/store-barang', 'SettingLapakController@storeBarang');
    Route::post('settings-lapak/store-jasa', 'SettingLapakController@storeJasa');
    Route::post('settings-lapak/store-lowongan', 'SettingLapakController@storeLowongan');
    Route::put('settings-lapak/update-barang/{id}', 'SettingLapakController@updateBarang');

    Route::get('settings-lapak/{id}/feedback', 'SettingLapakController@showFeedback');
    Route::get('settings-lapak/{id}/edit-barang', 'SettingLapakController@editBarang');
    Route::get('settings-lapak/others', 'SettingLapakController@addBarang');
    Route::get('settings-lapak/low/{id}', 'SettingLapakController@addLowongan');
    Route::get('settings-lapak/jasa', 'SettingLapakController@addJasa');
    Route::get('settings-lapak/show-barang', 'SettingLapakController@showBarang');

    Route::resource('settings-lapak', 'SettingLapakController');
});

Route::group(['prefix' => 'partner', 'namespace' => 'BackEnd\Partner', 'middleware' => 'guest'], function () {
    Route::resource('partner-kaki-lima', 'PartnerKakiLimaController');
});

Route::group(['prefix' => 'partner', 'namespace' => 'BackEnd\Partner', 'middleware' => 'guest'], function () {
    Route::resource('partner-kurir', 'PartnerKurirController');
});

/* Lapak */
Route::group(['namespace' => 'BackEnd\Rental', 'middleware' => 'guest'], function () {
    Route::get('settings-rental/{id}/detail', 'SettingsRentalController@showFeedback');
    Route::post('settings-rental/grid', 'SettingsRentalController@grid');
    Route::resource('settings-rental', 'SettingsRentalController');
});

// Route::group(['namespace' => 'Dashboard','middleware' => 'guest'], function(){
// //Dashboard
//     Route::resource('/dashboard', 'DashboardController');
// });

/* List Order */
Route::group(['namespace' => 'BackEnd\ListOrder', 'middleware' => 'guest'], function () {
    Route::get('list-order/{id}/detail', 'ListOrderController@show');
    Route::post('list-order/grid', 'ListOrderController@grid');
    Route::resource('list-order', 'ListOrderController');
});

/* List Order Rental */
Route::group(['namespace' => 'BackEnd\ListOrder', 'middleware' => 'guest'], function () {
    Route::get('list-order-rental/{id}/detail', 'ListOrderRentalController@show');
    Route::post('list-order-rental/grid', 'ListOrderRentalController@grid');
    Route::resource('list-order-rental', 'ListOrderRentalController');
});

/* History Transaksi */
Route::group(['namespace' => 'BackEnd\HistoryTransaksi', 'middleware' => 'guest'], function () {
    Route::get('history-trans/{id}/detail', 'HistoryTransaksiController@show');
    Route::post('history-trans/grid', 'HistoryTransaksiController@grid');
    Route::resource('history-trans', 'HistoryTransaksiController');
});


/* User Profile */
Route::group(['namespace' => 'BackEnd\Profile', 'middleware' => 'guest'], function () {
    Route::resource('myprofile', 'ProfileController');
});

/* Haji & Umroh */
Route::group(['namespace' => 'BackEnd\HajiUmroh', 'middleware' => 'guest'], function () {
    //Berita Terbaru
    Route::post('haji-umroh/riwayat-pendaftaran/approve', 'RiwayatPendaftaranController@approve');
    Route::post('haji-umroh/riwayat-pendaftaran/grid', 'RiwayatPendaftaranController@grid');
    Route::resource('haji-umroh/riwayat-pendaftaran', 'RiwayatPendaftaranController');
});

////////////////////// ADMINISTRATOR //////////////////
/* Refound */
Route::group(['namespace' => 'BackEnd\Refound', 'middleware' => 'roleAdministration'], function () {
    Route::post('refounds/grid', 'RefoundController@grid');
    Route::resource('refounds', 'RefoundController');
});

/* Berita */
Route::group(['namespace' => 'BackEnd\Berita', 'middleware' => 'roleAdministration'], function () {
    Route::post('berita/grid', 'BeritaController@grid');
    Route::resource('berita', 'BeritaController');
});

Route::group(['namespace' => 'BackEnd\Kurir', 'middleware' => 'roleAdministration'], function () {
    Route::post('list-kurir/grid', 'KurirController@grid');
    Route::resource('list-kurir', 'KurirController');
});

/* All Lapak */
Route::group(['prefix' => 'data', 'namespace' => 'BackEnd\AllDataLapak', 'middleware' => 'roleAdministration'], function () {
    Route::post('data-lapak/grid', 'DataLapakController@grid');
    Route::resource('data-lapak', 'DataLapakController');
});

/* All Barang */
Route::group(['prefix' => 'data', 'namespace' => 'BackEnd\AllDataBarang', 'middleware' => 'roleAdministration'], function () {
    Route::post('data-barang/grid', 'AllDataBarangController@grid');
    Route::resource('data-barang', 'AllDataBarangController');
});

Route::group(['prefix' => 'master', 'namespace' => 'BackEnd\Master', 'middleware' => 'roleAdministration'], function () {

    //Kategori Barang
    Route::post('rajaongkir/grid', 'RajaongkirController@grid');
    Route::resource('template/chat', 'TemplateChatController');

    //Kategori Barang
    Route::post('barang/kategori-barang/grid', 'KategoriBarangController@grid');
    Route::resource('barang/kategori-barang', 'KategoriBarangController');

    Route::post('barang/sub-kategori-barang/grid', 'KategoriBarangSubController@grid');
    Route::resource('barang/sub-kategori-barang', 'KategoriBarangSubController');

    // update data kategori
    Route::get('barang/kategori-ayo/edit/{id}','KategoriBarangController@edit');
    Route::put('barang/kategori/{id}','KategoriBarangController@Update')->name('update');
    
    Route::post('barang/child-kategori-barang/grid', 'KategoriBarangChildController@grid');
    Route::resource('barang/child-kategori-barang', 'KategoriBarangChildController');

    Route::post('wilayah/negara/grid', 'WilayahNegaraController@grid');
    Route::resource('wilayah/negara', 'WilayahNegaraController');

    Route::post('wilayah/provinsi/grid', 'WilayahProvinsiController@grid');
    Route::resource('wilayah/provinsi', 'WilayahProvinsiController');

    Route::post('wilayah/kab-kota/grid', 'WilayahKotaController@grid');
    Route::resource('wilayah/kab-kota', 'WilayahKotaController');

    Route::post('wilayah/kecamatan/grid', 'WilayahKecamatanController@grid');
    Route::resource('wilayah/kecamatan', 'WilayahKecamatanController');

    Route::post('aplikasi/data/grid', 'AplikasiTentangController@grid');
    Route::resource('aplikasi/data', 'AplikasiTentangController');

    Route::post('aplikasi/panduan/grid', 'AplikasiPanduanController@grid');
    Route::resource('aplikasi/panduan', 'AplikasiPanduanController');

    Route::post('aplikasi/sosial/grid', 'AplikasiSosialController@grid');
    Route::resource('aplikasi/sosial', 'AplikasiSosialController');

    Route::post('ppob-pulsa/grid', 'PPOBPulsaController@grid');
    Route::resource('ppob-pulsa', 'PPOBPulsaController');

    Route::post('ppob-provider/grid', 'PPOBPulsaProviderController@grid');
    Route::resource('ppob-provider', 'PPOBPulsaProviderController');

    Route::post('ppob-pdam/grid', 'PPOBPdamController@grid');
    Route::resource('ppob-pdam', 'PPOBPdamController');

    Route::post('rental/kategori-rental/grid', 'KategoriRentalController@grid');
    Route::resource('rental/kategori-rental', 'KategoriRentalController');

    Route::post('rental/sub-kategori-rental/grid', 'KategoriRentalSubController@grid');
    Route::resource('rental/sub-kategori-rental', 'KategoriRentalSubController');

    Route::post('stasiun-kereta/grid', 'TicketingStasiunKeretaController@grid');
    Route::resource('stasiun-kereta', 'TicketingStasiunKeretaController');

    Route::post('airport/grid', 'AirportController@grid');
    Route::resource('airport', 'AirportController');

    Route::post('pelni/grid', 'TicketingPelniController@grid');
    Route::resource('pelni', 'TicketingPelniController');

    Route::post('gallery-zakat/grid', 'GalleryZakatController@grid');
    Route::resource('gallery-zakat', 'GalleryZakatController');

    //Rajaongkir
    Route::post('rajaongkir/grid', 'RajaongkirController@grid');
    Route::resource('rajaongkir', 'RajaongkirController');
});

/* User Management */
Route::group(['prefix' => 'user-management', 'namespace' => 'BackEnd\UserManagement', 'middleware' => 'roleAdministration'], function () {
    //User Administration
    Route::post('users-administrations/grid', 'UsersAdminsController@grid');
    Route::resource('users-administrations', 'UsersAdminsController');


    //User Pengguna
    Route::post('users-pengguna/grid', 'UsersPenggunaController@grid');
    Route::resource('users-pengguna', 'UsersPenggunaController');
});

/* Haji & Umroh */
Route::group(['prefix' => 'haji-umroh', 'namespace' => 'BackEnd\HajiUmroh', 'middleware' => 'roleAdministration'], function () {
    //Berita Terbaru
    Route::post('berita-terbaru/grid', 'BeritaTerbaruController@grid');
    Route::resource('berita-terbaru', 'BeritaTerbaruController');
    //Gallery
    Route::post('gallery/grid', 'GalleryController@grid');
    Route::resource('gallery', 'GalleryController');
    //Paket
    Route::post('haji-paket/grid', 'HajiPaketController@grid');
    Route::resource('haji-paket', 'HajiPaketController');

    //Jadwal
    Route::post('haji-jadwal/grid', 'HajiJadwalController@grid');
    Route::resource('haji-jadwal', 'HajiJadwalController');

    //Daftar
    Route::post('haji-daftar/grid', 'HajiDaftarController@grid');
    Route::resource('haji-daftar', 'HajiDaftarController');

    //Feedback
    Route::post('haji-feedback/grid', 'HajiFeedbackController@grid');
    Route::resource('haji-feedback', 'HajiFeedbackController');

    //Angsuran
    Route::post('haji-angsuran/grid', 'HajiAngsuranController@grid');
    Route::resource('haji-angsuran', 'HajiAngsuranController');

    //Rekap
    Route::post('haji-rekap/grid', 'HajiRekapController@grid');
    Route::resource('haji-rekap', 'HajiRekapController');
});

Route::group(['namespace' => 'BackEnd\KakiLima', 'middleware' => 'roleAdministration'], function () {
    Route::post('list-kaki-lima/grid', 'KakiLimaController@grid');
    Route::resource('list-kaki-lima', 'KakiLimaController');
});


Route::get('/logout', 'Auth\LoginController@logout');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('register/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('register/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

// Route::get('/password/reset',function(){
//     Auth::logout();
//     return view('auth.reset');
// });

Route::post('password/email', 'Auth\ResetPasswordController@sendMail');

// forgout password
Route::post('password/change','Auth\ResetPasswordController@resetPassword');

// Route::get('password/email/change/{email}',function(){
//     Auth::logout();
//     return view('auth.passwords.reset');
// });

Route::get('password/reset', 'Auth\ResetPasswordController@index');
