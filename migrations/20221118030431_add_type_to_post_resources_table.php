<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddTypeToPostResourcesTable extends AbstractMigration
{
    private $tableName = 'post_resources';

    public function up()
    {
        $this->table($this->tableName)
            ->addColumn('type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'after' => 'status', 'comment' => '資源類型'])
            ->save();
    }

    public function down()
    {
        $this->table($this->tableName)
            ->removeColumn('type')
            ->save();
    }
}
