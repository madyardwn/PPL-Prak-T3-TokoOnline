<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Ongkir extends Model
{
    protected $table = 'ongkir';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kodepos_awal', 'kodepos_tujuan', 'ongkir_per_kilo'];
}
