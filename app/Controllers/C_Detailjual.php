<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Detailjual extends BaseController
{
    protected $penjualan;

    // constructor
    public function __construct()
    {
        $this->penjualan = new \App\Models\M_Detailjual();
    }

    public function index()
    {

        $data = [
            'title' => 'Transaksi',
            'penjualan' => $this->penjualan
                ->select(
                    [
                        'idtrans',
                        'jmljual',
                        'hargajual',
                        'kemeja.idkemeja',
                        'kemeja.namabrg',
                    ]
                )
                ->join('kemeja', 'kemeja.idkemeja = detailjual.idkemeja')
                ->get()->getResultArray()
        ];

        return view('penjualan/v_index', $data);
    }
}
