<?php

namespace App\Models\Favorit;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;



class LikeFavoritBarang extends Model
{
    protected $table 		= 'trans_like_favorit_barang';
    protected $log_table 	= 'log_trans_like_favorit_barang';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
       	'user_id',
		'id_barang',
		'created_by',
        'jumlah_barang',
        'status',
        'form_id',
		'form_type',
      ];

    public function form()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function barang()
    {
        return $this->belongsTo(LapakBarang::class, 'id_barang');
    }


}
