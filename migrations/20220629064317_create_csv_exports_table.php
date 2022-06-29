<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateCsvExportsTable extends AbstractMigration
{
    private $tableName = 'csv_exports';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id'          => false,
            'primary_key' => 'id',
            'collation'   => 'utf8mb4_unicode_ci',
            'comment'     => '匯出紀錄',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('file_number', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'default' => null, 'comment' => '檔案數量'])
            ->addColumn('metadata', 'json', ['comment' => '操作資訊'])
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '類型 CsvExport/Type'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 CsvExport/Status'])
            ->addColumn('operator', 'string', ['limit' => 30, 'null' => true, 'comment' => '操作人'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
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
