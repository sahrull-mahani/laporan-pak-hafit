<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Main extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'tanggal' => ['type' => 'date'],
            'materi' => ['type' => 'char', 'constraint' => 150],
            'kelas' => ['type' => 'char', 'constraint' => 50, 'null' => true],
            'mapel' => ['type' => 'char', 'constraint' => 150, 'null' => true],
            'jumlah' => ['type' => 'tinyint', 'constraint' => 3, 'null' => true],
            'hadir' => ['type' => 'tinyint', 'constraint' => 3, 'null' => true],
            'tidak_hadir' => ['type' => 'tinyint', 'constraint' => 3, 'null' => true],
            'alasan' => ['type' => 'char', 'constraint' => 200],
            'dokumentasi' => ['type' => 'char', 'constraint' => 200, 'null' => true],
            'keterangan' => ['type' => 'char', 'constraint' => 200],
            'created_at' => ['type' => 'date'],
            'updated_at' => ['type' => 'date'],
            'deleted_at' => ['type' => 'date', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('main', true);
    }

    public function down()
    {
        $this->forge->dropTable('main', true);
    }
}
