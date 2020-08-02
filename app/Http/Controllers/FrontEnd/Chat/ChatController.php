<?php

namespace App\Http\Controllers\FrontEnd\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita\Berita;


use App\Models\User;
use App\Models\Barang\LapakBarang;
use App\Models\Rental\Rental;
use App\Models\Chat\Chat;
use App\Models\Chat\ChatDetail;

use Zipper;
use Carbon\Carbon;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use File;

class ChatController extends Controller
{
    //
    protected $link = 'chat/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Chat Sekarang");
        $this->setGroup("Chat Sekarang");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Chat Sekarang' => '#']);
    }

    public function index(Request $request)
    {     
        // dd(auth()->user()->id);
        $cekChat = [];
        if(($request->toko_barang) && ($request->toko)){
            $cekLapakBarang = LapakBarang::find($request->toko_barang);
            $data['form_id']=$request->toko_barang;
            $data['form_type']='img_barang';
            $data['id_lapak']=$request->toko;
            $data['id_user_chat_to']=$cekLapakBarang->created_by;
            $cekChat = Chat::where('created_by',auth()->user()->id)->where('id_lapak',$request->toko)->first();
            if(!$cekChat){
               $cekChat = Chat::create($data);
            }
        }

        $rec1 = Chat::with('lapak','form','lapak.creator','form.creator','lapak.attachment','creator','creator.pictureoneusers')->where('created_by',auth()->user()->id)->orWhere('id_user_chat_to',auth()->user()->id)->paginate(5);

        return $this->render('frontend.chat.index',[
            'request' => $request->all(),
            'cekChat' => $cekChat,
            'appendList' => $rec1,
            'user_id' => auth()->user()->id
        ]);
    }

    public function showList(Request $request){
       $rec1 = Chat::with('lapak','form','lapak.creator','form.creator','lapak.attachment','creator','creator.pictureoneusers')->where('created_by',auth()->user()->id)->orWhere('id_user_chat_to',auth()->user()->id)->select('*');
        if(!is_null($request->search)){
            $REQ = $request->search;
            $rec1 = Chat::whereHas('creator',function($q) use($REQ){
                $q->where('nama', 'like', '%'.$REQ.'%');
            });
        }
        return response([
            'appendList' => $rec1->get(),
            'user_id' => auth()->user()->id
        ]);
        // return $this->render('frontend.chat.show-list');
    }

    public function sendChat(Request $request){
        $arrDetail = [
            'status' => 1,
            'chat' => $request->chat,
        ];
        $record = Chat::find($request->id);
        $record->status = 1;
        $record->save();
        $record->detail()->save(new ChatDetail($arrDetail));

        return response([
            'id' => $record->id,
            'user_id' => auth()->user()->id
        ]);
    }

    public function postNotif(Request $request){
        $record = Chat::find($request->id);
        $record->status = 2;
        $record->save();
    }

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }

    public function indexSewa(Request $request)
    {     
        // dd(auth()->user()->id);
        $cekChat = [];
        if(($request->toko_barang) && ($request->toko)){
            $cekLapakBarang = Rental::find($request->toko_barang);
            $data['form_id']=$request->toko_barang;
            $data['form_type']='img_rental';
            $data['id_lapak']=$request->toko;
            $data['id_user_chat_to']=$cekLapakBarang->created_by;
            $cekChat = Chat::where('created_by',auth()->user()->id)->where('id_lapak',$request->toko)->first();
            if(!$cekChat){
               $cekChat = Chat::create($data);
            }
        }

        $rec1 = Chat::with('lapak','form','lapak.creator','form.creator','lapak.attachment','creator','creator.pictureoneusers')->where('created_by',auth()->user()->id)->orWhere('id_user_chat_to',auth()->user()->id)->get();

        return $this->render('frontend.chat.index',[
            'request' => $request->all(),
            'cekChat' => $cekChat,
            'appendList' => $rec1,
            'user_id' => auth()->user()->id
        ]);
    }
}
