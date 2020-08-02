<?php

namespace App\Models\Notification;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use Mpociot\Firebase\SyncsWithFirebase;
class NotifFeedback extends Model
{
    use SyncsWithFirebase;
    protected $table 		= 'notification_feedback';
    protected $fillable 	= [
        'trans_id',
        'judul',
        'message',
        'user_id',
        'status',
        'review',
    ];

    public function trans(){
        return $this->belongsTo(TransaksiAmpase::class,'trans_id');
    }
}
