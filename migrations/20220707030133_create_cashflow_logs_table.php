<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateCashflowLogsTable extends AbstractMigration
{
    private $tableName = 'cashflow_logs';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '金流紀錄',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('member_type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '會員類型 Member/Type'])
            ->addColumn('member_line_code', 'string', ['limit' => 12, 'default' => 'default', 'comment' => '會員站點標示'])
            ->addColumn('order_id', 'string', ['limit' => 50, 'comment' => '訂單 ID'])
            ->addColumn('balance_change', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '金幣異動'])
            ->addColumn('lien_change', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '圈存異動'])
            ->addColumn('diamond_change', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '代幣異動'])
            ->addColumn('balance', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '金幣餘額'])
            ->addColumn('lien', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '圈存金額'])
            ->addColumn('diamond', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '代幣餘額'])
            ->addColumn('metadata', 'json', ['comment' => '詳細資訊'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_SMALL, 'signed' => false, 'comment' => '類型 CashflowLog/Type'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addIndex(['site_id', 'member_type'], ['name' => 'idx_site_id_member_type'])
            ->addIndex('member_id', ['name' => 'idx_member_id'])
            ->addIndex('order_id', ['name' => 'idx_order_id'])
            ->addIndex('create_at', ['name' => 'idx_create_at'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
