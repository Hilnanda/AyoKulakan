<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use App\Models\Traits\Utilities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\URL;

use Mail;

use App\Mail\RegisterUsersMail;
use App\Mail\ResetPasswordMail;

use App\Models\Master\WilayahNegara;
use App\Models\Master\WilayahProvinsi;
use App\Models\Master\WilayahKota;
use App\Models\Master\WilayahKecamatan;
use App\Models\Lapak\Lapak;

use App\Models\PictureUsers;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Utilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'email', 'phone', 'password', 'username', 'last_activity', 'status','provider','provider_id','id_negara','id_provinsi','id_kota','id_kecamatan','kode_pos'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'sys_users';
    // protected $primaryKey = 'id';

    public function filesMorphClass()
    {
        return 'ayokulakan-users';
    }

    public function pictureusers()
    {
        return $this->morphMany(PictureUsers::class, 'target');
    }

    public function pictureoneusers()
    {
        return $this->morphOne(PictureUsers::class, 'target')->orderBy('created_at','DESC');
    }
    
    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'sys_role_user', 'user_id', 'role_id');
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

    public function sendMails(){
        $urls = URL::full();
        Mail::to($this->email)->send(new RegisterUsersMail($this,'',$urls));
    }

    public function sendMailReset(){
        $urls = '';
        Mail::to($this->email)->send(new ResetPasswordMail($this,'',$urls));
    }

     public function lapak()
    {
        return $this->hasOne(Lapak::class, 'created_by');
    } 

    
}
