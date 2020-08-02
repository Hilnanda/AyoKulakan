<?php

namespace App\Models\Rental;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;


use App\Models\Master\KategoriRental;
use App\Models\Master\KategoriRentalSub;
use App\Models\Feedback\Feedback;

class Rental extends Model
{
    protected $table 		= 'trans_rental';
     protected $log_table 	= 'log_trans_rental';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
    	'judul',
    	'keterangan',
    	'status',
    	'kategori_id',
    	'sub_kategori_id',
    	'unit',
        'unit_tersewa',
        'harga_sewa',
        'waktu_sewa',
    	'rating'
    ];

    public function filesMorphClass()
    {
        return 'img_rental';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriRental::class, 'kategori_id');
    }

    public function sub_kategori()
    {
        return $this->belongsTo(KategoriRentalSub::class, 'sub_kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'form_id');
    }
}
