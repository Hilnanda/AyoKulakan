<?php

namespace App\Models\Lapak;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;
use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;
use App\Models\Barang\LapakBarang;
use App\Models\Master\KategoriBarang;

class Lapak extends Model
{
    protected $table 		= 'trans_lapak';
    protected $log_table 	= 'log_trans_lapak';
    protected $log_table_fk	= 'id_trans';
    protected $fillable 	= ['nama_lapak','deskripsi_lapak','alamat_lapak','phone','last_active','id_negara','id_provinsi','id_kota','id_kecamatan','kode_pos','deskripsi','created_by'];

	public function filesMorphClass()
    {
        return 'img_lapak';
    }


    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target');
    }

    public function attachment()
    {
        return $this->morphOne(Attachments::class, 'target');
    }

    public function negara()
    {
        return $this->belongsTo(WilayahNegara::class, 'id_negara');
    }    

    public function provinsi()
    {
        return $this->belongsTo(WilayahProvinsi::class, 'id_provinsi');
    }   

    public function kota()
    {
        return $this->belongsTo(WilayahKota::class, 'id_kota');
    }  

    public function kecamatan()
    {
        return $this->belongsTo(WilayahKecamatan::class, 'id_kecamatan');
    } 

    public function barang()
    {
        return $this->hasMany(LapakBarang::class, 'id_trans_lapak');
    } 
    public function lapakKategori()
    {
        return $this->belongsTo(KategoriBarang::class);
    }


}
