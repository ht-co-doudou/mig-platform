<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddPermissionGroupIdToManagersTable extends AbstractMigration
{
    private $tableName = 'managers';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('permission_group_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'null' => true, 'signed' => false, 'comment' => 'mapping permission_groups.id', 'after' => 'parent_id'])
            ->save();

        $this->table($this->tableName)
            ->addForeignKey('permission_group_id', 'permission_groups', 'id', ['constraint' => "fk_{$this->tableName}_permission_group_id"])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->dropForeignKey('permission_group_id', "fk_{$this->tableName}_permission_group_id")
            ->save();

        $this->table($this->tableName)
            ->removeColumn('permission_group_id')
            ->save();
    }
}
