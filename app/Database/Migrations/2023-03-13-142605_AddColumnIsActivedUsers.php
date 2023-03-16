<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnIsActivedUsers extends Migration
{
    public function up()
    {
        $data = [
            'is_active' => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0, 'after' => 'sebagai']
        ];
        $this->forge->addColumn('tb_users', $data);
    }

    public function down()
    {
        $this->forge->dropColumn('tb_users', 'is_active');
    }
}
