<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'no_transaksi' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],                
                'tanggal_transaksi' => [
                    'type' => 'DATE',
                ],
                'total_transaksi' => [
                    'type' => 'INT',
                    'constraint' => 11,
                ],
                'nama_pembeli' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'alamat' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'kecamatan' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'kota' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
            ]
        );

        $this->forge->addKey('no_transaksi', true);
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
