<?php

namespace App\Http\Controllers\Picture;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification\NotifFeedback;
use App\Models\FeedBack\FeedBack;

use Zipper;
use Carbon\Carbon;
use Auth;

class PictureController extends Controller
{
    protected $link = 'picture/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Picture");
        $this->setGroup("Picture");
        $this->setModalSize("mini");
        $this->setBreadcrumb(['Picture' => '#']);
    }

    public function bulkUnlink(Request $request)
    {
        try {
            if($request->filedelete)
            {
                foreach($request->filedelete as $filedelete)
                {
                    if(file_exists(storage_path().'/app/public/'.$filedelete))
                    {
                        unlink(storage_path().'/app/public/'.$filedelete);
                    }
                }
            }
        } catch (Exception $e) {
              return response([
                'status' => false,
                'errors' => $e
            ]);
        }

        return response([
            'status' => true,
        ]);
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
