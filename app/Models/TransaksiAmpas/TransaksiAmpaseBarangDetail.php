<?php

namespace App\Models\TransaksiAmpas;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Barang\LapakBarang;
use App\Models\Rental\Rental;

class TransaksiAmpaseBarangDetail extends Model
{
    protected $table 		= 'trans_ampas_transaksi_barang_detail';
    protected $log_table 	= 'log_trans_ampas_transaksi_barang_detail';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
    	'trans_transaksi_id',
    	'id_barang',
    	'jumlah_barang',
    	'total_harga',
        'form_id',
        'form_type',
        'ppob_pelanggan',
        'ppob_server',
        'ppob_type',
    	'created_by',
    ];

    public function form()
    {
        return $this->morphTo();
    }

    public function barang(){
        return $this->belongsTo(LapakBarang::class, 'form_id');
    }

    public function rent(){
        return $this->belongsTo(Rental::class, 'form_id');
    }

    public function trans_transaksi(){
        return $this->belongsTo(TransaksiAmpase::class, 'trans_transaksi_id');
    }

}
