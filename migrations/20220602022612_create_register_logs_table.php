<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateRegisterLogsTable extends AbstractMigration
{
    private $tableName = 'register_logs';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '會員註冊紀錄',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('member_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping members.id'])
            ->addColumn('domain_name_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'null' => true, 'comment' => 'mapping domain_names.id'])
            ->addColumn('ip', 'varbinary', ['limit' => 16, 'comment' => '註冊 IP'])
            ->addColumn('domain', 'string', ['limit' => 255, 'comment' => '註冊域名'])
            ->addColumn('register_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '註冊時間'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->addForeignKey('member_id', 'members', 'id', ['constraint' => "fk_{$this->tableName}_member_id", 'delete' => 'CASCADE'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
