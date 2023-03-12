<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tabelpelajaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelajaran' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true,],
            'nama_pelajaran' => ['type' => 'VARCHAR', 'constraint' => 50,],
            'created_at' => ['type' => 'datetime', 'null' => true,],
            'updated_at' => ['type' => 'datetime', 'null' => true,],
            'deleted_at' => ['type' => 'datetime', 'null' => true,],
        ]);
        $this->forge->addKey('id_pelajaran', true);
        $this->forge->createTable('tb_pelajaran');
    }

    public function down()
    {
        $this->forge->dropTable('tb_pelajaran');
    }
}
