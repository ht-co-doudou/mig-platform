<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePromotionOrdersTable extends AbstractMigration
{
    private $tableName = 'promotion_orders';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '兌換紀錄',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('member_type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '會員類型 Member/Type'])
            ->addColumn('promotion_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping promotions.id'])
            ->addColumn('promotion_code_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping promotion_code.id'])
            ->addColumn('order_id', 'string', ['limit' => 50, 'comment' => '訂單 ID'])
            ->addColumn('detail', 'json', ['null' => true, 'comment' => '兌換紀錄詳細'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addIndex(['site_id', 'member_type'], ['name' => 'idx_site_id_member_type'])
            ->addIndex('member_id', ['name' => 'idx_member_id'])
            ->addIndex('order_id', ['name' => 'idx_order_id'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
