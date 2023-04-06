<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Detailjual extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idtrans'       => [
                'type'       => 'INT',
                'constraint' => '5',
            ],
            'idkemeja' => [
                'type' => 'INT',
                'constraint' => '5',
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

        $this->forge->addKey('idtrans', true);
        $this->forge->addKey('idkemeja', true);
        $this->forge->createTable('detailjual');
    }

    public function down()
    {
        $this->forge->dropTable('detailjual');
    }
}
