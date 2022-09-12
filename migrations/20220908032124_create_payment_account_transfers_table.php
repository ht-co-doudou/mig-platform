<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePaymentAccountTransfersTable extends AbstractMigration
{
    private $tableName = 'payment_account_transfers';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['payment_rank_id', 'site_account_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '支付方式綁定：銀行轉帳',
        ]);

        $table->addColumn('payment_rank_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping payment_ranks.id'])
            ->addColumn('site_account_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping site_accounts.id'])
            ->save();

        $table->addForeignKey('payment_rank_id', 'payment_ranks', 'id', ['constraint' => "fk_{$this->tableName}_payment_rank_id", 'delete' => 'CASCADE'])
            ->addForeignKey('site_account_id', 'site_accounts', 'id', ['constraint' => "fk_{$this->tableName}_site_account_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
