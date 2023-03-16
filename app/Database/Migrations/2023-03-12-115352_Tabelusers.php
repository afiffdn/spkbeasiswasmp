<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabelusers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_users' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true,],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50,],
            'password' => ['type' => 'VARCHAR', 'constraint' => 225,],
            'sebagai' => ['type' => 'VARCHAR', 'constraint' => 50,],
            'created_at' => ['type' => 'datetime', 'null' => true,],
            'updated_at' => ['type' => 'datetime', 'null' => true,],
            'deleted_at' => ['type' => 'datetime', 'null' => true,],
        ]);
        $this->forge->addKey('id_users', true);
        $this->forge->createTable('tb_users');
    }

    public function down()
    {
        $this->forge->dropTable('tb_users');
    }
}
