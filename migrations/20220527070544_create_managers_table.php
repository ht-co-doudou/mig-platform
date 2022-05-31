<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateManagersTable extends AbstractMigration
{
    private $tableName = 'managers';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '管理員',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('parent_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'null' => true, 'comment' => 'mapping managers.id'])
            ->addColumn('uid', 'char', ['limit' => 32, 'comment' => 'UUID'])
            ->addColumn('username', 'string', ['limit' => 30, 'comment' => '帳號'])
            ->addColumn('password', 'string', ['limit' => 60, 'comment' => '密碼'])
            ->addColumn('nickname', 'string', ['limit' => 30, 'comment' => '暱稱'])
            ->addColumn('last_login_ip', 'varbinary', ['limit' => 16, 'null' => true, 'comment' => '最後登入 IP'])
            ->addColumn('last_login_at', 'timestamp', ['null' => true, 'comment' => '最後登入時間'])
            ->addColumn('metadata', 'json', ['comment' => '管理員資訊'])
            ->addColumn('note', 'string', ['limit' => 255, 'null' => true, 'comment' => '後台備註'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 Manager/Type'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 Manager/Status'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('delete_at', 'timestamp', ['null' => true, 'comment' => '刪除時間'])
            ->save();

        $table->addIndex('uid', ['unique' => true, 'name' => 'idx_uid_unique'])
            ->addIndex('username', ['unique' => true, 'name' => 'idx_username_unique'])
            ->save();

        $table->addForeignKey('parent_id', 'managers', 'id', ['constraint' => "fk_{$this->tableName}_parent_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
