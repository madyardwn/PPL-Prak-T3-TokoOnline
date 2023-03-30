<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Transaksi extends BaseController
{
    protected $transaksi;

    // constructor
    public function __construct()
    {
        $this->transaksi = new \App\Models\M_Transaksi();
    }

    public function index()
    {
        $data = [
            'title' => 'Transaksi',
            'transaksi' => $this->transaksi->findAll()
        ];

        return view('transaksi/v_index', $data);
    }
}
