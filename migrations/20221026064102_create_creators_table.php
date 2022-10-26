<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateCreatorsTable extends AbstractMigration
{
    private $tableName = 'creators';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '創作者',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('describe', 'string', ['limit' => 255, 'null' => true, 'comment' => '創作者描述'])
            ->addColumn('fans', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '粉絲數'])
            ->addColumn('follow', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => 0, 'comment' => '追縱數'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 Audit/Type'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 Audit/Status'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex(['member_id', 'create_at'], ['name' => 'idx_member_id_create_at'])
            ->save();

        $table->addForeignKey('member_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_member_id"])
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
