<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class PPOBPulsaProvider extends Model
{
    protected $table 		= 'ref_ppob_pulsa_provider';
    protected $fillable 	= [
    	'code',
		'name',
        'status',
        'type',
		'deskripsi',
    ];

    public function filesMorphClass()
    {
        return 'img_ppob_provider';
    }

    public function attachments()
    {
        return $this->morphMany(Attachments::class, 'target');
    }
}
