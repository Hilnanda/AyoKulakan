<?php

namespace App\Http\Controllers\FrontEnd\Favorit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Barang\LapakBarang;
use App\Models\Rental\Rental;
use App\Models\Favorit\LikeFavoritBarang;
use App\Models\User;

use Zipper;
use Carbon\Carbon;
class LikeFavoritBarangController extends Controller
{
    //
    protected $link = 'favorit/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Favorit Barang");
        $this->setGroup("Favorit Barang");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Favorit Barang' => '#']);
    }

    public function show($id)
    {     
        if($id != '-'){
            $record = LapakBarang::find($id);
            $cek = LikeFavoritBarang::where('user_id',auth()->user()->id)->where('id_barang',$record->id)->first();

            if(!isset($cek)){
                $save = new LikeFavoritBarang;
                $saveRecord['user_id'] = auth()->user()->id;
                $saveRecord['id_barang'] = $record->id;
                $saveRecord['form_id'] = $record->id;
                $saveRecord['form_type'] = 'img_barang';
                $save->fill($saveRecord);
                $save->save();
            }

        }
        // dd($record);
        return $this->render('frontend.like-favorit.show', [
            'mockup' => false,
            'record' => LikeFavoritBarang::with('form')->where('user_id',auth()->user()->id)->get(),
        ]);

    }

    public function showRental($id)
    {
        if($id != '-'){
            $record = Rental::find($id);
            $cek = LikeFavoritBarang::where('user_id',auth()->user()->id)->where('id_barang',$record->id)->first();

            if(!isset($cek)){
                $save = new LikeFavoritBarang;
                $saveRecord['user_id'] = auth()->user()->id;
                $saveRecord['id_barang'] = $record->id;
                $saveRecord['form_id'] = $record->id;
                $saveRecord['form_type'] = 'img_rental';
                $save->fill($saveRecord);
                $save->save();
            }

        }
        // dd($record);
        return $this->render('frontend.like-favorit.show', [
            'mockup' => false,
            'record' => LikeFavoritBarang::with('form')->where('user_id',auth()->user()->id)->get(),
        ]);
    }
    public function hapus(Request $request){
        LikeFavoritBarang::destroy($request->id);
        return response([
          'status' => true,
      ]);
    }
}
