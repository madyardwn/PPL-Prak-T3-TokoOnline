<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Detailjual extends Model
{
    protected $table = 'detailjual';
    protected $allowedFields = [
        'idtrans', 'idkemeja', 'hargajual', 'jmljual'
    ];
}
