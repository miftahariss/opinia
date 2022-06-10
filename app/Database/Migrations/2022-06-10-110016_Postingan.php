<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Postingan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'post_type' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'user' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'created_date datetime default current_timestamp',
            'updated_date datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('postingan');
    }

    public function down()
    {
        //
    }
}
