<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Files;
use App\Models\Attachments;
use App\Models\DaftarHadir;
use App\Models\Rapatk3\RapatBeritaAcara;

use Zipper;
use Carbon\Carbon;

class DownloadController extends Controller
{

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index($id)
    {
        $check = Files::find($id);
        // dd(public_path('storage/'.$check->url));
        if(file_exists(public_path('storage/'.$check->url)))
        {
            // dd('asd');
            return response()->download(storage_path('app/public/'.$check->url), $check->filename);
        }

        return $this->render('failed.file');
    }

    public function picture($id)
    {
        $check = Attachments::find($id);
        
        if(file_exists(public_path('storage/'.$check->url)))
        {
            return response()->download(public_path('storage/'.$check->url), $check->filename);
        }

        return $this->render('failed.file');
    }

    public function multipleDownloadFile($id, $type)
    {
        if($type != "undefined")
        {
            $check = Files::where('target_id', $id)->where('target_type', $type)->get();
            $files = [];
            if($check->count() > 0)
            {
                foreach($check as $c)
                {
                    if(file_exists(public_path('storage/'.$c->url)))
                    {
                        $files[] = public_path('storage/'.$c->url);
                    }
                }
                Zipper::make(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip'))->add($files)->close();
                if(file_exists(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip')))
                {
                    return response()->download(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip'));
                }
                return $this->render('failed.file');
            }

            return $this->render('failed.file');
        }
    }

    public function multipleDownloadPicture($id, $type)
    {
        if($type != "undefined")
        {
            $check = Attachments::where('target_id', $id)->where('target_type', $type)->get();
            $files = [];
            if($check->count() > 0)
            {
                foreach($check as $c)
                {
                    if(file_exists(public_path('storage/'.$c->url)))
                    {
                        $files[] = public_path('storage/'.$c->url);
                    }
                }
                Zipper::make(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip'))->add($files)->close();
                if(file_exists(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip')))
                {
                    return response()->download(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip'));
                }
                return $this->render('failed.file');
            }

            return $this->render('failed.file');
        }
    }

    public function deleteFile($id)
    {
        $file = Files::find($id);
        $file->delete();

        return $this->render('partials.file-tab.exist-file.lampiran', ['record' => $file->target]);
    }

    public function deletePicture($id)
    {
        $file = Attachments::find($id);
        $file->delete();

        return $this->render('partials.file-tab.exist-file.foto', ['record' => $file->target]);
    }

    //FRONTEND
    public function multipleDownloadFileFront($id, $type)
    {
        if($type != "undefined")
        {
            $check = Files::where('target_id', $id)->where('target_type', $type)->get();
            $files = [];
            if($check->count() > 0)
            {
                foreach($check as $c)
                {
                    if(file_exists(public_path('storage/'.$c->url)))
                    {
                        $files[] = public_path('storage/'.$c->url);
                    }
                }
                Zipper::make(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip'))->add($files)->close();
                if(file_exists(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip')))
                {
                    return response()->download(public_path('storage/'.$type.Carbon::now()->format('Ymdhis').'.zip'));
                }
                return $this->render('failed.frontend-failed-file');
            }

            return $this->render('failed.frontend-failed-file');
        }
    }
    
}
