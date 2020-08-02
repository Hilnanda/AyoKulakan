<?php

namespace App\Http\Controllers\Notification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification\NotifFeedback;
use App\Models\FeedBack\FeedBack;

use Zipper;
use Carbon\Carbon;
use Auth;

class NotificationController extends Controller
{
    protected $link = 'mess-not/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Notification");
        $this->setGroup("Notification");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Notification' => '#']);
    }

    public function indexNotification(Request $request)
    {     
      $record = [];
      $record = 0;
      $count = 0;
      if(Auth::check()){
        $record = NotifFeedback::where('user_id',auth()->user()->id)->where('review',1)->paginate(10);
        $count = NotifFeedback::where('user_id',auth()->user()->id)->where('review',1)->count();
      }
      return $this->render('notification.index', [
        'record' => $record,
        'count' => $count,
      ]);      
    }

    public function showNotif($id,$review){

      $record = NotifFeedback::find($id);
      $record->review = $review;
      $record->save();

      return $this->render('notification.show', [
        'record' => $record,
      ]);   
    }

    public function showNotifAll(Request $request){

      $record = NotifFeedback::where('user_id',auth()->user()->id)->get();
      return $this->render('notification.show-all', [
        'record' => $record,
      ]);   
    }

    public function store(Request $request){
      // dd($request->all());
      if(isset($request->feed)){
        foreach ($request->feed as $k => $value) {
            foreach ($value as $k1 => $value1) {
              $record = new FeedBack;
              $save['form_type']=$k; 
              $save['form_id']=$value1['form_id']; 
              $save['rate']=$value1['rate']; 
              $save['message']=$value1['message']; 
              $save['user_id']=auth()->user()->id; 
              
              $record->fill($save);
              $record->save();
            }
        }
      }
      return response([
        'status' => true,
        'url' => url('/')
      ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
