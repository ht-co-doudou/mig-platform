<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateDomainNamesTable extends AbstractMigration
{
    private $tableName = 'domain_names';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '域名',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('site_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping sites.id'])
            ->addColumn('domain', 'string', ['limit' => 255, 'comment' => '域名'])
            ->addColumn('create_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'comment' => '建立時間'])
            ->addColumn('update_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP', 'comment' => '更新時間'])
            ->save();

        $table->addIndex('domain', ['unique' => true, 'name' => 'idx_domain_unique'])
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
