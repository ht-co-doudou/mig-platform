<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateFourthUnionPaysTable extends AbstractMigration
{
    private $tableName = 'fourth_union_pays';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['fourth_party_id', 'bank_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '四方支付商號設定：銀聯',
        ]);

        $table->addColumn('fourth_party_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping fourth_partys.id'])
            ->addColumn('bank_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping banks.id'])
            ->save();

        $table->addForeignKey('fourth_party_id', 'fourth_partys', 'id', ['constraint' => "fk_{$this->tableName}_fourth_party_id", 'delete' => 'CASCADE'])
            ->addForeignKey('bank_id', 'banks', 'id', ['constraint' => "fk_{$this->tableName}_bank_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
