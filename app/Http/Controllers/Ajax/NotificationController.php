<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\System\Notification;
use App\Models\Induksi\Induksi;

use DataTables;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function user()
    {
        $notification = Notification::where('user_id', auth()->user()->user_id)->where('status', 0)->orderBy('created_at', 'DESC')->get();
        $return['count'] = 0;

        foreach($notification as $n)
        {
            $return['notification'][] = [
                'content' => $n->content,
                'id' => $n->id,
                'url' => '#',
            ];
            $return['count']++;
        }

        if(auth()->user()->canPerm('induction-approval'))
        {
          $today = new Carbon();
          if($today->dayOfWeek == Carbon::THURSDAY)
          {
              $induksi = Induksi::where('proyek_id', auth()->user()->showOnProject())->where('status', 1)->count();
              if($induksi > 0)
              {
                $return['notification'][] = [
                    'content' => 'Ada '.$induksi.' File Induksi yang belum anda approve / reject di minggu ini',
                    'id' => '0',
                    'url' => 'induksi/upload',
                ];
                $return['count']++;
              }
          }
        }

        return $return;
    }
    public function url($id)
    {
        $return = Notification::find($id);
        $return->status = 1;
        $return->save();

        return redirect(url($return->url));
    }
}
