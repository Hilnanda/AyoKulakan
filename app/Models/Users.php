<?php

namespace App\Models;

use App\Models\Model;
use App\Models\User;
use App\Models\PictureUsers;
use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;
use App\Models\Lapak\Lapak;

// GRAFIK
use App\Models\Kurir\Kurir;
use App\Models\Rental\Rental;
use App\Models\KakiLima\KakiLima;

class Users extends Model
{
    protected $table 		= 'sys_users';
    protected $fillable 	= ['nama', 'email', 'password', 'username', 'last_activity', 'status', 'ipAddress','alamat','gender','hp','provider','provider_id','id_negara','id_provinsi','id_kota','id_kecamatan','kode_pos'];

    public function filesMorphClass()
    {
        return 'ayokulakan-users';
    }

    public function pictureusers()
    {
        return $this->morphMany(PictureUsers::class, 'target')->orderBy('created_at','DESC');
    }

    public function pictureoneusers()
    {
        return $this->morphOne(PictureUsers::class, 'target')->orderBy('created_at','DESC');
    }

    public function scopeByUsersAdmin($query)
    {
        return $query->whereIn('status', ['1010','1011']);
    }

    public function scopeByUsersPengguna($query)
    {
        return $query->where('status', '1013');
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

    public function lapak()
    {
        return $this->hasOne(Lapak::class, 'created_by');
    } 

    // REALTIONS FOR GRAFIK
    public function kurir(){
        return $this->hasOne(Kurir::class,'user_id');
    }

    public function rental(){
        return $this->hasOne(Rental::class,'created_by');
    }

    public function kakilima(){
        return $this->hasOne(KakiLima::class,'created_by');
    }
}
