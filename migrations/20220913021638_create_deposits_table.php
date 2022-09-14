<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateDepositsTable extends AbstractMigration
{
    private $tableName = 'deposits';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '入款申請',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('txid', 'char', ['limit' => 32, 'comment' => 'UUID'])
            ->addColumn('amount', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '入款金額'])
            ->addColumn('actual_amount', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '實際入款金額'])
            ->addColumn('bonus', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '優惠金額'])
            ->addColumn('dml', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '打碼量'])
            ->addColumn('metadata', 'json', ['comment' => '入款資訊'])
            ->addColumn('remark', 'string', ['limit' => 255, 'null' => true, 'comment' => '前台備註'])
            ->addColumn('note', 'string', ['limit' => 255, 'null' => true, 'comment' => '後台備註'])
            ->addColumn('operator', 'string', ['limit' => 30, 'null' => true, 'comment' => '操作人'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 Deposit/Type'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 Deposit/Status'])
            ->addColumn('receive_at', 'timestamp', ['null' => true, 'comment' => '收到款項時間'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex('txid', ['unique' => true, 'name' => 'idx_txid_unique'])
            ->addIndex('receive_at', ['name' => 'idx_receive_at'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
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
