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


class CartSewaController extends Controller
{
    //
    protected $link = 'keranjang-sewa/';

    function __construct()
    {
        $this->setLink($this->link);
        $this->setTitle("Keranjang Sewa Anda");
        $this->setGroup("Keranjang Sewa Anda");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Keranjang Sewa Anda' => '#']);

        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {     
         
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
            

            return $this->render('frontend.cart.show-sewa', [
              'mockup' => false,
              'record' => FavoritBarang::where('form_type','img_rental')->where('user_id',auth()->user()->id)->get(),
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
      return $this->render('frontend.cart.show-sewa', [
        'mockup' => false,
        'record' => FavoritBarang::where('form_type','img_rental')->with('form')->where('user_id',auth()->user()->id)->get(),
      ]);
    }

    public function storeKeranjang(Request $request){
      if(!isset($request->accept['barang'])){
        return response([
            'status' => 'message',
            'message' => 'Silahkan Pilih Salah Satu Barang Untuk Di Bayar',
        ],422);
      }elseif($request->accept['jumlah_barang']){
        foreach ($request->accept['jumlah_barang'] as $value) {
            if((int)$value <= 0){
              return response([
                  'status' => 'message',
                  'message' => 'Jumlah Barang Sewa Tidak Boleh Kurang Dari 1',
              ],422);
            }
        }
      }

      try {
        $cek = FavoritBarang::where('form_type','img_rental')->where('user_id',auth()->user()->id)->update(['status' => '10']);
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

      $record = FavoritBarang::where('form_type','img_rental')->where('user_id',auth()->user()->id)->where('status','11')->get();
      $user = auth()->user();
      return $this->render('frontend.cart.checkout-sewa', [
        'mockup' => false,
        'record' => $record,
        'user' => $user,
        'rajaongkir' => Rajaongkir::get()
      ]);
    }

    public function storeMidtrans(CartMidtransRequest $request){
      $this->validate($request, [
          'attachment.*' => 'required',
          'attachment.*'=>'max:5120',
          'attachment.*' => 'image|mimes:jpg,png,jpeg',
          "attachment.*"=>"mimes:jpg,png,jpeg,gif"
      ],[
        'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
        'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
        'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
      ]);
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

        $record = FavoritBarang::where('form_type','img_rental')->where('user_id',auth()->user()->id)->where('status','11')->get();
        // dd($record);
        $saveTransDetailBarang = [];
        $recordDetailBarang = [];
        $totalBarang = [];
        $total_harga = 0;
        $priceToMidtrans = [];
        $toMidtrans = [];
        $i =0;
        if($record->count() > 0){
          foreach ($record as  $k => $value) {
              $i++;
              if($value->form_type == 'img_rental'){
                  $total_harga = $value->jumlah_barang * $value->form->harga_sewa;
                  $totalBarang[$i] = $total_harga;
                  $priceToMidtrans = $value->form->harga_sewa;
              }
            
            $saveTransDetailBarang['trans_transaksi_id'] = $recordTrans->id;
            $saveTransDetailBarang['id_barang'] = $value->id_barang;
            $saveTransDetailBarang['jumlah_barang'] = $value->jumlah_barang;
            $saveTransDetailBarang['total_harga'] = $total_harga;
            $saveTransDetailBarang['form_id'] = $value->form_id;
            $saveTransDetailBarang['form_type'] = $value->form_type;
            
            $recordDetailBarang = new TransaksiAmpaseBarangDetail;
            $recordDetailBarang->fill($saveTransDetailBarang);
            $recordDetailBarang->save();

            $toMidtrans['item_details'][$k]['id'] = $value->form->id;
            $toMidtrans['item_details'][$k]['name'] = ($value->form_type == 'img_rental') ? $value->form->judul : $value->form->judul;
            $toMidtrans['item_details'][$k]['price'] = $priceToMidtrans;
            $toMidtrans['item_details'][$k]['quantity'] = $value->jumlah_barang;
          }
        }

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
        
        $resultTotalHarga = array_sum($totalBarang);
        $toMidtrans['transaction_details'] = array(
          'order_id' => $recordTrans->order_id,
          'gross_amount' => $resultTotalHarga
        );

        $recordTrans->total_harga = $resultTotalHarga;
        $recordTrans->save();

        $toMidtrans['enabled_payments'] = array('bca_klikbca', 'bca_klikpay', 'permata_va', 'bca_va', 'bni_va', 'other_va', 'indomaret','credit_card','gopay','mandiri_clickpay','echannel','xl_tunai','permata_va','kioson','alfamart');

        $RessSnap = Veritrans_Snap::getSnapToken($toMidtrans);
        $recordTrans->snap_token = $RessSnap;
        $recordTrans->save();
        FavoritBarang::where('form_type','img_rental')->where('user_id',auth()->user()->id)->where('status','11')->delete();

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
      $record = FavoritBarang::where('form_type','img_rental')->where('user_id',auth()->user()->id)->where('status','11')->get();
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

    public function notFoundPage(){
        return $this->render('failed.page', ['mockup' => false]);
    }
}
