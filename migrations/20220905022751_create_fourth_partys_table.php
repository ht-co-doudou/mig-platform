<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateFourthPartysTable extends AbstractMigration
{
    private $tableName = 'fourth_partys';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '四方支付商號',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('code', 'string', ['limit' => 30, 'comment' => '四方支付代碼'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '名稱'])
            ->addColumn('merchant_id', 'string', ['limit' => 255, 'comment' => '商家號'])
            ->addColumn('metadata', 'json', ['comment' => '四方支付資訊'])
            ->addColumn('online_bank_deposit_max', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'default' => 0, 'comment' => '網路銀行入款上限'])
            ->addColumn('online_bank_deposit_min', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'default' => 0, 'comment' => '網路銀行入款下限'])
            ->addColumn('online_bank_remark', 'string', ['limit' => 255, 'null' => true, 'comment' => '網路銀行前台備註'])
            ->addColumn('union_pay_deposit_max', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'default' => 0, 'comment' => '銀聯入款上限'])
            ->addColumn('union_pay_deposit_min', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'default' => 0, 'comment' => '銀聯入款下限'])
            ->addColumn('union_pay_remark', 'string', ['limit' => 255, 'null' => true, 'comment' => '銀聯前台備註'])
            ->addColumn('note', 'string', ['limit' => 255, 'null' => true, 'comment' => '後台備註'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 FourthParty/Status'])
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
