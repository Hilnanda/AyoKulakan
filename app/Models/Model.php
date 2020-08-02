<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Base;
use App\Models\Traits\EntryBy;
use App\Models\Traits\RaidModel;
use App\Models\Traits\Utilities;
use App\Models\Attachments;
use App\Models\Picture;
use App\Models\DaftarHadir;

use Carbon\Carbon;

class Model extends Base
{
    use RaidModel, Utilities, EntryBy;

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray($append=true)
    {
    	if(!$append){
	        return $this->attributes;
    	}
        return array_merge($this->attributesToArray(), $this->relationsToArray());
    }

    public static function getLastId()
    {
        return Static::orderBy('id', 'DESC')->first()->id + 1;
    }
}
