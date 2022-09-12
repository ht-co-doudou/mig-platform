<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePaymentRanksTable extends AbstractMigration
{
    private $tableName = 'payment_ranks';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '支付層級',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '名稱'])
            ->addColumn('bonus_require', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '發送優惠金所需入款'])
            ->addColumn('bonus_pct', 'decimal', ['precision' => 4, 'scale' => 1, 'signed' => false, 'comment' => '優惠金百分比 0.0~100.0'])
            ->addColumn('bonus_max', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '優惠金上限'])
            ->addColumn('withdraw_max', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '出款上限'])
            ->addColumn('withdraw_min', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '出款下限'])
            ->addColumn('fee_pct', 'decimal', ['precision' => 4, 'scale' => 1, 'signed' => false, 'comment' => '手續費百分比 0.0~100.0'])
            ->addColumn('fee_max', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '手續費上限'])
            ->addColumn('free_fee_hour', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => '免手續費時數 (小時)'])
            ->addColumn('free_fee_num', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => '免手續費次數'])
            ->addColumn('dml_ratio', 'decimal', ['precision' => 5, 'scale' => 2, 'signed' => false, 'comment' => '打碼量倍率 0.00~100.00'])
            ->addColumn('bonus_dml_ratio', 'decimal', ['precision' => 5, 'scale' => 2, 'signed' => false, 'comment' => '優惠金打碼量倍率 0.00~100.00'])
            ->addColumn('cost_pct', 'decimal', ['precision' => 4, 'scale' => 1, 'signed' => false, 'comment' => '行政費百分比 0.0~100.0'])
            ->addColumn('note', 'string', ['limit' => 255, 'null' => true, 'comment' => '後台備註'])
            ->addColumn('default', 'boolean', ['default' => false, 'comment' => '是否預設層級'])
            ->addColumn('order', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '排序'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
