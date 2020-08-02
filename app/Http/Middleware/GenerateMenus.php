<?php

namespace App\Http\Middleware;

use Closure;
use Menu;
use Auth;

class GenerateMenus
{
     /**
      * Handle an incoming request.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  \Closure  $next
      * @return mixed
      */
     public function handle($request, Closure $next)
     {
          Menu::make('mainMenu', function ($menu) {
               if (Auth::check()) {
                    // $menu->add('Dashboard','dashboard')->data('icon', 'ion-ios-home')->data('tipe', 'width');

                    // $menu->add('My Account')
                    //          ->data('icon', 'file alternate')->data('tipe', 'width');
                    //     $menu->myAccount->add('Profiles', '#')->data('icon', 'edit');
                    //     $menu->myAccount->add('Barang', '#')->data('icon', 'edit');
                    //     $menu->myAccount->add('Barang', '#')->data('icon', 'edit');

                    if (Auth::check()) {
                         if (auth()->user()->status == 1010) {
                              $menu->add('All Berita', 'berita')->data('icon', 'ion-ios-home')->data('tipe', 'width');
                              $menu->add('All Kurir', 'list-kurir')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                              $menu->add('All Kaki Lima', 'list-kaki-lima')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                              $menu->add('All Lapak', 'data/data-lapak')->data('icon', 'file alternate')->data('tipe', 'width');
                              $menu->add('All Barang', 'data/data-barang')->data('icon', 'file alternate')->data('tipe', 'width');
                              $menu->add('Refound', 'refounds')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                              $menu->add('History Transaksi', 'history-trans')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                         }
                    }

                    $menu->add('List Order Barang', 'list-order')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                    $menu->add('List Order Sewa', 'list-order-rental')->data('icon', 'ion-ios-shop')->data('tipe', 'width');
                    $menu->add('Partner')->data('icon', 'file alternate')->data('tipe', 'width');
                    $menu->partner->add('Partner Kaki Lima', 'partner/partner-kaki-lima')->data('icon', 'edit');
                    $menu->partner->add('Partner Kurir', 'partner/partner-kurir')->data('icon', 'edit');
                    $menu->add('Setting Lapak', 'settings-lapak')->data('icon', 'ion-ios-home')->data('tipe', 'width');
                    $menu->add('Setting Sewa', 'settings-rental')->data('icon', 'ion-ios-home')->data('tipe', 'width');

                    $hajiUmroh = $menu->add('Haji & Umroh')->data('icon', 'users')->data('tipe', 'width');
                    $hajiUmroh->add('Riwayat Pendaftaran', 'haji-umroh/riwayat-pendaftaran/')->data('icon', 'edit');

                    if (Auth::check()) {
                         if (auth()->user()->status == 1010) {

                              $hajiUmroh->add('Berita Terbaru', 'haji-umroh/berita-terbaru')->data('icon', 'edit');
                              $hajiUmroh->add('Gallery Photo', 'haji-umroh/gallery/')->data('icon', 'edit');
                              $hajiUmroh->add('Paket Haji', 'haji-umroh/haji-paket/')->data('icon', 'edit');
                              $hajiUmroh->add('Jadwal Haji', 'haji-umroh/haji-jadwal/')->data('icon', 'edit');
                              $hajiUmroh->add('Daftar Haji', 'haji-umroh/haji-daftar/')->data('icon', 'edit');
                              $hajiUmroh->add('Feedback Haji', 'haji-umroh/haji-feedback/')->data('icon', 'edit');
                              $hajiUmroh->add('Angsuran Haji', 'haji-umroh/haji-angsuran/')->data('icon', 'edit');
                              $hajiUmroh->add('Rekap Haji', 'haji-umroh/haji-rekap/')->data('icon', 'edit');


                              /* Haji & Umroh */

                              $menu->add('Master')
                                   ->data('icon', 'file alternate')->data('tipe', 'width');

                              $menu->master->add('Template Chat', 'master/template/chat')
                                   ->data('icon', 'edit');

                              $menu->master->add('Rajaongkir', 'master/rajaongkir');

                              $menu->master->add('Kategori Barang', 'master/barang/kategori-barang')
                                   ->data('icon', 'edit');
                              $menu->master->add('Sub Kategori Barang', 'master/barang/sub-kategori-barang')
                                   ->data('icon', 'edit');
                              $menu->master->add('Child Kategori Barang', 'master/barang/child-kategori-barang')->data('icon', 'edit');

                              $menu->master->add('PPOB List', 'master/ppob-pulsa')
                                   ->data('icon', 'edit');
                              $menu->master->add('PPOB Provider', 'master/ppob-provider')
                                   ->data('icon', 'edit');
                              $menu->master->add('PPOB Pdam', 'master/ppob-pdam')
                                   ->data('icon', 'edit');


                              $menu->master->add('Tiket Airport', 'master/airport')
                                   ->data('icon', 'edit');
                              $menu->master->add('Tiket Pelni', 'master/pelni')
                                   ->data('icon', 'edit');
                              $menu->master->add('Tiket Stasiun Kereta', 'master/stasiun-kereta')
                                   ->data('icon', 'edit');


                              $menu->master->add('Kategori Rental', 'master/rental/kategori-rental')
                                   ->data('icon', 'edit');
                              $menu->master->add('Sub Kategori Rental', 'master/rental/sub-kategori-rental')
                                   ->data('icon', 'edit');


                              $menu->master->add('Wilayah Negara', 'master/wilayah/negara')
                                   ->data('icon', 'edit');
                              $menu->master->add('Wilayah Provinsi', 'master/wilayah/provinsi')
                                   ->data('icon', 'edit');
                              $menu->master->add('Wilayah Kab / Kota', 'master/wilayah/kab-kota')
                                   ->data('icon', 'edit');
                              $menu->master->add('Wilayah Kecamatan', 'master/wilayah/kecamatan')
                                   ->data('icon', 'edit');

                              $menu->master->add('Aplikasi Data', 'master/aplikasi/data')
                                   ->data('icon', 'edit');
                              $menu->master->add('Aplikasi Panduan & Bantuan', 'master/aplikasi/panduan')
                                   ->data('icon', 'edit');
                              $menu->master->add('Aplikasi Sosial Media', 'master/aplikasi/sosial')
                                   ->data('icon', 'edit');

                              $menu->master->add('Galeri Zakat', 'master/gallery-zakat')
                                   ->data('icon', 'edit');
                              /* User Management */
                              $menu->add('User Management')
                                   ->data('icon', 'users')->data('tipe', 'width');
                              $menu->userManagement->add('Admin / Cs', 'user-management/users-administrations/')
                                   ->data('icon', 'edit');
                              $menu->userManagement->add('User Pembeli / Penjual / Kurir', 'user-management/users-pengguna/')
                                   ->data('icon', 'edit');
                              $menu->userManagement->add('Role & Permission', 'user-management/roles/')
                                   ->data('icon', 'edit');
                         }
                    }
               }
          });

          Menu::make('mainMenuFrontEnd', function ($menuFrontEnd) {
               // $menuFrontEnd->add('Ayokulakan','#')->data('icon', 'fa fa-angle-down')->data('tipe', 'two');
               //     $menuFrontEnd->ayokulakan->add('Tentang', 'ayokulakan/tentang')
               //          ->data('icon', 'edit');
               //     $menuFrontEnd->ayokulakan->add('Aturan Pengguna', 'ayokulakan/aturan-pengguna')
               //          ->data('icon', 'edit');
               //     $menuFrontEnd->ayokulakan->add('Identitas Brand', 'ayokulakan/identitas-brand')
               //          ->data('icon', 'edit');
               //     $menuFrontEnd->ayokulakan->add('Kebijakan Privasi', 'ayokulakan/kebijakan-privasi')
               //          ->data('icon', 'edit');
               //     $menuFrontEnd->ayokulakan->add('Kontak Kami', 'ayokulakan/kontak-kami')
               //          ->data('icon', 'edit');

               $menuFrontEnd->add('Panduan', '#')->data('icon', 'fa fa-angle-down')->data('tipe', 'two');
               $menuFrontEnd->panduan->add('Panduan Pelapak', 'fitur/pelapak/panduan-pelapak')
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Pembeli', 'fitur/pembeli/panduan-pembeli')
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Sewa', 'fitur/rental/sewa')
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Kurir', 'fitur/kurir/panduan-kurir')
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Kaki Lima', 'fitur/kaki-lima/panduan-kaki-lima')
                    ->data('icon', 'edit');
               $menuFrontEnd->panduan->add('Panduan Haji & Umroh', 'fitur/haji-umroh/panduan')
                    ->data('icon', 'edit');
               // $menuFrontEnd->add('Agroteknologi','agroteknologi')->data('icon', '')->data('tipe', 'one');

               $menuFrontEnd->add('Fitur', '#')->data('icon', 'fa fa-angle-down')->data('tipe', 'two');

               $menuFrontEnd->fitur->add('Peta Kaki Lima', 'cari-kaki-lima')
                    ->data('icon', 'edit');
               $menuFrontEnd->fitur->add('Peta Mesjid', 'cari-mesjid')->data('icon', 'edit');

               $menuFrontEnd->fitur->add('Prakiraan Cuaca', 'perkiraan-cuaca')
                    ->data('icon', 'edit');
               $menuFrontEnd->fitur->add('Kalender Tanam', 'kalender-tanam')
                    ->data('icon', 'edit');
               $menuFrontEnd->fitur->add('Pencarian Ikan', 'pencarian-ikan')
                    ->data('icon', 'edit');
               // $menuFrontEnd->fitur->add('Musim Tanam', 'musim-tanam')->data('icon', 'edit');

               $menuFrontEnd->fitur->add('Kurs', 'konversi-mata-uang')
                    ->data('icon', 'edit');

               $menuFrontEnd->add('KAKI LIMA', 'kaki-lima')->data('icon', '')->data('tipe', 'one');

               $menuFrontEnd->add('Kabar Terbaru', 'kabar-terbaru')->data('icon', '')->data('tipe', 'one');
               // $menuFrontEnd->ayokulakan->add('FAQ', 'ayokulakan/faq')
               //      ->data('icon', 'edit');
               $menuFrontEnd->add('YoKuy Kurir', 'yokuy-kurir')->data('icon', '')->data('tipe', 'one');



               $hajiUmroh = $menuFrontEnd->add('Haji & Umroh', '#')->data('icon', 'fa fa-angle-down')->data('tipe', 'two');
               $hajiUmroh->add('Berita Terbaru', 'berita-terbaru/')->data('icon', 'edit');
               $hajiUmroh->add('Gallery Sosial Keagamaan', 'gallery-photo/')->data('icon', 'edit');
               $hajiUmroh->add('Tentang Haji & Umroh', 'tentang-haji-umroh/')->data('icon', 'edit');
               $hajiUmroh->add('Daftar Haji & Umroh', 'daftar-haji-umroh/')->data('icon', 'edit');

               $hajiUmroh = $menuFrontEnd->add('Zakat & Infaq', 'zakat-info')->data('tipe', 'two');
            //   $hajiUmroh->add('Ayo Zakat & Infaq', 'zakat-info')
            //         ->data('icon', 'edit');
               // $hajiUmroh->add('Galeri Zakat & Infaq', 'gallery-zakat-infaq')
               //      ->data('icon', 'edit');
          });
          return $next($request);
     }
}
