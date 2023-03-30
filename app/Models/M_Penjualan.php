<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'no_transaksi';
    protected $allowedFields = ['no_transaksi', 'id_barang', 'jumlah_jual', 'harga_jual'];
}
