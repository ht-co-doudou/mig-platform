<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateCsvImportTokenTicket extends AbstractMigration
{
    private $tableName = 'csv_import_token_ticket';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id'          => false,
            'primary_key' => 'id',
            'collation'   => 'utf8mb4_unicode_ci',
            'comment'     => '豆豆幣、觀影天數、觀影券匯入紀錄',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('csv_import_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping csv_imports.id'])
            ->addColumn('username', 'string', ['limit' => 30, 'comment' => '帳號'])
            ->addColumn('token_coin', 'decimal', ['precision' => 16, 'scale' => 4, 'comment' => '豆豆幣'])
            ->addColumn('days', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'comment' => '觀影天數'])
            ->addColumn('ticket', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'comment' => '觀影券'])
            ->addColumn('note', 'string', ['limit' => 255, 'null' => true, 'comment' => '後台備註'])
            ->addColumn('operator', 'string', ['limit' => 30, 'null' => true, 'comment' => '操作人'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addForeignKey('site_id', 'sites', 'id', ['constraint' => "fk_{$this->tableName}_site_id"])
            ->addForeignKey('csv_import_id', 'csv_imports', 'id', ['constraint' => "fk_{$this->tableName}_csv_import_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
