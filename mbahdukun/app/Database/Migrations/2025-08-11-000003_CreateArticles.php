<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true ],
            'title' => [ 'type' => 'VARCHAR', 'constraint' => 200 ],
            'slug' => [ 'type' => 'VARCHAR', 'constraint' => 200 ],
            'content' => [ 'type' => 'MEDIUMTEXT' ],
            'meta_description' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'published_at' => [ 'type' => 'DATETIME', 'null' => true ],
            'created_at' => [ 'type' => 'DATETIME', 'null' => true ],
            'updated_at' => [ 'type' => 'DATETIME', 'null' => true ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('slug');
        $this->forge->createTable('articles');
    }

    public function down()
    {
        $this->forge->dropTable('articles');
    }
}