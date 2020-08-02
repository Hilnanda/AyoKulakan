<?php

namespace App\Models\Kurir;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class Kurir extends Model
{
    protected $table        = 'trans_kurir';
    protected $log_table    = 'log_trans_kurir';
    protected $log_table_fk = 'trans_id';
    // protected $fillable 	= [
    //     'user_id',
    //     'nik',
    //     'kendaraan',
    //     'sim',
    //     'km',
    //     'kg',
    //     'rating',
    //     'status',
    // ];

    protected $guarded = [];

    public function filesMorphClass()
    {
        return 'img_kurir';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getKendaraan()
    {
        switch ($this->kendaraan) {
            case 1:
                return 'Motor';
                break;
            case 2:
                return 'Mobil';
                break;
            case 3:
                return 'Mobil & Motor';
                break;
        }
    }

    public function getSim()
    {
        switch ($this->sim) {
            case 1:
                return 'A';
                break;
            case 3:
                return 'C';
                break;
            case 6:
                return 'A & C';
                break;
        }
    }
}
