<?php

namespace App\Models\TransaksiAmpas;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Barang\LapakBarang;


class TransaksiAmpaseKereta extends Model
{
    protected $table 		= 'trans_ampas_transaksi_kereta';
    protected $log_table 	= 'log_trans_ampas_transaksi_kereta';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
        'trans_transaksi_id',
    	'target_id',
        'target_type',
        'form_id',
        'form_type',
        'org',
        'dest',
        'date',
        'trainNo',
        'kodeWagon',
        'kelasWagon',
        'subClass',
        'seats',
        'seatSelect',
        'adult',
        'adult_id',
        'adult_name',
        'adult_dob',
        'adult_phone',
        'infant',
        'infant_id',
        'infant_name',
        'status_tujuan',
        'trainName',
        'bookingCode',
        'bookTime',
        'timeLimit',
        'bookingDate',
        'class',
        'className',
        'departDate',
        'departTime',
        'arriveDate',
        'arriveTime',
        'ticketPrice',
        'discount',
        'admin',
        'tr_id',
    ];

    public function filesMorphClass()
    {
        return 'trans_kereta';
    }

    public function form(){
         return $this->morphTo();
    }
}
