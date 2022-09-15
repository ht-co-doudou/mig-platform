<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateAuditsTable extends AbstractMigration
{
    private $tableName = 'audits';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '稽核點',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('amount', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '入款金額'])
            ->addColumn('bonus', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '優惠金額'])
            ->addColumn('dml', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'comment' => '打碼量'])
            ->addColumn('valid_bet_amount', 'decimal', ['precision' => 16, 'scale' => 4, 'signed' => false, 'default' => 0, 'comment' => '有效投注金額'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 Audit/Type'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 Audit/Status'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex(['member_id', 'create_at'], ['name' => 'idx_member_id_create_at'])
            ->save();

        $table->addForeignKey('member_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_member_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
