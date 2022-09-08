<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateFourthH5sTable extends AbstractMigration
{
    private $tableName = 'fourth_h5s';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['fourth_party_id', 'channel', 'channel_code'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '四方支付商號設定：H5',
        ]);

        $table->addColumn('fourth_party_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping fourth_partys.id'])
            ->addColumn('channel', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => 'H5 支付通道 FourthParty/H5/Channel'])
            ->addColumn('channel_code', 'string', ['limit' => 255, 'default' => 'default', 'comment' => '支付代碼'])
            ->addColumn('channel_name', 'string', ['limit' => 30, 'null' => true, 'comment' => '渠道名稱'])
            ->addColumn('deposit_max', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '入款上限'])
            ->addColumn('deposit_min', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '入款下限'])
            ->addColumn('deposit_amount', 'string', ['limit' => 255, 'comment' => '入款限定金額'])
            ->addColumn('deposit_type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 1, 'comment' => '入款金額類型 FourthParty/DepositType'])
            ->addColumn('remark', 'string', ['limit' => 255, 'null' => true, 'comment' => '前台備註'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 1, 'comment' => '狀態 FourthParty/H5/Status'])
            ->save();

        $table->addForeignKey('fourth_party_id', 'fourth_partys', 'id', ['constraint' => "fk_{$this->tableName}_fourth_party_id", 'delete' => 'CASCADE'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
