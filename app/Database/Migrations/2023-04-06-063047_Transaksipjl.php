<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksipjl extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'idtrans'  => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                ],
                'nama'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'hp' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'alamat' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'kecamatan' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'kota' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'kodepos' => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                ],
                'total' => [
                    'type' => 'INT',
                    'constraint' => '11',
                ],
            ]
        );

        $this->forge->addKey('idtrans', true);
        $this->forge->addForeignKey('kodepos', 'ongkir', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('idtrans', 'transaksipjl', 'idtrans', 'CASCADE', 'CASCADE');

        $this->forge->createTable('transaksipjl');
    }

    public function down()
    {
        $this->forge->dropTable('transaksipjl');
    }
}
