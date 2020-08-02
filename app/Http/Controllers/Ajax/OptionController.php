<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Master\KategoriBarangSub;
use App\Models\Master\KategoriBarangChild;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;

use App\Models\Master\KategoriRental;
use App\Models\Master\KategoriRentalSub;

use App\Models\Master\PPOBPulsa;
use App\Models\Master\PPOBPulsaProvider;

use App\Models\Master\DarmaHotelKota;
use App\Models\Master\DarmaHotelNegara;

use App\Models\Barang\LapakBarang;
use App\Models\Lapak\Lapak;
use App\Models\Rental\Rental;
use App\Models\HajiUmroh\HajiJadwal;

use App\Helpers\HelpersPPOB;

use DataTables;

class OptionController extends Controller
{
    public function showSubKategori($id)
    {
        return KategoriBarangSub::options('sub_nama', 'id', ['filters' => ['id_kategori' => $id]], '( Pilih Sub Kategori )');
    }

    public function showSubKategoriRental($id)
    {
        return KategoriRentalSub::options('nama', 'id', ['filters' => ['trans_kategori_id' => $id]], '( Pilih Sub Kategori )');
    }

    public function showSubChildKategori($id)
    {
        return KategoriBarangChild::options('nama', 'id', ['filters' => ['id_sub_kategori' => $id]], '( Pilih Sub Kategori )');
    }

    public function showSubProvinsi($id)
    {
        return WilayahProvinsi::options('provinsi', 'id', ['filters' => ['id_negara' => $id]], '( Pilih Provinsi )');
    }

    public function showSubKota($id)
    {
        return WilayahKota::options('kota', 'id', ['filters' => ['id_provinsi' => $id]], '( Pilih Kab/Kota )');
    }

    public function showSubKecamatan($id)
    {
        return WilayahKecamatan::options('kecamatan', 'id', ['filters' => ['id_kota' => $id]], '( Pilih Kecamatan )');
    }

    public function showBarang($id)
    {
        return LapakBarang::options('nama_barang', 'id', ['filters' => ['id_trans_lapak' => $id]], '( Pilih Barang )');
    }

    public function showRental($id)
    {
        $lapak = Lapak::find($id);
        $arr = [];
        if($lapak){
            $arr = Rental::options('judul', 'id', ['filters' => ['created_by' => $lapak->created_by]], '( Pilih Rental )');
        }
        return $arr;
    }

    public static function PPOBPulsa($type,$value){
        $provider = PPOBPulsaProvider::where('code',$value)->where('type',$type)->first();
        $return = [];
        if($provider){
            $return = HelpersPPOB::cekData($type,$provider->name);
        }
        return $return;
    }

    public function showJadwalPaket($id)
    {
        return HajiJadwal::options('judul', 'id', ['filters' => ['paket_id' => $id]], '( Pilih Jadwal )');
    }

    public function darmawisataHotelKota($id){
        $record = DarmaHotelNegara::where('code',$id)->first();
        $result = [];
        if($record){
            $result = DarmaHotelKota::options('name','code',['filters' => [ 'id_negara' => $record->id ]],'( Pilih Salah Satu )');
        }

        return $result;
    }
    
}
