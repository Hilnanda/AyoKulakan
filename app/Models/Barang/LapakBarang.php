<?php

namespace App\Models\Barang;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;
use App\Models\Lapak\Lapak;
use App\Models\Master\KategoriBarang;
use App\Models\Master\KategoriBarangSub;
use App\Models\Master\KategoriBarangChild;
use App\Models\Feedback\Feedback;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;

class LapakBarang extends Model
{
    protected $table 		= 'trans_lapak_barang';
    protected $log_table 	= 'log_trans_lapak_barang';
    protected $log_table_fk	= 'id_trans';
    protected $fillable 	= [
        'id_trans_lapak',
        'nama_barang',
        'deskripsi_barang',
        'satuan_barang',
        'harga_barang',
        'id_kategori',
        'id_sub_kategori',
        'id_child_kategori',
        'berat_barang',
        'stock_barang',
        'barang_terjual',
        'minimum_pembelian',
        'kondisi_barang',
        'merek',
        'expired',
        'status_barang',
        'attribut_barang','created_by'];

	public function filesMorphClass()
    {
        return 'img_barang';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target')->orderBy('created_at','desc');
    }

    public function attacOne()
    {
        return $this->morphOne(Attachments::class, 'target')->orderBy('created_at','desc');
    }

    public function lapak()
    {
        return $this->belongsTo(Lapak::class, 'id_trans_lapak');
    }

    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class, 'id_kategori');
    }

    public function subKategoriBarang()
    {
        return $this->belongsTo(KategoriBarangSub::class, 'id_sub_kategori');
    }

    public function childKategoriBarang()
    {
        return $this->belongsTo(KategoriBarangChild::class, 'id_child_kategori');
    }

    public function favorit()
    {
        return $this->hasMany(FavoritBarang::class, 'id_barang');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'form_id');
    }

    public function trans_detail()
    {
        return $this->morphMany(TransaksiAmpaseBarangDetail::class, 'form');
    }

}
