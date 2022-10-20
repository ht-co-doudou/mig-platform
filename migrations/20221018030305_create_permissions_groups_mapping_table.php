<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreatePermissionsGroupsMappingTable extends AbstractMigration
{
    private $tableName = 'permissions_groups_mapping';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['group_id', 'permission_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '站台權限群組與權限對應表',
        ]);

        $table->addColumn('group_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping permission_groups.id'])
            ->addColumn('permission_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping permissions.id'])
            ->save();

        $table->addForeignKey('group_id', 'permission_groups', 'id', ['constraint' => "fk_{$this->tableName}_group_id"])
            ->addForeignKey('permission_id', 'permissions', 'id', ['constraint' => "fk_{$this->tableName}_permission_id"])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
