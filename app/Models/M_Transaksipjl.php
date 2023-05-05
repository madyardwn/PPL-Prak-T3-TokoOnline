<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Transaksipjl extends Model
{

    protected $table = 'transaksipjl';
    protected $primaryKey = 'idtrans';
    protected $allowedFields = [
        'idtrans', 'nama', 'hp', 'alamat', 'kecamatan', 'kota', 'total', 'kodepos'
    ];
}
