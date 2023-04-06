<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksipjl extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idtrans'  => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
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
            'total' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
        ]);

        $this->forge->addKey('idtrans', true);
        $this->forge->createTable('transaksipjl');
    }

    public function down()
    {
        $this->forge->dropTable('transaksipjl');
    }
}
