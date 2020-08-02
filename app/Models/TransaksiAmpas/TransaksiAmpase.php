<?php

namespace App\Models\TransaksiAmpas;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Helpers\HelpersPPOB;
use App\Models\Notification\NotifFeedback;

class TransaksiAmpase extends Model
{
    protected $table 		= 'trans_ampas_transaksi';
    protected $log_table 	= 'log_trans_ampas_transaksi';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
        'user_id',
        'payment_type',
        'order_id',
        'status',
        'snap_token',
        'created_by',
        'transaction_id',
        'signature_key',
        'total_harga',
        'transaction_status',
        'fraud_status',
        'store',
        'payment_code',
        'transaction_time',
        'status_code',
        'redirect_url',
        'merchant_id',
        'transaction_time_expiry'
    ];


    // public function kereta()
    // {
    //     return $this->morphMany(TransaksiAmpaseKereta::class,'target');
    // }

    public function attach(){
        return $this->hasMany(TransaksiAmpaseAttach::class,'trans_id');
    }

    public function kereta()
    {
        return $this->hasMany(TransaksiAmpaseKereta::class,'target_id');
    }

    public function prepaid()
    {
        return $this->hasOne(TransaksiAmpasePrepaid::class,'target_id');
    }

    public function postpaid()
    {
        return $this->hasOne(TransaksiAmpasePostpaid::class,'target_id');
    }

    public function detail(){
        return $this->hasMany(TransaksiAmpaseBarangDetail::class, 'trans_transaksi_id');
    }

    public function kurir(){
        return $this->hasOne(TransaksiKurir::class, 'trans_id');
    }

    public function user(){
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function checkTransaksi($request){
        if($this->prepaid){
            if ($request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                  if($request->fraud_status != 'challenge') {
                    $sendMobil['hp'] = $this->prepaid->pelanggan;
                    $sendMobil['pulsa_code'] = $this->prepaid->form->pulsa_code;
                    $recordChargePPOB = json_decode(HelpersPPOB::post($this->order_id,$this->prepaid->server,$sendMobil));

                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'detail pesanan';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                  }
                }
            }elseif($request->transaction_status == 'settlement') {
                $sendMobil['hp'] = $this->prepaid->pelanggan;
                $sendMobil['pulsa_code'] = $this->prepaid->form->pulsa_code;
                $recordChargePPOB = json_decode(HelpersPPOB::post($this->order_id,$this->prepaid->server,$sendMobil));

                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'success';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                $saveDataFeed['message'] = 'detail pesanan';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }

        }elseif($this->postpaid){
            if ($request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                  if($request->fraud_status != 'challenge') {
                    $recordPPOB = HelpersPPOB::postPayPasca($this->postpaid->tr_id);

                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'detail pesanan';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                  }
                }
            }elseif($request->transaction_status == 'settlement') {
                $recordPPOB = HelpersPPOB::postPayPasca($this->postpaid->tr_id);

                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'success';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                $saveDataFeed['message'] = 'detail pesanan';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }elseif($this->kereta->count() > 0){
            if ($request->transaction_status == 'capture') {
                if ($request->payment_type == 'credit_card') {
                  if($request->fraud_status != 'challenge') {
                    HelpersPPOB::bookingAccept($this->kereta->first()->tr_id);

                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'success';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                    $saveDataFeed['message'] = 'detail pesanan';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                  }
                }
            }elseif($request->transaction_status == 'settlement') {
                HelpersPPOB::bookingAccept($this->kereta->first()->tr_id);

                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'success';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                $saveDataFeed['message'] = 'detail pesanan';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }

    public function checkTransaksiBarangRental($request){
        if($this->detail){
            if($this->detail->count() > 0){
                if ($request->transaction_status == 'capture') {
                    if ($request->payment_type == 'credit_card') {
                      if($request->fraud_status != 'challenge') {
                        foreach ($this->detail as $value) {
                            if($value->form_type == 'img_barang'){
                                $tambah = (int)$value->form->barang_terjual + (int)$value->jumlah_barang;
                                $value->form->barang_terjual = $tambah;
                                $value->form->stock_barang = (int)$value->form->stock_barang - (int)$value->jumlah_barang;
                                $value->form->save();
                            }else if($value->form_type == 'img_rental'){
                                $tambah = (int)$value->form->unit_tersewa + (int)$value->jumlah_barang;
                                $value->form->unit_tersewa = $tambah;
                                $value->form->unit = (int)$value->form->unit_tersewa - (int)$value->jumlah_barang;
                                $value->form->save();
                            }
                        }
                        // Notiff Feedback
                        $recNotifFeedback = new NotifFeedback;
                        $saveDataFeed['trans_id'] = $this->id;
                        $saveDataFeed['user_id'] = $this->user_id;
                        $saveDataFeed['status'] = 'success';
                        $saveDataFeed['review'] = 1;
                        $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                        $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                        $recNotifFeedback->fill($saveDataFeed);
                        $recNotifFeedback->save();
                      }
                    }
                }elseif($request->transaction_status == 'settlement') {
                    foreach ($this->detail as $value) {
                        if($value->form_type == 'img_barang'){
                            $tambah = (int)$value->form->barang_terjual + (int)$value->jumlah_barang;
                            $value->form->barang_terjual = $tambah;
                            $value->form->stock_barang = (int)$value->form->stock_barang - (int)$value->jumlah_barang;
                            $value->form->save();
                        }else if($value->form_type == 'img_rental'){
                            $tambah = (int)$value->form->unit_tersewa + (int)$value->jumlah_barang;
                            $value->form->unit_tersewa = $tambah;
                            $value->form->unit = (int)$value->form->unit_tersewa - (int)$value->jumlah_barang;
                            $value->form->save();
                        }
                    }
                    // Notiff Feedback
                        $recNotifFeedback = new NotifFeedback;
                        $saveDataFeed['trans_id'] = $this->id;
                        $saveDataFeed['user_id'] = $this->user_id;
                        $saveDataFeed['status'] = 'success';
                        $saveDataFeed['review'] = 1;
                        $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                        $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                        $recNotifFeedback->fill($saveDataFeed);
                        $recNotifFeedback->save();
                }elseif($request->transaction_status == 'success'){
                    if($request->fraud_status == 'accept'){
                        foreach ($this->detail as $value) {
                            if($value->form_type == 'img_barang'){
                                $tambah = (int)$value->form->barang_terjual + (int)$value->jumlah_barang;
                                $value->form->barang_terjual = $tambah;
                                $value->form->stock_barang = (int)$value->form->stock_barang - (int)$value->jumlah_barang;
                                $value->form->save();
                            }else if($value->form_type == 'img_rental'){
                                $tambah = (int)$value->form->unit_tersewa + (int)$value->jumlah_barang;
                                $value->form->unit_tersewa = $tambah;
                                $value->form->unit = (int)$value->form->unit_tersewa - (int)$value->jumlah_barang;
                                $value->form->save();
                            }
                        }
                        // Notiff Feedback
                        $recNotifFeedback = new NotifFeedback;
                        $saveDataFeed['trans_id'] = $this->id;
                        $saveDataFeed['user_id'] = $this->user_id;
                        $saveDataFeed['status'] = 'success';
                        $saveDataFeed['review'] = 1;
                        $saveDataFeed['judul'] = 'Waah keren terimakasih telah berbelanja';
                        $saveDataFeed['message'] = 'Terimakasih telah berbelanja, silahkan tunggu pesanan anda, yang akan tiba';
                        $recNotifFeedback->fill($saveDataFeed);
                        $recNotifFeedback->save();
                    }
                }elseif($request->transaction_status == 'pending'){
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'pending';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                    $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }elseif($request->transaction_status == 'expiers'){
                    $recNotifFeedback = new NotifFeedback;
                    $saveDataFeed['trans_id'] = $this->id;
                    $saveDataFeed['user_id'] = $this->user_id;
                    $saveDataFeed['status'] = 'expiers';
                    $saveDataFeed['review'] = 1;
                    $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                    $saveDataFeed['message'] = 'pesanan anda telah kadluarsa, silahkan lakukan pembelian ulang';
                    $recNotifFeedback->fill($saveDataFeed);
                    $recNotifFeedback->save();
                }
            }elseif($request->transaction_status == 'pending'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'pending';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Silahkan Lakukan Pembayaran';
                $saveDataFeed['message'] = 'anda yakin mengabaikan pesanan anda, silahkan lakukan pembayaran segera';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }elseif($request->transaction_status == 'expiers'){
                $recNotifFeedback = new NotifFeedback;
                $saveDataFeed['trans_id'] = $this->id;
                $saveDataFeed['user_id'] = $this->user_id;
                $saveDataFeed['status'] = 'expiers';
                $saveDataFeed['review'] = 1;
                $saveDataFeed['judul'] = 'Ahh Sayang Sekali';
                $saveDataFeed['message'] = 'pesanan anda telah kadaluarsa, silahkan lakukan pembelian ulang';
                $recNotifFeedback->fill($saveDataFeed);
                $recNotifFeedback->save();
            }
        }
    }


}
