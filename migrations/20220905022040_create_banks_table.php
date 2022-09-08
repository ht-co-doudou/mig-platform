<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateBanksTable extends AbstractMigration
{
    private $tableName = 'banks';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '銀行',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('swift_code', 'char', ['limit' => 11, 'comment' => '銀行代碼'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '名稱'])
            ->addColumn('website', 'string', ['limit' => 255, 'comment' => '官網'])
            ->save();

        $table->addIndex('swift_code', ['unique' => true, 'name' => 'idx_swift_code_unique'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
