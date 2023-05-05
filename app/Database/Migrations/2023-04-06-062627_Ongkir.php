<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ongkir extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id'  => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'kodepos_awal' => [
                    'type' => 'VARCHAR',
                    'constraint' => '5',
                ],
                'kodepos_tujuan' => [
                    'type' => 'VARCHAR',
                    'constraint' => '5',
                ],
                'ongkir_per_kilo' => [
                    'type' => 'INT',
                    'constraint' => '11',
                ],
            ]
        );

        $this->forge->addKey('id', true);
        $this->forge->createTable('ongkir');
    }

    public function down()
    {
        $this->forge->dropTable('ongkir');
    }
}
