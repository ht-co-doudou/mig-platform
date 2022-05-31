<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePermissionsTable extends AbstractMigration
{
    private $tableName = 'permissions';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '權限',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('code', 'string', ['limit' => 30, 'comment' => '代碼'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '名稱'])
            ->addColumn('allow', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => 'BCD：2-站長、1-總管'])
            ->save();

        $table->addIndex('code', ['unique' => true, 'name' => 'idx_code_unique'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
