<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Barang extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_barang' => 'Harvest Moon',
                'harga' => 10000,
                'stok' => 10,
                'gambar' => 'harvest-moon.jpg'
            ],
            [
                'nama_barang' => 'Tomba',
                'harga' => 30000,
                'stok' => 20,
                'gambar' => 'tomba.jpg'
            ],
            [
                'nama_barang' => 'WWF Attitude',
                'harga' => 20000,
                'stok' => 30,
                'gambar' => 'wwf-attitude.jpg'
            ],
            [
                'nama_barang' => 'Tenchu',
                'harga' => 10000,
                'stok' => 40,
                'gambar' => 'tenchu.jpg'
            ],
            [
                'nama_barang' => 'CTR',
                'harga' => 20000,
                'stok' => 30,
                'gambar' => 'ctr.jpg'
            ],
            [
                'nama_barang' => 'Crash Bandicoot',
                'harga' => 20000,
                'stok' => 30,
                'gambar' => 'crash-bandicoot.jpg'
            ],
            [
                'nama_barang' => 'Super soccer',
                'harga' => 20000,
                'stok' => 30,
                'gambar' => 'super-soccer.jpg'
            ],
            [
                'nama_barang' => 'Mortal Kombat',
                'harga' => 20000,
                'stok' => 30,
                'gambar' => 'mortal-kombat.jpg'
            ],
            [
                'nama_barang' => 'Smack Down',
                'harga' => 20000,
                'stok' => 30,
                'gambar' => 'smackdown.jpg'
            ],
        ];

        // Using Query Builder
        $this->db->table('barang')->insertBatch($data);
    }
}
