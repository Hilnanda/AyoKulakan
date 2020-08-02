<?php

namespace App\Models\Master;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;


class Rajaongkir extends Model
{
    protected $table 		= 'ref_rajaongkir';
    protected $fillable 	= ['nama','code'];

    public function filesMorphClass()
    {
        return 'rajaongkir';
    }

    public function attachment()
    {
        return $this->morphOne(Attachments::class, 'target')->orderBy('created_at','DESC');
    }
}
