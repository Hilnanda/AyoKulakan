<?php

use App\Helpers\Rajaongkir\Rajaongkir;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('rajaongkir/province', 'Api\RajaongkirController@province');
Route::get('rajaongkir/province/{id}', 'Api\RajaongkirController@province');
Route::get('rajaongkir/city', 'Api\RajaongkirController@city');
Route::get('rajaongkir/city/{id}', 'Api\RajaongkirController@city');
Route::get('rajaongkir/cost', 'Api\RajaongkirController@cost');

Route::get('/cari-lokasi-terdekat', 'Api\Map\MapController');
Route::get('/wilayah/negara', 'Api\WilayahController@getCountry');
Route::get('/wilayah/negara/{id}/provinsi', 'Api\WilayahController@getProvince');

Route::group(['prefix' => 'darmawisata', 'namespace' => 'API\Darmawisata'], function () {
	Route::group(['airline'],function () {
		// API Airline Route
		Route::get('/list', 'AirlineController@getAirline');
		Route::get('/nationality', 'AirlineController@getAirlineNationality');
		Route::get('/route', 'AirlineController@getAirlineRoute');
		Route::get('/lowFareRoute', 'AirlineController@getAirlineLowFareRoute');
		Route::get('/scheduleAllAirline', 'AirlineController@getScheduleAllAirline');
		Route::get('/priceAllAirline', 'AirlineController@getPriceAllAirline');
		Route::get('/schedule', 'AirlineController@getAirlineSchedule');
		Route::get('/price', 'AirlineController@getPriceAirline');
		Route::get('/cities', 'AirlineController@getCities');
		Route::get('/baggageAndMeal', 'AirlineController@getBaggageAndMeal');
		Route::get('/seat', 'AirlineController@getSeat');
		Route::get('/booking', 'AirlineController@getBookingList');
		Route::get('/booking/detail', 'AirlineController@getBookingDetail');

		// Set Data
		Route::post('/booking', 'AirlineController@setBooking');
		Route::post('/issued', 'AirlineController@setIssued');
	});

	Route::group(['prefix' => 'hotel'],function () {
		Route::get('/country', 'HotelController@getCountry');
		Route::get('/passport', 'HotelController@getPassport');
		Route::get('/city', 'HotelController@getCity');
		Route::get('/city/all', 'HotelController@getAllCountryAllCity');
		Route::get('/search', 'HotelController@searchAllSupplier');
		Route::get('/search/rooms', 'HotelController@searchAvailableRooms');
		Route::get('/images', 'HotelController@getHotelImages');
		Route::get('/price', 'HotelController@getPriceAndPolicyInfo');

		Route::post('/booking', 'HotelController@setBookingAllSupplier');
		Route::post('/issued', 'HotelController@setIssued');

		Route::get('/booking', 'HotelController@getBookingList');
		Route::get('/booking/detail', 'HotelController@getBookingDetail');
		Route::get('/info', 'HotelController@getDetailInfo');
	});

	Route::group(['prefix' => 'bus'],function () {
		Route::get('/', 'BusController@getBusList');
		Route::get('/route', 'BusController@getBusRoute');
		Route::get('/schedule', 'BusController@getBusSchedule');
		Route::get('/seat-map', 'BusController@getBusSeatMap');

		Route::post('/booking', 'BusController@setBusBooking');
		Route::post('/issued', 'BusController@setBusIssued');

		Route::get('/booking', 'BusController@getBusBookingList');
		Route::get('/booking/detail', 'BusController@getBusBookingDetail');
	});
	
	Route::post('/', 'DarmawisataController@login');
	Route::post('/coba', 'DarmawisataController@coba');
});



Route::group(['prefix' => 'berita', 'namespace' => 'API\Berita'], function () {
	Route::get('/{id}', 'BeritaController@show');
	Route::resource('/', 'BeritaController');
});

Route::group(['namespace' => 'API\HajiUmroh'], function () {
	Route::group(['prefix' => 'hajiumroh'], function () {

		Route::post('berita-terbaru/{id}', 'BeritaTerbaruController@update');
		Route::get('berita-terbaru/{id}', 'BeritaTerbaruController@show');
		Route::delete('berita-terbaru/{id}', 'BeritaTerbaruController@destroy');
		Route::resource('/berita-terbaru', 'BeritaTerbaruController');


		Route::post('gallery/{id}', 'GalleryController@update');
		Route::get('gallery/{id}', 'GalleryController@show');
		Route::delete('gallery/{id}', 'GalleryController@destroy');
		Route::resource('/gallery', 'GalleryController');

		Route::post('haji-angusr/{id}', 'HajiAngsuranController@update');
		Route::get('haji-angusr/{id}', 'HajiAngsuranController@show');
		Route::delete('haji-angusr/{id}', 'HajiAngsuranController@destroy');
		Route::resource('/haji-angsur', 'HajiAngsuranController');

		Route::post('/haji-daftar', 'HajiDaftarController@store');

		Route::post('haji-feedback/{id}', 'HajiFeedbackController@update');
		Route::get('haji-feedback/{id}', 'HajiFeedbackController@show');
		Route::delete('haji-feedback/{id}', 'HajiFeedbackController@destroy');
		Route::resource('/haji-feedback', 'HajiFeedbackController');

		Route::post('haji-jadwal/{id}', 'HajiJadwalController@update');
		Route::get('haji-jadwal/{id}', 'HajiJadwalController@show');
		Route::delete('haji-jadwal/{id}', 'HajiJadwalController@destroy');
		Route::resource('/haji-jadwal', 'HajiJadwalController');

		Route::post('haji-paket/{id}', 'HajiPaketController@update');
		Route::get('haji-paket/{id}', 'HajiPaketController@show');
		Route::delete('haji-paket/{id}', 'HajiPaketController@destroy');
		Route::resource('/haji-paket', 'HajiPaketController');

		Route::post('haji-rekap/{id}', 'HajiRekapController@update');
		Route::get('haji-rekap/{id}', 'HajiRekapController@show');
		Route::delete('haji-rekap/{id}', 'HajiRekapController@destroy');
		Route::resource('/haji-rekap', 'HajiRekapController');
	});
});

Route::group(['prefix' => 'v0', 'namespace' => 'APIV0'], function () {
	Route::post('ppob/telepon_rumah', 'PpobControl@telepon_rumah')->name("ppob.telepon_rumah");
	Route::post('maps/cari_kl', 'MapsControl@cari_kl')->name("maps.cari_kl");
});

Route::group(['namespace' => 'API\Trans'], function () {

	Route::group(['prefix' => 'transaksi'], function () {
		Route::resource('/rental', 'TransaksiRentalController');
		Route::resource('/barang', 'TransaksiBarangController');

		Route::post('/notif', 'TransaksiController@getNotif');
		Route::post('/approve/{id}', 'TransaksiController@approve');
		Route::post('/expier/{id}', 'TransaksiController@expiers');
		Route::post('/cancel/{id}', 'TransaksiController@cancel');
		Route::post('/capture/{id}', 'TransaksiController@capture');
		Route::get('/{id}', 'TransaksiController@show');
		Route::resource('/', 'TransaksiController');
	});

	Route::group(['prefix' => 'midtrans'], function () {
		Route::get('/token-credit-card', 'MidtransController@getTokenCredit');
		Route::resource('/', 'MidtransController');

	});


});

Route::group(['prefix' => 'mobilpulsa', 'namespace' => 'API\MobilPulsa'], function () {
	Route::post('/callback', 'MobilPulsaController@callback');
});

Route::group(['prefix' => 'ppob', 'namespace' => 'API\PPOB'], function () {
	Route::group(['prefix' => 'list'], function () {
		Route::get('/{id}', 'PPOBListController@show');
		Route::resource('/', 'PPOBListController');
	});

	Route::group(['prefix' => 'pdam'], function () {
		Route::get('/{id}', 'PPOBPdamController@show');
		Route::resource('/', 'PPOBPdamController');
	});

	Route::group(['prefix' => 'pasca'], function () {
		Route::get('/plnprabayar', 'PPOBInqueryController@getPLNPrabayar');
		Route::get('/', 'PPOBInqueryController@getInquery');
		Route::post('/', 'PPOBInqueryController@store');
	});

	Route::group(['prefix' => 'provider'], function () {
		Route::get('/filter', 'PPOBPulsaController@filter');
		Route::get('/{id}', 'PPOBPulsaController@show');
		Route::resource('/', 'PPOBPulsaController');
	});
});

Route::group(['prefix' => 'kereta', 'namespace' => 'API\Ticketing'], function () {
	Route::post('/', 'TiketKeretaController@store');

	Route::group(['prefix' => 'search'], function () {
		Route::get('/', 'TiketKeretaController@search');
		Route::get('/seat', 'TiketKeretaController@searchSeat');
	});

	Route::group(['prefix' => 'destination'], function () {
		Route::get('/{id}', 'TiketKeretaController@show');
		Route::resource('/', 'TiketKeretaController');
	});
});

Route::group(['prefix' => 'pesawat', 'namespace' => 'API\Ticketing'], function () {
	Route::get('/{id}', 'TiketPesawatController@show');
	Route::resource('/', 'TiketPesawatController');
});

Route::group(['namespace' => 'API\CreditCard'], function () {
	Route::get('/credit-card/{id}', 'CreditCardController@show');
	Route::post('/credit-card/{id}', 'CreditCardController@update');
	Route::delete('/credit-card/{id}', 'CreditCardController@destroys');
	Route::resource('/credit-card', 'CreditCardController');
});

Route::group(['namespace' => 'API\Profile'], function () {
	Route::get('/profile/{id}', 'ProfileController@show');
	Route::post('/profile/{id}', 'ProfileController@update');
});

Route::group(['prefix' => 'pencarian', 'namespace' => 'API\Pencarian'], function () {
	Route::get('/barang', 'PencarianBarangController@index');
	Route::get('/rental', 'PencarianBarangController@indexRental');
});


Route::group(['prefix' => 'login', 'namespace' => 'API\Login'], function () {
	Route::post('/', 'LoginController@index');
	Route::post('/phone', 'LoginController@loginPhone');
	Route::post('/social', 'LoginController@loginProviders');
	// Route::post('/social/register', 'LoginController@createLoginProvider');
	// Route::get('/{facebook}', 'LoginController@redirectToProvider');
	// Route::post('/google', 'LoginController@googles');
});

Route::group(['prefix' => 'register', 'namespace' => 'API\Register'], function () {
	Route::post('/', 'RegisterController@index');
});

Route::group(['prefix' => 'zakat', 'namespace' => 'API\Zakat'], function () {
	Route::post('/profesi', 'ZakatController@profesi');
	Route::post('/maal', 'ZakatController@maal');

	Route::get('/gallery', 'ZakatController@gallery');
	Route::get('/gallery/{id}', 'ZakatController@galleryOne');
});

Route::group(['prefix' => 'rental', 'namespace' => 'API\Rental'], function () {
	// Route::get('/', 'BarangController@index');
	Route::get('/{id}', 'RentalController@show');
	Route::post('/{id}', 'RentalController@update');
	Route::delete('/{id}', 'RentalController@destroys');
	Route::resource('/', 'RentalController');
});

Route::group(['prefix' => 'kurir', 'namespace' => 'API\Kurir'], function () {
	// Route::get('/', 'BarangController@index');
	Route::get('/{id}', 'KurirController@show');
	Route::post('/{id}', 'KurirController@update');
	Route::delete('/{id}', 'KurirController@destroys');
	Route::resource('/', 'KurirController');
});

Route::group(['prefix' => 'kakilima', 'namespace' => 'API\KakiLima'], function () {
	Route::get('/{id}', 'KakiLimaController@show');
	Route::post('/{id}', 'KakiLimaController@update');
	Route::resource('/', 'KakiLimaController');
});

Route::group(['prefix' => 'barang', 'namespace' => 'API\Barang'], function () {
	// Route::get('/', 'BarangController@index');
	Route::get('/current/{id}', 'BarangController@showCurrentLocation');
	Route::get('/{id}', 'BarangController@show');
	Route::post('/{id}', 'BarangController@update');
	Route::delete('/{id}', 'BarangController@destroys');
	Route::resource('/', 'BarangController');
});

Route::group(['prefix' => 'favorit-barang', 'namespace' => 'API\Barang'], function () {

	Route::get('/{id}', 'FavoritBarangController@show');
	Route::post('/{id}', 'FavoritBarangController@update');
	Route::delete('/{id}', 'FavoritBarangController@destroys');
	Route::resource('/', 'FavoritBarangController');
});
// Route::group(['middleware' => 'auth:api'], function(){
Route::group(['prefix' => 'lapak', 'namespace' => 'API\Lapak'], function () {
	Route::post('/{id}', 'LapakController@update');
	Route::get('/{id}', 'LapakController@show');
	Route::delete('/{id}', 'LapakController@destroy');
	Route::resource('/', 'LapakController');
});
// });




Route::group(['namespace' => 'API\Master'], function () {

	Route::group(['prefix' => 'kapal-laut'], function () {
		Route::get('/{id}', 'PelniController@show');
		Route::resource('/', 'PelniController');
	});

	Route::group(['prefix' => 'kategori'], function () {
		Route::get('/barang', 'KategoriBarangController@index');
		Route::get('/barang/subchild', 'KategoriBarangController@subBarang');
		Route::get('/barang/child', 'KategoriBarangController@childBarang');

		Route::get('/rental', 'KategoriRentalController@index');
		Route::get('/rental/child', 'KategoriRentalController@indexSub');

		Route::get('/rental/{id}', 'KategoriRentalController@show');
		Route::get('/rental/child/{id}', 'KategoriRentalController@showSub');
	});

	Route::group(['prefix' => 'wilayah'], function () {
		Route::get('/negara', 'Api\WilayahController@getCountry');
		Route::get('/negara/{id}', 'WilayahController@showNegara');

		Route::get('/provinsi', 'WilayahController@provinsi');
		Route::get('/provinsi/{id}', 'WilayahController@showProvinsi');

		Route::get('/kota/current', 'WilayahController@currentKota');
		Route::get('/kota', 'WilayahController@kota');
		Route::get('/kota/{id}', 'WilayahController@showKota');

		Route::get('/kecamatan', 'WilayahController@kecamatan');
		Route::get('/kecamatan/{id}', 'WilayahController@showKecamatan');
	});

	Route::group(['prefix' => 'master'], function () {
		Route::get('/rajaongkir/{id}', 'RajaongkirController@show');
		Route::resource('/rajaongkir', 'RajaongkirController');
	});

	Route::group(['prefix' => 'aplikasi'], function () {
		Route::get('/', 'AplikasiController@index');
		Route::get('/aturan', 'AplikasiController@aturanPengguna');
		Route::get('/privasi', 'AplikasiController@kebijakanPrivasi');
		Route::get('/brand', 'AplikasiController@identitasBrand');
		Route::get('/kontak', 'AplikasiController@kontakKami');
		Route::get('/panduanpelapak', 'AplikasiController@panduanPelapak');
		Route::get('/panduanpembeli', 'AplikasiController@panduanPembeli');
		Route::get('/bantuan', 'AplikasiController@bukaBantuan');
		Route::get('/haji', 'AplikasiController@panduanHaji');
		Route::get('/kurir', 'AplikasiController@panduanKurir');
		Route::get('/sosial', 'AplikasiController@sosialMedia');
	});
});




Route::group(['prefix' => 'jadwal-sholat', 'namespace' => 'API\JadwalSholat'], function () {
	Route::resource('/', 'JadwalSholatController');
});

Route::group(['prefix' => 'reset', 'namespace' => 'API\ResetPassword'], function () {
	Route::get('/', 'ResetPasswordController@index');
	Route::post('/', 'ResetPasswordController@store');
});

Route::group(['prefix' => 'location', 'namespace' => 'API\Location'], function () {
	Route::get('/', 'LocationController@index');
	Route::get('/state', 'LocationController@state');
});

Route::group(['prefix' => 'like', 'namespace' => 'API\FavoritBarang'], function () {
	Route::post('/', 'LikeFavoritBarangController@update');
	Route::get('/{id}', 'LikeFavoritBarangController@show');
	Route::delete('/{id}', 'LikeFavoritBarangController@destroy');
	Route::resource('/', 'LikeFavoritBarangController');
});

Route::group(['prefix' => 'xample-email', 'namespace' => 'API\XampleMail'], function () {
	Route::post('/', 'XampleMailController@index');
});

Route::group(['prefix' => 'grafik', 'namespace' => 'API\Grafik'], function () {
	Route::get('/jumlah/all', 'GrafikController@index');
	Route::get('/jumlah/kurir', 'GrafikController@kurir');
	Route::get('/jumlah/rental', 'GrafikController@rental');
	Route::get('/jumlah/kakilima', 'GrafikController@kakilima');

	Route::get('/jumlah/barang', 'GrafikController@barang');
	Route::get('/jumlah/sewa', 'GrafikController@sewa');

	Route::get('/transaksi/barang', 'GrafikDataPenjualanController@index');
	Route::get('/transaksi/rental', 'GrafikDataPenjualanController@rental');
	Route::get('/transaksi/haji', 'GrafikDataPenjualanController@haji');
	Route::get('/transaksi/kakilima', 'GrafikDataPenjualanController@kakilima');
	Route::get('/transaksi/ppob', 'GrafikDataPenjualanController@ppob');
	Route::get('/transaksi/kereta', 'GrafikDataPenjualanController@kereta');
});


Route::namespace('API\Rajaongkir')->group(function () {
	Route::prefix('rajaongkir')->group(function () {
		Route::get('/cost', 'RajaongkirController@cost');
	});
});
