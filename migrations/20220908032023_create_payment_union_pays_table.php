<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePaymentUnionPaysTable extends AbstractMigration
{
    private $tableName = 'payment_union_pays';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['payment_rank_id', 'fourth_party_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '支付方式綁定：銀聯',
        ]);

        $table->addColumn('payment_rank_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping payment_ranks.id'])
            ->addColumn('fourth_party_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping fourth_partys.id'])
            ->save();

        $table->addForeignKey('payment_rank_id', 'payment_ranks', 'id', ['constraint' => "fk_{$this->tableName}_payment_rank_id", 'delete' => 'CASCADE'])
            ->addForeignKey('fourth_party_id', 'fourth_partys', 'id', ['constraint' => "fk_{$this->tableName}_fourth_party_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
