<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penjualan extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'no_transaksi' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'id_barang' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                ],
                'jumlah_jual' => [
                    'type' => 'INT',
                    'constraint' => 11,
                ],
                'harga_jual' => [
                    'type' => 'INT',
                    'constraint' => 11,
                ],
            ]
        );

        $this->forge->addForeignKey('no_transaksi', 'transaksi', 'no_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_barang', 'barang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penjualan');
    }

    public function down()
    {
        $this->forge->dropTable('penjualan');
    }
}
