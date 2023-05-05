<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Detailjual extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idtrans'       => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'idkemeja' => [
                'type' => 'INT',
                'constraint' => '5',
                'unsigned'       => true,
            ],
            'hargajual' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'jmljual' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
        ]);

        $this->forge->addForeignKey('idtrans', 'transaksipjl', 'idtrans', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idkemeja', 'kemeja', 'idkemeja', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detailjual');
    }

    public function down()
    {
        $this->forge->dropTable('detailjual');
    }
}
