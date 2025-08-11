<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [ 'type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true ],
            'reference' => [ 'type' => 'VARCHAR', 'constraint' => 32 ],
            'service' => [ 'type' => 'VARCHAR', 'constraint' => 20 ],
            'data' => [ 'type' => 'TEXT' ],
            'email' => [ 'type' => 'VARCHAR', 'constraint' => 100 ],
            'amount' => [ 'type' => 'INT', 'constraint' => 11 ],
            'status' => [ 'type' => 'VARCHAR', 'constraint' => 20, 'default' => 'UNPAID' ],
            'payment_url' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'payment_qr_string' => [ 'type' => 'TEXT', 'null' => true ],
            'payment_qr_url' => [ 'type' => 'VARCHAR', 'constraint' => 255, 'null' => true ],
            'tripay_ref' => [ 'type' => 'VARCHAR', 'constraint' => 64, 'null' => true ],
            'created_at' => [ 'type' => 'DATETIME', 'null' => true ],
            'updated_at' => [ 'type' => 'DATETIME', 'null' => true ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('reference');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}