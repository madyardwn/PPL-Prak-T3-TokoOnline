<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Transaksi extends Model
{

    protected $table = 'transaksi';
    protected $primaryKey = 'no_transaksi';
    protected $allowedFields = [
        'no_transaksi', 
        'total_transaksi', 
        'nama_pembeli', 
        'alamat', 
        'kecamatan', 
        'kota', 
        'tanggal_transaksi'
    ];
}
