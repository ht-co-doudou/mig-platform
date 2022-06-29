<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateFailedJobsTable extends AbstractMigration
{
    private $tableName = 'failed_jobs';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '執行失敗的 Queue Job',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_BIG, 'signed' => false, 'identity' => true])
            ->addColumn('connection', 'text', ['comment' => 'Connection 名稱'])
            ->addColumn('queue', 'text', ['comment' => 'Queue 名稱'])
            ->addColumn('payload', 'text', ['limit' => MysqlAdapter::TEXT_LONG, 'comment' => '乘載數據'])
            ->addColumn('exception', 'text', ['limit' => MysqlAdapter::TEXT_LONG, 'comment' => '例外錯誤'])
            ->addColumn('failed_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '失敗時間'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
