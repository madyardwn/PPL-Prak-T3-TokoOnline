<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    {
        $data = [
        [
        'username' => 'admin',
        'password' => md5('password'),
        ],
        [
        'username' => 'madya',
        'password' => md5('ridwan'),
        ],
        ];
        $this->db->table('admin')->insertBatch($data);

        $this->db->table('ongkir')->insertBatch(
            [
            [
            'kodepos_awal' => '40111',
            'kodepos_tujuan' => '40111',
            'ongkir_per_kilo' => '10000',
            ],
            [
            'kodepos_awal' => '40111',
            'kodepos_tujuan' => '40112',
            'ongkir_per_kilo' => '15000',
            ],
            [
            'kodepos_awal' => '40111',
            'kodepos_tujuan' => '40113',
            'ongkir_per_kilo' => '20000',
            ]
            ]
        );
    }
}
