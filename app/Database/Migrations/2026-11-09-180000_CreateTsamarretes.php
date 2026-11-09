<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTsamarretes extends Migration
{
    /** Columnes de quantitat, una per talla (vegeu Config\Samarretes) */
    private const TALLES = [
        'q_3_4', 'q_5_6', 'q_7_8', 'q_9_11', 'q_xs',
        'q_s', 'q_m', 'q_l', 'q_xl', 'q_2xl', 'q_3xl', 'q_4xl',
    ];

    public function up(): void
    {
        $camps = [
            'id'      => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'nom'     => ['type' => 'VARCHAR', 'constraint' => 150],
            'email'   => ['type' => 'VARCHAR', 'constraint' => 254],
            'telefon' => ['type' => 'VARCHAR', 'constraint' => 20],
        ];

        foreach (self::TALLES as $columna) {
            $camps[$columna] = ['type' => 'SMALLINT', 'unsigned' => true, 'default' => 0];
        }

        $camps += [
            'total'      => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ];

        $this->forge->addField($camps);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey('email');
        $this->forge->createTable('tsamarretes');
    }

    public function down(): void
    {
        $this->forge->dropTable('tsamarretes');
    }
}
