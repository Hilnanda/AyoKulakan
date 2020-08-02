<?php

namespace App\Models\TransaksiAmpas;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Barang\LapakBarang;


class TransaksiAmpasePostpaid extends Model
{
    protected $table 		= 'trans_ampas_transaksi_postpaid';
    protected $log_table 	= 'log_trans_ampas_transaksi_postpaid';
    protected $log_table_fk	= 'trans_id';
    protected $fillable 	= [
        'trans_transaksi_id',
        'target_id',
        'target_type',
        'form_id',
        'form_type',
        'pelanggan',
        'tr_name',
        'period',
        'noref',
        'jml_brg',
        'ttl_harga',
        'sn',
        'pin',
        'rc',
        'biaya_admin',
        'type',
        'server',
        'tr_id',
        'ref_id',

    ];

    public function filesMorphClass()
    {
        return 'trans_pospaid';
    }

    public function form()
    {
        return $this->morphTo();
    }
}
