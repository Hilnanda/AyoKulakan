<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }
        Carbon::setLocale('id');
        Schema::defaultStringLength(191); //191
        // dd(URL::full());
        Relation::morphMap([
            //Providers
            'img_lapak' => 'App\Models\Lapak\Lapak',
            'img_rental' => 'App\Models\Rental\Rental',
            'img_barang' => 'App\Models\Barang\LapakBarang',
            'img_berita' => 'App\Models\Berita\Berita',
            'img_kaki_lima' => 'App\Models\KakiLima\KakiLima',
            'img_kurir' => 'App\Models\Kurir\Kurir',
            'img_berita_haji' => 'App\Models\HajiUmroh\BeritaTerbaru',
            'img_gallery_haji' => 'App\Models\HajiUmroh\Gallery',
            'img_daftar_haji' => 'App\Models\HajiUmroh\HajiDaftar',
            'ayokulakan-users' => 'App\Models\Users',

            'list_ppob' => 'App\Models\Master\PPOBPulsa',
            'ppob_pdam' => 'App\Models\Master\PPOBPdam',
            'img_ppob_provider' => 'App\Models\Master\PPOBPulsaProvider',
            'trans_kereta' => 'App\Models\Master\TicketingStatsiunKereta',
            'img_gallery_zakat' => 'App\Models\Master\GalleryZakat',
            'img_kategori_barang' => 'App\Models\Master\KategoriBarang',
            'img_sub_kategori_barang' => 'App\Models\Master\KategoriBarangSub',
            
            'img_kategori_rental' => 'App\Models\Master\KategoriRental',

            'rajaongkir' => 'App\Models\Master\Rajaongkir',
        ]);
        Blade::withoutDoubleEncoding();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
