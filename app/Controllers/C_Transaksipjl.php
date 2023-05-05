<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Transaksipjl extends BaseController
{
    protected $transaksi;

    // constructor
    public function __construct()
    {
        $this->transaksi = new \App\Models\M_Transaksipjl();
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
