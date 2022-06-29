<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateCsvExportFilesTable extends AbstractMigration
{
    private $tableName = 'csv_export_files';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id'          => false,
            'primary_key' => 'id',
            'collation'   => 'utf8mb4_unicode_ci',
            'comment'     => '檔案匯出紀錄',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('csv_export_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping csv_exports.id'])
            ->addColumn('path', 'string', ['limit' => 255, 'comment' => '路徑'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addForeignKey('csv_export_id', 'csv_exports', 'id', ['constraint' => "fk_{$this->tableName}_csv_export_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
