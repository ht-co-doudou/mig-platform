<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateSiteActorsTable extends AbstractMigration
{
    private $tableName = 'site_actors';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台演員',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('actor_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => '片庫演員id'])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('avatar', 'string', ['limit' => 255, 'null' => true, 'comment' => '頭像'])
            ->addColumn('hot', 'boolean', ['default' => false, 'comment' => '是否為人氣演員'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'comment' => '狀態 Actor/Status'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex(['actor_id', 'site_id'], ['unique' => true, 'name' => 'idx_actor_id_site_id_unique'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
