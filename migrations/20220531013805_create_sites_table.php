<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSitesTable extends AbstractMigration
{
    private $tableName = 'sites';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('partner_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping managers.id'])
            ->addColumn('webmaster_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping managers.id'])
            ->addColumn('code', 'string', ['limit' => 30, 'comment' => '站台代碼'])
            ->addColumn('name', 'string', ['limit' => 30, 'comment' => '名稱'])
            ->addColumn('metadata', 'json', ['comment' => '網站資訊'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 Site/Status'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->save();

        $table->addIndex('code', ['unique' => true, 'name' => 'idx_code_unique'])
            ->save();

        $table->addForeignKey('partner_id', 'managers', 'id', ['constraint' => "fk_{$this->tableName}_partner_id"])
            ->addForeignKey('webmaster_id', 'managers', 'id', ['constraint' => "fk_{$this->tableName}_webmaster_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
