<?php

namespace App\Models\Barang;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Attachments;

class LapakKategoriBarang extends Model
{
    protected $table 		= 'trans_lapak_kategori_barang';
    protected $log_table 	= 'log_trans_kategori_barang';
    protected $log_table_fk	= 'id_trans';
    protected $fillable 	= [
        'id_trans_barang',
        'id_kategori',
        'id_sub_kategori',
        'id_child_kategori',
      ];

}
