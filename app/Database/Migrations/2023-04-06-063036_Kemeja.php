<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kemeja extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'idkemeja'  => [
                    'type'           => 'INT',
                    'constraint'     => 5,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'namabrg'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                ],
                'harga' => [
                    'type' => 'INT',
                    'constraint' => '11',
                ],
                'diskon' => [
                    'type' => 'INT',
                    'constraint' => '11',
                ],
                'stok' => [
                    'type' => 'INT',
                    'constraint' => '11',
                ],
                'namafile' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'berat' => [
                    'type' => 'INT',
                    'constraint' => '11',
                ],
            ]
        );

        $this->forge->addKey('idkemeja', true);
        $this->forge->createTable('kemeja');
    }

    public function down()
    {
        $this->forge->dropTable('kemeja');
    }
}
