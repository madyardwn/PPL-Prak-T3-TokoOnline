<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Penjualan extends BaseController
{
    protected $penjualan;

    // constructor
    public function __construct()
    {
        $this->penjualan = new \App\Models\M_Penjualan();
    }

    public function index()
    {
        $data = [
            'title' => 'Transaksi',
            'penjualan' => $this->penjualan->findAll()
        ];

        return view('penjualan/v_index', $data);
    }
}