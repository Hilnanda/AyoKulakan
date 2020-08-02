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


class ChatDetail extends Model
{
    use SyncsWithFirebase;
    protected $table 		= 'trans_chat_detail';
    protected $fillable 	= [
        'trans_id',
        'chat',
        'status',
        'boot_chat',
        'created_at'
    ];

    // protected $visible = [
    //     'id', 
    //     'title',
    //     'chat',
    //     'id_barang',
    //     'id_lapak',
    //     'id_user_chat_to',
    //     'status',
    //     'boot_chat',
    //     'created_by',
    //     'lapak',
    //     'lapak_barang',
    // ];

    public function lapak(){
        return $this->belongsTo(Lapak::class, 'id_lapak');
    }

    public function lapakBarang(){
        return $this->belongsTo(LapakBarang::class, 'id_barang');
    }

    public function chatUser(){
        $this->belongsTo(Users::class, 'id_user_chat_to');
    }

}
