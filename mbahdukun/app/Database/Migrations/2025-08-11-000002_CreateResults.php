<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateResults extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true ],
            'reference' => [ 'type' => 'VARCHAR', 'constraint' => 32 ],
            'content' => [ 'type' => 'MEDIUMTEXT' ],
            'created_at' => [ 'type' => 'DATETIME', 'null' => true ],
            'updated_at' => [ 'type' => 'DATETIME', 'null' => true ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('reference');
        $this->forge->createTable('results');
    }

    public function down()
    {
        $this->forge->dropTable('results');
    }
}