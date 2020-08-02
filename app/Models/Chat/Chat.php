<?php

namespace App\Models\Chat;

use App\Models\Model;
use App\Models\Roles;
use App\Models\Users;
use App\Models\Files;
use App\Models\Attachments;
use App\Models\Barang\LapakBarang;
use App\Models\Lapak\Lapak;


use Mpociot\Firebase\SyncsWithFirebase;


class Chat extends Model
{
    use SyncsWithFirebase;
    protected $table 		= 'trans_chat';
    protected $fillable 	= [
        'form_type',
        'form_id',
        'id_lapak',
        'id_user_chat_to',
        'status',
        'created_by'
    ];


    public function form()
    {
        return $this->morphTo();
    }

    public function detail(){
        return $this->hasMany(ChatDetail::class, 'trans_id');
    }

    public function lapak(){
        return $this->belongsTo(Lapak::class, 'id_lapak');
    }

    public function lapakBarang(){
        return $this->belongsTo(LapakBarang::class, 'id_barang');
    }

    public function chatUser(){
        $this->belongsTo(Users::class, 'id_user_chat_to');
    }

    public function createds(){
        $this->belongsTo(Users::class, 'created_by');
    }

}
