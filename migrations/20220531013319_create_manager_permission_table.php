<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateManagerPermissionTable extends AbstractMigration
{
    private $tableName = 'manager_permissions';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => ['manager_id', 'permission_id'],
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '管理員權限',
        ]);

        $table->addColumn('manager_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping managers.id'])
            ->addColumn('permission_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping permissions.id'])
            ->save();

        $table->addForeignKey('manager_id', 'managers', 'id', ['constraint' => "fk_{$this->tableName}_manager_id", 'delete' => 'CASCADE'])
            ->addForeignKey('permission_id', 'permissions', 'id', ['constraint' => "fk_{$this->tableName}_permission_id", 'delete' => 'CASCADE'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
