<?php

namespace App\Http\Controllers\FrontEnd\PendaftaranKurir;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\AplikasiPanduan;
use App\Models\Kurir\Kurir;
use App\Http\Requests\Kurir\KurirRequest;
use App\Http\Requests\Kurir\NewKurirRequest;
use App\Models\User;

use Zipper;
use Carbon\Carbon;
use Auth;

class PendaftaranKurirController extends Controller
{
    //
    protected $link = 'yokuy-kurir/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Pendfatran Kurir");
        $this->setGroup("Pendfatran Kurir");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Pendfatran Kurir' => '#']);
    }

    public function index()
    {
        $record = AplikasiPanduan::where('kategori', 'Panduan Kurir')->first();
        $recordKurir = [];
        if (Auth::check()) {
            $recordKurir = Kurir::where('user_id', auth()->user()->id)->first();
        }

        return $this->render('frontend.pendaftaran-kurir.index', [
            'mockup' => false,
            'record' => $record,
            'recordKurir' => $recordKurir,
        ]);
    }
    public function tentang()
    {
        return $this->render('frontend.pendaftaran-kurir.tentang');
    }
    public function create()
    {
        if (Auth::check()) {
            // return $this->render('frontend.pendaftaran-kurir.create');
            return $this->render('frontend.pendaftaran-kurir.newcreate');
        } else {
            return redirect('login');
        }
    }

    public function store(KurirRequest $request)
    {
        $this->validate($request, [
            'attachment.*' => 'required',
            'attachment.*' => 'max:500',
        ], [
            'attachment.*.max' => 'Lampiran tidak boleh lebih dari 500 Kilobyte',
        ]);
        try {
            $request['user_id'] = auth()->user()->id;
            $data = Kurir::saveData($request);
        } catch (\Exception $e) {
            return response([
                'status' => 'error',
                'message' => 'An error occurred!',
            ], 500);
        }

        return response([
            'status' => true,
            'url' => true
        ]);
    }

    public function newStore(Request $request)
    {
        try {
            $request['user_id'] = auth()->user()->id;
            $request['fotoSim'] =($request->file('fotoSim')) ? $request->file('fotoSim')->store('public/kurir_files') : '';
            $request['fotoKtp'] =($request->file('fotoKtp')) ? $request->file('fotoKtp')->store('public/kurir_files') : '';
            $request['swafoto'] =($request->file('swafoto')) ? $request->file('swafoto')->store('public/kurir_files') : '';
            $request['fotocopyKK'] =($request->file('fotocopyKK')) ? $request->file('fotocopyKK')->store('public/kurir_files') : '';
            $data = Kurir::saveData($request);
            $this->sendMailGlobal(
                isset(auth()->user()->email) ? auth()->user()->email : '',
                $data,
                'Selamat anda telah terdaftar sebagai kurir ayokulakan',
                'Hai kepada saudara '.isset(auth()->user()->nama) ? auth()->user()->nama : ''.' selamat bergabung, silahkan baca & taati, kebijakan & aturan dari ayokulakan',
                'https://ayokulakan.com/fitur/kurir/panduan-kurir',
                'Kebijakan Privasi',
                'mails.global-mail'
            );
        } catch (\Exception $e) {
            return response([
                'status' => 'error',
                'message' => 'An error occurred!',
            ], 500);
        }

        return response([
            'status' => true,
            'url' => true
        ]);
    }

    public function notFoundPage()
    {
        return $this->render('failed.page', ['mockup' => false]);
    }
}
