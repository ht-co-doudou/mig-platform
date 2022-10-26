<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateDonateOrdersTable extends AbstractMigration
{
    private $tableName = 'donate_orders';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '打賞創作者',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('payee_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('withdrawer_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping creators.id'])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('order_id', 'string', ['limit' => 50, 'comment' => '訂單 ID'])
            ->addColumn('diamond', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '轉出豆豆幣'])
            ->addColumn('gold', 'decimal', ['precision' => 16, 'scale' => 4, 'default' => 0, 'comment' => '轉入金豆幣'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addIndex(['site_id', 'payee_id'], ['name' => 'idx_site_id_payee_id'])
            ->addIndex(['site_id', 'withdrawer_id'], ['name' => 'idx_site_id_withdrawer_id'])
            ->addIndex('order_id', ['name' => 'idx_order_id'])
            ->save();

        $table->addForeignKey('payee_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_payee_id"])
            ->addForeignKey('withdrawer_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_withdrawer_id"])
            ->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
