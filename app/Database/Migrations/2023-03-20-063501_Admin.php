<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'nip' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'username' => [
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ],
                'password' => [
                    'type' => 'VARCHAR',
                    'constraint' => '150',
                ],
            ]
        );
        $this->forge->addKey('username', true);
        $this->forge->createTable('admin');
    }

    public function down()
    {
        $this->forge->dropTable('admin');
    }
}
