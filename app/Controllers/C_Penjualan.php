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
            'penjualan' => $this->penjualan
                ->select([
                    'penjualan.no_transaksi',
                    'penjualan.id_barang',
                    'penjualan.jumlah_jual',
                    'penjualan.harga_jual',
                    'barang.nama_barang'
                ])
                ->join('barang', 'barang.id = penjualan.id_barang')
                ->get()->getResultArray()
        ];

        return view('penjualan/v_index', $data);
    }
}
