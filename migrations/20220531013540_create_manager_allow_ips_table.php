<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class CreateManagerAllowIpsTable extends AbstractMigration
{
    private $tableName = 'manager_allow_ips';

    public function up()
    {
        $table = $this->table($this->tableName, [
            'id' => false,
            'primary_key' => 'id',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '管理員登入白名單',
        ]);

        $table->addColumn('id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'identity' => true])
            ->addColumn('manager_id', 'integer', ['limit' => MysqlAdapter::INT_REGULAR, 'signed' => false, 'comment' => 'mapping managers.id'])
            ->addColumn('ip', 'varbinary', ['limit' => 16, 'comment' => '允許登入 IP'])
            ->save();

        $table->addForeignKey('manager_id', 'managers', 'id', ['constraint' => "fk_{$this->tableName}_manager_id", 'delete' => 'CASCADE'])
            ->save();
    }

    public function down()
    {
        if ($this->hasTable($this->tableName)) {
            $this->table($this->tableName)->drop()->save();
        }
    }
}
