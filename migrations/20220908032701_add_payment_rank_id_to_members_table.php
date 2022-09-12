<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddPaymentRankIdToMembersTable extends AbstractMigration
{
    private $tableName = 'members';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('payment_rank_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'null' => true, 'signed' => false, 'comment' => 'mapping payment_ranks.id', 'after' => 'site_id'])
            ->save();

        $this->table($this->tableName)
            ->addForeignKey('payment_rank_id', 'payment_ranks', 'id', ['constraint' => "fk_{$this->tableName}_payment_rank_id"])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->dropForeignKey('payment_rank_id', "fk_{$this->tableName}_payment_rank_id")
            ->save();

        $this->table($this->tableName)
            ->removeColumn('payment_rank_id')
            ->save();
    }
}
