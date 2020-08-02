<?php

namespace App\Models\Refound;

use App\Models\Model;
use App\Models\Roles;
use App\Models\Users;
use App\Models\Files;
use App\Models\Attachments;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\Barang\LapakBarang;
use App\Models\Lapak\Lapak;


class Refound extends Model
{
    protected $table        = 'trans_refound';
    protected $log_table    = 'log_trans_refound';
    protected $log_table_fk = 'log_trans_id';
    protected $fillable     = [
        'trans_id',
        'form_id',
        'form_type',
        'status',
        'lapak_id'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(TransaksiAmpase::class, 'trans_id');
    }   

    public function lapak()
    {
        return $this->belongsTo(Lapak::class, 'lapak_id');
    }   

    public function form()
    {
        return $this->morphTo();
    }   

    public function typeLabel()
    {
        switch($this->form_type) {
            case 'img_barang' : return 'Barang';
            break;
            case 'img_rental' : return 'Rental';
            break;
           
        }
    }
}
