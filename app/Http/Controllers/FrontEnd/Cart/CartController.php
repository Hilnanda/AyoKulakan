<?php

namespace App\Http\Controllers\FrontEnd\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\FrontEnd\Cart\CartMidtransRequest;

use App\Models\User;
use App\Models\Barang\FavoritBarang;

use App\Models\Lapak\Lapak;
use App\Models\Master\Rajaongkir;
use App\Models\Kurir\Kurir;
use App\Models\Barang\LapakBarang;
use App\Models\TransaksiAmpas\TransaksiAmpase;
use App\Models\TransaksiAmpas\TransaksiAmpaseAttach;
use App\Models\TransaksiAmpas\TransaksiAmpaseBarangDetail;
use App\Models\TransaksiAmpas\TransaksiAmpaseDetail;
use App\Models\TransaksiAmpas\TransaksiKurir;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Veritrans_Transaction;
use Veritrans_VtDirect;
use Zipper;
use Carbon\Carbon;
use Auth;
use DB;


class CartController extends Controller
{
    //
    protected $link = 'keranjang/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Keranjang Anda");
        $this->setGroup("Keranjang Anda");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Keranjang Anda' => '#']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {     
          $record = AplikasiTentang::where('kategori','Panduan Haji & Umroh')->first();
        
          return $this->render('frontend.panduan-haji.index', [
            'mockup' => false,
            'record' => $record,
          ]);
          
    }

    public function tambahKeranjang($id,$jml,$type){
      if(Auth::check()){
        try {
          $data = [];
          $record = FavoritBarang::where('id_barang',$id)->where('form_type',$type)->first();
          if(!$record){
            $record = new FavoritBarang;
            $data['user_id'] = auth()->user()->id;
            $data['id_barang'] = $id;
            $data['form_id'] = $id;
            $data['form_type'] = $type;
            $data['jumlah_barang'] = ($jml != 'undefined') ? $jml : 1;
            $record->fill($data);
            $record->save();
          }else{
            $data['user_id'] = auth()->user()->id;
            $data['id_barang'] = $id;
            $data['form_id'] = $id;
            $data['form_type'] = $type;
            $data['jumlah_barang'] = ($jml != 'undefined') ? ($jml+$record->jumlah_barang) : (1+$record->jumlah_barang);
            $record->fill($data);
            $record->save();

          }
            

            return $this->render('frontend.cart.show', [
              'mockup' => false,
              'record' => FavoritBarang::where('form_type','img_barang')->where('user_id',auth()->user()->id)->get(),
            ]);
        } catch (Exception $e) {
          return response([
                'status' => false,
                'errors' => $e
            ]);
        }
        
      }

    }

    public function hapusKeranjang(Request $request){
      try {
        FavoritBarang::destroy($request->id);
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

    public function show(){
      return $this->render('frontend.cart.show', [
        'mockup' => false,
        'record' => FavoritBarang::where('form_type','img_barang')->with('form')->where('user_id',auth()->user()->id)->get(),
      ]);
    }

    public function storeKeranjang(Request $request){
      // dd($request->all());
      if(isset($request->accept['barang'])){}else{
        $data = [
          'barang' => array(null)
        ];
        $request['accept'] = array_merge($request['accept'],$data);
        $this->validate($request, [
            'accept.barang.*' => 'required',
        ],[
          'accept.barang.*.required' => 'Silahkan Pilih Salah Satu Barang Untuk Di Bayar',
          'accept.barang.*.min' => 'Minimum Pembelian 1 Barang',
        ]);
      }

      try {
        $cek = FavoritBarang::where('form_type','img_barang')->where('user_id',auth()->user()->id)->update(['status' => '10']);
        $total = 0;
        if(isset($request->accept['barang'])){
          foreach ($request->accept['barang'] as $k => $value) {
            $hasilData = FavoritBarang::find($value);
            if($hasilData){
              $hasilData->jumlah_barang = isset($request->accept['jumlah_barang'][$k]) ? $request->accept['jumlah_barang'][$k] : 1;
              $hasilData->status = 11;
              $hasilData->save();
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
          'url' => url($this->link.'store')
      ]);
    }

    public function getKeranjang(){
      $record = FavoritBarang::with('form.attacOne','form.lapak')->where('form_type','img_barang')->where('user_id',auth()->user()->id)->where('status','11')->get()->groupBy('form.lapak.id');
      $user = auth()->user();
      return $this->render('frontend.cart.checkout', [
        'mockup' => false,
        'record' => $record,
        'user' => $user,
        'rajaongkir' => Rajaongkir::get()
      ]);
    }

    public function storeMidtrans(CartMidtransRequest $request){
      if(isset($request->item_details)){
        foreach ($request->item_details as $k => $value) {
          if(is_null($value['kurir_code'])){
            return response([
                'errors' => [
                  'pengiriman' => ['Pilih Data Pengiriman Setiap Outlet Yang Tersedia']
                ],
            ],422);
          }else if(is_null($value['kurir_tipe_child'])){
            return response([
                'errors' => [
                  'tipe_pengiriman' => ['Pilih Tipe Pengiriman Setiap Outlet Yang Tersedia']
                ],
            ],422);
          }
        }
      }

      DB::beginTransaction();
      try {
        $saveTrans = [];
        $saveTrans['user_id'] = auth()->user()->id;
        $saveTrans['status'] = 'Menunggu Pembayaran';
        $recordTrans = new TransaksiAmpase;
        $recordTrans->fill($saveTrans);
        $recordTrans->save();

        if(isset($request->attachment_new)){
          if(count($request->attachment_new) > 0){
            foreach ($request->attachment_new as $k => $value) {
              $recordTransAttach = new TransaksiAmpaseAttach;
              $saveTransAttach['filename'] = $request->filenames[$k];
              $saveTransAttach['fileurl'] = $value;
              $saveTransAttach['form_id'] = $recordTrans->id;
              $saveTransAttach['trans_id'] = $recordTrans->id;
              $saveTransAttach['form_type'] = 'img_rental';
              $recordTransAttach->fill($saveTransAttach);
              $recordTransAttach->save();
            }
          }
        }

        $generateOrder = generateOrder(strlen(auth()->user()->nama));
        $recordTrans->order_id = '0'.$generateOrder.'000'.$recordTrans->id;
        $recordTrans->save();

        $record = FavoritBarang::where('form_type','img_barang')->where('user_id',auth()->user()->id)->where('status','11')->get();
        // dd($record);
        $saveTransDetailBarang = [];
        $recordDetailBarang = [];
        $totalBarang = 0;
        $totalHargaKurir = 0;
        $toMidtrans = [];
        $dataTransKurir = [];
        // dump($request->all());
        if(count($request->item_details) > 0){
          foreach ($request->item_details as $k => $val) {
            if(isset($val['barang'])){
              if(count($val['barang']) > 0){
                foreach ($val['barang'] as $k => $value) {
                  $saveTransDetailBarang['trans_transaksi_id'] = $recordTrans->id;
                  $saveTransDetailBarang['id_barang'] = $value['id'];
                  $saveTransDetailBarang['jumlah_barang'] = $value['quantity'];
                  $saveTransDetailBarang['total_harga'] = $value['price'];
                  
                  $hitung = ((float)$value['price'] * (float)$value['quantity']);
                  $totalBarang += $hitung;

                  $recordDetailBarang = $recordTrans->detail()->create($saveTransDetailBarang);
                  
                  if(isset($toMidtrans['item_details'])){
                    array_push($toMidtrans['item_details'],array(
                      'id' => $recordDetailBarang->id,
                      'name' => $value['name'],
                      'price' => $value['price'],
                      'quantity' => $value['quantity'],
                    ));
                  }else{
                    $toMidtrans['item_details'][$k]['id'] = $recordDetailBarang->id;
                    $toMidtrans['item_details'][$k]['name'] = $value['name'];
                    $toMidtrans['item_details'][$k]['price'] = $value['price'];
                    $toMidtrans['item_details'][$k]['quantity'] = $value['quantity'];
                  }

                }
              }
            }
            if(isset($val['kurir_code'])){
              $itemDetail = '-';
              $masterRk = Rajaongkir::where('code',$val['kurir_code'])->first();
              if($masterRk){
                $itemDetail = $masterRk->name.' '.$val['kurir_tipe_child'];
                $recordTransKurir = TransaksiKurir::create([
                  'trans_id' => $recordTrans->id,
                  'lapak_id' => $masterRk->id,
                  'form_id' => $masterRk->id,
                  'form_type' => 'rajaongkir',
                  'kurir_child_tipe' => $val['kurir_tipe_child'],
                  'kurir_child_harga' => $val['kurir_harga_child'],
                  'kurir_child_hari' => $val['kurir_hari_child'],
                ]);
              }else{
                $masterRk = Kurir::where('user_id',$val['kurir_code'])->first();
                $itemDetail = 'Kurir Ayokulakan '.$masterRk->creator->name;
                $recordTransKurir = TransaksiKurir::create([
                  'trans_id' => $recordTrans->id,
                  'form_id' => $masterRk->id,
                  'form_type' => 'Rajaongkir',
                ]);
              }
              $totalHargaKurir += (float)$val['kurir_harga_child'];
              array_push($dataTransKurir,[
                'id' => $recordTransKurir->id,
                'name' => $itemDetail,
                'price' => $val['kurir_harga_child'],
                'quantity' => 1,
              ]);
              
            }
          }
        }

        $toMidtrans['item_details'] = array_merge($toMidtrans['item_details'],$dataTransKurir);
        $resultTotalHarga = $totalBarang + $totalHargaKurir;
        $toMidtrans['transaction_details'] = array(
          'order_id' => $recordTrans->order_id,
          'gross_amount' => $resultTotalHarga
        );
        ////////////
        $toMidtrans["customer_details"]['first_name'] = auth()->user()->nama;
        $toMidtrans["customer_details"]['last_name'] = '';
        $toMidtrans["customer_details"]['email'] = auth()->user()->email;
        $toMidtrans["customer_details"]['phone'] = auth()->user()->phone;
        $toMidtrans["customer_details"]['billing_address']['first_name'] = auth()->user()->nama;
        $toMidtrans["customer_details"]['billing_address']['last_name'] = '';
        $toMidtrans["customer_details"]['billing_address']['email'] = auth()->user()->email;
        $toMidtrans["customer_details"]['billing_address']['phone'] = auth()->user()->phone;
        $toMidtrans["customer_details"]['billing_address']['address'] = auth()->user()->alamat;
        $toMidtrans["customer_details"]['billing_address']['city'] = auth()->user()->kota->kota;
        $toMidtrans["customer_details"]['billing_address']['postal_code'] = auth()->user()->kode_pos;
        $toMidtrans["customer_details"]['billing_address']['country_code'] = 'IDN';
        
        $recordTrans->total_harga = $resultTotalHarga;
        $recordTrans->save();

        $toMidtrans['enabled_payments'] = array('bca_klikbca', 'bca_klikpay', 'permata_va', 'bca_va', 'bni_va', 'other_va', 'indomaret','credit_card','gopay','mandiri_clickpay','echannel','xl_tunai','permata_va','kioson','alfamart');

        $RessSnap = Veritrans_Snap::getSnapToken($toMidtrans);
        $recordTrans->snap_token = $RessSnap;
        $recordTrans->save();
        FavoritBarang::where('form_type','img_barang')->where('user_id',auth()->user()->id)->where('status','11')->delete();

        DB::commit();

      } catch (Exception $e) {
          DB::rollback();
          return response([
              'status' => false,
              'errors' => $e
          ]);
      }
        return response([
            'status' => true,
            'record' => $recordTrans,
            'url' => url('transaksi/confirmation/'.$recordTrans->order_id)
        ]);
    }

    public function confirmMidtrans($order_id){
      $record = FavoritBarang::where('form_type','img_barang')->where('user_id',auth()->user()->id)->where('status','11')->get();
      $user = auth()->user();
      return $this->render('frontend.cart.detail-transaksi', [
        'mockup' => false,
        'record' => $record,
        'user' => $user
      ]);
    }

    public function upload(Request $request){
        $url = [];
        $filename = [];
        try {
            if(count($request->picture) > 0){
                foreach ($request->picture as $key => $file) {
                    if(filesize($file)){
                        $url[$key] = $file->storeAs('transaksi', $file->getClientOriginalName(), 'public');
                        $filename[$key] = $file->getClientOriginalName();
                    }else{
                        return response([
                            'status' => false,
                            'size' => ini_get('upload_max_filesize').'B',
                        ]);
                    }
                }
            }
            return response([
                'status' => true,
                'filename' => $filename,
                'url' => $url,
            ]);

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

    // GET PENGIRIMAN 1
    public function getPengiriman(Request $request){
      $Lapak = Lapak::findOrFail($request->lapak_id);
      $cekCost = [];
      if($Lapak){
        $cekCost = \App\Helpers\Rajaongkir\Rajaongkir::cost([
          'origin' => ($Lapak->kota) ? $Lapak->kota->id : '',
          'originType' => 'city',
          'destination' => ($Lapak->kecamatan) ? $Lapak->kecamatan->id : '',
          'destinationType' => 'subdistrict',
          'weight' => $request->berat,
          'courier' => $request->kurir_id,
        ]);
      }

      return $this->render('frontend.cart.checkout-kurir', [
        'mockup' => false,
        'lapak' => $Lapak,
        'request' => $request->all(),
        'cekCost' => ($cekCost->rajaongkir) ? $cekCost->rajaongkir : [],
      ]);
    }
    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
