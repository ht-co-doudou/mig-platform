<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePaymentThirdPartyTransfersTable extends AbstractMigration
{
    private $tableName = 'payment_third_party_transfers';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['payment_rank_id', 'site_third_party_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '支付方式綁定：三方支付轉帳',
        ]);

        $table->addColumn('payment_rank_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping payment_ranks.id'])
            ->addColumn('site_third_party_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping site_third_partys.id'])
            ->save();

        $table->addForeignKey('payment_rank_id', 'payment_ranks', 'id', ['constraint' => "fk_{$this->tableName}_payment_rank_id", 'delete' => 'CASCADE'])
            ->addForeignKey('site_third_party_id', 'site_third_partys', 'id', ['constraint' => "fk_{$this->tableName}_site_third_party_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
