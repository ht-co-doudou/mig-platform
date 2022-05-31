<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateOperateLogsTable extends AbstractMigration
{
    private $tableName = 'operate_logs';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '操作日誌',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'null' => true, 'comment' => 'mapping sites.id'])
            ->addColumn('log_name', 'string', ['limit' => 50, 'comment' => '操作名稱'])
            ->addColumn('subject_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'null' => true, 'comment' => 'MorphTo subject_id'])
            ->addColumn('subject_type', 'string', ['limit' => 50, 'null' => true, 'comment' => 'MorphTo subject_type'])
            ->addColumn('operator', 'string', ['limit' => 30, 'comment' => '操作人'])
            ->addColumn('ip', 'varbinary', ['limit' => 16, 'comment' => '操作 IP'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 OperateLog/Type'])
            ->addColumn('properties', 'json', ['comment' => '操作資訊'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->addIndex(['create_at', 'type'], ['name' => 'idx_create_at_type'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
