<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TabelDataDiri extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_data_diri' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true,],
            'users_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'unique' => true],
            'nisn' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 50,],
            'jenis_kelamin' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'agama' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'kelas' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'alamat' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'nip' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'jabatan' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'created_at' => ['type' => 'datetime', 'null' => true,],
            'updated_at' => ['type' => 'datetime', 'null' => true,],
            'deleted_at' => ['type' => 'datetime', 'null' => true,],
        ]);
        $this->forge->addKey('id_data_diri', true);
        $this->forge->addForeignKey('users_id', 'tb_users', 'id_users', 'cascade', 'cascade');
        $this->forge->createTable('tb_data_diri');
    }

    public function down()
    {
        $this->forge->dropForeignKey('tb_data_diri', 'tb_data_diri_users_id_foreign');
        $this->forge->dropTable('tb_data_diri');
    }
}
