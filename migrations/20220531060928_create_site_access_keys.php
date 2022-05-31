<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSiteAccessKeys extends AbstractMigration
{
    private $tableName = 'site_access_keys';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'site_id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台存取密鑰',
        ]);

        $table->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('id', 'char', ['limit' => 32, 'comment' => '唯一 ID'])
            ->addColumn('secret', 'char', ['limit' => 32, 'comment' => '密鑰'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex('id', ['unique' => true, 'name' => 'idx_id_unique'])
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
