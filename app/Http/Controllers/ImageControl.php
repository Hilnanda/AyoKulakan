<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Auth;
use App\Models\Master\WilayahKota;
use App\Models\Users;
use App\Models\Kurir\Kurir;
use App\Models\KakiLima\KakiLima;
use QrCode;
use Carbon\Carbon;

class ImageControl extends Controller
{
    public function __construct()
    {
    }

    public function kartu_yokurir()
    {
        return $this->create_card(new Kurir(), 'KR', public_path("XML/YokuyKurir.png"));
    }

    public function kartu_kakilima()
    {
        return $this->create_card(new KakiLima(), 'KL', public_path("XML/KakiLima.png"));
    }

    private function create_card($model, $text, $fileQrCode)
    {
        if (!Auth::check()) {
            return redirect(url("404"));
        }

        $id = auth()->user()->id;
        $get = $model->where(["user_id" => $id]);

        if ($get->count() > 0) {
            $data = $get->first();
            $tag = $text . str_pad($id, 10, 0, STR_PAD_LEFT);
            $base = Image::make(public_path('new-temp.jpeg'));
            $base->text('ID : ' . $tag, 350, 300, function ($font) {
                $font->file(public_path('arial.ttf'));
                $font->size(40);
                $font->align("center");
            });

            $data = Users::where("id", $id)->first();
            $id = $data->id_kota;
            $kota = WilayahKota::where("id", $id);
            $kota = $kota->first()->kota;
            $base->text($kota, 350, 370, function ($font) {
                $font->file(public_path('arial.ttf'));
                $font->size(40);
                $font->align("center");
            });

            $base->text(auth()->user()->nama, 370, 850, function ($font) {
                $font->file(public_path('arial.ttf'));
                $font->size(40);
                $font->align("center");
            });

            if ($data->pictureoneusers != null) {
                $newbase = Image::make(storage_path("app/public/" . $data->pictureoneusers->url));
            } else {
                $newbase = Image::make(public_path("users.png"));
            }

            $newbase->resize(200, 200);
            $base->insert($newbase, "center");

            $embed = $data->id . '_' . auth()->user()->nama ? auth()->user()->nama : auth()->user()->email . '_KR' . str_pad($id, 10, 0, STR_PAD_LEFT);
            $file = fopen($fileQrCode, "w");

            fwrite($file, QrCode::format('png')->size(300)->generate($embed));
            fclose($file);

            $qr = Image::make($fileQrCode);
            $qr->resize(200, 200);
            $base->insert($qr, "bottom", 10, 200);

            return $base->response();
        } else {
            return back();
        }
    }
}
