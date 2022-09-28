<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateVendorTxOrdersTable extends AbstractMigration
{
    private $tableName = 'vendor_tx_orders';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '平台商轉帳訂單',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('member_type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '會員類型 Member/Type'])
            ->addColumn('order_id', 'string', ['limit' => 50, 'comment' => '訂單 ID'])
            ->addColumn('amount', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '交易金額'])
            ->addColumn('balance', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '餘額'])
            ->addColumn('lien', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '圈存金額'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 VendorTxOrders/Type'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 VendorTxOrders/Status'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex(['site_id', 'order_id'], ['unique' => true, 'name' => 'idx_site_id_order_id_unique'])
            ->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->addForeignKey('member_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_member_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
